<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Variant extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'variants';
    protected $fillable = [
        'name',
        'description',
        'reason',
    ];
    public function images()
    {
        return $this->belongsToMany(Image::class, 'variant_images', 'variant_id', 'image_id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'room_variant', 'variant_id', 'room_id');
    }
}
