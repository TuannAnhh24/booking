<?php

namespace App\Repositories\Eloquent;

use App\Models\UserDevice;
use App\Repositories\Contracts\UserDeviceRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Repositories\Traits\RepositoryTraits;

class UserDeviceRepositoryEloquent extends BaseRepository implements UserDeviceRepository
{
    use RepositoryTraits;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UserDevice::class;
    }

    /**
     * Implement the abstract method `buildQuery` from `BaseRepository`.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function buildQuery($model, $filters)
    {
        if ($this->isValidKey($filters, 'keyword')) {
            $model = $model->whereHas('user', function ($query) use ($filters) {
                $query->where('first_name', 'like', '%' . $filters['keyword'] . '%')
                    ->orWhere('last_name', 'like', '%' . $filters['keyword'] . '%')
                    ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ['%' . $filters['keyword'] . '%']);
            });
        }
        if ($this->isValidKey($filters, 'name')) {
            $model = $model->whereHas('user', function ($query) use ($filters) {
                $query->where('first_name', 'like', '%' . $filters['name'] . '%')
                    ->orWhere('last_name', 'like', '%' . $filters['name'] . '%')
                    ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ['%' . $filters['name'] . '%']);
            });
        }
        if ($this->isValidKey($filters, 'device_name')) {
            $model = $model->where('device_name', 'like', '%' . $filters['device_name'] . '%');
        }
        if ($this->isValidKey($filters, 'device_type')) {
            $model = $model->where('device_type', 'like', '%' . $filters['device_type'] . '%');
        }
        if ($this->isValidKey($filters, 'device_ip')) {
            $model = $model->where('device_ip', 'like', '%' . $filters['device_ip'] . '%');
        }
        if ($this->isValidKey($filters, 'browser')) {
            $model = $model->where('browser', 'like', '%' . $filters['browser'] . '%');
        }
        if ($this->isValidKey($filters, 'status')) {
            $model = $model->where('status', 'like', '%' . $filters['status'] . '%');
        }

        return $model;
    }
    public function findBy($conditions)
    {
        return $this->model->where($conditions)->first();
    }
    public function findAllBy($conditions)
    {
        return $this->model->where($conditions)->get();
    }
    public function updateMany(array $conditions, array $data)
    {
        return $this->model->where($conditions)->update($data);
    }
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }
}
