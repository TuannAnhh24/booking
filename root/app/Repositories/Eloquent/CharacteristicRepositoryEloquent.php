<?php

namespace App\Repositories\Eloquent;

use App\Models\Characteristic;
use App\Repositories\Traits\RepositoryTraits;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Location;
use App\Repositories\Contracts\CharacteristicRepository as ContractsCharacteristicRepository;

/**
 * Class ExampleRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CharacteristicRepositoryEloquent extends BaseRepository implements ContractsCharacteristicRepository
{
    use RepositoryTraits;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Characteristic::class;
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
}
