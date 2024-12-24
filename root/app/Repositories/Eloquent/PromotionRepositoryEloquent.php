<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Traits\RepositoryTraits;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Promotion;
use App\Repositories\Contracts\PromotionRepository;

/**
 * Class ExampleRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PromotionRepositoryEloquent extends BaseRepository implements PromotionRepository
{
    use RepositoryTraits;

    public function model()
    {
        return Promotion::class;
    }

    public function buildQuery($model, $filters)
    {
        if ($this->isValidKey($filters, 'keyword')) {
            $model = $model->where('short_description', 'like', '%' . $filters['keyword'] . '%');
        }
        return $model;
    }
    public function codeExists($code)
    {
        return $this->model->where('code', $code)->exists();
    }

}
