<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        $kategoriTas = Kategori::where('nama_kategori', 'Tas (Bag)')->first();
        $kategoriAksesori = Kategori::where('nama_kategori', 'Aksesori & Gantungan Tas (Bag Charm)')->first();

        $tasId = $kategoriTas ? $kategoriTas->kategori_id : 1;
        $aksesoriId = $kategoriAksesori ? $kategoriAksesori->kategori_id : 2;

        $produkList = [
            // Kategori 1: Tas (Bag)
            [
                'kategori_id' => $tasId,
                'nama_produk' => 'Rabita Totebag Genbie Sasirangan',
                'gambar_produk' => 'totebag-genbie.jpg',
                'deskripsi_produk' => 'Totebag etnik Sasirangan khas Banjarbaru seri Genbie dengan bahan berkualitas dan aksen motif sasirangan eksklusif.',
                'harga' => 135000,
                'stok' => 20,
                'berat_gram' => 350,
                'status' => 'aktif',
            ],
            [
                'kategori_id' => $tasId,
                'nama_produk' => 'Rabita Glowy Bag (Tas Mika Transparan Motif Sasirangan)',
                'gambar_produk' => 'glowy-bag.jpg',
                'deskripsi_produk' => 'Tas mika transparan modis kombinasi sentuhan motif Sasirangan khas, waterproof dan stylish untuk gaya kasual.',
                'harga' => 110000,
                'stok' => 15,
                'berat_gram' => 300,
                'status' => 'aktif',
            ],
            [
                'kategori_id' => $tasId,
                'nama_produk' => 'Rabita Waistbag Sasirangan Bordir (Tersedia hingga Size Jumbo)',
                'gambar_produk' => 'waistbag-sasirangan.jpg',
                'deskripsi_produk' => 'Waistbag praktis dengan motif bordir Sasirangan khas Banjarbaru berkapasitas lega hingga size jumbo, nyaman dipakai harian.',
                'harga' => 145000,
                'stok' => 25,
                'berat_gram' => 400,
                'status' => 'aktif',
            ],
            [
                'kategori_id' => $tasId,
                'nama_produk' => 'Tas Lipit Sasirangan Bordir',
                'gambar_produk' => 'tas-lipit-sasirangan.jpg',
                'deskripsi_produk' => 'Tas lipit elegan dengan paduan kain Sasirangan beraksen bordir detail rapi dan anggun.',
                'harga' => 125000,
                'stok' => 15,
                'berat_gram' => 350,
                'status' => 'aktif',
            ],
            [
                'kategori_id' => $tasId,
                'nama_produk' => 'Totebag Sasirangan Landscape',
                'gambar_produk' => 'totebag-landscape.jpg',
                'deskripsi_produk' => 'Totebag model lanskap lebar bermotif Sasirangan penuh, muat laptop dan dokumen harian.',
                'harga' => 120000,
                'stok' => 20,
                'berat_gram' => 350,
                'status' => 'aktif',
            ],
            [
                'kategori_id' => $tasId,
                'nama_produk' => 'Bamega Travel Sasirangan Bag',
                'gambar_produk' => 'bamega-travel-bag.jpg',
                'deskripsi_produk' => 'Tas travel luas motif Sasirangan khas Bamega, sangat kuat dan cocok untuk bepergian serta liburan.',
                'harga' => 225000,
                'stok' => 10,
                'berat_gram' => 600,
                'status' => 'aktif',
            ],
            [
                'kategori_id' => $tasId,
                'nama_produk' => 'Handbag Sasirangan Bordir Souvenir',
                'gambar_produk' => 'handbag-souvenir.jpg',
                'deskripsi_produk' => 'Handbag manis berukuran compact dengan bordir Sasirangan cantik, ideal untuk kado ataupun souvenir acara.',
                'harga' => 85000,
                'stok' => 30,
                'berat_gram' => 250,
                'status' => 'aktif',
            ],
            [
                'kategori_id' => $tasId,
                'nama_produk' => 'Rabita Zalecha (Tas Kulit Premium Kombinasi Sasirangan)',
                'gambar_produk' => 'rabita-zalecha.jpg',
                'deskripsi_produk' => 'Tas kulit premium berpadu kain Sasirangan asli berkualitas tinggi, menghadirkan kesan mewah, eksklusif, dan tahan lama.',
                'harga' => 375000,
                'stok' => 10,
                'berat_gram' => 650,
                'status' => 'aktif',
            ],

            // Kategori 2: Aksesori & Gantungan Tas (Bag Charm)
            [
                'kategori_id' => $aksesoriId,
                'nama_produk' => 'Rabita Gantungan Tas Estetik (Ganci Sasirangan standar)',
                'gambar_produk' => 'ganci-sasirangan.jpg',
                'deskripsi_produk' => 'Gantungan kunci/tas estetik motif Sasirangan dengan sentuhan etnik minimalis yang unik.',
                'harga' => 25000,
                'stok' => 50,
                'berat_gram' => 50,
                'status' => 'aktif',
            ],
            [
                'kategori_id' => $aksesoriId,
                'nama_produk' => 'Rabita Bag Charm Sasirangan Kimono (Gantungan bentuk baju kimono mini)',
                'gambar_produk' => 'bag-charm-kimono.jpg',
                'deskripsi_produk' => 'Bag charm unik berbentuk pakaian kimono mini berbalut kain motif Sasirangan Kalimantan Selatan.',
                'harga' => 35000,
                'stok' => 40,
                'berat_gram' => 60,
                'status' => 'aktif',
            ],
            [
                'kategori_id' => $aksesoriId,
                'nama_produk' => 'Rabita Bag Charm Queen (Gantungan premium dari bahan kulit sapi asli)',
                'gambar_produk' => 'bag-charm-queen.jpg',
                'deskripsi_produk' => 'Gantungan tas premium Queen Series berbahan kulit sapi asli berpadu aksen Sasirangan mewah.',
                'harga' => 65000,
                'stok' => 30,
                'berat_gram' => 80,
                'status' => 'aktif',
            ],
            // Kategori 1: Tas tambahan
            [
                'kategori_id' => $tasId,
                'nama_produk' => 'Lolly Backpack Mini Sasirangan By Rabita',
                'gambar_produk' => 'lolly-backpack-mini.jpg',
                'deskripsi_produk' => 'Tas ransel mini kasual berbalut kain Sasirangan khas Kalimantan Selatan, ringan dan trendy untuk kegiatan sehari-hari.',
                'harga' => 185000,
                'stok' => 18,
                'berat_gram' => 400,
                'status' => 'aktif',
            ],
            [
                'kategori_id' => $tasId,
                'nama_produk' => 'Rabita Rimpi Pouch Sasirangan',
                'gambar_produk' => 'rimpi-pouch.jpg',
                'deskripsi_produk' => 'Dompet/pouch kecil serbaguna dari perca kain Sasirangan, populer sebagai suvenir pernikahan dan oleh-oleh khas Banjarbaru.',
                'harga' => 55000,
                'stok' => 60,
                'berat_gram' => 100,
                'status' => 'aktif',
            ],
            [
                'kategori_id' => $tasId,
                'nama_produk' => 'Tas Sasirangan Halfmoon Warna Alam',
                'gambar_produk' => 'halfmoon-warna-alam.jpg',
                'deskripsi_produk' => 'Tas berbentuk setengah lingkaran dengan pewarnaan alami (natural dyes) ramah lingkungan, motif Sasirangan eksklusif edisi terbatas.',
                'harga' => 210000,
                'stok' => 12,
                'berat_gram' => 450,
                'status' => 'aktif',
            ],
            [
                'kategori_id' => $tasId,
                'nama_produk' => 'Tas Sasirangan Ecoprint Model Maherja',
                'gambar_produk' => 'ecoprint-maherja.jpg',
                'deskripsi_produk' => 'Tas motif daun alami (ecoprint) berpadu kain Sasirangan etnik, ramah lingkungan dengan estetika tinggi.',
                'harga' => 260000,
                'stok' => 8,
                'berat_gram' => 500,
                'status' => 'aktif',
            ],
            [
                'kategori_id' => $tasId,
                'nama_produk' => 'Rabita Shoulder Bag Sasirangan',
                'gambar_produk' => 'shoulder-bag-sasirangan.jpg',
                'deskripsi_produk' => 'Tas bahu formal kombinasi kain Sasirangan dengan tali pas untuk acara resmi, kerja, maupun semi-formal.',
                'harga' => 175000,
                'stok' => 20,
                'berat_gram' => 420,
                'status' => 'aktif',
            ],
            [
                'kategori_id' => $tasId,
                'nama_produk' => 'Rabita Square Bag Sasirangan',
                'gambar_produk' => 'square-bag-sasirangan.jpg',
                'deskripsi_produk' => 'Tas selempang kotak (square bag) elegan dengan kain Sasirangan khas Banjar, cocok untuk tampilan kasual maupun semiformal.',
                'harga' => 155000,
                'stok' => 22,
                'berat_gram' => 380,
                'status' => 'aktif',
            ],
            [
                'kategori_id' => $tasId,
                'nama_produk' => 'Rabita JB Handbag Premium Sasirangan',
                'gambar_produk' => 'jb-handbag-premium.jpg',
                'deskripsi_produk' => 'Handbag premium seri JB dengan interior suede mewah dan eksterior kain Sasirangan pilihan, tampil eksklusif di setiap kesempatan.',
                'harga' => 520000,
                'stok' => 6,
                'berat_gram' => 700,
                'status' => 'aktif',
            ],

            // Kategori 2: Aksesori tambahan
            [
                'kategori_id' => $aksesoriId,
                'nama_produk' => 'Rabita Souvenir Gantungan Kunci Bunga Tulip Sasirangan',
                'gambar_produk' => 'gantungan-kunci-bunga-tulip.jpg',
                'deskripsi_produk' => 'Gantungan kunci handmade berbentuk kelopak bunga tulip dari kain Sasirangan, estetik dan cocok sebagai suvenir atau oleh-oleh.',
                'harga' => 20000,
                'stok' => 80,
                'berat_gram' => 30,
                'status' => 'aktif',
            ],
        ];


        foreach ($produkList as $item) {
            Produk::updateOrCreate(
                ['nama_produk' => $item['nama_produk']],
                $item
            );
        }
    }
}
