<?php
namespace App\Services\Web;

use App\Models\Characteristic;
use App\Services\Contracts\CharacteristicServiceInterface;
use App\Repositories\Contracts\CharacteristicRepository;
use App\Traits\FileTrait;

class CharacteristicService implements CharacteristicServiceInterface
{
    use FileTrait {
        delete as deleteFile;
    }

    protected $characteristicRepository;

    public function __construct(CharacteristicRepository $characteristicRepository)
    {
        $this->characteristicRepository = $characteristicRepository;
    }

    public function getAllCharacteristics($paginate = true)
    {       
        if($paginate){
        // Sử dụng all() để lấy tất cả các bản ghi từ repository
        return $this->characteristicRepository->with('locations.images')->paginateByFilters(
            $filters = [],
            $pageSize = 10,
            $relationship = ['locations', 'locations.images'], // Load cả hình ảnh
            $orderBy = ['id' => 'desc'],
            $columns = "*"
        );
    }else{
        return $this->characteristicRepository->with('locations.images')->all();
    }
    }

    public function getCharacteristic($id)
    {
        // Lấy chi tiết của một Characteristic cụ thể theo id
        return $this->characteristicRepository->find($id);
    }

    public function createCharacteristic($request)
    {
        // Tạo mới một Characteristic với dữ liệu từ $request
        $data = $request->all();
        return $this->characteristicRepository->create($data);
    }

    public function updateCharacteristic($request, $id)
    {
        // Cập nhật thông tin của một Characteristic cụ thể
        $characteristic = $this->characteristicRepository->find($id);
        $this->characteristicRepository->update($request->all(), $id);
        return $characteristic;
    }

    public function deleteCharacteristic($id, $reason)
    {
        // Thêm lý do xóa trước khi xóa Characteristic
        $characteristic = $this->characteristicRepository->find($id);
        $characteristic->deleted_reason = $reason;
        $characteristic->save();
        $characteristic->delete();
    }

    // client
    public function getAll()
    {
        $order_by['updated_at'] = 'desc';
        $characteristic = $this->characteristicRepository->paginateByFilters(
            [],
            [],
            ['locations.images', 'locations'],
            $order_by
        )->withQueryString();
        return $characteristic;
    }
    public function getTrash()
    {
        $characteristics = Characteristic::onlyTrashed()
            ->orderBy('deleted_at', 'desc')
            ->paginate(PAGINATE_MAX_RECORD)
            ->appends(request()->query());
        return $characteristics;
    }
    public function restoreTrash($id)
    {
        $characteristic = Characteristic::onlyTrashed()->find($id);
        $characteristic->restore();
        return $characteristic;
    }
    public function forceDelete($id)
    {
        $characteristic = Characteristic::onlyTrashed()->find($id);
        $characteristic->forceDelete();
        return $characteristic;
    }
}
