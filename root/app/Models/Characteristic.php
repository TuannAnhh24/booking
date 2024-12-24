<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Characteristic extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'characteristics';

    protected $fillable = [
        'name',
        'deleted_reason',
    ];

    public function locations()
    {
        // Quan hệ nhiều-nhiều với model Location
        return $this->belongsToMany(Location::class, 'location_characteristic', 'characteristic_id', 'location_id');
    }
}
