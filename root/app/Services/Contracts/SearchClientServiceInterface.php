<?php

namespace App\Services\Contracts;

interface SearchClientServiceInterface
{
    public function searchByLocationAndAvailability($location, $checkIn, $checkOut);
    public function loadFiltersByLocation($location);
}
