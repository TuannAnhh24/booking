<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        Review::create([
            'user_id' => '2',
            'destination_id' => '1',
            'review_image_id' => '1',
            'rating' => '3',
            'comment' => 'tuyet voi',
        ]);

        Review::create([
            'user_id' => '3',
            'destination_id' => '2',
            'review_image_id' => '2',
            'rating' => '5',
            'comment' => 'cuc ky hai long',
        ]);
    }
}
