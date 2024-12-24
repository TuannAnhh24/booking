<?php

namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Repositories\Traits\RepositoryTraits;

class CategoryRepositoryEloquent extends BaseRepository implements CategoryRepository
{
    use RepositoryTraits;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
    }

    /**
     * Implement the abstract method `buildQuery` from `BaseRepository`.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function buildQuery($model, $filters)
    {
        if($this->isValidKey($filters, 'keyword')) {
            $keyword = $filters['keyword'];
            $model = $model->where('name', 'like', '%' . $keyword . '%');
        }
        return $model;
    }
}
