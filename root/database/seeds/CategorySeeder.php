<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Images;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $categories = [];
        // for ($i = 1; $i <= 5; $i++) {
        //     $categories[] = [
        //         'name' => 'Category ' . $i,
        //         'description' => 'Description for category ' . $i,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //         'deleted_reason' => null,
        //     ];
        // }

        // DB::table('categories')->insert($categories);

        // $images = [];
        // for ($i = 1; $i <= 5; $i++) {
        //     $images[] = [
        //         'image' => 'https://example.com/image' . $i . '.jpg',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ];
        // }

        // DB::table('images')->insert($images);

        // $categoryIds = DB::table('categories')->pluck('id');
        // $imageIds = DB::table('images')->pluck('id');

        // $categoryImageData = [];
        // foreach ($categoryIds as $categoryId) {
        //     foreach (array_rand($imageIds->toArray(), 2) as $imageId) {
        //         $categoryImageData[] = [
        //             'category_id' => $categoryId,
        //             'image_id' => $imageIds[$imageId],
        //         ];
        //     }
        // }

        // DB::table('category_images')->insert($categoryImageData);
    }
}
