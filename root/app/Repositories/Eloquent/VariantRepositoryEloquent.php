<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Traits\RepositoryTraits;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\VariantRepository;
use App\Models\Example;
use App\Models\Variant;

/**
 * Class ExampleRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class VariantRepositoryEloquent extends BaseRepository implements VariantRepository
{
    use RepositoryTraits;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Variant::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function buildQuery($model, $filters)
    {
        if($this->isValidKey($filters, 'keyword')) {
            $keyword = $filters['keyword'];
            $model = $model->where('name', 'like', '%' . $keyword . '%');
        }
        return $model;
    }

}
