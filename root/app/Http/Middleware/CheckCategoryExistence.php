<?php

namespace App\Http\Middleware;

use App\Repositories\Contracts\CategoryRepository;
use Closure;
use Illuminate\Http\Request;

class CheckCategoryExistence
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
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
        $categoryId = $request->route('id');

        if (!$this->categoryRepository->find($categoryId)) {
            return redirect()->route('admin.categories.index')
                ->with('error', __('content.category.category_not_found'));
        }
        return $next($request);
    }
}
