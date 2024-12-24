<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use HasFactory;
    
    use SoftDeletes;
    protected $table = "review";
    protected $fillable = [
        'user_id',
        'destination_id',
        'review_image_id',
        'rating',
        'comment',
        'deletion_reason',
        'staff_rating',
        'comfort_rating',
        'amenities_rating',
        'value_for_money_rating',
        'location_rating',
        'cleanliness_rating',
    ];

    public function images(){
        return $this->belongsToMany(Image::class, 'review_image', 'review_id', 'image_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function destination()
    {
        return $this->belongsTo(Destination::class, 'destination_id');
    }
    public function getRatingAvgAttribute()
    {
        $ratings = [
            'rating',
            'staff_rating',
            'comfort_rating',
            'amenities_rating',
            'value_for_money_rating',
            'location_rating',
            'cleanliness_rating'
        ];
        $sum = 0;
        $count = 0;

        foreach ($ratings as $rating) {
            if ($this->{$rating} !== null) {
                $sum += $this->{$rating};
                $count++;
            }
        }

        return $count > 0 ? $sum / $count : 0;
    }
}
