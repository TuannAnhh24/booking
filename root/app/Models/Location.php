<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'locations';

    protected $fillable = [
        'code',
        'name',
        'views',
        'description',
        'deleted_reason',

    ];

    public function images()
    {
        return $this->belongsToMany(Image::class, 'location_images', 'location_id', 'image_id');
    }
    public function destinations()
    {
        return $this->belongsToMany(Destination::class, 'location_destination', 'location_id', 'destination_id');
    }
    public function characteristics()
    {
        return $this->belongsToMany(Characteristic::class, 'location_characteristic')->withTimestamps();
        ;
    }
    public function locationDestinations()
    {
        return $this->hasMany(LocationDestination::class);
    }
}