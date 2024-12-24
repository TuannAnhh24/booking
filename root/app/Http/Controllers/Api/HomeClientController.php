<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Contracts\BannerServiceInterface;
use App\Services\Contracts\CategoryServiceInterface;
use App\Services\Contracts\CharacteristicServiceInterface;
use App\Services\Contracts\DestinationServiceInterface;
use App\Services\Contracts\LocationServiceInterface;
use App\Services\Contracts\ReviewServiceInterface;

class HomeClientController extends Controller
{
    protected $destination;
    protected $categories;
    protected $locations;
    protected $charater;
    protected $reviews;
    protected $banner;

    public function __construct(
        DestinationServiceInterface $destination,
        CategoryServiceInterface $categories,
        ReviewServiceInterface $reviews,
        LocationServiceInterface $locations,
        CharacteristicServiceInterface $charater,
        BannerServiceInterface $banner
    ) {
        $this->destination = $destination;
        $this->locations = $locations;
        $this->categories = $categories;
        $this->reviews = $reviews;
        $this->charater = $charater;
        $this->banner = $banner;
    }




    // API cho trang home
    public function home()
    {
        $categories = $this->categories->getAll();
        $locations = $this->locations->getAll()->sortByDesc('destinations_count');
        $top5Location = $this->locations->getTop5();
        $characteristices = $this->charater->getAll();
        $destinations = $this->destination->getAll();
        $favoriteDestinations = $this->reviews->getFavoriteDestinations();
        $banner = $this->banner->getOneBaner(3);

        // Trả về JSON
        return response()->json([
            'categories' => $categories,
            'locations' => $locations,
            'top5Location' => $top5Location,
            'characteristices' => $characteristices,
            'destinations' => $destinations,
            'favoriteDestinations' => $favoriteDestinations,
            'banner' => $banner
        ]);
    }

    // API lấy danh sách locations theo đặc điểm
    public function getLocationsByCharacteristic($id)
    {
        $locations = $this->locations->getLocationsByCharacteristic($id);

        // Trả về JSON
        return response()->json($locations);
    }
}
