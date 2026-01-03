<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientSeeder extends Seeder
{
    public function run()
    {
        DB::table('ingredients')->insert([
            ['ingredients_name' => 'Sausage', 'ingredients_price' => 2.00, 'ingredients_image' => 'images/kolbasa.webp'],
            ['ingredients_name' => 'Ham', 'ingredients_price' => 3.00, 'ingredients_image' => 'images/vetchina.webp'],
            ['ingredients_name' => 'Mozzarella', 'ingredients_price' => 12.00, 'ingredients_image' => 'images/mozarella.webp'],
            ['ingredients_name' => 'Mushrooms', 'ingredients_price' => 4.00, 'ingredients_image' => 'images/gribi.webp'],
            ['ingredients_name' => 'Pepper', 'ingredients_price' => 2.00, 'ingredients_image' => 'images/halapen.webp'],
            ['ingredients_name' => 'Onion', 'ingredients_price' => 1.00, 'ingredients_image' => 'images/lok.webp'],
        ]);
    }
}