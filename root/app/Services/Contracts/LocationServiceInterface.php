<?php

namespace App\Services\Contracts;

interface LocationServiceInterface
{

    public function getAllLocations($request);
    public function getLocation($id);
    public function createLocation($request);
    public function updateLocation($request, $id);
    public function deleteLocation($id, $reason);

    // client
    public function getAll();
    public function getTop5();
    public function getLocationsByCharacteristic($id);
    public function getTrash();
    public function restoreTrash($id);

    public function forceDelete($id);

}
