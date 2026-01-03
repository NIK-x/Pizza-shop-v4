<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizeSeeder extends Seeder
{
    public function run()
    {
        DB::table('sizes')->insert([
            ['size_name' => 'Small', 'size_diameter' => 22],
            ['size_name' => 'Medium', 'size_diameter' => 28],
            ['size_name' => 'Large', 'size_diameter' => 33],
        ]);
    }
}