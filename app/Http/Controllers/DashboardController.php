<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\PemesananDetail;
use App\Models\Produk;
use App\Models\Motif;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    private function getDashboardData()
    {
        // 1. Metrik Utama
        $totalProduk = Produk::count();
        $totalPemesanan = Pemesanan::count();
        $totalPendapatan = Pemesanan::where('status_pesanan', '!=', 'dibatalkan')->sum('total_harga');
        $totalPengguna = User::where('level', 'user')->count();

        // 2. Data Perbandingan Real-Time (Bulan Ini vs Bulan Lalu)
        $startThisMonth = Carbon::now()->startOfMonth();
        $startLastMonth = Carbon::now()->subMonth()->startOfMonth();
        $endLastMonth   = Carbon::now()->subMonth()->endOfMonth();

        // Total Produk
        $diffProduk = 'Total produk';
        $trendProduk = 'neutral';

        // Selisih Pesanan
        $pesananThisMonth = Pemesanan::where('created_at', '>=', $startThisMonth)->count();
        $pesananLastMonth = Pemesanan::whereBetween('created_at', [$startLastMonth, $endLastMonth])->count();
        $diffPesananNum   = $pesananThisMonth - $pesananLastMonth;
        $diffPemesanan = ($diffPesananNum >= 0 ? '+' : '') . $diffPesananNum . ' dari bulan lalu';
        $trendPemesanan = $diffPesananNum > 0 ? 'up' : ($diffPesananNum < 0 ? 'down' : 'neutral');

        // Selisih Pendapatan
        $pendapatanThisMonth = Pemesanan::where('status_pesanan', '!=', 'dibatalkan')
            ->where('created_at', '>=', $startThisMonth)
            ->sum('total_harga');
        $pendapatanLastMonth = Pemesanan::where('status_pesanan', '!=', 'dibatalkan')
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

            $omset = Pemesanan::where('status_pesanan', '!=', 'dibatalkan')
                ->whereDate('created_at', $dateStr)
                ->sum('total_harga');

            $chart7Values[] = (int) $omset;
        }

        $chart30Labels = [];
        $chart30Values = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dateStr = $date->format('Y-m-d');
            $chart30Labels[] = $date->translatedFormat('d M');

            $omset = Pemesanan::where('status_pesanan', '!=', 'dibatalkan')
                ->whereDate('created_at', $dateStr)
                ->sum('total_harga');

            $chart30Values[] = (int) $omset;
        }

        // 3. Pesanan Terbaru
        $pesananTerbaru = Pemesanan::with(['user', 'details.motif.produk'])
            ->latest('created_at')
            ->take(5)
            ->get();

        // 4. Stok Produk Hampir Habis (Melalui motif)
        $stokMenipis = Motif::with('produk.kategori')
            ->where('stok', '<', 16)
            ->orderBy('stok', 'asc')
            ->take(5)
            ->get();

        // 5. Produk Paling Diminati (Terlaris)
        $produkTerlaris = PemesananDetail::select('motif_id', DB::raw('SUM(jumlah) as total_terjual'))
            ->groupBy('motif_id')
            ->orderByDesc('total_terjual')
            ->with('motif.produk')
            ->take(4)
            ->get();

        return compact(
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
        );
    }

    public function index()
    {
        $data = $this->getDashboardData();
        return view('dashboard', $data);
    }

    public function showPengaturan()
    {
        // Cari file QRIS yang ada (bisa berekstensi .png, .jpeg, .jpg, atau .svg)
        $qrPath = null;
        $extensions = ['png', 'jpeg', 'jpg', 'svg'];
        foreach ($extensions as $ext) {
            if (file_exists(public_path("assets/image/qris.{$ext}"))) {
                $qrPath = asset("assets/image/qris.{$ext}");
                break;
            }
        }

        return view('admin.pengaturan', compact('qrPath'));
    }

    public function updatePengaturan(Request $request)
    {
        $request->validate([
            'qris' => 'required|image|mimes:png,jpg,jpeg,svg|max:2048',
        ]);

        // Hapus file QRIS lama agar tidak dobel ekstensi
        $extensions = ['png', 'jpeg', 'jpg', 'svg'];
        foreach ($extensions as $ext) {
            $oldFile = public_path("assets/image/qris.{$ext}");
            if (file_exists($oldFile)) {
                @unlink($oldFile);
            }
        }

        $file = $request->file('qris');
        $filename = 'qris.' . strtolower($file->getClientOriginalExtension());
        $file->move(public_path('assets/image'), $filename);

        return redirect()->route('admin.pengaturan')->with('success', 'Foto QRIS berhasil diperbarui.');
    }


    }
