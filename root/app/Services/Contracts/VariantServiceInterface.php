<?php

namespace App\Services\Contracts;

use App\Http\Requests\StoreVariantRequest;



interface VariantServiceInterface
{
    public function getAllVariant($keyword, $paginate = true);
    public function getVariantById($id);

    public function createVariant($data);
    public function storeVariant(StoreVariantRequest $request);
    public function editVariant($id);
    public function updateVariant(StoreVariantRequest $request, $id);
    public function deleteVariant($request, $id);
    public function getTrash();
    public function restoreTrash($id);

    public function forceDelete($id);
    
}
