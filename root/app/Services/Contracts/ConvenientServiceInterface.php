<?php

namespace App\Services\Contracts;

interface ConvenientServiceInterface
{
    public function getAllConvenients();
    public function getConvenient($id);
    public function createConvenient($request);
    public function updateConvenient($request, $id);
    public function deleteConvenient($id, $reason);   
    public function getTrash();
    public function restoreTrash($id);

    public function forceDelete($id);

}
