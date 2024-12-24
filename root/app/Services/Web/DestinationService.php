<?php

namespace App\Services\Web;

use App\Models\CategoryDestination;
use App\Models\Destination;
use App\Repositories\Contracts\DestinationRepository;
use App\Repositories\Contracts\LocationRepository;
use App\Repositories\Contracts\ImageRepository;
use App\Services\Contracts\DestinationServiceInterface;
use App\Traits\FileTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DestinationService implements DestinationServiceInterface
{
    use FileTrait {
        delete as deleteFile;
    }
    protected $destinationRepository;
    protected $imageRepository;
    protected $locationRepository;

    public function __construct(LocationRepository $locationRepository, DestinationRepository $destinationRepository, ImageRepository $imageRepository)
    {
        $this->locationRepository = $locationRepository;
        $this->destinationRepository = $destinationRepository;
        $this->imageRepository = $imageRepository;
    }
    public function getPopularDestinations()
    {
        $destinations = $this->destinationRepository
            ->with('images') // Tải trước quan hệ images
            ->orderBy('views', 'desc') // Sắp xếp theo lượt xem từ cao đến thấp
            ->take(5) // Lấy 5 kết quả đầu tiên
            ->get();

        return $destinations;
    }
    public function getAllDestinations()
    {
        $userId = Auth::id();
        $destinations = Destination::whereHas('users', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
            ->with('users')
            ->orderBy('updated_at', 'desc')
            ->paginate(PAGINATE_MAX_RECORD)
            ->withQueryString();

        return $destinations;
    }
    public function getAllDestinationsForRoom($paginate = true)
    {
        $userId = Auth::id();
        $query = Destination::whereHas('users', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
            ->with('users')
            ->orderBy('updated_at', 'desc');

        // Kiểm tra điều kiện paginate
        if (!$paginate) {
            return $query->get(); // Trả về toàn bộ dữ liệu nếu không cần phân trang
        }

        return $query->paginate(PAGINATE_MAX_RECORD)->withQueryString(); // Trả về dữ liệu đã phân trang
    }
    public function getDestination($id, $checkInDate = null, $checkOutDate = null, $guestCount = 2)
    {
        $checkInDate = $checkInDate ?: Carbon::today()->toDateString();
        $checkOutDate = $checkOutDate ?: Carbon::tomorrow()->toDateString();

        return $this->destinationRepository->with([
            'images',
            'locations',
            'convenients',
            'reviews' => function ($query) {
                $query->orderBy('rating', 'desc')->take(1);
            },
            'reviews.user',
            'rooms' => function ($query) use ($guestCount) {
                $query->select('*')
                    ->selectRaw('CASE
                    WHEN guest_quantity >= ? THEN guest_quantity - ? 
                    ELSE 1000 + (? - guest_quantity)
                    END as guest_diff', [$guestCount, $guestCount, $guestCount])
                    ->orderBy('guest_diff', 'asc')
                    ->orderByDesc('guest_quantity');
            },
            'rooms.variants' => function ($query) {
                $query->select('variants.id', 'variants.name', 'room_variant.price_per_night')
                    ->orderBy('room_variant.price_per_night', 'desc');
            },
            'rooms.roomLists' => function ($query) use ($checkInDate, $checkOutDate) {
                $query->whereDoesntHave('bookings', function ($subQuery) use ($checkInDate, $checkOutDate) {
                    $subQuery->where(function ($dateQuery) use ($checkInDate, $checkOutDate) {
                        $dateQuery->whereBetween('available_from', [$checkInDate, $checkOutDate])
                            ->orWhereBetween('available_to', [$checkInDate, $checkOutDate])
                            ->orWhere(function ($overlapQuery) use ($checkInDate, $checkOutDate) {
                                $overlapQuery->where('available_from', '<=', $checkInDate)
                                    ->where('available_to', '>=', $checkOutDate);
                            });
                    });
                });
            },
        ])->find($id);
    }

    public function createDestination($request)
    {

        $destinations = $request->input('destinations', []);
        foreach ($destinations as $index => $destinationData) {
            $data = [
                'location' => $destinationData['location'],
                'district' => $destinationData['district'],
                'ward' => $destinationData['ward'],
                'name' => $destinationData['name'],
                'detailed_address' => $destinationData['detailed_address'],
                'description' => $destinationData['description'],
            ];

            // Lưu địa điểm vào cơ sở dữ liệu
            $destination = $this->destinationRepository->create($data);

            // Xử lý và lưu ảnh (nếu có)
            $savedImages = [];
            $images = $request->file("destinations.{$index}.images", []); // Lấy ảnh từ form
            if (!empty($images)) {
                foreach ($images as $imgData) {
                    $filePath = $this->upload($imgData, DESTINATION_IMAGES_PATH);
                    $savedImages[] = $this->imageRepository->create([
                        'image' => $filePath,
                    ]);
                }

                // Gắn ảnh vào địa điểm
                $destination->images()->attach(array_column($savedImages, 'id'));
            }
            $user = auth()->user();
            $destination->users()->attach($user->id);

            // Lấy tên huyện và xã từ dữ liệu form
            $districtName = $destinationData['district'];
            $wardName = $destinationData['ward'];
            $districtCode = $destinationData['district_code'];
            $wardCode = $destinationData['ward_code'];
            // Tìm ID location từ tên
            $location = $this->locationRepository->where('name', $destinationData['location'])->first();

            if ($location) {
                // Lưu vào bảng location_destination
                DB::table('location_destination')->insert([
                    'location_id' => $location->id, // ID của location
                    'destination_id' => $destination->id,
                    'address' => "{$districtName}, {$wardName}", // Lưu tên huyện và xã vào cột address
                    'district_code' => $districtCode, // Lưu mã huyện (nếu cần)
                    'ward_code' => $wardCode, // Lưu mã xã (nếu cần)
                    'description' => $destinationData['description'], // Lưu mô tả
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {

                return false;
            }
            // Lấy danh sách danh mục và lưu vào bảng category_destination trực tiếp
            $categories = $destinationData['categoriesAdd'] ?? [];

            if (!empty($categories)) {
                $categoryData = [];
                foreach ($categories as $categoryId) {
                    $categoryData[] = [
                        'category_id' => $categoryId,
                        'destination_id' => $destination->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }

                // Lưu hàng loạt vào bảng category_destination
                DB::table('category_destination')->insert($categoryData);
            }
            // Xử lý tiện nghi
            $convenients = $destinationData['convenientsAdd'] ?? [];
            if (!empty($convenients)) {
                // Sử dụng phương thức attach để gắn các tiện nghi vào địa điểm
                $destination->convenients()->attach($convenients);
            }
        }

        return $destination;
    }


    public function updateDestination($request, $id)
    {
        $destination = $this->destinationRepository->find($id);

        // Cập nhật thông tin cơ bản của địa điểm
        $this->destinationRepository->update($request->all(), $id);

        // Xử lý ảnh cũ và mới
        $currentImages = $destination->images->pluck('id')->toArray();
        $existingImages = $request->input('existing_images', []);
        $savedImages = [];

        // Nếu có ảnh mới, upload ảnh mới và lưu lại
        if ($request->hasFile('destination_image')) {
            foreach ($request->file('destination_image') as $imgData) {
                $filePath = $this->upload($imgData, DESTINATION_IMAGES_PATH);
                $savedImage = $this->imageRepository->create(['image' => $filePath]);
                $savedImages[] = $savedImage->id;
            }
        }


        // Kết hợp ảnh cũ và ảnh mới
        $allImages = array_merge($existingImages, $savedImages);

        // Tìm các ảnh cũ không còn cần thiết
        $imagesToDelete = array_diff($currentImages, $allImages);

        // Xóa các ảnh cũ
        if (!empty($imagesToDelete)) {
            $this->deleteImages($imagesToDelete);
        }

        // Cập nhật lại các ảnh cho địa điểm
        $destination->images()->sync($allImages);

        // Cập nhật thông tin location, huyện, xã
        $districtCode = $request->input('district_code_edit');
        $wardCode = $request->input('ward_code_edit');
        $districtName = $request->input('district_name_edit');
        $wardName = $request->input('ward_name_edit');

        // Tìm location_id từ mã tỉnh
        $location = $this->locationRepository->where('code', $request->input('location_name'))->first();

        if ($location) {
            // Cập nhật nếu có sự thay đổi
            DB::table('location_destination')
                ->where('destination_id', $destination->id)
                ->update([
                    'location_id' => $location->id,
                    'address' => "{$districtName}, {$wardName}", // Lưu tên huyện và xã vào address
                    'district_code' => $districtCode, // Lưu mã huyện
                    'ward_code' => $wardCode, // Lưu mã xã
                    'description' => $request->input('description'),
                    'updated_at' => now(),
                ]);
        } else {
            return redirect()->back()->with('error', 'Location not found');
        }
        // Cập nhật danh sách danh mục cho địa điểm
        $categoryIds = $request->input('categories', []); // Lấy danh sách category_id từ request
        $destination->categories()->sync($categoryIds); // Đồng bộ danh mục với địa điểm
        // Cập nhật danh sách danh mục cho địa điểm
        $convenientsIds = $request->input('convenients', []); // Lấy danh sách category_id từ request
        $destination->convenients()->sync($convenientsIds); // Đồng bộ danh mục với địa điểm


        return $destination;
    }

    private function deleteImages(array $imageIds)
    {
        foreach ($imageIds as $imageId) {
            $image = $this->imageRepository->find($imageId);
            if ($image) {
                $this->deleteFile($image->image);
                $this->imageRepository->delete($imageId);
            }
        }
    }
    public function deleteDestination($id, $reason)
    {
        $destination = $this->destinationRepository->find($id);
        $destination->deleted_reason = $reason;
        $destination->save();
        $destination->delete();
    }

    // client
    public function getAll()
    {
        $destination = $this->destinationRepository->get();
        return $destination;
    }
    public function getTrash()
    {
        $destinations = Destination::onlyTrashed()
            ->with(['images' => function ($query) {
                // Nếu images cũng sử dụng soft delete
                $query->withTrashed();
            }])
            ->orderBy('deleted_at', 'desc')
            ->paginate(PAGINATE_MAX_RECORD)
            ->appends(request()->query());
        return $destinations;
    }
    public function restoreTrash($id)
    {
        $destination = Destination::onlyTrashed()->find($id);
        $destination->restore();
        return $destination;
    }
    public function forceDelete($id)
    {
        $destination = Destination::onlyTrashed()->find($id);
        $destination->forceDelete();
        return $destination;
    }
}
