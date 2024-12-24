<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoomBooking extends Model
{
    use HasFactory;
    protected $table = 'room_booking';

    protected $fillable = [
        'user_id',
        'room_booking_detail',
        'check_in',
        'check_out',
        'guest_details',
        'total_price',
        'take_note',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    // public function room_variant()
    // {
    //     return $this->belongsTo(RoomVariant::class, 'variant_id');
    // }
    public function roomListBookings()
    {
        return $this->hasMany(RoomListBooking::class, 'booking_id');
    }
    public function roomLists()
    {
        return $this->belongsToMany(RoomList::class, 'room_list_booking', 'booking_id', 'room_list_id')
            ->withPivot('available_from', 'available_to', 'status');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_room_booking', 'booking_id', 'user_id');
    }
    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);
        if (is_string($value) && $this->isJson($value)) {
            return json_decode($value, true);
        }

        return $value;
    }
    protected function isJson($string)
    {
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }
}
