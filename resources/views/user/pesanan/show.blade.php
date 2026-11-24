@extends('layouts.user')

@section('head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>Detail Pesanan #{{ $pesanan->pemesanan_id }} | Rabita</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    @vite(['resources/css/user/pages/pesanan/show.css', 'resources/css/user/components.css'])
@endsection

@section('content')
    <main>
        <nav class="breadcrumb">
            <a href="{{ route('beranda') }}">Beranda</a>
            <span>/</span>
            <a href="{{ route('pesanan.user.index') }}">Pesanan Saya</a>
            <span>/</span>
            <span style="color:var(--ink); font-weight:600;">Detail Pesanan #{{ $pesanan->pemesanan_id }}</span>
        </nav>

        @if (session('success'))
            <div class="alert-box alert-success">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert-box alert-error">
                <ul style="padding-left:16px;">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="order-header-card">
            <div class="header-left">
                <h1>Pesanan #{{ $pesanan->pemesanan_id }}</h1>
                <p>Dipesan pada {{ $pesanan->created_at->format('d M Y, H:i') }} WIB</p>
            </div>

            @php
                $badgeClass = match ($pesanan->status_pesanan) {
                    'diproses' => 'badge-diproses',
                    'dikirim' => 'badge-dikirim',
                    'selesai' => 'badge-selesai',
                    'dibatalkan' => 'badge-dibatalkan',
                    default => 'badge-menunggu',
                };
                $statusLabel = match ($pesanan->status_pesanan) {
                    'menunggu' => 'Menunggu Verifikasi Pembayaran',
                    'diproses' => 'Pesanan Sedang Diproses',
                    'dikirim' => 'Dalam Perjalanan Pengiriman',
                    'selesai' => 'Pesanan Selesai',
                    'dibatalkan' => 'Pesanan Dibatalkan',
                    default => ucfirst($pesanan->status_pesanan),
                };
            @endphp
            <div class="badge {{ $badgeClass }}">
                {{ $statusLabel }}
            </div>
        </div>

        <div class="detail-grid">

            <div>
                <div class="card">
                    <h2 class="card-title">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"></path>
                            <path d="M3 6h18"></path>
                            <path d="M16 10a4 4 0 0 1-8 0"></path>
                        </svg>
                        Produk yang Dipesan ({{ count($pesanan->details) }})
                    </h2>

                    <div class="item-list">
                        @foreach ($pesanan->details as $detail)
                            @php
                                $motif = $detail->motif;
                                $produk = $motif->produk ?? null;
                                $gambar = $motif->gambar_depan ?? ($produk->gambar_produk ?? null);
                            @endphp
                            <div class="item-card">
                                @if ($gambar && file_exists(public_path('assets/image/produk/' . $gambar)))
                                    <img src="{{ asset('assets/image/produk/' . $gambar) }}"
                                        alt="{{ $produk->nama_produk ?? 'Batik' }}" class="item-img">
                                @else
                                    <div class="item-img" style="display:grid;place-items:center;color:#999;">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="1.5">
                                            <rect x="3" y="4" width="18" height="16" rx="2" />
                                            <circle cx="9" cy="10" r="1.6" />
                                            <path d="m21 16-5-5-8 8" />
                                        </svg>
                                    </div>
                                @endif
                                <div class="item-details">
                                    <div class="item-title">{{ $produk->nama_produk ?? 'Batik Sasirangan' }}</div>
                                    <div class="item-meta">
                                        {{ $produk->kategori->nama_kategori ?? 'Sasirangan' }} · Motif
                                        {{ $motif->nama_motif ?? '-' }}
                                    </div>
                                    <div class="item-calc">
                                        {{ $detail->jumlah }} x Rp
                                        {{ number_format($detail->harga_satuan, 0, ',', '.') }}
                                    </div>
                                </div>
                                <div class="item-total">
                                    Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="card">
                    <h2 class="card-title">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="5" width="20" height="14" rx="2"></rect>
                            <line x1="2" y1="10" x2="22" y2="10"></line>
                        </svg>
                        Bukti Pembayaran QRIS
                    </h2>

                    @if ($pesanan->bukti_bayar)
                        <div class="proof-box">
                            <a href="{{ asset('assets/image/pembayaran/' . $pesanan->bukti_bayar) }}" target="_blank"
                                title="Klik untuk memperbesar">
                                <img src="{{ asset('assets/image/pembayaran/' . $pesanan->bukti_bayar) }}"
                                    alt="Bukti Transfer" class="proof-preview">
                            </a>
                            <div
                                style="font-size:12.5px;color:#059669;font-weight:600;display:inline-flex;align-items:center;gap:6px;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 6 9 17l-5-5" />
                                </svg>
                                Bukti transfer telah terkirim
                            </div>
                            <div style="font-size:11.5px;color:#888;margin-top:4px;">
                                Diunggah:
                                {{ $pesanan->waktu_bayar ? \Carbon\Carbon::parse($pesanan->waktu_bayar)->format('d M Y, H:i') : '-' }}
                                WIB
                            </div>

                            @if ($pesanan->status_pesanan === 'menunggu')
                                <details style="margin-top:16px;text-align:left;">
                                    <summary style="font-size:12px;color:var(--gold);cursor:pointer;font-weight:600;">
                                        Ganti Bukti Pembayaran</summary>
                                    <form action="{{ route('pesanan.user.upload-bukti', $pesanan->pemesanan_id) }}"
                                        method="POST" enctype="multipart/form-data" style="margin-top:12px;">
                                        @csrf
                                        <input type="file" name="bukti_bayar" accept="image/png,image/jpeg,image/jpg"
                                            required style="font-size:12px;margin-bottom:8px;width:100%;">
                                        <button type="submit" class="btn-upload-submit">Unggah Ulang Bukti</button>
                                    </form>
                                </details>
                            @endif
                        </div>
                    @else
                        <div class="proof-box">
                            <div
                                style="background:#FFFBEB;border:1px solid #FDE68A;border-radius:8px;padding:12px;font-size:12.5px;color:#B45309;margin-bottom:16px;">
                                Anda belum mengunggah bukti pembayaran untuk pesanan ini. Silakan scan kode QRIS dan
                                upload foto bukti transfer Anda.
                            </div>

                            @if (!empty($qrPath))
                                <div style="margin-bottom:14px;">
                                    <span style="font-size:11px;color:#888;display:block;margin-bottom:6px;">Kode QRIS
                                        Toko:</span>
                                    <img src="{{ $qrPath }}" alt="QRIS"
                                        style="max-width:180px;height:auto;border-radius:8px;border:1px solid #E5E7EB;margin:0 auto;display:block;">
                                </div>
                            @endif

                            <form action="{{ route('pesanan.user.upload-bukti', $pesanan->pemesanan_id) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <div style="text-align:left;margin-bottom:10px;">
                                    <label style="font-size:12px;font-weight:600;display:block;margin-bottom:4px;">Pilih
                                        File Bukti Transfer:</label>
                                    <input type="file" name="bukti_bayar" accept="image/png,image/jpeg,image/jpg"
                                        required style="font-size:12px;width:100%;">
                                </div>
                                <button type="submit" class="btn-upload-submit">Kirim Bukti Pembayaran</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>

            <div>
                <div class="card">
                    <h2 class="card-title">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="1" y="3" width="15" height="13"></rect>
                            <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                            <circle cx="5.5" cy="18.5" r="2.5"></circle>
                            <circle cx="18.5" cy="18.5" r="2.5"></circle>
                        </svg>
                        Pengiriman & Nomor Resi
                    </h2>

                    <div class="tracking-box">
                        <div class="tracking-row">
                            <span class="tracking-label">Kurir Ekspedisi</span>
                            <span class="tracking-val">{{ $pesanan->kurir }} ({{ $pesanan->layanan_kurir }})</span>
                        </div>
                        <div class="tracking-row" style="margin-top:10px;">
                            <span class="tracking-label">Nomor Resi</span>
                            <div>
                                @if (!empty($pesanan->no_resi))
                                    <span class="resi-highlight">{{ $pesanan->no_resi }}</span>
                                @else
                                    <span style="font-size:12px;color:#888;font-style:italic;">Menunggu input dari
                                        admin</span>
                                @endif
                            </div>
                        </div>
                        <div class="tracking-row" style="margin-top:10px;">
                            <span class="tracking-label">Estimasi Tiba</span>
                            <span class="tracking-val">{{ $pesanan->estimasi_tiba ?? '2-3 Hari' }}</span>
                        </div>
                    </div>

                    <div style="font-size:12.5px;color:var(--tx);line-height:1.6;">
                        <strong style="color:var(--ink);display:block;margin-bottom:4px;">Alamat Tujuan:</strong>
                        <div><strong>{{ $pesanan->nama_penerima }}</strong> ({{ $pesanan->no_hp_penerima }})</div>
                        <div>{{ $pesanan->alamat_lengkap }}</div>
                        <div>{{ $pesanan->kecamatan }}, {{ $pesanan->kota }}</div>
                        <div>{{ $pesanan->provinsi }} - {{ $pesanan->kode_pos }}</div>
                        @if ($pesanan->catatan)
                            <div style="margin-top:8px;font-style:italic;color:#777;">
                                Catatan: "{{ $pesanan->catatan }}"
                            </div>
                        @endif
                    </div>
                </div>

                <div class="card">
                    <h2 class="card-title">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="1" x2="12" y2="23"></line>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                        Rincian Pembayaran
                    </h2>

                    @php
                        $subtotalBarang = $pesanan->details->sum('subtotal');
                    @endphp

                    <div class="summary-row">
                        <span>Total Harga Produk</span>
                        <span style="font-weight:600;color:var(--ink);">Rp
                            {{ number_format($subtotalBarang, 0, ',', '.') }}</span>
                    </div>

                    <div class="summary-row">
                        <span>Biaya Pengiriman (Ongkir)</span>
                        <span style="font-weight:600;color:var(--ink);">Rp
                            {{ number_format($pesanan->ongkir, 0, ',', '.') }}</span>
                    </div>

                    <div class="summary-row total">
                        <span>Total Pembayaran</span>
                        <span class="total-price">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
                    </div>
                </div>

            </div>

        </div>

        <a href="{{ route('pesanan.user.index') }}" class="btn-back">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12" />
                <polyline points="12 19 5 12 12 5" />
            </svg>
            Kembali ke Riwayat Pesanan
        </a>
    </main>
@endsection
