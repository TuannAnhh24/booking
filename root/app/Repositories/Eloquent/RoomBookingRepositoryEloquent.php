<?php

namespace App\Repositories\Eloquent;

use App\Models\RoomBooking;
use App\Repositories\Contracts\RoomBookingRepository;
use App\Repositories\Traits\RepositoryTraits;
use Prettus\Repository\Eloquent\BaseRepository;

class RoomBookingRepositoryEloquent extends BaseRepository implements RoomBookingRepository
{
    use RepositoryTraits;

    public function model()
    {
        return RoomBooking::class;
    }

    public function buildQuery($model, $filters)
    {
        $userId = auth()->id();
        $model = $model->with([
            'users',
            'roomListBookings',
        ]);
        $model->whereHas('users', function ($query) use ($userId) {
            $query->where('users.id', $userId);
        });
        if (!empty($filters['keyword'])) {
            $model->whereRaw("JSON_EXTRACT(guest_details, '$.transaction_id') LIKE ?", ['%' . $filters['keyword'] . '%']);
        }
        if (!empty($filters['roomType'])) {
            $model->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(room_booking_detail, '$[*].room_name')) LIKE ?", ['%' . $filters['roomType'] . '%']);
        }
        if (!empty($filters['transaction_id'])) {
            $model->whereRaw("JSON_EXTRACT(guest_details, '$.transaction_id') LIKE ?", ['%' . $filters['transaction_id'] . '%']);
        }
        if (!empty($filters['bookerName'])) {
            $model->whereRaw("JSON_EXTRACT(guest_details, '$.full_name_guest') LIKE ?", ['%' . $filters['bookerName'] . '%']);
        }
        if (!empty($filters['phoneNumber'])) {
            $model->whereRaw("JSON_EXTRACT(guest_details, '$.phone_number') LIKE ?", ['%' . $filters['phoneNumber'] . '%']);
        }
        if (!empty($filters['status'])) {
            $model->whereHas('roomListBookings', function ($query) use ($filters) {
                $query->where('status', 'like', '%' . $filters['status'] . '%');
            });
        }
        return $model;
    }
}
