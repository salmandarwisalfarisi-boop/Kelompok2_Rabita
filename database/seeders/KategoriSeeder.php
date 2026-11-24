<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use RuntimeException;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = [
            ['nama_kategori' => 'Tote Bag', 'gambar' => 'totebag.png'],
            ['nama_kategori' => 'Sling Bag', 'gambar' => 'Slingbag.png'],
            ['nama_kategori' => 'Handbag', 'gambar' => 'handbag.png'],
            ['nama_kategori' => 'Charm Bag', 'gambar' => 'Charm.png'],
            ['nama_kategori' => 'Backpack', 'gambar' => 'Backpack.png'],
        ];

        foreach ($kategori as $data) {
            $sourcePath = database_path('seeders/images/kategori/' . $data['gambar']);
            $destinationDirectory = public_path('assets/image/kategori');
            $destinationPath = $destinationDirectory . DIRECTORY_SEPARATOR . $data['gambar'];

            if (!File::exists($sourcePath)) {
                throw new RuntimeException("Foto seed kategori tidak ditemukan: {$sourcePath}");
            }

            File::ensureDirectoryExists($destinationDirectory);
            if (!File::copy($sourcePath, $destinationPath)) {
                throw new RuntimeException("Gagal menyalin foto kategori: {$sourcePath}");
            }

            Kategori::updateOrCreate(
                ['nama_kategori' => $data['nama_kategori']],
                [
                    'slug'   => Str::slug($data['nama_kategori']),
                    'gambar' => $data['gambar'],
                ]
            );
        }
    }
}
