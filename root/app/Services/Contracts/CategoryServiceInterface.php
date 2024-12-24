<?php

namespace App\Services\Contracts;


interface CategoryServiceInterface
{
    public function getAllCategory($request);
    public function getCategory($id);
    public function createCategory($request);
    public function updateCategory($request, $id);
    public function deleteCategory($id, $reason);

    public function getTrash();
    public function restoreTrash($id);

    public function forceDelete($id);
    // client
    public function getAll();
    public function getHotelsByCategory($categoryId);

}
