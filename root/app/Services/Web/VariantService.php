<?php

namespace App\Services\Web;

use App\Http\Requests\StoreVariantRequest;
use App\Models\Variant;
use App\Repositories\Contracts\ImageRepository;
use App\Repositories\Contracts\VariantRepository;
use App\Services\Contracts\VariantServiceInterface;
use App\Traits\FileTrait;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class VariantService implements VariantServiceInterface
{
    use FileTrait {
        delete as deleteFile;
    }

    protected $variantRepository;
    protected $imageRepository;

    public function __construct(
        VariantRepository $variantRepository,
        ImageRepository $imageRepository
    ) {
        $this->variantRepository = $variantRepository;
        $this->imageRepository = $imageRepository;
    }

    public function getVariantById($id)
    {
        return $this->variantRepository->find($id);
    }

    public function getAllVariant($keyword, $paginate = true)
    {
        $userId = Auth::id();

        $variants = Variant::whereHas('users', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
            ->with('users');

        if (!empty($keyword)) {
            $variants->where(function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('description', 'like', '%' . $keyword . '%');
            });
        }

        $variants->orderBy('updated_at', 'desc');

        if ($paginate) {
            $variants = $variants->paginate(PAGINATE_MAX_RECORD)->withQueryString();
        } else {
            $variants = $variants->get();
        }

        return $variants;
    }


    public function createVariant($data) {}

    public function storeVariant(StoreVariantRequest $request)
    {

        $variant = $this->variantRepository->create($request->all());

        foreach ($request->file('variant_image', []) as $imgData) {
            $filePath = $this->upload($imgData, IMAGE_PATHS['variant_images']);
            $savedImage = $this->imageRepository->create([
                'image' => $filePath,
            ]);
            $variant->images()->attach($savedImage->id);
        }
        $user = auth()->user();
        $variant->users()->attach($user->id);
        return $variant;
    }

    public function editVariant($id) {}


    public function updateVariant(StoreVariantRequest $request, $id)
    {
        $variant = $this->variantRepository->find($id);

        // Cập nhật thông tin của variant
        $this->variantRepository->update($request->all(), $id);

        // Lấy danh sách các ảnh hiện tại của variant
        $currentImages = $variant->images->pluck('id')->toArray();

        // Lấy danh sách các ảnh cũ được giữ lại
        $existingImages = $request->input('existing_images', []);
        $savedImages = [];

        // Nếu có ảnh mới, upload ảnh mới và lưu lại
        if ($request->hasFile('variant_image')) {
            foreach ($request->file('variant_image') as $imgData) {
                $filePath = $this->upload($imgData, IMAGE_PATHS['variant_images']);
                $savedImage = $this->imageRepository->create(['image' => $filePath]);
                $savedImages[] = $savedImage->id;
            }
        }

        // Kết hợp ảnh cũ và ảnh mới
        $allImages = array_merge($existingImages, $savedImages);

        // Tìm các ảnh cũ không còn xuất hiện trong danh sách mới
        $imagesToDelete = array_diff($currentImages, $allImages);

        // Xóa các ảnh không còn cần thiết
        if (!empty($imagesToDelete)) {
            $this->deleteImages($imagesToDelete);
        }

        // Cập nhật lại các ảnh cho variant
        $variant->images()->sync($allImages);

        return $variant;
    }
    private function deleteImages(array $imageIds)
    {
        foreach ($imageIds as $imageId) {
            $image = $this->imageRepository->find($imageId);
            if ($image) {
                // Xóa liên kết giữa ảnh và các biến thể trong bảng variant_images
                $image->variants()->detach();
                // Xóa file ảnh vật lý
                $this->deleteFile($image->image);
                // Xóa ảnh khỏi cơ sở dữ liệu vĩnh viễn
                $image->forceDelete();
            }
        }
    }


    public function deleteVariant($request, $id)
    {
        $variant = $this->variantRepository->findOrFail($id);

        $variant->reason = $request['reason'];
        $variant->save();

        $variant->delete();
    }
    public function getTrash()
    {
        $variant = Variant::onlyTrashed()
            ->with(['images' => function ($query) {
                // Nếu images cũng sử dụng soft delete
                $query->withTrashed();
            }])
            ->orderBy('deleted_at', 'desc')
            ->paginate(PAGINATE_MAX_RECORD)
            ->appends(request()->query());
        return $variant;
    }
    public function restoreTrash($id)
    {
        $variant = Variant::onlyTrashed()->find($id);
        $variant->restore();
        
        return $variant;
    }
    public function forceDelete($id)
    {
        $variant = Variant::onlyTrashed()->find($id);
        $variant->forceDelete();
        return $variant;
    }
}
