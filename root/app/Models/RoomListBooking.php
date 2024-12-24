<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomListBooking extends Model
{
    use HasFactory;

    protected $table = 'room_list_booking';

    protected $fillable = [
        'room_list_id',
        'booking_id',
        'available_from',
        'available_to',
        'status',
    ];

    public function roomList()
    {
        return $this->belongsTo(RoomList::class, 'room_list_id');
    }

    public function booking()
    {
        return $this->belongsTo(RoomBooking::class, 'booking_id');
    }
}
