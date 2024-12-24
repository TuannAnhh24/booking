<?php

namespace Database\Seeds;


use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'role_id' => 1,
            'user_name' => 'user',
            'first_name' => 'user_first_name1',
            'last_name' => 'user_last_name1',
            'email' => 'example1@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'address' => '123 Elm Street',
            'phone_number' => '123-456-7890',
            'gender' => 1,
            'birthday' => '1990-01-01',
            'avatar' => 'avatar1.jpg',
            'nationality' => 'American',
            'passport' => 'A1234567',
            'status' => 1,
            'description' => 'Sample user 1',
        ]);

        User::create([
            'role_id' => 2,
            'user_name' => 'user_admin',
            'first_name' => 'user_first_name2',
            'last_name' => 'user_last_name2',
            'email' => 'example2@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'address' => '456 Oak Avenue',
            'phone_number' => '987-654-3210',
            'gender' => 0,
            'birthday' => '1985-05-15',
            'avatar' => 'avatar2.jpg',
            'nationality' => 'British',
            'passport' => 'B2345678',
            'status' => 1,
            'description' => 'Sample user 2',
        ]);

        User::create([
            'role_id' => 3,
            'user_name' => 'system_admin',
            'first_name' => 'user_first_name3',
            'last_name' => 'user_last_name3',
            'email' => 'example3@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'address' => '789 Pine Road',
            'phone_number' => '345-678-9012',
            'gender' => 1,
            'birthday' => '1992-07-22',
            'avatar' => 'avatar3.jpg',
            'nationality' => 'Canadian',
            'passport' => 'C3456789',
            'status' => 1,
            'description' => 'Sample user 3',
        ]);

        User::create([
            'role_id' => 4,
            'user_name' => 'super_admin',
            'first_name' => 'user_first_name4',
            'last_name' => 'user_first_name4',
            'email' => 'example4@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'address' => '101 Maple Street',
            'phone_number' => '567-890-1234',
            'gender' => 0,
            'birthday' => '1988-11-30',
            'avatar' => 'avatar4.jpg',
            'nationality' => 'Australian',
            'passport' => 'D4567890',
            'status' => 1,
            'description' => 'Sample user 4',
        ]);
    }
}
