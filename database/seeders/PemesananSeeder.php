<?php

namespace Database\Seeders;

use App\Models\Alamat;
use App\Models\Pemesanan;
use App\Models\PemesananDetail;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PemesananSeeder extends Seeder
{
    public function run(): void
    {
        $budi = User::where('email', 'budi@gmail.com')->first();
        $siti = User::where('email', 'siti@gmail.com')->first();

        $alamatBudi = Alamat::where('user_id', $budi ? $budi->user_id : 2)->first();
        $alamatSiti = Alamat::where('user_id', $siti ? $siti->user_id : 3)->first();

        $produkGenbie = Produk::where('nama_produk', 'like', '%Totebag Genbie%')->first();
        $produkWaistbag = Produk::where('nama_produk', 'like', '%Waistbag Sasirangan%')->first();
        $produkBamega = Produk::where('nama_produk', 'like', '%Bamega Travel%')->first();
        $produkValecha = Produk::where('nama_produk', 'like', '%Zalecha%')->first();
        $produkAksKimono = Produk::where('nama_produk', 'like', '%Kimono%')->first();
        $produkGanci = Produk::where('nama_produk', 'like', '%Gantungan Tas Estetik%')->first();

        // 1. Pesanan 1 (Budi) - Status: Selesai
        if ($budi && $alamatBudi && $produkWaistbag && $produkGanci) {
            $ongkir1 = 18000;
            $total1 = ($produkWaistbag->harga * 1) + ($produkGanci->harga * 2) + $ongkir1;

            $pesanan1 = Pemesanan::create([
                'user_id' => $budi->user_id,
                'alamat_id' => $alamatBudi->alamat_id,
                'total_harga' => $total1,
                'kurir' => 'JNE',
                'layanan_kurir' => 'REG',
                'ongkir' => $ongkir1,
                'estimasi_tiba' => '2-3 Hari',
                'metode_bayar' => 'qris',
                'status_bayar' => 'berhasil',
                'status_pesanan' => 'selesai',
                'tanggal_pesan' => Carbon::now()->subDays(3),
                'waktu_bayar' => Carbon::now()->subDays(3)->addMinutes(15),
            ]);

            PemesananDetail::create([
                'pemesanan_id' => $pesanan1->pemesanan_id,
                'produk_id' => $produkWaistbag->produk_id,
                'jumlah' => 1,
                'harga_satuan' => $produkWaistbag->harga,
            ]);

            PemesananDetail::create([
                'pemesanan_id' => $pesanan1->pemesanan_id,
                'produk_id' => $produkGanci->produk_id,
                'jumlah' => 2,
                'harga_satuan' => $produkGanci->harga,
            ]);
        }

        // 2. Pesanan 2 (Siti) - Status: Dikirim
        if ($siti && $alamatSiti && $produkGenbie && $produkAksKimono) {
            $ongkir2 = 15000;
            $total2 = ($produkGenbie->harga * 1) + ($produkAksKimono->harga * 1) + $ongkir2;

            $pesanan2 = Pemesanan::create([
                'user_id' => $siti->user_id,
                'alamat_id' => $alamatSiti->alamat_id,
                'total_harga' => $total2,
                'kurir' => 'SiCepat',
                'layanan_kurir' => 'BEST',
                'ongkir' => $ongkir2,
                'estimasi_tiba' => '1-2 Hari',
                'metode_bayar' => 'qris',
                'status_bayar' => 'berhasil',
                'status_pesanan' => 'dikirim',
                'tanggal_pesan' => Carbon::now()->subDay(),
                'waktu_bayar' => Carbon::now()->subDay()->addMinutes(10),
            ]);

            PemesananDetail::create([
                'pemesanan_id' => $pesanan2->pemesanan_id,
                'produk_id' => $produkGenbie->produk_id,
                'jumlah' => 1,
                'harga_satuan' => $produkGenbie->harga,
            ]);

            PemesananDetail::create([
                'pemesanan_id' => $pesanan2->pemesanan_id,
                'produk_id' => $produkAksKimono->produk_id,
                'jumlah' => 1,
                'harga_satuan' => $produkAksKimono->harga,
            ]);
        }

        // 3. Pesanan 3 (Budi) - Status: Dikemas (Perlu tindakan Admin)
        if ($budi && $alamatBudi && $produkValecha) {
            $ongkir3 = 22000;
            $total3 = ($produkValecha->harga * 1) + $ongkir3;

            $pesanan3 = Pemesanan::create([
                'user_id' => $budi->user_id,
                'alamat_id' => $alamatBudi->alamat_id,
                'total_harga' => $total3,
                'kurir' => 'J&T Express',
                'layanan_kurir' => 'EZ',
                'ongkir' => $ongkir3,
                'estimasi_tiba' => '2-4 Hari',
                'metode_bayar' => 'qris',
                'status_bayar' => 'berhasil',
                'status_pesanan' => 'dikemas',
                'tanggal_pesan' => Carbon::now()->subHours(4),
                'waktu_bayar' => Carbon::now()->subHours(4)->addMinutes(5),
            ]);

            PemesananDetail::create([
                'pemesanan_id' => $pesanan3->pemesanan_id,
                'produk_id' => $produkValecha->produk_id,
                'jumlah' => 1,
                'harga_satuan' => $produkValecha->harga,
            ]);
        }

        // 4. Pesanan 4 (Siti) - Status: Pending (Belum Bayar)
        if ($siti && $alamatSiti && $produkBamega) {
            $ongkir4 = 25000;
            $total4 = ($produkBamega->harga * 1) + $ongkir4;

            $pesanan4 = Pemesanan::create([
                'user_id' => $siti->user_id,
                'alamat_id' => $alamatSiti->alamat_id,
                'total_harga' => $total4,
                'kurir' => 'JNE',
                'layanan_kurir' => 'YES',
                'ongkir' => $ongkir4,
                'estimasi_tiba' => '1 Hari',
                'metode_bayar' => 'qris',
                'status_bayar' => 'pending',
                'status_pesanan' => 'diproses',
                'tanggal_pesan' => Carbon::now()->subMinutes(30),
                'waktu_bayar' => null,
            ]);

            PemesananDetail::create([
                'pemesanan_id' => $pesanan4->pemesanan_id,
                'produk_id' => $produkBamega->produk_id,
                'jumlah' => 1,
                'harga_satuan' => $produkBamega->harga,
            ]);
        }
    }
}
