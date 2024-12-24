<?php

namespace App\Services\Web;

use App\Models\Banner;
use App\Repositories\Contracts\BannerRepository;
use App\Services\Contracts\BannerServiceInterface;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\Storage;

class BannerService implements BannerServiceInterface
{
    use FileTrait {
        delete as deleteFile;
    }
    protected $bannerRepository;

    public function __construct(BannerRepository $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;
    }

    public function getAllBanner()
    {
        $order_by['updated_at'] = 'desc';
        $filter = [];
        $banners = $this->bannerRepository->paginateByFilters(
            $filter,
            PAGINATE_MAX_RECORD,
            [],
            $order_by
        );
        return $banners;
    }

    public function getBanner($id)
    {
        return $this->bannerRepository->firstById($id);
    }

    public function createBanner($request)
    {
        $images = $request->file('images', []);
        $savedImages = [];
        foreach ($images as $imgData) {
            $filePath = $this->upload($imgData, BANNER_IMAGES_DIRECTORY);
            $savedImages[] = $this->bannerRepository->create([
                'img_banner' => $filePath,
            ]);
        }
        return $savedImages;
    }

    public function updateBanner($request, $id)
    {
        $newImage = $request->file('images');

        $banner = $this->bannerRepository->find($id);

        if ($banner->img_banner) {
            $this->deleteFile($banner->img_banner);
        }
        if ($newImage) {
            $filePath = $this->upload($newImage, BANNER_IMAGES_DIRECTORY);
            $banner->img_banner = $filePath;
            $banner->save();
        }

        return $banner;
    }


    public function deleteBanner($id, $reason)
    {
        $Banner = $this->bannerRepository->find($id);
        $Banner->reason = $reason;
        $Banner->save();
        $Banner->delete();
    }

    //client
    public function getOneBaner($id)
    {
        $banner = $this->bannerRepository->find($id);
        return $banner;
    }
    public function getTrash()
    {
        $banners = Banner::onlyTrashed()
            ->orderBy('deleted_at', 'desc')
            ->paginate(PAGINATE_MAX_RECORD)
            ->appends(request()->query());
        return $banners;
    }
    public function restoreTrash($id)
    {
        $banner = Banner::onlyTrashed()->find($id);
        $banner->restore();
        return $banner;
    }
    public function forceDelete($id)
    {
        $banner = Banner::onlyTrashed()->find($id);
        $banner->forceDelete();
        return $banner;
    }
}
