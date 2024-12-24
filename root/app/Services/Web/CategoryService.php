<?php

namespace App\Services\Web;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepository;
use App\Repositories\Contracts\ImageRepository;
use App\Services\Contracts\CategoryServiceInterface;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\Log;

class CategoryService implements CategoryServiceInterface
{
    use FileTrait {
        delete as deleteFile;
    }
    protected $categoryRepository;
    protected $imageRepository;

    public function __construct(CategoryRepository $categoryRepository, ImageRepository $imageRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->imageRepository = $imageRepository;
    }

    public function getAllCategory($keyword,  $paginate = true)
    {
        $order_by['id'] = 'desc';
        $filter = [];

        if (!empty($keyword)) {
            $filter['keyword'] = $keyword;
        }
        if ($paginate) {
        $categories = $this->categoryRepository->with('images')->paginateByFilters(

            $filter,
            PAGINATE_MAX_RECORD,
            ['images'],
            $order_by
        )->withQueryString();
        }else {
            // Lấy toàn bộ danh sách không phân trang
            return $this->categoryRepository->with('images')->all();
        }

        return $categories;
    }


    public function getCategory($id)
    {
        return $this->categoryRepository->with('images')->firstById($id);
    }

    public function createCategory($request)
    {
        $category = $this->categoryRepository->create([
            'name' => $request->name,
            'description' => $request->description
        ]);
        $images = $request->file('images', []);
        $savedImages = [];
        foreach ($images as $imgData) {
            $filePath = $this->upload($imgData, CATEGORY_IMAGES_DIRECTORY);
            $savedImages[] = $this->imageRepository->create([
                'image' => $filePath,
            ]);
        }
        $category->images()->attach(array_column($savedImages, 'id'));

        return $category;
    }

    public function updateCategory($request, $id)
    {
        $images = $request->file('images', []);

        $category = $this->categoryRepository->find($id);

        $this->categoryRepository->update([
            'name' => $request->name,
            'description' => $request->description,
        ], $id);

        if ($request->filled('images_to_delete')) {
            $imageIdsToDelete = explode(',', $request->input('images_to_delete'));
            foreach ($imageIdsToDelete as $imageId) {
                $image = $this->imageRepository->find($imageId);
                if ($image) {
                    $this->deleteFile($image->image);
                    $this->imageRepository->delete($imageId);
                }
            }
            $category->images()->detach($imageIdsToDelete);
        }

        if (!empty($images)) {
            $savedImages = [];
            foreach ($images as $imgData) {
                $filePath = $this->upload($imgData, CATEGORY_IMAGES_DIRECTORY);
                $savedImages[] = $this->imageRepository->create([
                    'image' => $filePath,
                ]);
            }
            $category->images()->attach(array_column($savedImages, 'id'));
        }

        return $category;
    }

    public function deleteCategory($id, $reason)
    {
        $category = $this->categoryRepository->find($id);
        $category->deleted_reason = $reason;
        $category->save();
        $category->delete();
    }

    // client
    public function getAll()
    {
        $order_by['updated_at'] = 'desc';
        $categories = $this->categoryRepository->paginateByFilters(
            [],
            [],
            ['images'],
            $order_by
        )->withQueryString();
        return $categories;
    }
    public function getTrash()
    {
        $categories = Category::onlyTrashed()
            ->with(['images' => function ($query) {
                // Nếu images cũng sử dụng soft delete
                $query->withTrashed();
            }])
            ->orderBy('deleted_at', 'desc')
            ->paginate(PAGINATE_MAX_RECORD)
            ->appends(request()->query());
        return $categories;
    }
    public function restoreTrash($id)
    {
        $category = Category::onlyTrashed()->find($id);
        $category->restore();
        return $category;
    }
    public function forceDelete($id)
    {
        $category = Category::onlyTrashed()->find($id);
        $category->forceDelete();
        return $category;
    }
    public function getHotelsByCategory($categoryId)
{
    // Lấy category và danh sách khách sạn liên kết
    $category = Category::with('destinations')->findOrFail($categoryId);
    return $category->hotels; // Giả định mối quan hệ đã được định nghĩa
}

}
