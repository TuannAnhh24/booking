<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoomList extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'room_lists';

    protected $fillable = [
        'room_id',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
    public function roomListBookings()
    {
        return $this->hasMany(RoomListBooking::class, 'room_list_id');
    }

    public function bookings()
    {
        return $this->belongsToMany(RoomBooking::class, 'room_list_booking', 'room_list_id', 'booking_id')
            ->withPivot('available_from', 'available_to', 'status');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_room_list', 'roomList_id', 'user_id');
    }
}
