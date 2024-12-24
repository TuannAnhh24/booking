<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\DeleteCategoryRequest;
use App\Models\Category;
use App\Models\Destination;
use App\Services\Contracts\CategoryServiceInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $categories = $this->categoryService->getAllCategory($request->keyword);
        if ($request->ajax()) {
            $html = view('admin.categories.partials.table', compact('categories'))->render();
            return response()->json(['html' => $html]);
        }
        return view('admin.categories.list', compact('categories'));
    }


    public function store(CategoryRequest $request)
    {
        try {
            $category = $this->categoryService->createCategory($request);
            activity()
                ->causedBy(auth()->user())
                ->withProperties(['title' => __('content.activity.create_category_title')])
                ->log(__('content.activity.create_category') . ': ' . $category->name);
            return redirect()->route('admin.categories.index')
                ->with('success', __('content.category.category_created_successfully'));
        } catch (\Exception $e) {
            return redirect()->route('admin.categories.index')
                ->with('error', __('content.category.an_error_occurred: ') . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $category = $this->categoryService->getCategory($id);
        return view('admin.categories.modal.edit', compact('category'));
    }


    public function update(CategoryRequest $request, $id)
    {
        try {
            $category = $this->categoryService->updateCategory($request, $id);
            activity()
                ->causedBy(auth()->user())
                ->withProperties(['title' => __('content.activity.update_category_title')])
                ->log(__('content.activity.update_category') . ': ' . $category->name);
            return redirect()->route('admin.categories.index')
                ->with('success', __('content.category.category_updated_successfully'));
        } catch (\Exception $e) {
            return redirect()->route('admin.categories.index')
                ->with('error', __('content.category.an_error_occurred: ') . $e->getMessage());
        }
    }

    public function destroy(DeleteCategoryRequest $request, $id)
    {
        try {
            $category = $this->categoryService->deleteCategory($id, $request->input('deleted_reason'));
            activity()
                ->causedBy(auth()->user())
                ->withProperties(['title' => __('content.activity.delete_category_title')])
                ->log(__('content.activity.delete_category') . ': ' . $category->name);
            return redirect()->route('admin.categories.index')
                ->with('success', __('content.category.category_deleted_successfully'));
        } catch (\Exception $e) {
            return redirect()->route('admin.categories.index')
                ->with('error', __('content.category.an_error_occurred: ') . $e->getMessage());
        }
    }
    public function restoreTrash($id)
    {
        $category = $this->categoryService->restoreTrash($id);
        activity()
            ->causedBy(auth()->user())
            ->withProperties(['title' => __('content.activity.restore_category_title')])
            ->log(__('content.activity.restore_category') . ': ' . $category->name);
        return redirect()->route('admin.categories.index')
            ->with('success', __('content.category.category_restored_successfully'));
    }
    public function getTrash()
    {
        $categories = $this->categoryService->getTrash();
        return view('admin.categories.trash', compact('categories'));
    }
    public function forceDelete($id)
    {
        $category = $this->categoryService->forceDelete($id);
        activity()
            ->causedBy(auth()->user())
            ->withProperties(['title' => __('content.activity.delete_category_title')])
            ->log(__('content.activity.delete_category') . ': ' . $category->name);
        return redirect()->route('admin.categories.index')
            ->with('success', __('content.category.category_deleted_successfully'));
    }
    public function getHotelsByCategory($categoryId)
    {
        // Lấy danh sách destination theo category
        $hotels = Category::with(['destinations.rooms.variants', 'destinations.reviews'])
            ->find($categoryId)
            ->destinations()->paginate(10);
            
        // Truyền $hotels vào view
        return view('client.home.page-hotels', compact('hotels'));
    }
}
