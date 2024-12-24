<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $locations = [];
        // for ($i = 1; $i <= 5; $i++) {
        //     $locations[] = [
        //         'name' => 'Location ' . $i,
        //         'description' => 'Description for location ' . $i,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //         'deleted_reason' => null,
        //     ];
        // }

        // DB::table('locations')->insert($locations);

        // $images = [];
        // for ($i = 1; $i <= 5; $i++) {
        //     $images[] = [
        //         'image' => 'https://example.com/image' . $i . '.jpg',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ];
        // }

        // DB::table('images')->insert($images);

        // $locationIds = DB::table('locations')->pluck('id');
        // $imageIds = DB::table('images')->pluck('id');

        // $locationImageData = [];
        // foreach ($locationIds as $locationId) {
        //     foreach (array_rand($imageIds->toArray(), 2) as $imageId) {
        //         $locationImageData[] = [
        //             'location_id' => $locationId,
        //             'image_id' => $imageIds[$imageId],
        //         ];
        //     }
        // }

        // DB::table('location_images')->insert($locationImageData);
    }
}
