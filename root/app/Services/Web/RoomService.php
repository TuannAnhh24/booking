<?php

namespace App\Services\Web;

use App\Models\Room;
use App\Repositories\Contracts\DestinationRepository;
use App\Repositories\Contracts\ImageRepository;
use App\Repositories\Contracts\RoomRepository;
use App\Repositories\Contracts\VariantRepository;
use App\Services\Contracts\RoomListServiceInterface;
use App\Services\Contracts\RoomServiceInterface;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RoomService implements RoomServiceInterface
{
    use FileTrait {
        delete as deleteFile;
    }

    protected $roomRepository;
    protected $imageRepository;

    protected $destinationRepository;
    protected $variantRepository;
    protected $roomListRepository;
    public function __construct(
        RoomRepository $roomRepository,
        ImageRepository $imageRepository,
        DestinationService $destinationRepository,
        VariantRepository $variantRepository,
        RoomListServiceInterface $roomListService
    ) {
        $this->roomRepository = $roomRepository;
        $this->imageRepository = $imageRepository;
        $this->destinationRepository = $destinationRepository;
        $this->variantRepository = $variantRepository;
        $this->roomListRepository = $roomListService;
    }

    public function getRoomById($id)
    {
        return $this->roomRepository->with('variants')->find($id);
    }

    public function getAllRoom()
    {
        $userId = Auth::id();

        $rooms = Room::whereHas('users', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
            ->with('users', 'destinations', 'roomLists')
            ->orderBy('updated_at', 'desc')
            ->paginate(PAGINATE_MAX_RECORD)
            ->withQueryString();

        return $rooms;
    }

    public function createRoom()
    {
        $this->destinationRepository->getAllDestinationsForRoom(false);
        $this->variantRepository->getAllVariant();
    }

    public function storeRoom($request)
    {
        $room = $this->roomRepository->create($request->all());
        // Kiểm tra và lưu các ảnh của phòng
        if ($request->hasFile('room_image')) {
            foreach ($request->file('room_image', []) as $imgData) {
                $filePath = $this->upload($imgData, IMAGE_PATHS['room_images']);
                $savedImage = $this->imageRepository->create([
                    'image' => $filePath,
                ]);
                if ($savedImage) {
                    $room->images()->attach($savedImage->id);
                }
            }
        }

        // Kiểm tra và lưu người dùng hiện tại vào phòng
        $user = auth()->user();
        if ($user) {
            $room->users()->attach($user->id);
        }

        // Kiểm tra và lưu thông tin variant vào bảng room_variant
        if ($request->has('variant_id') && $request->has('price')) {
            $variants = $request->input('variant_id', []); // Mảng các variant_id
            $pricePerNight = $request->input('price'); // Giá thuê phòng

            // Lặp qua từng variant và lưu vào bảng room_variant
            foreach ($variants as $variantId) {
                DB::table('room_variant')->insert([
                    'room_id' => $room->id,
                    'variant_id' => $variantId,
                    'price_per_night' => $pricePerNight,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
        $user = auth()->user();
        $quantity = $request->input('quantity', 1);
        for ($i = 0; $i < $quantity; $i++) {
            $roomList = $this->roomListRepository->createRoomListEntry($room->id, 'trống');

            if ($user && $roomList) {
                $roomList->users()->attach($user->id);
            }
        }
        return $room;
    }


    public function editRoom($id)
    {
        $destinations = $this->destinationRepository->getAllDestinations();
        $variants = $this->variantRepository->getAllVariants();
        $room = $this->getRoomById($id);
        $prices = $room->variants->first()->pivot->price_per_night ?? 0;

        return compact('destinations', 'variants', 'room', 'prices');
    }


    public function updateRoom($request, $id)
    {
        // Lấy thông tin phòng hiện tại
        $room = $this->roomRepository->find($id);

        // Cập nhật thông tin phòng (bao gồm cả giá phòng)
        $this->roomRepository->update($request->only(['name', 'description', 'destination_id', 'price', 'guest_quantity']), $id);

        // Xử lý hình ảnh hiện có và hình ảnh mới
        $currentImages = $room->images->pluck('id')->toArray();  // Lấy các ID của hình ảnh hiện tại
        $existingImages = $request->input('existing_images', []); // Hình ảnh hiện tại không bị xóa
        $savedImages = [];

        // Lưu hình ảnh mới
        if ($request->hasFile('room_image')) {
            foreach ($request->file('room_image') as $imgData) {
                $filePath = $this->upload($imgData, IMAGE_PATHS['room_images']);
                $savedImage = $this->imageRepository->create(['image' => $filePath]);
                $savedImages[] = $savedImage->id;
            }
        }

        // Hợp nhất tất cả hình ảnh và kiểm tra các hình ảnh không còn sử dụng
        $allImages = array_merge($existingImages, $savedImages);  // Hợp nhất hình ảnh cũ và mới
        $imagesToDelete = array_diff($currentImages, $allImages); // Tìm hình ảnh nào cần xóa
        if (!empty($imagesToDelete)) {
            $this->deleteImages($imagesToDelete); // Xóa hình ảnh không còn sử dụng
        }

        // Cập nhật lại hình ảnh của phòng
        $room->images()->sync($allImages);

        // Cập nhật giá phòng cho biến thể
        $pricePerNight = $request->input('price');

        // Cập nhật các biến thể (variants)
        $variants = $request->input('variant_id', []);
        $room->variants()->sync($variants);

        // Cập nhật giá phòng cho từng biến thể
        DB::table('room_variant')
            ->where('room_id', $room->id)
            ->update(['price_per_night' => $pricePerNight, 'updated_at' => now()]);
        $quantity = $request->input('quantity', 1);
        $existingRoomLists = $this->roomListRepository->getRoomListsByRoomId($room->id);
        $user = auth()->user(); // Lấy thông tin người dùng hiện tại

        if ($quantity > $existingRoomLists->count()) {
            // Thêm các phòng mới vào `room_lists` và `user_room_list`
            for ($i = $existingRoomLists->count(); $i < $quantity; $i++) {
                $roomList = $this->roomListRepository->createRoomListEntry($room->id, 'trống');

                // Thêm bản ghi vào `user_room_list` cho phòng mới
                if ($user && $roomList) {
                    $roomList->users()->attach($user->id, [
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        } elseif ($quantity < $existingRoomLists->count()) {
            // Xóa các phòng từ `room_lists` nếu số lượng phòng giảm
            $roomListsToDelete = $existingRoomLists->skip($quantity)->pluck('id');

            // Xóa các bản ghi tương ứng trong `user_room_list`
            foreach ($roomListsToDelete as $roomListId) {
                $roomList = $this->roomListRepository->findRoomListById($roomListId);
                if ($roomList) {
                    $roomList->users()->detach($user->id); // Xóa liên kết trong `user_room_list`
                }
            }

            // Sau khi xóa liên kết, xóa các bản ghi trong `room_lists`
            $this->roomListRepository->deleteRoomListEntries($roomListsToDelete);
        }
        return $room;
    }


    private function deleteImages(array $imageIds)
    {
        foreach ($imageIds as $imageId) {
            $image = $this->imageRepository->find($imageId);
            if ($image) {
                // Xóa liên kết giữa ảnh và các biến thể trong bảng variant_images
                $image->rooms()->detach();
                // Xóa file ảnh vật lý
                $this->deleteFile($image->image);
                // Xóa ảnh khỏi cơ sở dữ liệu vĩnh viễn
                $image->forceDelete();
            }
        }
    }

    public function deleteRoom($request, $id)
    {
        $room = $this->roomRepository->findOrFail($id);

        $room->reason = $request['reason'];
        $room->save();

        $room->delete();
    }
    public function getTrash()
    {
        $room = Room::onlyTrashed()
            ->with([
                'images' => function ($query) {
                    // Nếu images cũng sử dụng soft delete
                    $query->withTrashed();
                }
            ])
            ->orderBy('deleted_at', 'desc')
            ->paginate(PAGINATE_MAX_RECORD)
            ->appends(request()->query());
        return $room;
    }
    public function restoreTrash($id)
    {
        $room = Room::withTrashed()->findOrFail($id); // Tìm bản ghi bị xóa mềm
        $room->restore(); // Khôi phục bản ghi
        Log::info("Room ID: $id đã được khôi phục.");
        return $room;
    }
    public function forceDelete($id)
    {
        $room = Room::withTrashed()->findOrFail($id); // Tìm bản ghi, bao gồm cả bản bị xóa mềm
        $room->forceDelete(); // Xóa vĩnh viễn bản ghi
        return $room;
    }

    // manage-room
    public function getAllRoomManage()
    {
        $userId = Auth::id();
        $rooms = Room::whereHas('users', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
            ->with('users', 'destinations', 'roomLists')
            ->orderBy('updated_at', 'desc')
            ->get();
        return $rooms;
    }
}
