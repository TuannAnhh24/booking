<?php

namespace App\Http\Controllers;

use App\Services\Web\AnalyticService;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    protected $analyticService;

    public function __construct(AnalyticService $analyticService)
    {
        $this->analyticService = $analyticService;
    }

    public function index(Request $request)
    {
        $destinationId = $request->input('destination_id');
        $dateRange = [
            'start' => $request->input('start_date'),
            'end' => $request->input('end_date')
        ];

        $hotels = $this->analyticService->getUserHotels();
        $totalBookings = $this->analyticService->getTotalBookings($destinationId, $dateRange);
        $currentRevenue = $this->analyticService->getTotalRevenue($destinationId, $dateRange);
        $monthlyRevenue = $this->analyticService->getMonthlyRevenue($destinationId)->toArray();
        $monthlyBookings = $this->analyticService->getMonthlyBookings($destinationId)->toArray();
        $totalRooms = $this->analyticService->getTotalRooms($destinationId);
        $topRevenueHotels = $this->analyticService->getTopRevenueHotels($dateRange);

        $availableRooms = null;
        if ($destinationId && $request->has('start_date') && $request->input('start_date') === $request->input('end_date')) {
            $availableRooms = $this->analyticService->getAvailableRooms($destinationId, $request->input('start_date'));
        }

        return view('admin.analytics.index', compact(
            'hotels',
            'totalBookings',
            'currentRevenue',
            'monthlyRevenue',
            'monthlyBookings',
            'totalRooms',
            'availableRooms',
            'topRevenueHotels'
        ));
    }
}
