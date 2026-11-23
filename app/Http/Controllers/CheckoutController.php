<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Motif;
use App\Models\Pemesanan;
use App\Models\PemesananDetail;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    /**
     * Tampilkan halaman checkout beserta item yang dipilih
     */
    public function index(Request $request)
    {
        $checkoutItems = [];
        $subtotal = 0;
        $totalQty = 0;

        // Jalur 1: "Beli Sekarang" dari halaman detail
        if ($request->filled('buy_now') && $request->filled('motif_id')) {
            $motif = Motif::with('produk.kategori')->findOrFail($request->motif_id);
            $qty = max(1, (int) $request->input('qty', 1));
            $itemSubtotal = $motif->produk->harga * $qty;

            $checkoutItems[] = [
                'motif_id'    => $motif->motif_id,
                'produk_id'   => $motif->produk->produk_id,
                'nama_produk' => $motif->produk->nama_produk,
                'kategori'    => $motif->produk->kategori->nama_kategori ?? 'Sasirangan',
                'nama_motif'  => $motif->nama_motif,
                'harga'       => $motif->produk->harga,
                'qty'         => $qty,
                'gambar'      => $motif->gambar_depan ?? $motif->produk->gambar_produk,
                'subtotal'    => $itemSubtotal,
                'cart_id'     => null,
            ];
            $subtotal += $itemSubtotal;
            $totalQty += $qty;
        } else {
            // Jalur 2: Checkout dari Keranjang belanja (item terpilih)
            $selectedIds = $request->input('selected_ids');
            if (is_string($selectedIds)) {
                $selectedIds = explode(',', $selectedIds);
            }
            $selectedIds = is_array($selectedIds) ? array_filter($selectedIds) : [];

            if (Auth::check()) {
                $query = Keranjang::with('motif.produk.kategori')->where('user_id', Auth::id());
                if (!empty($selectedIds)) {
                    $query->whereIn('keranjang_id', $selectedIds);
                }
                $keranjangList = $query->get();

                foreach ($keranjangList as $item) {
                    if (!$item->motif || !$item->motif->produk) continue;
                    $p = $item->motif->produk;
                    $m = $item->motif;
                    $itemSubtotal = $p->harga * $item->jumlah;

                    $checkoutItems[] = [
                        'motif_id'    => $m->motif_id,
                        'produk_id'   => $p->produk_id,
                        'nama_produk' => $p->nama_produk,
                        'kategori'    => $p->kategori->nama_kategori ?? 'Sasirangan',
                        'nama_motif'  => $m->nama_motif,
                        'harga'       => $p->harga,
                        'qty'         => $item->jumlah,
                        'gambar'      => $m->gambar_depan ?? $p->gambar_produk,
                        'subtotal'    => $itemSubtotal,
                        'cart_id'     => $item->keranjang_id,
                    ];
                    $subtotal += $itemSubtotal;
                    $totalQty += $item->jumlah;
                }
            } else {
                $sessionCart = Session::get('cart', []);
                foreach ($sessionCart as $key => $item) {
                    if (!empty($selectedIds) && !in_array($key, $selectedIds) && !in_array($item['motif_id'], $selectedIds)) {
                        continue;
                    }
                    $motif = Motif::with('produk.kategori')->find($item['motif_id']);
                    if (!$motif || !$motif->produk) continue;
                    $p = $motif->produk;
                    $itemSubtotal = $p->harga * $item['qty'];

                    $checkoutItems[] = [
                        'motif_id'    => $motif->motif_id,
                        'produk_id'   => $p->produk_id,
                        'nama_produk' => $p->nama_produk,
                        'kategori'    => $p->kategori->nama_kategori ?? 'Sasirangan',
                        'nama_motif'  => $motif->nama_motif,
                        'harga'       => $p->harga,
                        'qty'         => $item['qty'],
                        'gambar'      => $motif->gambar_depan ?? $p->gambar_produk,
                        'subtotal'    => $itemSubtotal,
                        'cart_id'     => $key,
                    ];
                    $subtotal += $itemSubtotal;
                    $totalQty += $item['qty'];
                }
            }
        }

        // Jika keranjang kosong saat checkout, redirect ke keranjang
        if (empty($checkoutItems)) {
            return redirect()->route('keranjang')->with('error', 'Silakan pilih minimal satu produk untuk di-checkout.');
        }

        // Estimasi berat produk: rata-rata 350 gram per pcs tas/kain sasirangan, minimum 1000 gram (1 kg kurir)
        $totalWeight = max(1000, $totalQty * 350);

        // Nilai ongkir default sebelum pembeli memilih kurir
        $ongkir = 20000;
        $total = $subtotal + $ongkir;

        // Cari file QRIS aktif toko secara dinamis
        $qrPath = null;
        $extensions = ['png', 'jpeg', 'jpg', 'svg'];
        foreach ($extensions as $ext) {
            if (file_exists(public_path("assets/image/qris.{$ext}"))) {
                $qrPath = asset("assets/image/qris.{$ext}");
                break;
            }
        }

        return view('checkout', compact('checkoutItems', 'subtotal', 'ongkir', 'total', 'totalWeight', 'qrPath'));
    }

    /**
     * API Pencarian Wilayah Tujuan (RajaOngkir Komerce)
     */
    public function getDestinations(Request $request)
    {
        $search = trim($request->input('search', ''));
        if (strlen($search) < 3) {
            return response()->json(['data' => []]);
        }

        try {
            $apiKey = config('services.rajaongkir.key', env('RAJAONGKIR_API_KEY'));
            $response = Http::withHeaders(['key' => $apiKey])
                ->withoutVerifying()
                ->timeout(8)
                ->get('https://rajaongkir.komerce.id/api/v1/destination/domestic-destination', [
                    'search' => $search
                ]);

            if ($response->successful()) {
                return response()->json($response->json());
            }

            return response()->json(['data' => [], 'error' => 'Gagal mengambil data dari server RajaOngkir'], 502);
        } catch (\Exception $e) {
            Log::error('RajaOngkir Destination Error: ' . $e->getMessage());
            return response()->json(['data' => [], 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * API Kalkulasi Ongkos Kirim Realtime dari Banjarbaru (ID: 3081)
     */
    public function calculateCost(Request $request)
    {
        $request->validate([
            'destination' => 'required',
            'weight'      => 'nullable|integer|min:1',
        ]);

        $origin = (int) config('services.rajaongkir.origin', env('RAJAONGKIR_ORIGIN', 3081));
        $destination = (int) $request->input('destination');
        $weight = max(1000, (int) $request->input('weight', 1000));
        $apiKey = config('services.rajaongkir.key', env('RAJAONGKIR_API_KEY'));

        $supportedCouriers = ['jne', 'jnt', 'pos'];
        $results = [];

        foreach ($supportedCouriers as $courier) {
            try {
                $response = Http::asForm()
                    ->withHeaders(['key' => $apiKey])
                    ->withoutVerifying()
                    ->timeout(8)
                    ->post('https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost', [
                        'origin'      => $origin,
                        'destination' => $destination,
                        'weight'      => $weight,
                        'courier'     => $courier
                    ]);

                if ($response->successful()) {
                    $services = $response->json('data', []);
                    if (is_array($services)) {
                        foreach ($services as $srv) {
                            $results[] = [
                                'courier_code' => strtolower($srv['code'] ?? $courier),
                                'courier_name' => $srv['name'] ?? strtoupper($courier),
                                'service'      => $srv['service'] ?? 'Reguler',
                                'description'  => $srv['description'] ?? '',
                                'cost'         => (int) ($srv['cost'] ?? 0),
                                'etd'          => !empty($srv['etd']) ? $srv['etd'] : '2-3 Hari',
                            ];
                        }
                    }
                }
            } catch (\Exception $e) {
                Log::warning("RajaOngkir Cost Error ({$courier}): " . $e->getMessage());
            }
        }

        // Urutkan hasil ongkir dari yang termurah
        usort($results, function ($a, $b) {
            return $a['cost'] <=> $b['cost'];
        });

        return response()->json([
            'success' => true,
            'origin'  => $origin,
            'destination' => $destination,
            'weight'  => $weight,
            'data'    => $results
        ]);
    }

    /**
     * Proses penyimpanan pesanan ke tb_pemesanan dan tb_pemesanan_detail
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_penerima'  => 'required|string|max:100',
            'no_hp_penerima' => 'required|string|max:20',
            'provinsi'       => 'required|string|max:100',
            'kota'           => 'required|string|max:100',
            'alamat_lengkap' => 'required|string',
            'kode_pos'       => 'required|string|max:10',
            'ongkir'         => 'required|numeric|min:0',
            'kurir'          => 'required|string|max:100',
            'layanan_kurir'  => 'nullable|string|max:100',
            'estimasi_tiba'  => 'nullable|string|max:100',
            'bukti_bayar'    => 'nullable|image|mimes:png,jpg,jpeg|max:4096',
            'items'          => 'required|array|min:1',
            'items.*.motif_id' => 'required|exists:tb_motif,motif_id',
            'items.*.qty'      => 'required|integer|min:1',
        ], [
            'nama_penerima.required'  => 'Nama penerima wajib diisi.',
            'no_hp_penerima.required' => 'Nomor telepon wajib diisi.',
            'provinsi.required'       => 'Provinsi wajib dipilih.',
            'kota.required'           => 'Kota wajib dipilih.',
            'alamat_lengkap.required' => 'Alamat lengkap wajib diisi.',
            'kode_pos.required'       => 'Kode pos wajib diisi.',
            'ongkir.required'         => 'Pilihan kurir dan ongkos kirim wajib dipilih.',
            'kurir.required'          => 'Silakan pilih kurir pengiriman.',
            'bukti_bayar.image'       => 'Bukti pembayaran harus berupa gambar.',
            'bukti_bayar.mimes'       => 'Bukti pembayaran harus berformat PNG, JPG, atau JPEG.',
            'bukti_bayar.max'         => 'Ukuran bukti pembayaran maksimal 4MB.',
        ]);

        $userId = Auth::id() ?? 1; // Jika belum login, assign ke default user id 1
        $ongkir = (int) $request->input('ongkir', 20000);
        $totalBarang = 0;
        $detailToInsert = [];
        $cartIdsToDelete = [];

        foreach ($request->input('items', []) as $it) {
            $motif = Motif::with('produk')->find($it['motif_id']);
            if (!$motif || !$motif->produk) continue;

            $hargaSatuan = $motif->produk->harga;
            $qty = (int) $it['qty'];
            $subtotal = $hargaSatuan * $qty;
            $totalBarang += $subtotal;

            $detailToInsert[] = [
                'motif_id'     => $motif->motif_id,
                'jumlah'       => $qty,
                'harga_satuan' => $hargaSatuan,
                'subtotal'     => $subtotal,
            ];

            if (!empty($it['cart_id'])) {
                $cartIdsToDelete[] = $it['cart_id'];
            }
        }

        if (empty($detailToInsert)) {
            return back()->with('error', 'Item pesanan tidak valid.');
        }

        $totalHarga = $totalBarang + $ongkir;

        // Handle upload bukti transfer jika ada
        $buktiFilename = null;
        $waktuBayar = null;
        if ($request->hasFile('bukti_bayar')) {
            $buktiFile = $request->file('bukti_bayar');
            $buktiFilename = 'bukti_' . time() . '_' . uniqid() . '.' . $buktiFile->getClientOriginalExtension();
            $destPath = public_path('assets/image/pembayaran');
            if (!file_exists($destPath)) {
                @mkdir($destPath, 0777, true);
            }
            $buktiFile->move($destPath, $buktiFilename);
            $waktuBayar = now();
        }

        DB::beginTransaction();
        try {
            // 1. Simpan ke tb_pemesanan
            $pemesanan = Pemesanan::create([
                'user_id'        => $userId,
                'nama_penerima'  => $request->nama_penerima,
                'no_hp_penerima' => $request->no_hp_penerima,
                'provinsi'       => $request->provinsi,
                'kota'           => $request->kota,
                'kecamatan'      => $request->input('kecamatan', $request->kota),
                'alamat_lengkap' => $request->alamat_lengkap,
                'kode_pos'       => $request->kode_pos,
                'kurir'          => $request->input('kurir', 'J&T Express'),
                'layanan_kurir'  => $request->input('layanan_kurir', 'Reguler'),
                'ongkir'         => $ongkir,
                'estimasi_tiba'  => $request->input('estimasi_tiba', '2-3 Hari'),
                'total_harga'    => $totalHarga,
                'status_pesanan' => 'menunggu',
                'no_resi'        => null,
                'bukti_bayar'    => $buktiFilename,
                'waktu_bayar'    => $waktuBayar,
                'catatan'        => $request->input('catatan'),
            ]);

            // 2. Simpan setiap item ke tb_pemesanan_detail
            foreach ($detailToInsert as $detail) {
                PemesananDetail::create([
                    'pemesanan_id' => $pemesanan->pemesanan_id,
                    'motif_id'     => $detail['motif_id'],
                    'jumlah'       => $detail['jumlah'],
                    'harga_satuan' => $detail['harga_satuan'],
                    'subtotal'     => $detail['subtotal'],
                ]);
            }

            // 3. Bersihkan item yang dicheckout dari keranjang
            if (Auth::check()) {
                if (!empty($cartIdsToDelete)) {
                    Keranjang::where('user_id', Auth::id())
                        ->whereIn('keranjang_id', $cartIdsToDelete)
                        ->delete();
                }
            } else {
                $cart = Session::get('cart', []);
                foreach ($cartIdsToDelete as $cid) {
                    unset($cart[$cid]);
                }
                Session::put('cart', $cart);
            }

            DB::commit();

            if (Auth::check()) {
                return redirect()->route('pesanan.user.show', $pemesanan->pemesanan_id)
                    ->with('success', 'Pesanan Anda #' . $pemesanan->pemesanan_id . ' berhasil dibuat! Terima kasih telah berbelanja di Rabita.');
            }

            return redirect()->route('beranda')->with('success', 'Pesanan Anda #' . $pemesanan->pemesanan_id . ' berhasil dibuat! Silakan login untuk memantau status pesanan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memproses pesanan: ' . $e->getMessage());
        }
    }

    /**
     * Tampilkan riwayat pesanan milik user yang sedang login
     */
    public function riwayatPesanan()
    {
        $userId = Auth::id();
        $pesananList = Pemesanan::where('user_id', $userId)
            ->with(['details.motif.produk.kategori'])
            ->latest('created_at')
            ->paginate(10);

        return view('pesanan-user.index', compact('pesananList'));
    }

    /**
     * Tampilkan detail satu pesanan milik user yang sedang login
     */
    public function detailPesanan($id)
    {
        $userId = Auth::id();
        $pesanan = Pemesanan::where('pemesanan_id', $id)
            ->where('user_id', $userId)
            ->with(['details.motif.produk.kategori'])
            ->firstOrFail();

        // Cari file QRIS aktif jika user ingin melihat kode QRIS untuk transfer
        $qrPath = null;
        $extensions = ['png', 'jpeg', 'jpg', 'svg'];
        foreach ($extensions as $ext) {
            if (file_exists(public_path("assets/image/qris.{$ext}"))) {
                $qrPath = asset("assets/image/qris.{$ext}");
                break;
            }
        }

        return view('pesanan-user.show', compact('pesanan', 'qrPath'));
    }

    /**
     * Upload susulan bukti pembayaran dari halaman detail pesanan
     */
    public function uploadBukti(Request $request, $id)
    {
        $request->validate([
            'bukti_bayar' => 'required|image|mimes:png,jpg,jpeg|max:4096',
        ], [
            'bukti_bayar.required' => 'Silakan pilih file bukti pembayaran.',
            'bukti_bayar.image'    => 'File harus berupa gambar.',
            'bukti_bayar.mimes'    => 'Format gambar harus PNG, JPG, atau JPEG.',
            'bukti_bayar.max'      => 'Ukuran file maksimal 4MB.',
        ]);

        $userId = Auth::id();
        $pesanan = Pemesanan::where('pemesanan_id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        $buktiFile = $request->file('bukti_bayar');
        $buktiFilename = 'bukti_' . time() . '_' . uniqid() . '.' . $buktiFile->getClientOriginalExtension();
        $destPath = public_path('assets/image/pembayaran');
        if (!file_exists($destPath)) {
            @mkdir($destPath, 0777, true);
        }

        // Hapus bukti lama jika ada
        if ($pesanan->bukti_bayar && file_exists($destPath . '/' . $pesanan->bukti_bayar)) {
            @unlink($destPath . '/' . $pesanan->bukti_bayar);
        }

        $buktiFile->move($destPath, $buktiFilename);

        $pesanan->update([
            'bukti_bayar' => $buktiFilename,
            'waktu_bayar' => now(),
        ]);

        return back()->with('success', 'Bukti pembayaran berhasil diunggah! Admin akan segera memverifikasi pembayaran Anda.');
    }
}
