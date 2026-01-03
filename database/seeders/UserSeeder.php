<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name_user' => 'Test User',
                'email_user' => 'test@example.com',
                'password_user' => Hash::make('password123'),
                'phone_user' => '+79991234567',
                'city_id' => DB::table('cities')->where('city_name', 'Kazan')->value('city_id'),
            ],
        ]);
    }
}