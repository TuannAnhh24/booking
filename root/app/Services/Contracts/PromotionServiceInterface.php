<?php

namespace App\Services\Contracts;

interface PromotionServiceInterface
{
    public function listPromotion($request);
    public function listDeletedPromotions($request);

    public function store($request);

    public function update($id, $request);

    public function delete($id, $reason);

    public function getPromotionId($id);
    public function restoreTrash($id);
    public function forceDelete($id);

}
