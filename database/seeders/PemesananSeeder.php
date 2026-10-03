<?php

namespace Database\Seeders;

use App\Models\Pemesanan;
use App\Models\PemesananDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PemesananSeeder extends Seeder
{
    public function run(): void
    {
        $pemesanan = Pemesanan::create([
            'user_id' => 2,
            'alamat_id' => 1,
            'total_harga' => 330000,
            'kurir' => 'JNE',
            'layanan_kurir' => 'REG',
            'ongkir' => 15000,
            'estimasi_tiba' => '2-3 Hari',
            'metode_bayar' => 'qris',
            'status_bayar' => 'berhasil',
            'status_pesanan' => 'dikemas',
            'tanggal_pesan' => Carbon::now()->subHours(2),
            'waktu_bayar' => Carbon::now()->subHours(1),
        ]);

        PemesananDetail::create([
            'pemesanan_id' => $pemesanan->pemesanan_id,
            'produk_id' => 1, // Gamis Silk Premium
            'jumlah' => 1,
            'harga_satuan' => 285000,
        ]);

        PemesananDetail::create([
            'pemesanan_id' => $pemesanan->pemesanan_id,
            'produk_id' => 3, // Hijab Segiempat
            'jumlah' => 1,
            'harga_satuan' => 45000,
        ]);
    }
}
