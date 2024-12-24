<?php

namespace App\Services\Web;

use App\Models\Category;
use App\Models\Convenient;
use App\Models\Destination;
use App\Models\Location;
use App\Models\Variant;
use App\Repositories\Contracts\SearchRepository;

class SearchClientService
{
    protected $searchRepository;

    public $hotels;
    public $categories;
    public $ratings;
    public $convenients;
    public $variants;
    public $minPrice;
    public $maxPrice;

    public function __construct(SearchRepository $searchRepository)
    {
        $this->searchRepository = $searchRepository;
    }

    public function searchByLocationAndAvailability($location, $startTime, $endTime, $requiredRooms, $people_old)
    {
        $keywords = [$location];
        $startDate = $startTime->format('Y-m-d');
        $endDate = $endTime->format('Y-m-d');
        $exactHotel = $this->searchRepository->searchByLocation($keywords, $startDate, $endDate, $requiredRooms, $people_old );

        $locationModel = Location::where('name', 'like', "%{$location}%")->first();
        $locationModel?->increment('views');

        $locationName = $exactHotel?->locations->first()->name ?? $location;
        $otherHotels = $exactHotel && $exactHotel->locations->isNotEmpty()
            ? $this->searchRepository->searchOtherHotels($exactHotel, $locationName, $startDate, $endDate, $requiredRooms, $people_old)
            : [];

        // $this->hotels = collect([$exactHotel])->merge($otherHotels)->filter();
        $hotels = $this->searchRepository->searchHotelsForPagination($exactHotel, $otherHotels, $locationName, $startDate, $endDate, $requiredRooms, $people_old);
        $this->loadFiltersByLocation($locationName);

        return [
            // 'hotels' => $this->hotels,
            'hotels' => $hotels->appends([
                'location' => $location,
                'check_in' => $startTime->format('Y-m-d'),
                'check_out' => $endTime->format('Y-m-d'),
                'people_old' => $people_old,
                'rooms' => $requiredRooms
            ]),
            'categories' => $this->categories,
            'ratings' => $this->ratings,
            'convenients' => $this->convenients,
            'variants' => $this->variants,
            'minPrice' => $this->minPrice,
            'maxPrice' => $this->maxPrice,
            'locationName' => $locationName,
        ];
    }

    public function loadFiltersByLocation($locationName)
    {
        $this->categories = $this->loadCategories($locationName);
        $this->ratings = $this->calculateRatings($locationName);
        $this->convenients = $this->loadConvenients($locationName);
        $this->variants = $this->loadVariants($locationName);
        $priceRange = $this->calculatePriceRange($locationName);

        $this->minPrice = $priceRange->min_price ?? 0;
        $this->maxPrice = $priceRange->max_price ?? 0;
    }

    private function loadCategories($locationName)
    {
        return Category::whereHas('destinations.locations', fn($q) => $q->where('name', 'like', "%{$locationName}%"))
            ->withCount(['destinations' => fn($q) => $q->whereHas('locations', fn($sq) => $sq->where('name', 'like', "%{$locationName}%"))])
            ->distinct()->get();
    }

    private function calculateRatings($locationName)
    {
        return collect([1, 2, 3, 4, 5, 6, 7, 8, 9])->mapWithKeys(function ($rating) use ($locationName) {
            $count = Destination::whereHas('locations', fn($q) => $q->where('name', 'like', "%{$locationName}%"))
                ->whereHas('reviews', fn($q) => $q->havingRaw('AVG(rating) > ?', [$rating]))
                ->count();
            return [$rating => $count];
        });
    }

    private function loadConvenients($locationName)
    {
        return Convenient::whereHas('destinations.locations', fn($q) => $q->where('name', 'like', "%{$locationName}%"))
            ->withCount(['destinations' => fn($q) => $q->whereHas('locations', fn($sq) => $sq->where('name', 'like', "%{$locationName}%"))])
            ->distinct()->get();
    }

    private function loadVariants($locationName)
    {
        return Variant::whereHas('rooms.destinations.locations', fn($q) => $q->where('name', 'like', "%{$locationName}%"))
            ->withCount(['rooms' => fn($q) => $q->whereHas('destinations.locations', fn($sq) => $sq->where('name', 'like', "%{$locationName}%"))])
            ->distinct()->get();
    }

    private function calculatePriceRange($locationName)
    {
        return Destination::whereHas('locations', fn($q) => $q->where('name', 'like', "%{$locationName}%"))
            ->join('rooms', 'destinations.id', '=', 'rooms.destination_id')
            ->join('room_variant', 'rooms.id', '=', 'room_variant.room_id')
            ->selectRaw('MIN(room_variant.price_per_night) as min_price, MAX(room_variant.price_per_night) as max_price')
            ->first();
    }

    public function filterHotels($locationName, $minPrice, $maxPrice, $categories, $ratings, $convenients, $variants, $startTime, $endTime, $requiredRooms, $people_old)
    {
        return $this->searchRepository->filterHotels(
            $locationName,
            $minPrice,
            $maxPrice,
            $categories,
            $ratings,
            $convenients,
            $variants,
            $startTime,
            $endTime,
            $requiredRooms,
            $people_old,

        );
    }
    public function getTotalHotels($location, $startTime, $endTime, $requiredRooms, $people_old)
    {
        $keywords = [$location];
        $startDate = $startTime->format('Y-m-d');
        $endDate = $endTime->format('Y-m-d');
        $exactHotel = $this->searchRepository->searchByLocation($keywords, $startDate, $endDate, $requiredRooms, $people_old);

        $locationModel = Location::where('name', 'like', "%{$location}%")->first();
        $locationModel?->increment('views');

        $locationName = $exactHotel?->locations->first()->name ?? $location;
        $otherHotels = $exactHotel && $exactHotel->locations->isNotEmpty()
            ? $this->searchRepository->searchOtherHotels($exactHotel, $locationName, $startDate, $endDate, $requiredRooms, $people_old)
            : [];

        $hotels = collect([$exactHotel])->merge($otherHotels)->filter();

        return $hotels->count();
    }

}