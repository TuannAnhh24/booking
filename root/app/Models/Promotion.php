<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promotion extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'promotion';
    protected $fillable = [
        'code',
        'discount_percentage',
        'discount_amount',
        'discount_type',
        'start_date',
        'end_date',
        'image',
        'short_description',
        'long_description',
        'quantity',
        'deletion_reason',
        'created_by',
    ];
    public function users()
    {
        return $this->belongsToMany(User::class, 'promotion_user', 'promotion_id', 'user_id');
    }
}
