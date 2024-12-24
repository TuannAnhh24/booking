<?php



namespace Database\Seeders;
use Database\Seeders\CategorySeeder;

use Database\Seeders\LocationSeeder;
use Database\Seeds\RoleSeeder;
use Database\Seeds\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       $this->call(CategorySeeder::class);

        $this->call(
            LocationSeeder::class,
        );
        // $this->call(VariantSeeder::class);
        // $this->call(CustomTableSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);

    }
}
