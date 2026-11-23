<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>Detail Pesanan #{{ $pesanan->pemesanan_id }} | Rabita</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --nav: #151515;
            --gold: #C9A66B;
            --gold-hover: #b58f52;
            --bg1: #F5F4EF;
            --bg2: #E9E5DE;
            --ink: #111111;
            --tx: #555555;
            --mu: #777777;
            --bd: #E2DDD5;
            --white: #FFFFFF;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            background-color: var(--bg1);
            color: var(--ink);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
            max-width: 1060px;
            width: 100%;
            margin: 0 auto;
            padding: 36px 24px 60px;
        }

        /* Breadcrumb */
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: var(--mu);
            margin-bottom: 20px;
        }

        .breadcrumb a {
            color: var(--tx);
            text-decoration: none;
            transition: color 0.15s ease;
        }

        .breadcrumb a:hover {
            color: var(--gold);
        }

        /* Header Card */
        .order-header-card {
            background: var(--white);
            border-radius: 16px;
            border: 1px solid var(--bd);
            padding: 24px 28px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.02);
        }

        .header-left h1 {
            font-size: 24px;
            font-weight: 700;
            color: var(--ink);
            line-height: 1.2;
        }

        .header-left p {
            font-size: 13px;
            color: var(--mu);
            margin-top: 4px;
        }

        /* Status Badge */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }

        .badge-menunggu {
            background-color: #FEF3C7;
            color: #B45309;
            border: 1px solid #FDE68A;
        }
        .badge-diproses {
            background-color: #EFF6FF;
            color: #1D4ED8;
            border: 1px solid #BFDBFE;
        }
        .badge-dikirim {
            background-color: #F5F3FF;
            color: #6D28D9;
            border: 1px solid #DDD6FE;
        }
        .badge-selesai {
            background-color: #ECFDF5;
            color: #047857;
            border: 1px solid #A7F3D0;
        }
        .badge-dibatalkan {
            background-color: #FEF2F2;
            color: #B91C1C;
            border: 1px solid #FECACA;
        }

        /* Alerts */
        .alert-box {
            padding: 14px 18px;
            border-radius: 12px;
            font-size: 13.5px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .alert-success {
            background-color: #ECFDF5;
            color: #065F46;
            border: 1px solid #A7F3D0;
        }
        .alert-error {
            background-color: #FEF2F2;
            color: #991B1B;
            border: 1px solid #FECACA;
        }

        /* Grid Layout */
        .detail-grid {
            display: grid;
            grid-template-columns: 1.35fr 1fr;
            gap: 24px;
            align-items: start;
        }

        .card {
            background: var(--white);
            border: 1px solid var(--bd);
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.02);
            margin-bottom: 24px;
        }

        .card:last-child {
            margin-bottom: 0;
        }

        .card-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--ink);
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Product Items List */
        .item-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .item-card {
            display: flex;
            align-items: center;
            gap: 16px;
            padding-bottom: 16px;
            border-bottom: 1px solid #F0ECE4;
        }

        .item-card:last-child {
            padding-bottom: 0;
            border-bottom: none;
        }

        .item-img {
            width: 70px;
            height: 70px;
            border-radius: 10px;
            object-fit: cover;
            border: 1px solid #EAE6DE;
            background: var(--bg2);
            flex-shrink: 0;
        }

        .item-details {
            flex: 1;
            min-width: 0;
        }

        .item-title {
            font-size: 14.5px;
            font-weight: 600;
            color: var(--ink);
            line-height: 1.3;
        }

        .item-meta {
            font-size: 12px;
            color: var(--mu);
            margin-top: 3px;
        }

        .item-calc {
            font-size: 12.5px;
            color: var(--tx);
            margin-top: 4px;
        }

        .item-total {
            font-size: 14.5px;
            font-weight: 700;
            color: var(--ink);
            text-align: right;
            white-space: nowrap;
        }

        /* Resi & Tracking Card */
        .tracking-box {
            background: #FAFAF7;
            border: 1px solid #E8E2D9;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 18px;
        }

        .tracking-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
            font-size: 13px;
        }

        .tracking-row:last-child {
            margin-bottom: 0;
        }

        .tracking-label {
            color: var(--mu);
        }

        .tracking-val {
            font-weight: 600;
            color: var(--ink);
        }

        .resi-highlight {
            font-family: monospace;
            background: #FFFFFF;
            border: 1px solid #DEC096;
            color: #C9A66B;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        /* Summary Breakdown */
        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13.5px;
            color: var(--tx);
            margin-bottom: 12px;
        }

        .summary-row.total {
            border-top: 1px solid #E8E2D9;
            padding-top: 14px;
            margin-top: 14px;
            font-size: 16px;
            font-weight: 700;
            color: var(--ink);
        }

        .total-price {
            font-size: 20px;
            color: var(--gold);
        }

        /* Bukti Transfer Box */
        .proof-box {
            background: #FAFAF7;
            border: 1px solid #EAE6DE;
            border-radius: 12px;
            padding: 18px;
            text-align: center;
        }

        .proof-preview {
            max-width: 220px;
            max-height: 220px;
            width: 100%;
            height: auto;
            border-radius: 10px;
            object-fit: contain;
            border: 1px solid #DDD;
            margin: 0 auto 12px;
            display: block;
            background: #FFF;
            cursor: pointer;
        }

        .btn-upload-submit {
            width: 100%;
            background: var(--gold);
            color: #FFFFFF;
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-size: 13.5px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 12px;
            transition: background 0.2s ease;
        }

        .btn-upload-submit:hover {
            background: var(--gold-hover);
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: transparent;
            color: var(--tx);
            border: 1px solid var(--bd);
            padding: 10px 18px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            margin-top: 24px;
            transition: all 0.15s ease;
        }

        .btn-back:hover {
            background: #FFFFFF;
            color: var(--ink);
            border-color: var(--ink);
        }

        @media (max-width: 900px) {
            .detail-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <x-navbar />

    <main>
        <!-- Breadcrumb -->
        <nav class="breadcrumb">
            <a href="{{ route('beranda') }}">Beranda</a>
            <span>/</span>
            <a href="{{ route('pesanan.user.index') }}">Pesanan Saya</a>
            <span>/</span>
            <span style="color:var(--ink); font-weight:600;">Detail Pesanan #{{ $pesanan->pemesanan_id }}</span>
        </nav>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="alert-box alert-success">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="alert-box alert-error">
                <ul style="padding-left:16px;">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Header Card -->
        <div class="order-header-card">
            <div class="header-left">
                <h1>Pesanan #{{ $pesanan->pemesanan_id }}</h1>
                <p>Dipesan pada {{ $pesanan->created_at->format('d M Y, H:i') }} WIB</p>
            </div>

            @php
                $badgeClass = match($pesanan->status_pesanan) {
                    'diproses' => 'badge-diproses',
                    'dikirim' => 'badge-dikirim',
                    'selesai' => 'badge-selesai',
                    'dibatalkan' => 'badge-dibatalkan',
                    default => 'badge-menunggu',
                };
                $statusLabel = match($pesanan->status_pesanan) {
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

        <!-- 2-Column Grid -->
        <div class="detail-grid">
            
            <!-- Sisi Kiri: Produk & Bukti Pembayaran -->
            <div>
                <!-- Daftar Produk Card -->
                <div class="card">
                    <h2 class="card-title">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"></path>
                            <path d="M3 6h18"></path>
                            <path d="M16 10a4 4 0 0 1-8 0"></path>
                        </svg>
                        Produk yang Dipesan ({{ count($pesanan->details) }})
                    </h2>

                    <div class="item-list">
                        @foreach($pesanan->details as $detail)
                            @php
                                $motif = $detail->motif;
                                $produk = $motif->produk ?? null;
                                $gambar = $motif->gambar_depan ?? ($produk->gambar_produk ?? null);
                            @endphp
                            <div class="item-card">
                                @if($gambar && file_exists(public_path('assets/image/produk/' . $gambar)))
                                    <img src="{{ asset('assets/image/produk/' . $gambar) }}" alt="{{ $produk->nama_produk ?? 'Batik' }}" class="item-img">
                                @else
                                    <div class="item-img" style="display:grid;place-items:center;color:#999;">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="4" width="18" height="16" rx="2"/><circle cx="9" cy="10" r="1.6"/><path d="m21 16-5-5-8 8"/></svg>
                                    </div>
                                @endif
                                <div class="item-details">
                                    <div class="item-title">{{ $produk->nama_produk ?? 'Batik Sasirangan' }}</div>
                                    <div class="item-meta">
                                        {{ $produk->kategori->nama_kategori ?? 'Sasirangan' }} · Motif {{ $motif->nama_motif ?? '-' }}
                                    </div>
                                    <div class="item-calc">
                                        {{ $detail->jumlah }} x Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}
                                    </div>
                                </div>
                                <div class="item-total">
                                    Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Bukti Pembayaran Card -->
                <div class="card">
                    <h2 class="card-title">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="5" width="20" height="14" rx="2"></rect>
                            <line x1="2" y1="10" x2="22" y2="10"></line>
                        </svg>
                        Bukti Pembayaran QRIS
                    </h2>

                    @if($pesanan->bukti_bayar)
                        <div class="proof-box">
                            <a href="{{ asset('assets/image/pembayaran/' . $pesanan->bukti_bayar) }}" target="_blank" title="Klik untuk memperbesar">
                                <img src="{{ asset('assets/image/pembayaran/' . $pesanan->bukti_bayar) }}" alt="Bukti Transfer" class="proof-preview">
                            </a>
                            <div style="font-size:12.5px;color:#059669;font-weight:600;display:inline-flex;align-items:center;gap:6px;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                                Bukti transfer telah terkirim
                            </div>
                            <div style="font-size:11.5px;color:#888;margin-top:4px;">
                                Diunggah: {{ $pesanan->waktu_bayar ? \Carbon\Carbon::parse($pesanan->waktu_bayar)->format('d M Y, H:i') : '-' }} WIB
                            </div>

                            @if($pesanan->status_pesanan === 'menunggu')
                                <details style="margin-top:16px;text-align:left;">
                                    <summary style="font-size:12px;color:var(--gold);cursor:pointer;font-weight:600;">Ganti Bukti Pembayaran</summary>
                                    <form action="{{ route('pesanan.user.upload-bukti', $pesanan->pemesanan_id) }}" method="POST" enctype="multipart/form-data" style="margin-top:12px;">
                                        @csrf
                                        <input type="file" name="bukti_bayar" accept="image/png,image/jpeg,image/jpg" required style="font-size:12px;margin-bottom:8px;width:100%;">
                                        <button type="submit" class="btn-upload-submit">Unggah Ulang Bukti</button>
                                    </form>
                                </details>
                            @endif
                        </div>
                    @else
                        <!-- Form Upload Bukti Susulan -->
                        <div class="proof-box">
                            <div style="background:#FFFBEB;border:1px solid #FDE68A;border-radius:8px;padding:12px;font-size:12.5px;color:#B45309;margin-bottom:16px;">
                                Anda belum mengunggah bukti pembayaran untuk pesanan ini. Silakan scan kode QRIS dan upload foto bukti transfer Anda.
                            </div>

                            @if(!empty($qrPath))
                                <div style="margin-bottom:14px;">
                                    <span style="font-size:11px;color:#888;display:block;margin-bottom:6px;">Kode QRIS Toko:</span>
                                    <img src="{{ $qrPath }}" alt="QRIS" style="max-width:180px;height:auto;border-radius:8px;border:1px solid #E5E7EB;margin:0 auto;display:block;">
                                </div>
                            @endif

                            <form action="{{ route('pesanan.user.upload-bukti', $pesanan->pemesanan_id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div style="text-align:left;margin-bottom:10px;">
                                    <label style="font-size:12px;font-weight:600;display:block;margin-bottom:4px;">Pilih File Bukti Transfer:</label>
                                    <input type="file" name="bukti_bayar" accept="image/png,image/jpeg,image/jpg" required style="font-size:12px;width:100%;">
                                </div>
                                <button type="submit" class="btn-upload-submit">Kirim Bukti Pembayaran</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Sisi Kanan: Pengiriman & Ringkasan Biaya -->
            <div>
                <!-- Ekspedisi & Resi Card -->
                <div class="card">
                    <h2 class="card-title">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                                @if(!empty($pesanan->no_resi))
                                    <span class="resi-highlight">{{ $pesanan->no_resi }}</span>
                                @else
                                    <span style="font-size:12px;color:#888;font-style:italic;">Menunggu input dari admin</span>
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
                        @if($pesanan->catatan)
                            <div style="margin-top:8px;font-style:italic;color:#777;">
                                Catatan: "{{ $pesanan->catatan }}"
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Ringkasan Biaya Card -->
                <div class="card">
                    <h2 class="card-title">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                        <span style="font-weight:600;color:var(--ink);">Rp {{ number_format($subtotalBarang, 0, ',', '.') }}</span>
                    </div>

                    <div class="summary-row">
                        <span>Biaya Pengiriman (Ongkir)</span>
                        <span style="font-weight:600;color:var(--ink);">Rp {{ number_format($pesanan->ongkir, 0, ',', '.') }}</span>
                    </div>

                    <div class="summary-row total">
                        <span>Total Pembayaran</span>
                        <span class="total-price">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
                    </div>
                </div>

            </div>

        </div>

        <a href="{{ route('pesanan.user.index') }}" class="btn-back">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
            Kembali ke Riwayat Pesanan
        </a>
    </main>

    <x-footer />
</body>
</html>
