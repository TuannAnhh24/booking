<?php

namespace App\Services\Web;

use App\Models\RoomVariant;
use App\Repositories\Contracts\DestinationRepository;
use App\Repositories\Contracts\RoomBookingRepository;
use App\Repositories\Contracts\UserRepository;
use App\Services\Contracts\DashboardServiceInterface;
use App\Traits\FileTrait;

class DashboardService implements DashboardServiceInterface
{
    use FileTrait {
        delete as deleteFile;
    }
    protected $userRepository;
    protected $destinationRepository;
    protected $roombookingRepository;

    public function __construct(UserRepository $userRepository, DestinationRepository $destinationRepository, RoomBookingRepository $roombookingRepository)
    {
        $this->userRepository = $userRepository;
        $this->destinationRepository = $destinationRepository;
        $this->roombookingRepository = $roombookingRepository;
    }

    public function getCountAllRoleUser()
    {
        $userCount = $this->userRepository->getUsersByRole(1)->count();
        $userAdminCount = $this->userRepository->getUsersByRole(2)->count();
        $systemAdminCount = $this->userRepository->getUsersByRole(3)->count();
        $superAdminCount = $this->userRepository->getUsersByRole(4)->count();

        $totalUsers = $userCount + $userAdminCount + $systemAdminCount + $superAdminCount;

        $percentages = [
            'user' => $totalUsers > 0 ? ($userCount / $totalUsers) * 100 : 0,
            'user_admin' => $totalUsers > 0 ? ($userAdminCount / $totalUsers) * 100 : 0,
            'system_admin' => $totalUsers > 0 ? ($systemAdminCount / $totalUsers) * 100 : 0,
            'super_admin' => $totalUsers > 0 ? ($superAdminCount / $totalUsers) * 100 : 0,
        ];

        return [
            'user' => $userCount,
            'user_admin' => $userAdminCount,
            'system_admin' => $systemAdminCount,
            'super_admin' => $superAdminCount,
            'percentages' => $percentages,
        ];
    }
    public function getNewUser()
    {
        $listUser = $this->userRepository
            ->where('role_id', 1)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        return $listUser;
    }

    public function getAllDestination()
    {
        $countDestination = $this->destinationRepository->all()->count();
        return $countDestination;
    }

    public function getRecentDestinations()
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;

        $recentDestinations = $this->destinationRepository
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();

        return $recentDestinations;
    }

    public function getAvailableRooms()
    {
        $availableRooms = RoomVariant::whereDoesntHave('bookings', function ($query) {
            $query  ->where('check_in', '<=', now())
                    ->where('check_out', '>=', now());
        })  ->where('available_from', '<=', now())
            ->where('available_to', '>=', now())
            ->count();

        return $availableRooms;
    }

    public function getBookingToDay(){
        $today = now()->toDateString();
        $bookingToDay = $this->roombookingRepository
            ->whereDate('created_at', $today)
            ->count();
        return $bookingToDay;
    }
}
