<?php

namespace App\Services\Web;

use App\Models\Promotion;
use App\Repositories\Contracts\PromotionRepository;
use App\Services\Contracts\PromotionServiceInterface;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PromotionService implements PromotionServiceInterface
{
    use FileTrait {
        delete as deleteFile;
    }
    protected $promotionRepository;

    public function __construct(PromotionRepository $promotionRepository)
    {
        $this->promotionRepository = $promotionRepository;
    }

    public function listPromotion($keyword = null)
    {
        $promotionId = Auth::id();

        $promotion = Promotion::whereHas('users', function ($query) use ($promotionId) {
            $query->where('user_id', $promotionId);
        })->with('users');

        if (!empty($keyword)) {
            $promotion->where(function ($query) use ($keyword) {
                $query->where('short_description', 'like', '%' . $keyword . '%');
            });
        }
        $perPage = config('constants.paginate_max_record', 10); // 10 là mặc định
        $promotion = $promotion->orderBy('updated_at', 'desc')
            ->paginate($perPage)
            ->withQueryString();
        return $promotion;
    }

    public function listDeletedPromotions($keyword = null)
    {
        $promotionId = Auth::id();

        // Lấy các mã giảm giá đã bị xóa mềm
        $promotion = Promotion::onlyTrashed()->whereHas('users', function ($query) use ($promotionId) {
            $query->where('user_id', $promotionId);
        })->with('users');

        if (!empty($keyword)) {
            $promotion->where(function ($query) use ($keyword) {
                $query->where('short_description', 'like', '%' . $keyword . '%');
            });
        }

        $perPage = config('constants.paginate_max_record', 10); // 10 là mặc định
        $promotion = $promotion->orderBy('updated_at', 'desc')
            ->paginate($perPage)
            ->appends(request()->query());
        return $promotion;
    }


    public function store($request)
    {
        $code = $request['code'];

        while ($this->promotionRepository->codeExists($code)) {
            $code = strtoupper(Str::random(10));
            $request['code'] = $code;
        }

        $promotion = $this->promotionRepository->create($request);

        if (!empty($request['image'])) {
            $imagePath = $this->upload($request['image'], PROMOTION_IMAGE_PATH);
            $promotion->update(['image' => $imagePath]);
        }

        // Gán mã giảm giá cho người dùng hiện tại trong bảng promotion_user
        $promotion->users()->attach(auth()->id());

        return $promotion;
    }

    public function update($id, $request)
    {
        $promotion = $this->promotionRepository->find($id);
        if (!empty($request['image'])) {
            if ($promotion->image) {
                $this->deleteFile([$promotion->image]);
            }
            $imagePath = $this->upload($request['image'], PROMOTION_IMAGE_PATH);
            $request['image'] = $imagePath;
        }

        // Xử lý loại giảm giá
        if ($request['discount_type-edit'] === 'percentage') {
            $request['discount_amount'] = null;
            $request['discount_percentage'] = $request['discount_percentage'] ?? null;
        } elseif ($request['discount_type-edit'] === 'amount') {
            $request['discount_percentage'] = null;
            $request['discount_amount'] = $request['discount_amount'] ?? null;
        }

        // Cập nhật promotion
        $promotion->update($request);

        return $promotion;
    }
    public function delete($id, $reason)
    {
        $promotion = $this->promotionRepository->find($id);
        $promotion->deletion_reason = $reason;
        $promotion->save();
        $promotion->delete();
    }

    public function getPromotionId($id)
    {
        return $this->promotionRepository->find($id);
    }

    public function restoreTrash($id)
    {
        $promotion = Promotion::onlyTrashed()->find($id);
        $promotion->restore();
        return $promotion;
    }

    public function forceDelete($id)
    {
        $promotion = Promotion::onlyTrashed()->find($id);
        $promotion->forceDelete();
        return $promotion;
    }
}
