<?php

namespace App\Services\Contracts;

interface CharacteristicServiceInterface
{
    public function getAllCharacteristics();
    public function getCharacteristic($id);
    public function createCharacteristic($request);
    public function updateCharacteristic($request, $id);
    public function deleteCharacteristic($id, $reason);
    public function getTrash();
    public function restoreTrash($id);

    public function forceDelete($id);

    //client
    public function getAll();
}
