<?php

namespace Database\Seeders;

use App\Models\Keranjang;
use Illuminate\Database\Seeder;

class KeranjangSeeder extends Seeder
{
    public function run(): void
    {
        $produk1 = \App\Models\Produk::first(); // Misal Totebag Genbie
        $produk2 = \App\Models\Produk::skip(1)->first(); // Misal Glowy Bag

        if ($produk1) {
            Keranjang::create([
                'user_id' => 2,
                'produk_id' => $produk1->produk_id,
                'jumlah' => 2,
            ]);
        }

        if ($produk2) {
            Keranjang::create([
                'user_id' => 3,
                'produk_id' => $produk2->produk_id,
                'jumlah' => 1,
            ]);
        }
    }
}
