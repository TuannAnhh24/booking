<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Destination extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'destinations';

    protected $fillable = [
        'name',
        'detailed_address',
        'views',
        'description',
        'deleted_reason',
    ];
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
    public function images()
    {
        return $this->belongsToMany(Image::class, 'destination_images', 'destination_id', 'image_id');
    }
    public function locations()
    {
        return $this->belongsToMany(Location::class, 'location_destination', 'destination_id', 'location_id')->withPivot('address', 'district_code', 'ward_code');
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_destination', 'destination_id', 'category_id')->withTimestamps();
        ;
    }
    public function convenients()
    {
        return $this->belongsToMany(Convenient::class, 'destination_convenient')->withTimestamps();
        ;
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_destination', 'destination_id', 'user_id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function locationDestinations()
    {
        return $this->hasMany(LocationDestination::class);
    }
}
