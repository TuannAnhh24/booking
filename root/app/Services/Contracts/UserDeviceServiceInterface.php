<?php

namespace App\Services\Contracts;

interface UserDeviceServiceInterface
{
    public function getAll($request);
    public function getDeviceInfo();
    public function saveDeviceInfo($user, $data);
    public function updateStatusLogout($user, $data);
    public function getDevicesByUserId($id);
    public function logoutAllDevices($user);
    public function logoutDeviceById($user, $deviceId);

}
