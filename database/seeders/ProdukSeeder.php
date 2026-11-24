<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Motif;
use App\Models\Produk;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use RuntimeException;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        $produkList = [
            [
                'nama_produk' => 'Rabita Assa Kambang Bil',
                'kategori' => 'Tote Bag',
                'harga' => 650000,
                'gambar' => 'Tas Assa Kambang Bil.png',
                'motif' => 'Kambang Bil',
                'additional_motifs' => [
                    [
                        'nama' => 'Kambang Bil Motif Bunga',
                        'gambar' => 'Tas Assa kambang bil motif bunga.png',
                    ],
                ],
                'ukuran' => '30 x 25 x 12 cm',
                'berat_gram' => 400,
            ],
            [
                'nama_produk' => 'Tas Sasirangan Lovely',
                'kategori' => 'Tote Bag',
                'harga' => 450000,
                'gambar' => 'Sasirangan Lovely.png',
                'motif' => 'Sasirangan Lovely',
                'ukuran' => '30 x 25 x 12 cm',
                'berat_gram' => 400,
            ],
            [
                'nama_produk' => 'Mini Sling Bag',
                'kategori' => 'Sling Bag',
                'harga' => 460000,
                'gambar' => 'Mini Sling.png',
                'motif' => 'Sasirangan',
                'ukuran' => '22 x 18 x 8 cm',
                'berat_gram' => 300,
            ],
            [
                'nama_produk' => 'Tas Lipit Sasirangan',
                'kategori' => 'Sling Bag',
                'harga' => 160000,
                'gambar' => 'Tas Lipit.png',
                'motif' => 'Sasirangan Lipit',
                'ukuran' => '22 x 18 x 8 cm',
                'berat_gram' => 300,
            ],
            [
                'nama_produk' => 'Rabita Bag Charm',
                'kategori' => 'Charm Bag',
                'harga' => 90000,
                'gambar' => 'Bag Charm.png',
                'motif' => 'Sasirangan',
                'ukuran' => '8 x 8 x 3 cm',
                'berat_gram' => 80,
            ],
            [
                'nama_produk' => 'Rabita Tas Sasirangan Premium',
                'kategori' => 'Tote Bag',
                'harga' => 1500000,
                'gambar' => 'Tas Rabita.png',
                'motif' => 'Sasirangan Premium',
                'ukuran' => '32 x 28 x 14 cm',
                'berat_gram' => 500,
            ],
            [
                'nama_produk' => 'Kanaya Tas Jinjing',
                'kategori' => 'Tote Bag',
                'harga' => 440000,
                'gambar' => 'Kanaya Tas.png',
                'motif' => 'Sasirangan',
                'ukuran' => '30 x 25 x 12 cm',
                'berat_gram' => 400,
            ],
            [
                'nama_produk' => 'Tas Lipat Sasirangan',
                'kategori' => 'Sling Bag',
                'harga' => 360000,
                'gambar' => 'Tas Lipat.png',
                'motif' => 'Sasirangan Lipat',
                'ukuran' => '22 x 18 x 8 cm',
                'berat_gram' => 300,
            ],
            [
                'nama_produk' => 'Bag Charm Queen',
                'kategori' => 'Charm Bag',
                'harga' => 80000,
                'gambar' => 'Bag Charm.png',
                'motif' => 'Queen',
                'ukuran' => '8 x 8 x 3 cm',
                'berat_gram' => 80,
            ],
            [
                'nama_produk' => 'Kanaya Tas Jinjing',
                'kategori' => 'Sling Bag',
                'harga' => 600000,
                'gambar' => 'Kanaya Tas.png',
                'motif' => 'Sasirangan',
                'ukuran' => '22 x 18 x 8 cm',
                'berat_gram' => 300,
            ],
        ];

        foreach ($produkList as $data) {
            $kategori = Kategori::where('nama_kategori', $data['kategori'])->firstOrFail();
            $slug = Str::slug($data['nama_produk'] . '-' . $data['kategori']);
            $produk = Produk::updateOrCreate(
                ['slug' => $slug],
                [
                    'kategori_id' => $kategori->kategori_id,
                    'nama_produk' => $data['nama_produk'],
                    'deskripsi_produk' => $data['kategori'] === 'Charm Bag'
                        ? "Aksesori {$data['nama_produk']} dengan sentuhan kain sasirangan, cocok untuk melengkapi tas dan gaya sehari-hari."
                        : "{$data['nama_produk']} menghadirkan tas bernuansa kain sasirangan yang memadukan karakter budaya Banjar dengan fungsi untuk aktivitas sehari-hari.",
                    'harga' => $data['harga'],
                    'berat_gram' => $data['berat_gram'],
                    'ukuran' => $data['ukuran'],
                    'material' => 'Kain sasirangan',
                    'status' => 'aktif',
                ]
            );

            $motifs = array_merge(
                [
                    [
                        'nama' => $data['motif'],
                        'gambar' => $data['gambar'],
                    ],
                ],
                $data['additional_motifs'] ?? []
            );

            foreach ($motifs as $motif) {
                $sourcePath = database_path('seeders/images/produk/' . $motif['gambar']);
                $destinationDirectory = public_path('assets/image/produk');
                $destinationPath = $destinationDirectory . DIRECTORY_SEPARATOR . $motif['gambar'];

                if (!File::exists($sourcePath)) {
                    throw new RuntimeException("Foto seed produk tidak ditemukan: {$sourcePath}");
                }

                File::ensureDirectoryExists($destinationDirectory);
                if (!File::copy($sourcePath, $destinationPath)) {
                    throw new RuntimeException("Gagal menyalin foto produk: {$sourcePath}");
                }

                Motif::updateOrCreate(
                    [
                        'produk_id' => $produk->produk_id,
                        'nama_motif' => $motif['nama'],
                    ],
                    [
                        'stok' => 10,
                        'gambar_depan' => $motif['gambar'],
                        'gambar_kanan' => null,
                        'gambar_kiri' => null,
                        'gambar_dalam' => null,
                        'status_motif' => true,
                    ]
                );
            }
        }
    }
}
