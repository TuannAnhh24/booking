<?php

namespace App\Http\Middleware;

use App\Repositories\Contracts\BannerRepository;
use Closure;
use Illuminate\Http\Request;

class CheckBannerExistence
{
    protected $bannerRepository;
    public function __construct(BannerRepository $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $bannerId = $request->route('id');

        if (!$this->bannerRepository->find($bannerId)) {
            return redirect()->route('admin.banners.index')
                ->with('error', __('content.banner.banner_not_found'));
        }
        return $next($request);
    }
}
