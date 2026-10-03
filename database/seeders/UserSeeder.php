<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'username' => 'admin_rabita',
            'email' => 'admin@rabita.com',
            'password' => Hash::make('password123'),
            'no_hp' => '081234567890',
            'level' => 'admin',
        ]);

        User::create([
            'username' => 'budi_santoso',
            'email' => 'budi@gmail.com',
            'password' => Hash::make('password123'),
            'no_hp' => '082198765432',
            'level' => 'user',
        ]);

        User::create([
            'username' => 'siti_aminah',
            'email' => 'siti@gmail.com',
            'password' => Hash::make('password123'),
            'no_hp' => '085712345678',
            'level' => 'user',
        ]);
    }
}
