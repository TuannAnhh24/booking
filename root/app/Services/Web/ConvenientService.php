<?php
namespace App\Services\Web;

use App\Models\Convenient;
use App\Services\Contracts\CharacteristicServiceInterface;
use App\Repositories\Contracts\CharacteristicRepository;
use App\Repositories\Contracts\ConvenientRepository;
use App\Services\Contracts\ConvenientServiceInterface;
use App\Traits\FileTrait;

class ConvenientService implements ConvenientServiceInterface
{
    use FileTrait {
        delete as deleteFile;
    }

    protected $convenientRepository;

    public function __construct(ConvenientRepository $convenientRepository)
    {
        $this->convenientRepository = $convenientRepository;
    }

    public function getAllConvenients($paginate = true)
    {
        // Sử dụng all() để lấy tất cả các bản ghi từ repository
        if($paginate){
        return $this->convenientRepository->paginateByFilters(
            $filters = [],
            $pageSize = 10,
            $relationship = [],
            $orderBy = ['id' => 'desc'],
            $columns = "*"
        );
    }else{
        return $this->convenientRepository->all();
    }
    }

    public function getConvenient($id)
    {
        // Lấy chi tiết của một Characteristic cụ thể theo id
        return $this->convenientRepository->find($id);
    }

    public function createConvenient($request)
    {
        // Tạo mới một Characteristic với dữ liệu từ $request
        $data = $request->all();
        return $this->convenientRepository->create($data);
    }

    public function updateConvenient($request, $id)
    {
        // Cập nhật thông tin của một Characteristic cụ thể
        $convenient = $this->convenientRepository->find($id);
        $this->convenientRepository->update($request->all(), $id);
        return $convenient;
    }

    public function deleteConvenient($id, $reason)
    {
        // Thêm lý do xóa trước khi xóa Characteristic
        $convenient = $this->convenientRepository->find($id);
        $convenient->deleted_reason = $reason;
        $convenient->save();
        $convenient->delete();
    
    }
    public function getTrash()
    {
        $convenients = Convenient::onlyTrashed()
            ->orderBy('deleted_at', 'desc')
            ->paginate(PAGINATE_MAX_RECORD)
            ->appends(request()->query());
        return $convenients;
    }
    public function restoreTrash($id)
    {
        $convenient = Convenient::onlyTrashed()->find($id);
        $convenient->restore();
        return $convenient;
    }
    public function forceDelete($id)
    {
        $convenient = Convenient::onlyTrashed()->find($id);
        $convenient->forceDelete();
        return $convenient;
    }
}
