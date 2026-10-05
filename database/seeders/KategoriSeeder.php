<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategoriList = [
            'Tas (Bag)',
            'Aksesori & Gantungan Tas (Bag Charm)',
        ];

        foreach ($kategoriList as $nama) {
            Kategori::firstOrCreate(
                ['nama_kategori' => $nama],
                ['slug' => Str::slug($nama)]
            );
        }
    }
}
