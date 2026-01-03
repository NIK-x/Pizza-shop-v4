<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert([
            ['category_name' => 'Meat', 'category_slug' => 'meat'],
            ['category_name' => 'Vegetarian', 'category_slug' => 'vegetarian'],
            ['category_name' => 'Sea products', 'category_slug' => 'sea'],
            ['category_name' => 'Mushroom', 'category_slug' => 'mushroom'],
        ]);
    }
}