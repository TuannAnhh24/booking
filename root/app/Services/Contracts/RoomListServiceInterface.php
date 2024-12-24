<?php

namespace App\Services\Contracts;



interface RoomListServiceInterface
{
    public function getRoomQuantity($roomId);
    public function getRoomListsByRoomId($roomId);
    public function createRoomListEntry($roomId, $status = 'trống');
    public function deleteRoomListEntries($ids);
    public function manageRoomList($request);
    public function findRoomListById($id);
    public function updateStatusOrder($id, $request);
    public function addNameRoom($id, $request);
    public function getRoomList($id);
}
