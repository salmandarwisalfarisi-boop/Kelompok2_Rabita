<?php

namespace Database\Seeders;

use App\Models\Motif;
use App\Models\Pemesanan;
use App\Models\PemesananDetail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use RuntimeException;

class PemesananSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'kucinguser@rabita.com')->firstOrFail();
        $motifs = Motif::with('produk')
            ->where('status_motif', true)
            ->whereHas('produk', function ($query) {
                $query->where('status', 'aktif');
            })
            ->orderBy('motif_id')
            ->get();

        if ($motifs->isEmpty()) {
            throw new RuntimeException('Tidak ada motif produk aktif untuk membuat data pesanan contoh.');
        }

        $today = Carbon::today();
        $startDate = $today->copy()->subDays(6)->toDateString();
        $seedNotePrefix = 'Data seeder grafik 7 hari:';

        Pemesanan::where('user_id', $user->user_id)
            ->where('catatan', 'like', $seedNotePrefix . '%')
            ->whereDate('created_at', '<', $startDate)
            ->delete();

        $statuses = [
            'selesai',
            'dikirim',
            'diproses',
            'selesai',
            'dikirim',
            'diproses',
            'menunggu',
        ];

        foreach ($statuses as $index => $status) {
            $date = $today->copy()->subDays(6 - $index);
            $orderAt = $date->copy()->setTime(10 + ($index % 4), 0);
            $motif = $motifs[$index % $motifs->count()];
            $quantity = 1 + ($index % 3);
            $itemSubtotal = $motif->produk->harga * $quantity;
            $shippingCost = 15000;
            $seedNote = $seedNotePrefix . ' ' . $date->toDateString();
            $hasTracking = in_array($status, ['dikirim', 'selesai'], true);

            $pesanan = Pemesanan::firstOrNew([
                'user_id' => $user->user_id,
                'catatan' => $seedNote,
            ]);

            $pesanan->fill([
                'nama_penerima' => 'Kucing User',
                'no_hp_penerima' => $user->no_hp ?? '081234567891',
                'provinsi' => 'Kalimantan Selatan',
                'kota' => 'Banjarbaru',
                'kecamatan' => 'Banjarbaru Selatan',
                'alamat_lengkap' => 'Jl. Contoh Raya No. 10',
                'kode_pos' => '70714',
                'kurir' => 'JNE',
                'layanan_kurir' => 'REG',
                'ongkir' => $shippingCost,
                'estimasi_tiba' => '2-3 Hari',
                'total_harga' => $itemSubtotal + $shippingCost,
                'bukti_bayar' => null,
                'waktu_bayar' => $orderAt->copy()->addMinutes(10),
                'status_pesanan' => $status,
                'no_resi' => $hasTracking ? 'RESI-DEMO-' . $date->format('Ymd') : null,
                'catatan' => $seedNote,
            ]);
            $pesanan->created_at = $orderAt;
            $pesanan->save();

            $pesanan->details()->delete();
            PemesananDetail::create([
                'pemesanan_id' => $pesanan->pemesanan_id,
                'motif_id' => $motif->motif_id,
                'jumlah' => $quantity,
                'harga_satuan' => $motif->produk->harga,
                'subtotal' => $itemSubtotal,
            ]);
        }
    }
}
