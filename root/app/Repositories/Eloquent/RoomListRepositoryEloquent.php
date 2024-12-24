<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Traits\RepositoryTraits;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\RoomListRepository;
use App\Models\RoomList;


/**
 * Class ExampleRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class RoomListRepositoryEloquent extends BaseRepository implements RoomListRepository
{
    use RepositoryTraits;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return RoomList::class;
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
        $userId = auth()->id();
        $currentDateTime = now();
        $model = $model->with([
            'users',
            'roomListBookings' => function ($query) use ($currentDateTime) {
                $query->where('available_from', '<=', $currentDateTime)
                    ->where('available_to', '>=', $currentDateTime)
                    ->with('booking.user');
            },
            'room',
        ]);
        $model->whereHas('users', function ($query) use ($userId) {
            $query->where('users.id', $userId);
        });
        if (!empty($filters['keyword'])) {
            $model->whereHas('room', function ($query) use ($filters) {
                $query->where('name', 'like', '%' . $filters['keyword'] . '%');
            });
        }
        if (!empty($filters['roomType'])) {
            $model->whereHas('room', function ($query) use ($filters) {
                $query->where('name', 'like', '%' . $filters['roomType'] . '%');
            });
        }
        if (!empty($filters['maxGuests'])) {
            $model->whereHas('room', function ($query) use ($filters) {
                $query->where('guest_quantity', 'like', '%' . $filters['maxGuests'] . '%');
            });
        }
        if (!empty($filters['bookerName'])) {
            $model->whereHas('roomListBookings.booking', function ($query) use ($filters) {
                $query->where('guest_details->full_name_guest', 'like', '%' . $filters['bookerName'] . '%');
            });
        }
        if (!empty($filters['phoneNumber'])) {
            $model->whereHas('roomListBookings.booking', function ($query) use ($filters) {
                $query->where('guest_details->phone_number', 'like', '%' . $filters['phoneNumber'] . '%');
            });
        }
        if (!empty($filters['status']) && $filters['status'] === 'booked') {
            $model->whereHas('roomListBookings.booking', function ($query) {
                $query->whereNotNull('id');
            });
        }
        if (!empty($filters['status']) && $filters['status'] === 'available') {
            $model->whereDoesntHave('roomListBookings.booking', function ($query) {
                $query->whereNotNull('id');
            });
        }
        return $model;
    }

    public function countByRoomId($roomId)
    {
        return $this->model->where('room_id', $roomId)->count();
    }
    public function findByRoomId($roomId)
    {
        return $this->model->where('room_id', $roomId)->get();
    }

    public function deleteMany($ids)
    {
        return $this->model->whereIn('id', $ids)->delete();
    }
}
