<?php

namespace App\Repositories\Eloquent;

use App\Models\RoomBooking;
use App\Repositories\Contracts\AnalyticRepository;
use App\Repositories\Traits\RepositoryTraits;
use Prettus\Repository\Eloquent\BaseRepository;

class AnalyticRepositoryEloquent extends BaseRepository implements AnalyticRepository
{
    use RepositoryTraits;

    public function model()
    {
        return RoomBooking::class;
    }

    public function buildQuery($model, $filters)
    {
        return $model;
    }

}
