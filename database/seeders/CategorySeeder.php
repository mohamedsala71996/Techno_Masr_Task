<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Technology',
                'slug' => 'technology',
                'parent_id' => null,
            ],
            [
                'name' => 'Programming',
                'slug' => 'programming',
                'parent_id' => 1,
            ],
            [
                'name' => 'Gadgets',
                'slug' => 'gadgets',
                'parent_id' => 1,
            ],
            // [
            //     'name' => 'Lifestyle',
            //     'slug' => 'lifestyle',
            //     'parent_id' => null,
            // ],
            // [
            //     'name' => 'Travel',
            //     'slug' => 'travel',
            //     'parent_id' => 4,
            // ],
            // [
            //     'name' => 'Food',
            //     'slug' => 'food',
            //     'parent_id' => 4,
            // ],
        ];

        DB::table('categories')->insert($categories);
    }
}
