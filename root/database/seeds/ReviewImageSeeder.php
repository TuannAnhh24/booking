<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewImageSeeder extends Seeder
{

    public function run()
    {
        DB::table('review_image')->insert([
            // Review 1 có hai ảnh
            [
                'review_id' => 1,
                'image_id' => 1,
            ],
            [
                'review_id' => 1,
                'image_id' => 2,
            ],
            // Review 2 có ba ảnh
            [
                'review_id' => 2,
                'image_id' => 3,
            ],
            [
                'review_id' => 2,
                'image_id' => 4,
            ],
            [
                'review_id' => 2,
                'image_id' => 5,
            ],
        ]);
    }
}
