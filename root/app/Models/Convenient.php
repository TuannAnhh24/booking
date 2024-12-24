<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Convenient extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'convenients';

    protected $fillable = [
        'name',
        'deleted_reason',
        'icon_class',
    ];

    public function destinations()
    {
        // Quan hệ nhiều-nhiều với model Location
        return $this->belongsToMany(Destination::class, 'destination_convenient', 'convenient_id', 'destination_id');
    }
}
