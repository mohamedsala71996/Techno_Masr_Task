<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'author_id' => 1,
                'author_type' => 'App\\Models\\User',
                'category_id' => 2, // Programming
                'title' => 'Getting Started with Laravel',
                'description' => 'A beginner\'s guide to building web apps using Laravel framework.',
                'status' => 'approved',
                'slug' => 'getting-started-with-laravel',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'author_id' => 2,
                'author_type' => 'App\\Models\\User',
                'category_id' => 3, // Gadgets
                'title' => 'Top 5 Gadgets of 2025',
                'description' => 'A review of the most innovative gadgets released this year.',
                'status' => 'approved',
                'slug' => 'top-5-gadgets-of-2025',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // [
            //     'author_id' => 3,
            //     'author_type' => 'App\\Models\\User',
            //     'category_id' => 5, // Travel
            //     'title' => 'Exploring Egypt: A Travel Guide',
            //     'description' => 'Discover the best places to visit in Egypt, from Cairo to Luxor.',
            //     'status' => 'pending',
            //     'slug' => 'exploring-egypt-travel-guide',
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'author_id' => 1,
            //     'author_type' => 'App\\Models\\User',
            //     'category_id' => 6, // Food
            //     'title' => 'Delicious Egyptian Dishes',
            //     'description' => 'A look at some of the tastiest traditional Egyptian foods.',
            //     'status' => 'approved',
            //     'slug' => 'delicious-egyptian-dishes',
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
        ];

        DB::table('posts')->insert($posts);
    }
}
