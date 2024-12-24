<?php

namespace App\Services\Contracts;

interface DashboardServiceInterface
{
    public function getCountAllRoleUser();
    
    public function getAllDestination();

    public function getRecentDestinations();

    public function getNewUser();

    public function getAvailableRooms();

    public function getBookingToDay();
}
