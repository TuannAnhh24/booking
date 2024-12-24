<?php

namespace App\Services\Contracts;

use App\Models\Category;

interface BannerServiceInterface
{
    public function getAllBanner();
    public function getBanner($id);
    public function createBanner($request);
    public function updateBanner($request, $id);
    public function deleteBanner($id, $reason);

    public function getTrash();
    public function restoreTrash($id);

    public function forceDelete($id);
    // client
    public function getOneBaner($id);


}
