<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Services\Web\DestinationService;
use App\Services\Web\ReviewService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HotelDetailsController extends Controller
{
    protected $destinationService;
    protected $reviewService;

    public function __construct(DestinationService $destinationService, ReviewService $reviewService)
    {
        $this->destinationService = $destinationService;
        $this->reviewService = $reviewService;
    }
    public function hotelDetails(Request $request, $id)
    {
        $checkInDate = Carbon::parse($request->input('check_in_date', Carbon::today()->toDateString()));
        $checkOutDate = Carbon::parse($request->input('check_out_date', Carbon::tomorrow()->toDateString()));

        $numberOfNights = $checkOutDate->diffInDays($checkInDate);

        $guest_count = $request->input('guest_count', 2);


        $destination = $this->destinationService->getDestination($id, $checkInDate, $checkOutDate, $guest_count);
        
        $destination->increment('views');// +1 views khi người dùng truy cập
        
        $sortOption = $request->input('sortOption', 'newest');
        $page = $request->input('page', 1);

        $reviews = $this->reviewService->getReviewsByDestinationId($id, $sortOption);
        $reviewCount = Review::where('destination_id', $id)->count();
        $averageRating = $this->reviewService->calculateAverageRating($id);

        $breadcrumbs = [
            ["url" => route('home'), "label" => __('content.hotel_detail.home')],
            ["url" => route('hotel-details', ['id' => $id]), "label" => $destination->name],
        ];

        if ($request->ajax()) {
            $html = view('client.hotel_details.partials.reviews_list', compact('reviews'))->render();
            return response()->json(['html' => $html]);
        }
        return view('client.hotel_details.hotel_details', [
            'destination' => $destination,
            'reviews' => $reviews,
            'averageRating' => $averageRating,
            'checkInDate' => $checkInDate->format('Y-m-d'),
            'checkOutDate' => $checkOutDate->format('Y-m-d'),
            'breadcrumbs' => $breadcrumbs,
            'numberOfNights' => $numberOfNights,
            'guest_count' => $guest_count,
            'reviewCount' => $reviewCount
        ]);
    }
    public function writeReview(Request $request)
    {
        $userId = Auth::id();
        if (!$this->reviewService->canUserReview($userId, $request->input('destination_id'))) {
            return redirect()->back()->with('error', __('content.hotel_detail.review_permission_denied'));
        }
        $review = $this->reviewService->writeReviews($request);
        activity()
            ->causedBy(auth()->user())
            ->withProperties(['title' => __('content.activity.add_review_title')])
            ->log(__('content.activity.add_review') . ': ' . $review->comment);
        return redirect()->back()->with('success', __('content.hotel_detail.review_success'));
    }
}