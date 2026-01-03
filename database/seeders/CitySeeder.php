<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    public function run()
    {
        DB::table('cities')->insert([
            ['city_name' => 'Kazan'],
            ['city_name' => 'Chelyabinsk'],
            ['city_name' => 'Ufa'],
            ['city_name' => 'Samara'],
            ['city_name' => 'Izhevsk'],
        ]);
    }
}