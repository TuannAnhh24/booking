<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Contracts\UserRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Repositories\Traits\RepositoryTraits;

class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    use RepositoryTraits;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Implement the abstract method `buildQuery` from `BaseRepository`.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function buildQuery($model, $filters)
    {
        if ($this->isValidKey($filters, 'keyword')) {
            $model = $model->where('first_name', 'like', '%' . $filters['keyword'] . '%')
                ->orWhere('last_name', 'like', '%' . $filters['keyword'] . '%')
                ->orwhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ['%' . $filters['keyword'] . '%']);
        }
        if ($this->isValidKey($filters, 'name')) {
            $model = $model->where('first_name', 'like', '%' . $filters['name'] . '%')
                ->orWhere('last_name', 'like', '%' . $filters['name'] . '%')
                ->orwhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ['%' . $filters['name'] . '%']);
        }
        if ($this->isValidKey($filters, 'email')) {
            $model = $model->where('email', 'like', '%' . $filters['email'] . '%');
        }
        if ($this->isValidKey($filters, 'phoneNumber')) {
            $model = $model->where('phone_number', 'like', '%' . $filters['phoneNumber'] . '%');
        }
        if ($this->isValidKey($filters, 'status')) {
            $model = $model->where('status', 'like', '%' . $filters['status'] . '%');
        }

        return $model;
    }
    public function getUsersByRole($roleId)
    {
        return $this->model->where('role_id', $roleId)->get();
    }

}
