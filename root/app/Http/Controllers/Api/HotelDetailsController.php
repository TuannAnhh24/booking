<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Web\DestinationService;
use App\Services\Web\ReviewService;
use Illuminate\Http\Request;

class HotelDetailsController extends Controller
{

    protected $destinationService;
    protected $reviewService;

    public function __construct(DestinationService $destinationService, ReviewService $reviewService)
    {
        $this->destinationService = $destinationService;
        $this->reviewService = $reviewService;
    }
    public function hotelDetails($id)
    {
        try {
            $destination = $this->destinationService->getDestination($id);

            if (!$destination) {
                return response()->json([
                    'message' => 'Destination not found'
                ], 404);
            }

            $reviews = $this->reviewService->getReviewsByDestinationId($id);

            if ($reviews->isEmpty()) {
                return response()->json([
                    'destination' => $destination,
                    'reviews' => [],
                    'averageRating' => null,
                    'message' => 'No reviews available for this destination'
                ], 200);
            }

            $averageRating = $reviews->avg('rating');

            return response()->json([
                'destination' => $destination,
                'reviews' => $reviews,
                'averageRating' => $averageRating
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while fetching hotel details',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
