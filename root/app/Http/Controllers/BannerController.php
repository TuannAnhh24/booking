<?php

namespace App\Http\Controllers;

use App\Http\Requests\BannerRequest;
use App\Http\Requests\DeleteBannerRequest;
use App\Services\Contracts\BannerServiceInterface;


class BannerController extends Controller
{
    protected $bannerService;
    public function __construct(BannerServiceInterface $bannerService)
    {
        $this->bannerService = $bannerService;
    }

    public function index()
    {
        $banners = $this->bannerService->getAllBanner();
        return view('admin.banners.list', compact('banners'));
    }

    public function store(BannerRequest $request)
    {
        try {
            $this->bannerService->createBanner($request);
            activity()
                ->causedBy(auth()->user())
                ->withProperties(['title' => __('content.activity.create_banner_title')])
                ->log(__('content.activity.create_banner'));
            return redirect()->route('admin.banners.index')
                ->with('success', __('content.banner.banner_created_successfully'));
        } catch (\Exception $e) {
            return redirect()->route('admin.banners.index')
                ->with('error', __('content.banner.an_error_occurred: ') . $e->getMessage());
        }

    }
    public function edit($id)
    {
        $banner = $this->bannerService->getBanner($id);
        return view('admin.banners.modal.edit', compact('banner'));
    }

    public function update(BannerRequest $request, $id)
    {
        try {
            $this->bannerService->updateBanner($request, $id);
            activity()
                ->causedBy(auth()->user())
                ->withProperties(['title' => __('content.activity.update_banner_title')])
                ->log(__('content.activity.update_banner'));
            return redirect()->route('admin.banners.index')
                ->with('success', __('content.banner.banner_updated_successfully'));
        } catch (\Exception $e) {
            return redirect()->route('admin.banners.index')
                ->with('error', __('content.banner.an_error_occurred: ') . $e->getMessage());
        }
    }

    public function destroy(DeleteBannerRequest $request, $id)
    {
        try {
            $this->bannerService->deleteBanner($id, $request->input('reason'));
            activity()
                ->causedBy(auth()->user())
                ->withProperties(['title' => __('content.activity.delete_banner_title')])
                ->log(__('content.activity.delete_banner'));
            return redirect()->route('admin.banners.index')
                ->with('success', __('content.banner.banner_deleted_successfully'));
        } catch (\Exception $e) {
            return redirect()->route('admin.banners.index')
                ->with('error', __('content.banner.an_error_occurred: ') . $e->getMessage());
        }
    }
    public function restoreTrash($id)
    {
        $banner = $this->bannerService->restoreTrash($id);
        activity()
            ->causedBy(auth()->user())
            ->withProperties(['title' => __('content.activity.restore_banner_title')])
            ->log(__('content.activity.restore_banner') . ': ' . $banner->name);
        return redirect()->route('admin.banners.index')
            ->with('success', __('content.banner.banner_restored_successfully'));
    }
    public function getTrash()
    {
        $banners = $this->bannerService->getTrash();
        return view('admin.banners.trash', compact('banners'));
    }
    public function forceDelete($id)
    {
        $banner = $this->bannerService->forceDelete($id);
        activity()
            ->causedBy(auth()->user())
            ->withProperties(['title' => __('content.activity.delete_banner_title')])
            ->log(__('content.activity.delete_banner') . ': ' . $banner->name);
        return redirect()->route('admin.banners.index')
            ->with('success', __('content.banner.banner_deleted_successfully'));
    }
}
