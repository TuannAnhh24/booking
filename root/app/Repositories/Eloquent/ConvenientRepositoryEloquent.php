<?php

namespace App\Repositories\Eloquent;

use App\Models\Convenient;
use App\Repositories\Traits\RepositoryTraits;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Repositories\Contracts\ConvenientRepository as ContractsConvenientRepository;

/**
 * Class ExampleRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ConvenientRepositoryEloquent extends BaseRepository implements ContractsConvenientRepository
{
    use RepositoryTraits;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Convenient::class;
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
