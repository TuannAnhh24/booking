<?php

namespace App\Services\Contracts;

interface DestinationServiceInterface
{
    public function getPopularDestinations();
    public function getAllDestinations();
    public function getDestination($id, $checkInDate = null, $checkOutDate = null, $guestCount = 2);
    public function createDestination($request);
    public function updateDestination($request, $id);
    public function deleteDestination($id, $reason);
    public function getTrash();
    public function restoreTrash($id);

    public function forceDelete($id);
    public function getAllDestinationsForRoom($paginate = true);

    // client
    public function getAll();
}
