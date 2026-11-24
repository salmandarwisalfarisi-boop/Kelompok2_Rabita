<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@rabita.com'],
            [
                'username' => 'kucingadmin',
                'password' => Hash::make('password123'),
                'no_hp'    => '081234567890',
                'level'    => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'kucinguser@rabita.com'],
            [
                'username' => 'kucinguser',
                'password' => Hash::make('password123'),
                'no_hp'    => '081234567891',
                'level'    => 'user',
            ]
        );
    }
}
