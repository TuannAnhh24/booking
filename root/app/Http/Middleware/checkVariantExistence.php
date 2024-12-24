<?php

namespace App\Http\Middleware;

use App\Models\Variant;
use App\Repositories\Contracts\VariantRepository;
use Closure;
use Illuminate\Http\Request;

class checkVariantExistence
{
    protected $variantRepository;

    public function __construct(VariantRepository $variantRepository)
    {
        $this->variantRepository = $variantRepository;
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
        // Lấy variant từ database dựa trên id trong route
        $variant =  $this->variantRepository->find($request->route('id'));
        // Nếu không tìm thấy variant, redirect hoặc trả về thông báo lỗi
        if (!$variant) {
            return redirect()->route('admin.variants.index')
                ->with('error', __('content.variant.error_not_found'));
        }
        return $next($request);
    }
}
