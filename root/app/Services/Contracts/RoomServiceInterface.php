<?php

namespace App\Services\Contracts;



interface RoomServiceInterface
{
    public function getAllRoom();
    public function getRoomById($id);

    public function createRoom();
    public function storeRoom($request);
    public function editRoom($id);
    public function updateRoom($request, $id);
    public function deleteRoom($request, $id);
    public function getTrash();
    public function restoreTrash($id);
    public function forceDelete($id);

    // manage-room
    public function getAllRoomManage();
}
