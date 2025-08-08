<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Ahmed Mostafa',
                'email' => 'ahmed@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'is_banned' => false,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sara Youssef',
                'email' => 'sara@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'is_banned' => false,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mohamed Ali',
                'email' => 'mohamed@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'is_banned' => false,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('users')->insert($users);
    }
}
