<?php

namespace Database\Seeders;

use App\Models\Alamat;
use Illuminate\Database\Seeder;

class AlamatSeeder extends Seeder
{
    public function run(): void
    {
        Alamat::create([
            'user_id' => 2, // Budi Santoso
            'label_alamat' => 'Rumah Budi',
            'nama_penerima' => 'Budi Santoso',
            'no_hp_penerima' => '082198765432',
            'alamat_lengkap' => 'Jl. Merdeka No. 45, RT 02/RW 05, Kel. Gambir',
            'catatan_kurir' => 'Pagar warna hijau, titip di sekuriti jika tidak di rumah',
            'area_wilayah' => 'Jakarta Pusat, DKI Jakarta',
            'latitude' => -6.17539240,
            'longitude' => 106.82715300,
            'alamat_utama' => true,
        ]);

        Alamat::create([
            'user_id' => 3, // Siti Aminah
            'label_alamat' => 'Kantor Siti',
            'nama_penerima' => 'Siti Aminah',
            'no_hp_penerima' => '085712345678',
            'alamat_lengkap' => 'Gedung Rabita Tower Lt. 5, Jl. Sudirman No. 12',
            'catatan_kurir' => 'Antar jam kerja (09.00 - 17.00)',
            'area_wilayah' => 'Jakarta Selatan, DKI Jakarta',
            'latitude' => -6.22974650,
            'longitude' => 106.81666700,
            'alamat_utama' => true,
        ]);
    }
}
