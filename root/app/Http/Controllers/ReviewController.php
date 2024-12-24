<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeleteReviewRequest;
use App\Services\Contracts\ReviewServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    protected $reviewService;
    public function __construct(ReviewServiceInterface $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    public function index()
    {
        try {
            $listReview = $this->reviewService->getAllReview();
            return view('admin.review.list_review', compact('listReview'));
        } catch (\Exception $e) {
            Log::error('Error fetching review list: ' . $e->getMessage());
            return redirect()->route('admin.review.index')->with('error', __('content.review.could_not_retrieve_reviews.') . ' ' . __('content.review.please_try_again_later.'));
        }
    }

    public function destroy(DeleteReviewRequest $request, $id)
    {
        $validatedData = $request->validated();
        try {
            $this->reviewService->deleteReviewId($id, $validatedData['deletion_reason']);
            activity()
                ->causedBy(auth()->user())
                ->withProperties(['title' => __('content.activity.delete_review_title')])
                ->log(__('content.activity.delete_review'));
            return redirect()->route('admin.review.index')->with('success', __('content.review.review_deleted_successfully'));
        } catch (\Exception $e) {
            Log::error('Error deleting review: ' . $e->getMessage());
            return redirect()->route('admin.review.index')->with('error', __('content.review.failed_to_delete_review') . ' ' . __('content.review.please_try_again_later'));
        }
    }
}
