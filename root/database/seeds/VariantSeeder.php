<?php

namespace Database\Seeds;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VariantSeeder extends Seeder
{
     public function run()
    {
        $variant = [];
        for($i=0;$i<5;$i++){
            $variant[]=[
                'name'=>fake()->name(),
                'description'=>fake()->text(),
                'reason'=>fake()->text(),
            ];
        }
        DB::table('variants')->insert($variant);
    }
}
