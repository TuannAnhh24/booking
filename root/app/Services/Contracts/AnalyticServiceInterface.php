<?php

namespace App\Services\Contracts;

interface AnalyticServiceInterface
{
    public function getUserHotels();
    public function getAllBookingForUser($destinationId = null, $dateRange = []);
    public function getTotalBookings($destinationId = null, $dateRange = []);
    public function getTotalRevenue($destinationId = null, $dateRange = []);
    public function getMonthlyRevenue($destinationId = null);
    public function getMonthlyBookings($destinationId = null);
    public function getTotalRooms($destinationId = null);
    public function getTopRevenueHotels($dateRange = []);
   
}
