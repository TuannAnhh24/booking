<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Traits\RepositoryTraits;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Review;
use App\Repositories\Contracts\ReviewRepository;

/**
 * Class ExampleRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ReviewRepositoryEloquent extends BaseRepository implements ReviewRepository
{
    use RepositoryTraits;

    public function model()
    {
        return Review::class;
    }

    public function buildQuery($model, $filters)
    {
        if (isset($filters['destination_id'])) {
            $model = $model->where('destination_id', $filters['destination_id']);
        }
        return $model;
    }
}
