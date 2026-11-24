<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index(Request $request)
    {
        $totalPesanan        = Pemesanan::count();
        $menungguKonfirmasi = Pemesanan::where('status_pesanan', 'menunggu')->count();
        $dalamPengiriman     = Pemesanan::where('status_pesanan', 'dikirim')->count();
        $pesananSelesai      = Pemesanan::where('status_pesanan', 'selesai')->count();

        $query = Pemesanan::with(['user', 'details.motif.produk'])->latest('pemesanan_id');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_penerima', 'like', "%{$search}%")
                  ->orWhere('pemesanan_id', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($qu) use ($search) {
                      $qu->where('username', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('status')) {
            $query->where('status_pesanan', $request->status);
        }

        if ($request->filled('tanggal')) {
            if ($request->tanggal === 'today') {
                $query->whereDate('created_at', today());
            } elseif ($request->tanggal === '7days') {
                $query->where('created_at', '>=', now()->subDays(7));
            } elseif ($request->tanggal === 'month') {
                $query->whereMonth('created_at', now()->month)
                      ->whereYear('created_at', now()->year);
            } else {
                $query->whereDate('created_at', $request->tanggal);
            }
        }

        $pesanan = $query->paginate(10)->withQueryString();

        return view('admin.pesanan.index', compact(
            'pesanan',
            'totalPesanan',
            'menungguKonfirmasi',
            'dalamPengiriman',
            'pesananSelesai'
        ));
    }

    public function show(Pemesanan $pesanan)
    {
        $pesanan->load(['user', 'details.motif.produk']);

        return response()->json([
            'status' => 'success',
            'data'   => [
                'pemesanan_id'    => $pesanan->pemesanan_id,
                'nama_penerima'   => $pesanan->nama_penerima,
                'no_hp_penerima'  => $pesanan->no_hp_penerima,
                'email'           => $pesanan->user->email ?? '-',
                'status_pesanan'  => $pesanan->status_pesanan,
                'no_resi'         => $pesanan->no_resi,
                'kurir'           => $pesanan->kurir,
                'layanan_kurir'   => $pesanan->layanan_kurir,
                'estimasi_tiba'   => $pesanan->estimasi_tiba,
                'alamat_lengkap'  => $pesanan->alamat_lengkap,
                'kecamatan'       => $pesanan->kecamatan,
                'kota'            => $pesanan->kota,
                'provinsi'        => $pesanan->provinsi,
                'kode_pos'        => $pesanan->kode_pos,
                'catatan'         => $pesanan->catatan,
                'ongkir'          => $pesanan->ongkir,
                'total_harga'     => $pesanan->total_harga,
                'subtotal_produk' => $pesanan->details->sum('subtotal'),
                'bukti_bayar'     => $pesanan->bukti_bayar ? asset('assets/image/pembayaran/' . $pesanan->bukti_bayar) : null,
                'waktu_bayar'     => $pesanan->waktu_bayar ? $pesanan->waktu_bayar->translatedFormat('d M Y H:i') : null,
                'tanggal_pesan'   => $pesanan->created_at ? $pesanan->created_at->translatedFormat('d M Y H:i') : null,
                'items'           => $pesanan->details->map(function ($item) {
                    $motif = $item->motif;
                    $produk = $motif?->produk;
                    $gambar = $motif?->gambar_depan ? asset('assets/image/produk/' . $motif->gambar_depan) : null;
                    return [
                        'nama_produk'  => $produk->nama_produk ?? 'Produk',
                        'nama_motif'   => $motif->nama_motif ?? '-',
                        'gambar'       => $gambar,
                        'jumlah'       => $item->jumlah,
                        'harga_satuan' => $item->harga_satuan,
                        'subtotal'     => $item->subtotal,
                    ];
                }),
            ]
        ]);
    }

    // Transisi status pesanan hanya melalui tindakan pada tabel.
    public function konfirmasi(Pemesanan $pesanan)
    {
        $current = $pesanan->status_pesanan;

        if ($current === 'menunggu') {
            $pesanan->status_pesanan = 'diproses';
            if (!$pesanan->waktu_bayar) {
                $pesanan->waktu_bayar = now();
            }
            $pesanan->save();

            return redirect()->back()->with('success', "Pesanan #{$pesanan->pemesanan_id} berhasil dikonfirmasi dan sedang diproses!");
        } elseif ($current === 'diproses' && filled($pesanan->no_resi)) {
            $pesanan->status_pesanan = 'dikirim';
            $pesanan->save();

            return redirect()->back()->with('success', "Pesanan #{$pesanan->pemesanan_id} telah diubah statusnya menjadi Dikirim!");
        } elseif ($current === 'dikirim') {
            $pesanan->status_pesanan = 'selesai';
            $pesanan->save();

            return redirect()->back()->with('success', "Pesanan #{$pesanan->pemesanan_id} telah diselesaikan!");
        }

        if ($current === 'diproses') {
            return redirect()->back()->with('error', 'Nomor resi wajib diisi sebelum pesanan dapat ditandai dikirim.');
        }

        return redirect()->back()->with('error', 'Status pesanan ini tidak dapat diubah.');
    }

    public function updateResi(Request $request, Pemesanan $pesanan)
    {
        $request->validate([
            'no_resi' => 'required|string|max:100',
        ]);

        $pesanan->update(['no_resi' => $request->no_resi]);

        return redirect()->back()->with('success', "Nomor resi pesanan #{$pesanan->pemesanan_id} berhasil disimpan.");
    }

}
