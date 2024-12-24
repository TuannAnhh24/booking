<?php

namespace App\Services\Web;

use App\Models\Destination;
use App\Repositories\Contracts\ImageRepository;
use App\Repositories\Contracts\ReviewRepository;
use App\Repositories\Contracts\RoomBookingRepository;
use App\Services\Contracts\ReviewServiceInterface;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\DB;

class ReviewService implements ReviewServiceInterface
{
    use FileTrait {
        delete as deleteFile;
    }
    protected $reviewRepository;
    protected $imageRepository;

    protected $roomBookingRepository;

    public function __construct(ReviewRepository $reviewRepository, ImageRepository $imageRepository, RoomBookingRepository $roomBookingRepository)
    {
        $this->reviewRepository = $reviewRepository;
        $this->imageRepository = $imageRepository;
        $this->roomBookingRepository = $roomBookingRepository;
    }


    public function getFavoriteHomes()
    {
        $favoriteHomes = $this->reviewRepository
            ->with(['destination.rooms.variants', 'destination.images']) // Tải trước cả rooms, variants và images
            ->select('destination_id', DB::raw('AVG(rating) as average_rating'), DB::raw('COUNT(comment) as comments_count'))
            ->groupBy('destination_id')
            ->get();

        $favoriteHomes->each(function ($favorite) {
            if ($favorite->destination && $favorite->destination->rooms->isNotEmpty()) {
                $favorite->lowest_price = $favorite->destination->rooms->flatMap(function ($room) {
                    return $room->variants;
                })->min('pivot.price_per_night');

                $favorite->total_comments = $this->reviewRepository
                    ->where('destination_id', $favorite->destination_id)
                    ->count();
            } else {
                $favorite->lowest_price = null;
                $favorite->total_comments = 0;
            }
        });

        return $favoriteHomes;
    }
    public function getAllReview()
    {
        $orderBy = ['updated_at' => 'desc'];
        $filters = [];

        $promotion = $this->reviewRepository->paginateByFilters(
            $filters,
            PAGINATE_MAX_RECORD,
            ['user', 'destination'],
            $orderBy
        )->withQueryString();

        return $promotion;
    }

    public function deleteReviewId($id, $reason)
    {
        $promotion = $this->reviewRepository->find($id);
        $promotion->deletion_reason = $reason;
        $promotion->save();
        $promotion->delete();
    }
    public function getReviewsByDestinationId($destinationId, $sortOption = 'highest_rating')
    {
        $filters = [
            'destination_id' => $destinationId
        ];
        $query = $this->reviewRepository->buildQuery($this->reviewRepository->getModel(), $filters);

        switch ($sortOption) {
            case 'highest_rating':
                $query->orderBy('rating', 'desc');
                break;
            case 'lowest_rating':
                $query->orderBy('rating', 'asc');
                break;
            case 'most_recent':
                $query->orderBy('created_at', 'desc');
                break;
            case 'least_recent':
                $query->orderBy('created_at', 'asc');
                break;
            default:
                $query->orderBy('comment', 'desc');
                break;
        }

        $reviews = $query->with(['user', 'destination', 'images'])->paginate(PAGINATE_MAX_RECORD);

        return $reviews;
    }



    public function getFavoriteDestinations()
    {
        $favoriteDestinations = $this->reviewRepository
            ->with(['destination.rooms.variants', 'destination.images'])
            ->select('destination_id')
            ->selectRaw('AVG(rating) as average_rating')
            ->selectRaw('COUNT(comment) as comments_count')
            ->groupBy('destination_id')
            ->get()
            ->map(function ($favorite) {
                $destination = $favorite->destination;
                if ($destination && $destination->rooms->isNotEmpty()) {
                    $favorite->lowest_price = $destination->rooms->flatMap->variants->min('pivot.price_per_night');
                    $favorite->total_comments = $destination->reviews_count;
                } else {
                    $favorite->lowest_price = null;
                    $favorite->total_comments = 0;
                }
                $favorite->destination = $destination;
                return $favorite;
            });
        return $favoriteDestinations;
    }
    public function writeReviews($request)
    {

        $review = $this->reviewRepository->create([
            'user_id' => auth()->id(),
            'destination_id' => $request->input('destination_id'),
            'rating' => $request->input('rating'),
            'staff_rating' => $request->input('staff_rating'),
            'comfort_rating' => $request->input('comfort_rating'),
            'amenities_rating' => $request->input('amenities_rating'),
            'value_for_money_rating' => $request->input('value_for_money_rating'),
            'location_rating' => $request->input('location_rating'),
            'cleanliness_rating' => $request->input('cleanliness_rating'),
            'comment' => $request->input('comment'),
            'deletion_reason' => $request->input('deletion_reason')
        ]);
        $images = $request->file('review_images', []);
        $savedImages = [];
        foreach ($images as $imgData) {
            $filePath = $this->upload($imgData, REVIEW_IMAGES_DIRECTORY);
            $savedImages[] = $this->imageRepository->create([
                'image' => $filePath,
            ]);
        }
        $review->images()->attach(array_column($savedImages, 'id'));

        return $review;
    }
    public function canUserReview($userId, $destinationId)
    {
        $query = $this->roomBookingRepository
            ->where('user_id', $userId)
            ->whereRaw('JSON_UNQUOTE(JSON_EXTRACT(room_booking_detail, "$[0].destinations_id")) = ?', [$destinationId])
            ->whereHas('roomListBookings', function ($query) {
                $query->where('status', 'completed');
            });

        return $query->exists();
    }
    public function calculateAverageRating($destinationId)
    {
        $reviews = $this->reviewRepository->where('destination_id', $destinationId)->get();

        $averageRatings = $reviews->map(function ($review) {
            return collect([
                $review->rating,
                $review->staff_rating,
                $review->comfort_rating,
                $review->amenities_rating,
                $review->value_for_money_rating,
                $review->location_rating,
                $review->cleanliness_rating,
            ])->filter()->avg();
        });
        return $averageRatings->isNotEmpty() ? $averageRatings->avg() : null;
    }
}
