<?php

namespace App\Services\Web;

use App\Models\RoomBooking;
use App\Models\Destination;
use App\Models\Room;
use App\Models\RoomList;
use App\Models\RoomListBooking;
use Illuminate\Support\Facades\Auth;
use App\Services\Contracts\AnalyticServiceInterface;

class AnalyticService implements AnalyticServiceInterface
{
    public function getUserHotels()
{
    $userId = Auth::id();
    $userRole = Auth::user()->role_id;

    // Nếu là super admin (role_id = 4, hoặc 3 ), lấy toàn bộ khách sạn
    if (in_array($userRole, [4, 3])) {
        return Destination::all();
    }

    // Ngược lại, chỉ lấy các khách sạn mà người dùng có liên kết
    return Destination::whereHas('users', function ($query) use ($userId) {
        $query->where('user_id', $userId);
    })->get();
}


    public function getAllBookingForUser($destinationId = null, $dateRange = [])
    {
        $ownerId = Auth::id();
        $userRole = Auth::user()->role_id; // Assuming role_id is stored in the users table

        // If the user is a super admin (role_id = 4, hoặc 3), load all bookings
        if (in_array($userRole, [4, 3])) {
            $query = RoomBooking::query();
        } else {
            $query = RoomBooking::query()
                ->whereHas('users', function ($query) use ($ownerId) {
                    $query->where('user_id', $ownerId);
                });
        }

        if (!empty($dateRange['start']) && !empty($dateRange['end']) && $dateRange['start'] === $dateRange['end']) {
            $singleDate = $dateRange['start'];
            $query->where(function ($query) use ($singleDate) {
                $query->where('check_in', '<=', $singleDate)
                    ->where('check_out', '>=', $singleDate);
            });
        } elseif (!empty($dateRange['start']) && !empty($dateRange['end'])) {
            $query->where(function ($query) use ($dateRange) {
                $query->whereBetween('check_in', [$dateRange['start'], $dateRange['end']])
                    ->orWhereBetween('check_out', [$dateRange['start'], $dateRange['end']])
                    ->orWhere(function ($query) use ($dateRange) {
                        $query->where('check_in', '<=', $dateRange['start'])
                            ->where('check_out', '>=', $dateRange['end']);
                    });
            });
        }

        $bookings = $query->orderBy('updated_at', 'desc')->get();

        if ($destinationId) {
            $roomIds = Room::where('destination_id', $destinationId)->pluck('id')->toArray();
            $bookings = $bookings->filter(function ($booking) use ($roomIds) {
                $details = is_string($booking->room_booking_detail)
                    ? json_decode($booking->room_booking_detail, true)
                    : $booking->room_booking_detail;

                if (is_array($details)) {
                    foreach ($details as $roomDetail) {
                        if (isset($roomDetail['room_id']) && in_array($roomDetail['room_id'], $roomIds)) {
                            return true;
                        }
                    }
                }
                return false;
            })->values();
        }

        foreach ($bookings as $booking) {
            if (is_string($booking->guest_details)) {
                $booking->guest_details = json_decode($booking->guest_details, true);
            }
        }

        return $bookings;
    }



    public function getTotalBookings($destinationId = null, $dateRange = [])
    {
        $bookings = $this->getAllBookingForUser($destinationId, $dateRange);
        return $bookings->count();
    }

    public function getTotalRevenue($destinationId = null, $dateRange = [])
    {
        $bookings = $this->getAllBookingForUser($destinationId, $dateRange);
        return $bookings->sum('total_price');
    }
    public function getMonthlyRevenue($destinationId = null)
    {
        $bookings = $this->getAllBookingForUser($destinationId);

        $monthlyRevenue = [];

        foreach ($bookings as $booking) {
            $monthYear = date('Y-m', strtotime($booking->check_in));
            $monthlyRevenue[$monthYear] = ($monthlyRevenue[$monthYear] ?? 0) + $booking->total_price;
        }

        ksort($monthlyRevenue);

        return collect($monthlyRevenue);
    }
    public function getMonthlyBookings($destinationId = null)
    {
        $bookings = $this->getAllBookingForUser($destinationId);

        $monthlyBookings = [];

        foreach ($bookings as $booking) {
            $monthYear = date('Y-m', strtotime($booking->check_in));
            $monthlyBookings[$monthYear] = ($monthlyBookings[$monthYear] ?? 0) + 1;
        }

        ksort($monthlyBookings);

        return collect($monthlyBookings);
    }


    public function getTotalRooms($destinationId = null)
    {
        $userId = Auth::id();

        if ($destinationId) {
            return RoomList::whereHas('room', function ($query) use ($destinationId, $userId) {
                $query->where('destination_id', $destinationId)
                    ->whereHas('destinations', function ($query) use ($userId) {
                        $query->whereHas('users', function ($query) use ($userId) {
                            $query->where('user_id', $userId);
                        });
                    });
            })->count();
        }
        return 0;
    }
    public function getAvailableRooms($destinationId, $date)
    {
        if (!$destinationId || !$date) {
            return 0;
        }

        $roomIds = Room::where('destination_id', $destinationId)->pluck('id');

        $roomListIds = RoomList::whereIn('room_id', $roomIds)->pluck('id');

        $bookedRoomListIds = RoomListBooking::whereIn('room_list_id', $roomListIds)
            ->where('status', 'đã thuê')
            ->where(function ($query) use ($date) {
                $query->where('available_from', '<=', $date)
                    ->where('available_to', '>=', $date);
            })
            ->pluck('room_list_id')
            ->unique();

        return RoomList::whereIn('id', $roomListIds)
            ->whereNotIn('id', $bookedRoomListIds)
            ->count();
    }
    public function getTopRevenueHotels($dateRange = [])
    {
        $userHotels = $this->getUserHotels();
        $hotelRevenues = [];

        foreach ($userHotels as $hotel) {
            $revenue = $this->getTotalRevenue($hotel->id, $dateRange);
            $hotelRevenues[] = [
                'hotel_name' => $hotel->name,
                'total_revenue' => $revenue,
            ];
        }

        $sortedRevenues = collect($hotelRevenues)->sortByDesc('total_revenue');

        return $sortedRevenues->values();
    }
}
