<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeletePromotionRequest;
use App\Http\Requests\EditPromotionRequest;
use App\Http\Requests\PromotionRequest;
use App\Services\Contracts\PromotionServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class PromotionController extends Controller
{
    protected $promotionService;
    public function __construct(PromotionServiceInterface $promotionService)
    {
        $this->promotionService = $promotionService;
    }
    public function index(Request $request)
    {
        try {
            $listPromotion = $this->promotionService->listPromotion($request->keyword);
            if ($request->ajax()) {
                $html = view('admin.promotion.partials.table', compact('listPromotion'))->render();
                return response()->json(['html' => $html]);
            }
            return view('admin.promotion.list_promotion', compact('listPromotion'));
        } catch (\Exception $e) {
            Log::error('Error fetching promotion list: ' . $e->getMessage());
            return redirect()->route('admin.promotion.index')->with('error', __('content.promotion.could_not_retrieve_promotions') . ' ' . __('content.promotion.please_try_again_later'));
        }
    }

    public function store(PromotionRequest $request)
    {
        try {
            $promotion = $this->promotionService->store($request->validated());
            activity()
                ->causedBy(auth()->user())
                ->withProperties(['title' => __('content.activity.create_promotion_title')])
                ->log(__('content.activity.create_promotion') . ': ' . $promotion->code);
            return redirect()->route('admin.promotion.index')->with('success', __('content.promotion.promotion_create_successfully'));
        } catch (\Exception $e) {
            Log::error('Error storing promotion: ' . $e->getMessage());
            return redirect()->route('admin.promotion.index')->with('error', __('content.promotion.unable_to_create_new_promotions') . ' ' . __('content.promotion.please_try_again_later'));
        }
    }

    public function show($id)
    {
        try {
            $promotion = $this->promotionService->getPromotionId($id);
            return view('admin.promotion.modal.detail_promotion', compact('promotion'));
        } catch (\Exception $e) {
            Log::error('Error retrieving promotion: ' . $e->getMessage());
            return redirect()->route('admin.promotion.index')->with('error', __('content.promotion.could_not_retrieve_promotions') . ' ' . __('content.promotion.please_try_again_later'));
        }
    }

    public function edit($id)
    {
        try {
            $promotion = $this->promotionService->getPromotionId($id);
            return view('admin.promotion.modal.edit_promotion', compact('promotion'));
        } catch (\Exception $e) {
            Log::error('Error retrieving promotion for edit: ' . $e->getMessage());
            return redirect()->route('admin.promotion.index')->with('error', __('content.promotion.could_not_retrieve_promotions') . ' ' . __('content.promotion.please_try_again_later'));
        }
    }
    public function update(EditPromotionRequest $request, $id)
    {
        try {
            $promotion = $this->promotionService->update($id, $request->validated());
            activity()
                ->causedBy(auth()->user())
                ->withProperties(['title' => __('content.activity.update_promotion_title')])
                ->log(__('content.activity.update_promotion') . ': ' . $promotion->code);
            return redirect()->route('admin.promotion.index')->with('success', __('content.promotion.promotion_updated_successfully'));
        } catch (\Exception $e) {
            Log::error('Error updating promotion: ' . $e->getMessage());
            return redirect()->route('admin.promotion.index')->with('error', __('content.promotion.failed_to_update_promotion') . ' ' . __('content.promotion.please_try_again_later'));
        }
    }

    public function destroy(DeletePromotionRequest $request, $id)
    {
        $validatedData = $request->validated();
        try {
            $promotion = $this->promotionService->delete($id, $validatedData['deletion_reason']);
            activity()
                ->causedBy(auth()->user())
                ->withProperties(['title' => __('content.activity.delete_promotion_title')])
                ->log(__('content.activity.delete_promotion') . ': ' . $promotion->code);
            return redirect()->route('admin.promotion.index')->with('success', __('content.promotion.promotion_deleted_successfully'));
        } catch (\Exception $e) {
            Log::error('Error deleting promotion: ' . $e->getMessage());
            return redirect()->route('admin.promotion.index')->with('error', __('content.promotion.failed_to_delete_promotion') . ' ' . __('content.promotion.please_try_again_later'));
        }
    }
    public function trash(Request $request)
    {
        try {
            $listDeletedPromotions = $this->promotionService->listDeletedPromotions($request->keyword);
            return view('admin.promotion.trash_promotion', compact('listDeletedPromotions'));
        } catch (\Exception $e) {
            Log::error('Error deleting promotion: ' . $e->getMessage());
            return redirect()->route('admin.promotion.index')->with('error', __('content.promotion.could_not_retrieve_promotions') . ' ' . __('content.promotion.please_try_again_later'));
        }
    }

    public function restoreTrash($id)
    {
        $promotion = $this->promotionService->restoreTrash($id);
        activity()
            ->causedBy(auth()->user())
            ->withProperties(['title' => __('content.activity.restore_promotion_title')])
            ->log(__('content.activity.restore_promotion') . ': ' . $promotion->code);
        return redirect()->route('admin.promotion.index')
            ->with('success', __('content.promotion.promotion_restored_successfully'));
    }

    public function forceDelete($id)
    {
        $promotion = $this->promotionService->forceDelete($id);
        activity()
            ->causedBy(auth()->user())
            ->withProperties(['title' => __('content.activity.delete_promotion_title')])
            ->log(__('content.activity.delete_promotion') . ': ' . $promotion->code);
        return redirect()->route('admin.categories.index')
            ->with('success', __('content.promotion.promotion_deleted_successfully'));
    }
}
