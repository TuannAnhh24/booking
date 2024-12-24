<?php

namespace App\Http\Controllers;

use App\Services\Contracts\DashboardServiceInterface;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    protected $dashboardService;
    

    public function __construct(DashboardServiceInterface $dashboardService)
    {
        $this->dashboardService = $dashboardService;
        
    }

    public function index()
    {
        try {
            $rolesData = $this->dashboardService->getCountAllRoleUser();
            $countDestination = $this->dashboardService->getAllDestination();
            $recentDestinations = $this->dashboardService->getRecentDestinations();
            $listUser = $this->dashboardService->getNewUser();
            // $availableRooms = $this->dashboardService->getAvailableRooms();
            $bookingToDay = $this->dashboardService->getBookingToDay();
            return view('admin.dashboard', compact('rolesData', 'countDestination', 'recentDestinations', 'listUser', 'bookingToDay'));
        } catch (\Exception $e) {
            Log::error('Error fetching dashboard list: ' . $e->getMessage());
            return redirect()->route('admin.dashboard')->with('error', __('content.dashboard.could_not_retrieve_dashboards') . ' ' . __('content.dashboard.please_try_again_later'));
        }
    }
}
