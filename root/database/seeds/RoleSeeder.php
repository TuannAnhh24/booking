<?php

namespace Database\Seeds;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'user',
            'description' => ' guest user',
        ]);
        Role::create([
            'name' => 'user_admin',
            'description' => ' user admin',

        ]);
        Role::create([
            'name' => 'system_admin',
            'description' => 'Administrator with full access',
        ]);
        Role::create([
            'name' => 'super_admin',
            'description' => 'Administrator with full access',

        ]);
    }
}
