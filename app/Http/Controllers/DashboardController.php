<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\PemesananDetail;
use App\Models\Produk;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Metrik Utama
        $totalProduk = Produk::count();
        $totalPemesanan = Pemesanan::count();
        $totalPendapatan = Pemesanan::where('status_bayar', 'berhasil')->sum('total_harga');
        $totalPengguna = User::where('level', 'user')->count();

        // 2. Data Perbandingan Real-Time (Bulan Ini vs Bulan Lalu)
        $startThisMonth = Carbon::now()->startOfMonth();
        $startLastMonth = Carbon::now()->subMonth()->startOfMonth();
        $endLastMonth   = Carbon::now()->subMonth()->endOfMonth();

        // Selisih Produk (Produk baru bulan ini)
        $produkThisMonth = Produk::where('created_at', '>=', $startThisMonth)->count();
        $produkLastMonth = Produk::whereBetween('created_at', [$startLastMonth, $endLastMonth])->count();
        $diffProdukNum   = $produkThisMonth - $produkLastMonth;
        $diffProduk = ($diffProdukNum >= 0 ? '+' : '') . $diffProdukNum . ' dari bulan lalu';
        $trendProduk = $diffProdukNum > 0 ? 'up' : ($diffProdukNum < 0 ? 'down' : 'neutral');

        // Selisih Pesanan
        $pesananThisMonth = Pemesanan::where('created_at', '>=', $startThisMonth)->count();
        $pesananLastMonth = Pemesanan::whereBetween('created_at', [$startLastMonth, $endLastMonth])->count();
        $diffPesananNum   = $pesananThisMonth - $pesananLastMonth;
        $diffPemesanan = ($diffPesananNum >= 0 ? '+' : '') . $diffPesananNum . ' dari bulan lalu';
        $trendPemesanan = $diffPesananNum > 0 ? 'up' : ($diffPesananNum < 0 ? 'down' : 'neutral');

        // Selisih Pendapatan Hari Ini vs Kemarin / Rata-rata
        $todayIncome = Pemesanan::where('status_bayar', 'berhasil')
            ->whereDate('tanggal_pesan', Carbon::today())
            ->sum('total_harga');

        $pendapatanThisMonth = Pemesanan::where('status_bayar', 'berhasil')
            ->where('created_at', '>=', $startThisMonth)
            ->sum('total_harga');
        $pendapatanLastMonth = Pemesanan::where('status_bayar', 'berhasil')
            ->whereBetween('created_at', [$startLastMonth, $endLastMonth])
            ->sum('total_harga');
        $diffIncomeNum = $pendapatanThisMonth - $pendapatanLastMonth;

        $diffPendapatan = ($diffIncomeNum >= 0 ? '+Rp ' : '-Rp ') . number_format(abs($diffIncomeNum), 0, ',', '.') . ' dari bulan lalu';
        $trendPendapatan = $diffIncomeNum > 0 ? 'up' : ($diffIncomeNum < 0 ? 'down' : 'neutral');

        // Selisih Pengguna Baru
        $userThisMonth = User::where('level', 'user')->where('created_at', '>=', $startThisMonth)->count();
        $userLastMonth = User::where('level', 'user')->whereBetween('created_at', [$startLastMonth, $endLastMonth])->count();
        $diffUserNum   = $userThisMonth - $userLastMonth;
        $diffPengguna = ($diffUserNum >= 0 ? '+' : '') . $diffUserNum . ' dari bulan lalu';
        $trendPengguna = $diffUserNum > 0 ? 'up' : ($diffUserNum < 0 ? 'down' : 'neutral');

        // 2. Data Grafik Pendapatan Riil dari Database (7 Hari & 30 Hari Terakhir)
        $chart7Labels = [];
        $chart7Values = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dateStr = $date->format('Y-m-d');
            $chart7Labels[] = $date->translatedFormat('d M');

            $omset = Pemesanan::where('status_bayar', 'berhasil')
                ->whereDate('tanggal_pesan', $dateStr)
                ->sum('total_harga');

            $chart7Values[] = (int) $omset;
        }

        $chart30Labels = [];
        $chart30Values = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dateStr = $date->format('Y-m-d');
            $chart30Labels[] = $date->translatedFormat('d M');

            $omset = Pemesanan::where('status_bayar', 'berhasil')
                ->whereDate('tanggal_pesan', $dateStr)
                ->sum('total_harga');

            $chart30Values[] = (int) $omset;
        }

        // 3. Pesanan Terbaru
        $pesananTerbaru = Pemesanan::with(['user', 'details.produk'])
            ->latest('tanggal_pesan')
            ->take(5)
            ->get();

        // 4. Stok Produk Hampir Habis (Hanya yang stoknya kurang dari 16)
        $stokMenipis = Produk::with('kategori')
            ->where('stok', '<', 16)
            ->orderBy('stok', 'asc')
            ->take(5)
            ->get();

        // 5. Produk Paling Diminati (Terlaris)
        $produkTerlaris = PemesananDetail::select('produk_id', DB::raw('SUM(jumlah) as total_terjual'))
            ->groupBy('produk_id')
            ->orderByDesc('total_terjual')
            ->with('produk')
            ->take(4)
            ->get();

        if ($produkTerlaris->isEmpty()) {
            $fallbackProduk = Produk::take(4)->get();
            $produkTerlaris = $fallbackProduk->map(function ($p, $idx) {
                return (object)[
                    'produk' => $p,
                    'total_terjual' => 20 - ($idx * 4),
                ];
            });
        }

        return view('dashboard', compact(
            'totalProduk',
            'totalPemesanan',
            'totalPendapatan',
            'totalPengguna',
            'diffProduk',
            'diffPemesanan',
            'diffPendapatan',
            'diffPengguna',
            'trendProduk',
            'trendPemesanan',
            'trendPendapatan',
            'trendPengguna',
            'chart7Labels',
            'chart7Values',
            'chart30Labels',
            'chart30Values',
            'pesananTerbaru',
            'stokMenipis',
            'produkTerlaris'
        ));
    }
}
