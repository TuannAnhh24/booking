<?php

namespace App\Http\Controllers;

use App\Services\Web\SearchClientService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    protected $searchService;

    public function __construct(SearchClientService $searchService)
    {
        $this->searchService = $searchService;
    }

    public function index(Request $request)
    {
        $startTime = Carbon::parse($request->check_in);
        $endTime = Carbon::parse($request->check_out);

        $searchResult = $this->searchService->searchByLocationAndAvailability(
            $request->location,
            $startTime,
            $endTime,
            $request->rooms,
            $request->people_old,
        );
        $totalHotels = $this->searchService->getTotalHotels($request->location, $startTime, $endTime, $request->rooms, $request->people_old);
        activity()
            ->causedBy(auth()->user())
            ->withProperties(['title' => __('content.activity.search_title')])
            ->log(__('content.activity.search') . ": {$request->location}");

        return view('client.searchresults.mainsearch', array_merge($searchResult, [
            'totalHotels' => $totalHotels
        ]));
    }

    public function filterHotels(Request $request)
    {
        $locationName = $request->input('location');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $categories = $request->input('categories', []);
        $ratings = $request->input('ratings', []);
        $convenients = $request->input('convenients', []);
        $variants = $request->input('variants', []);
        $startTime = Carbon::parse($request->input('check_in'));
        $endTime = Carbon::parse($request->input('check_out'));

        $requiredRooms = $request->query('rooms');
        $people_old = $request->query('people_old');

        $categoryId = $request->input('category_id');
        if ($categoryId && !in_array($categoryId, $categories)) {
            $categories[] = $categoryId;
        }
        $numNights = $startTime->diffInDays($endTime);
        $totalHotels = $this->searchService->getTotalHotels($request->location, $startTime, $endTime, $request->rooms, $request->people_old);
        $hotels = $this->searchService->filterHotels(
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
        
        $html = view('client.searchresults.layouts-search.list-item', compact(
            'hotels',
            'locationName',
            'numNights',
            'convenients',
            'totalHotels'
        ))->render();
        return response()->json(['html' => $html]);
    }
}