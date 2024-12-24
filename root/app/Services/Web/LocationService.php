<?php

namespace App\Services\Web;

use App\Models\Location;
use App\Repositories\Contracts\LocationRepository;
use App\Repositories\Contracts\ImageRepository;
use App\Services\Contracts\LocationServiceInterface;
use App\Traits\FileTrait;


class LocationService implements LocationServiceInterface
{
    use FileTrait {
        delete as deleteFile;
    }
    protected $locationRepository;
    protected $imageRepository;

    public function __construct(LocationRepository $locationRepository, ImageRepository $imageRepository)
    {
        $this->locationRepository = $locationRepository;
        $this->imageRepository = $imageRepository;
    }

    public function getAllLocations($keyword, $paginate = true)
    {
        $order_by = ['id' => 'asc'];
        $filter = [];
    
        if (!empty($keyword)) {
            $filter['keyword'] = $keyword;
        }
    
        if ($paginate) {
            // Lấy danh sách có phân trang
            return $this->locationRepository->with('images')->paginateByFilters(
                $filter,
                PAGINATE_MAX_RECORD,
                [],
                $order_by
            )->withQueryString();
        } else {
            // Lấy toàn bộ danh sách không phân trang
            return $this->locationRepository->with('images')->all();
        }
    }


    public function getLocation($id)
    {

        return $this->locationRepository->with('images')->find($id);
    }

    public function createLocation($request)
    {
        $data = $request->all();
        $images = $request->file('images', []);
        $characteristicIds = $request->input('characteristicAdd', []); // Lấy ID của characteristic từ request

        // Tạo mới Location
        $location = $this->locationRepository->create($data);

        // Nếu có characteristic được chọn, thêm vào bảng trung gian
        if (!empty($characteristicIds)) {
            $location->characteristics()->attach($characteristicIds);
        }

        // Xử lý hình ảnh
        $savedImages = [];
        foreach ($images as $imgData) {
            $filePath = $this->upload($imgData, LOCATION_IMAGES_PATH);
            $savedImages[] = $this->imageRepository->create([
                'image' => $filePath,
            ]);
        }

        // Gán các hình ảnh đã lưu cho location
        $location->images()->attach(array_column($savedImages, 'id'));

        return $location;
    }


    public function updateLocation($request, $id)
    {
        $location = $this->locationRepository->find($id);

        // Cập nhật thông tin của variant
        $this->locationRepository->update($request->all(), $id);

        // Lấy danh sách các ảnh hiện tại của variant
        $currentImages = $location->images->pluck('id')->toArray();

        // Lấy danh sách các ảnh cũ được giữ lại
        $existingImages = $request->input('existing_images', []);
        $savedImages = [];

        // Nếu có ảnh mới, upload ảnh mới và lưu lại
        if ($request->hasFile('location_image')) {
            foreach ($request->file('location_image') as $imgData) {
                $filePath = $this->upload($imgData, LOCATION_IMAGES_PATH);
                $savedImage = $this->imageRepository->create(['image' => $filePath]);
                $savedImages[] = $savedImage->id;
            }
        }

        // Kết hợp ảnh cũ và ảnh mới
        $allImages = array_merge($existingImages, $savedImages);

        // Tìm các ảnh cũ không còn xuất hiện trong danh sách mới
        $imagesToDelete = array_diff($currentImages, $allImages);

        // Xóa các ảnh không còn cần thiết
        if (!empty($imagesToDelete)) {
            $this->deleteImages($imagesToDelete);
        }

        // Cập nhật lại các ảnh cho variant
        $location->images()->sync($allImages);
        // Handle characteristics update
        $selectedCharacteristics = $request->input('characteristicsEdit', []);
        $location->characteristics()->sync($selectedCharacteristics);

        return $location;
    }
    private function deleteImages(array $imageIds)
    {
        foreach ($imageIds as $imageId) {
            // Tìm hình ảnh theo ID
            $image = $this->imageRepository->find($imageId);

            // Nếu hình ảnh tồn tại, xóa tệp tin và bản ghi
            if ($image) {
                // Xóa tệp tin hình ảnh
                $this->deleteFile($image->image);

                // Xóa bản ghi hình ảnh
                $this->imageRepository->delete($imageId);
            }
        }
    }

    public function deleteLocation($id, $reason)
    {
        $location = $this->locationRepository->find($id);
        $location->deleted_reason = $reason;
        $location->save();
        $location->delete();
    }

    // client
    public function getAll()
    {
        $order_by['updated_at'] = 'desc';
        $locations = $this->locationRepository->paginateByFilters(
            [],
            [],
            ['images'],
            $order_by
        );
        $locations->getCollection()->loadCount('destinations');
        return $locations;
    }

    public function getTop5()
    {
        $order_by['views'] = 'desc';
        $locations = $this->locationRepository->paginateByFilters(
            [],
            TOP5,
            ['images'],
            $order_by,
        );
        return $locations;
    }

    public function getLocationsByCharacteristic($id)
    {
        $locations = $this->locationRepository->getLocationsByCharacteristic($id);
        return $locations;
    }

    public function getTrash()
    {
        $locations = Location::onlyTrashed()
            ->with(['images' => function ($query) {
                // Nếu images cũng sử dụng soft delete
                $query->withTrashed();
            }])
            ->orderBy('deleted_at', 'desc')
            ->paginate(PAGINATE_MAX_RECORD)
            ->appends(request()->query());
        return $locations;
    }
    public function restoreTrash($id)
    {
        $location = Location::onlyTrashed()->find($id);
        $location->restore();
        return $location;
    }
    public function forceDelete($id)
    {
        $location = Location::onlyTrashed()->find($id);
        $location->forceDelete();
        return $location;
    }
}
