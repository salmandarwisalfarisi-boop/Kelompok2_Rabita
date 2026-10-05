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
    private function getDashboardData()
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

        // Selisih Pendapatan
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

    public function realtimeStats()
    {
        $data = $this->getDashboardData();

        // Format Pesanan Terbaru
        $pesananTerbaruFormatted = $data['pesananTerbaru']->map(function ($order) {
            $firstItem = $order->details->first();
            $namaProduk = $firstItem && $firstItem->produk ? $firstItem->produk->nama_produk : 'Pesanan Rabita';
            $extraCount = $order->details->count() - 1;

            $badgeClass = 'y';
            $statusLabel = ucfirst($order->status_pesanan);
            if ($order->status_pesanan === 'selesai') {
                $badgeClass = 'g';
            } elseif ($order->status_pesanan === 'batal') {
                $badgeClass = 'r';
            }

            return [
                'order_no'         => '#ORD-' . str_pad($order->pemesanan_id, 4, '0', STR_PAD_LEFT),
                'tanggal'          => Carbon::parse($order->tanggal_pesan)->format('d M Y, H:i'),
                'nama_produk'      => $namaProduk,
                'nama_produk_short'=> \Illuminate\Support\Str::limit($namaProduk, 28),
                'extra_count'      => $extraCount,
                'customer'         => $order->user->username ?? 'Customer',
                'total_harga'      => 'Rp ' . number_format($order->total_harga, 0, ',', '.'),
                'badge_class'      => $badgeClass,
                'status_label'     => $statusLabel,
            ];
        });

        // Format Stok Menipis
        $stokMenipisFormatted = $data['stokMenipis']->map(function ($item) {
            $fotoPath = $item->gambar_produk ? public_path('assets/image/produk/' . $item->gambar_produk) : null;
            $fotoUrl  = ($fotoPath && file_exists($fotoPath)) ? asset('assets/image/produk/' . $item->gambar_produk) : null;

            return [
                'nama_produk'       => $item->nama_produk,
                'nama_produk_short' => \Illuminate\Support\Str::limit($item->nama_produk, 26),
                'kategori'          => $item->kategori->nama_kategori ?? 'Sasirangan',
                'stok'              => $item->stok,
                'foto_url'          => $fotoUrl,
            ];
        });

        // Format Produk Terlaris
        $produkTerlarisFormatted = $data['produkTerlaris']->map(function ($item) {
            $nama = $item->produk->nama_produk ?? 'Produk Rabita';
            $harga = $item->produk->harga ?? 0;
            $terjual = $item->total_terjual ?? 1;
            $barWidth = min(100, max(20, $terjual * 15));

            return [
                'nama'       => $nama,
                'harga'      => 'Rp ' . number_format($harga, 0, ',', '.'),
                'terjual'    => $terjual,
                'bar_width'  => $barWidth,
            ];
        });

        return response()->json([
            'status' => 'success',
            'stats' => [
                'totalProduk'     => number_format($data['totalProduk'], 0, ',', '.'),
                'totalPemesanan'  => number_format($data['totalPemesanan'], 0, ',', '.'),
                'totalPendapatan' => 'Rp ' . number_format($data['totalPendapatan'], 0, ',', '.'),
                'totalPengguna'   => number_format($data['totalPengguna'], 0, ',', '.'),
                'diffProduk'      => $data['diffProduk'],
                'diffPemesanan'   => $data['diffPemesanan'],
                'diffPendapatan'  => $data['diffPendapatan'],
                'diffPengguna'    => $data['diffPengguna'],
                'trendProduk'     => $data['trendProduk'],
                'trendPemesanan'  => $data['trendPemesanan'],
                'trendPendapatan' => $data['trendPendapatan'],
                'trendPengguna'   => $data['trendPengguna'],
            ],
            'charts' => [
                'chart7' => [
                    'labels' => $data['chart7Labels'],
                    'values' => $data['chart7Values'],
                ],
                'chart30' => [
                    'labels' => $data['chart30Labels'],
                    'values' => $data['chart30Values'],
                ],
            ],
            'pesananTerbaru'  => $pesananTerbaruFormatted,
            'stokMenipis'     => $stokMenipisFormatted,
            'produkTerlaris'  => $produkTerlarisFormatted,
        ]);
    }
}
