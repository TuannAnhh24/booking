<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'images';
    protected $fillable = [
        'image',
    ];
    public function variants()
    {
        return $this->belongsToMany(Variant::class, 'variant_images', 'image_id', 'variant_id');
    }

    public function locations()
    {
        return $this->belongsToMany(Location::class, 'location_images', 'image_id', 'location_id');
    }

    public function destinations()
    {
        return $this->belongsToMany(Destination::class, 'destination_images', 'image_id', 'destination_id');
    }

    public function review()
    {
        return $this->belongsToMany(Review::class, 'review_image', 'review_id', 'image_id',);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_images', 'image_id', 'category_id');
    }
    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'room_images', 'image_id', 'room_id');
    }
   
}
