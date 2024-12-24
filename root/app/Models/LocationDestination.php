<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationDestination extends Model
{
    use HasFactory;
    protected $table = 'location_destination';

    protected $fillable = [
        'location_id',
        'destination_id',
        'address',
    ];
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}
