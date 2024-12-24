<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Traits\RepositoryTraits;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Location;
use App\Repositories\Contracts\LocationRepository as ContractsLocationRepository;

/**
 * Class ExampleRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class LocationRepositoryEloquent extends BaseRepository implements ContractsLocationRepository
{
    use RepositoryTraits;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Location::class;
    }

    /**
     * Implement the abstract method `buildQuery` from `BaseRepository`.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function buildQuery($model, $filters)
    {
        if ($this->isValidKey($filters, 'keyword')) {
            $model = $model->where('name', 'like', '%' . $filters['keyword'] . '%');
        }
        return $model;
    }
    public function getLocationsByCharacteristic($id)
    {
        return Location::with('images')
            ->whereHas('characteristics', function ($query) use ($id) {
                $query->where('characteristic_id', $id);
            })->get();
    }

}
