<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        Produk::create([
            'kategori_id' => 1,
            'nama_produk' => 'Gamis Silk Premium Silk Elegance',
            'gambar_produk' => 'gamis-silk-premium.jpg',
            'deskripsi_produk' => 'Gamis anggun berbahan silk premium yang dingin dan lembut di kulit, cocok untuk acara formal.',
            'harga' => 285000,
            'stok' => 25,
            'berat_gram' => 500,
            'status' => 'aktif',
        ]);

        Produk::create([
            'kategori_id' => 1,
            'nama_produk' => 'Abaya Simpel Hitam Jetblack',
            'gambar_produk' => 'abaya-jetblack.jpg',
            'deskripsi_produk' => 'Abaya polos bahan jetblack super pekat, potongan lebar dan nyaman.',
            'harga' => 240000,
            'stok' => 15,
            'berat_gram' => 450,
            'status' => 'aktif',
        ]);

        Produk::create([
            'kategori_id' => 2,
            'nama_produk' => 'Hijab Segiempat Paris Premium',
            'gambar_produk' => 'hijab-paris-premium.jpg',
            'deskripsi_produk' => 'Hijab segiempat mudah dibentuk, adem dan tegak di dahi.',
            'harga' => 45000,
            'stok' => 50,
            'berat_gram' => 150,
            'status' => 'aktif',
        ]);

        Produk::create([
            'kategori_id' => 3,
            'nama_produk' => 'Mukena Travel Silk Pouch Mini',
            'gambar_produk' => 'mukena-travel-silk.jpg',
            'deskripsi_produk' => 'Mukena travel praktis, dapat dilipat sangat kecil dan disertai pouch eksklusif.',
            'harga' => 175000,
            'stok' => 30,
            'berat_gram' => 350,
            'status' => 'aktif',
        ]);
    }
}
