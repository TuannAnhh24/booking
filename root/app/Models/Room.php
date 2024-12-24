<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'rooms';
    protected $fillable = [
        'name',
        'destination_id',
        'description',
        'reason',
        'guest_quantity',
    ];
    public function images()
    {
        return $this->belongsToMany(Image::class, 'room_images', 'room_id', 'image_id');
    }
    public function destinations()
    {
        return $this->belongsTo(Destination::class, 'destination_id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_room', 'room_id', 'user_id');
    }
    public function variants()
    {
        return $this->belongsToMany(Variant::class, 'room_variant', 'room_id', 'variant_id')->withPivot('price_per_night');
    }
    public function roomLists()
    {
        return $this->hasMany(RoomList::class, 'room_id');

    }
    public function bookings()
    {
        return $this->hasManyThrough(RoomBooking::class, RoomList::class, 'room_id', 'id', 'id', 'booking_id');
    }
}
