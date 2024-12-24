<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'description',
        'deleted_reason',
    ];

    public function images()
    {
        return $this->belongsToMany(Image::class, 'category_images', 'category_id', 'image_id');
    }
    public function destinations()
    {
        return $this->belongsToMany(Destination::class, 'category_destination', 'category_id', 'destination_id');
    }
    public function scopeSearch($query, $keyword)
    {
        return $query->where('name', 'like', '%' . $keyword . '%');
    }
}
