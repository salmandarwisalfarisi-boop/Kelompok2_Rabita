<?php

namespace Database\Seeders;

use App\Models\Keranjang;
use Illuminate\Database\Seeder;

class KeranjangSeeder extends Seeder
{
    public function run(): void
    {
        Keranjang::create([
            'user_id' => 2,
            'produk_id' => 3,
            'jumlah' => 2,
        ]);

        Keranjang::create([
            'user_id' => 3,
            'produk_id' => 1,
            'jumlah' => 1,
        ]);
    }
}
