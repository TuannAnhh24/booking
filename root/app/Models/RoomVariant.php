<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomVariant extends Model
{
    use HasFactory;
    protected $table = 'room_variant';
    protected $fillable = [
        'room_id',
        'variant_id',
        'price_per_night',
    ];

    public function bookings()
    {
        return $this->hasMany(RoomBooking::class, 'variant_id');
    }

    
}
