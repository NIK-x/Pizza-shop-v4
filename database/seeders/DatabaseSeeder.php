<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Сначала создайте таблицу cities вручную через SQL или пропустите
        // $this->call([CitySeeder::class]); // ЗАКОММЕНТИРУЙТЕ ЭТУ СТРОКУ
        
        $this->call([
            CategorySeeder::class,
            SizeSeeder::class,
            IngredientSeeder::class,
            PizzaSeeder::class,
            // UserSeeder::class, // Временно закомментируйте, пока не создана cities
        ]);
    }
}