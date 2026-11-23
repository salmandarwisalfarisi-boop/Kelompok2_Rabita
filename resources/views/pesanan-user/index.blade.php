<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>Pesanan Saya | Rabita</title>
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
            padding: 40px 24px 60px;
        }

        .header-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--ink);
            margin-bottom: 6px;
        }

        .header-subtitle {
            font-size: 14px;
            color: var(--tx);
            margin-bottom: 30px;
        }

        /* Alert */
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

        /* Order Cards List */
        .order-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .order-card {
            background: var(--white);
            border: 1px solid var(--bd);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.03);
            transition: box-shadow 0.2s ease, border-color 0.2s ease;
        }

        .order-card:hover {
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06);
            border-color: #D4C9BC;
        }

        .order-header {
            padding: 16px 24px;
            background: #FAFAF7;
            border-bottom: 1px solid var(--bd);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }

        .order-meta {
            display: flex;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .order-id {
            font-weight: 700;
            font-size: 15px;
            color: var(--ink);
        }

        .order-date {
            font-size: 12.5px;
            color: var(--mu);
        }

        /* Status Badge */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: capitalize;
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

        /* Order Body (Items) */
        .order-body {
            padding: 20px 24px;
        }

        .items-preview {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .item-row {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .item-thumb {
            width: 58px;
            height: 58px;
            border-radius: 8px;
            object-fit: cover;
            background: var(--bg2);
            border: 1px solid #EAE6DE;
            flex-shrink: 0;
        }

        .item-info {
            flex: 1;
            min-width: 0;
        }

        .item-name {
            font-weight: 600;
            font-size: 14px;
            color: var(--ink);
            line-height: 1.3;
        }

        .item-sub {
            font-size: 12px;
            color: var(--mu);
            margin-top: 3px;
        }

        .item-price {
            font-size: 13.5px;
            font-weight: 600;
            color: var(--ink);
            text-align: right;
            white-space: nowrap;
        }

        /* Order Footer */
        .order-footer {
            padding: 16px 24px;
            background: #FFFFFF;
            border-top: 1px solid #F0ECE4;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
        }

        .tracking-status {
            font-size: 12.5px;
            color: var(--tx);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .order-total-box {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .total-label {
            font-size: 12px;
            color: var(--mu);
            text-align: right;
        }

        .total-amount {
            font-size: 17px;
            font-weight: 700;
            color: var(--gold);
        }

        .btn-detail {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background-color: var(--ink);
            color: #FFFFFF;
            padding: 9px 18px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: background 0.2s ease, transform 0.1s ease;
        }

        .btn-detail:hover {
            background-color: var(--gold);
        }

        /* Empty State */
        .empty-orders {
            text-align: center;
            padding: 60px 20px;
            background: var(--white);
            border-radius: 16px;
            border: 1px solid var(--bd);
        }

        .empty-orders svg {
            margin: 0 auto 16px;
            color: var(--gold);
        }

        .empty-orders h3 {
            font-size: 18px;
            font-weight: 600;
            color: var(--ink);
            margin-bottom: 6px;
        }

        .empty-orders p {
            font-size: 13.5px;
            color: var(--mu);
            margin-bottom: 24px;
        }

        .btn-shop {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: var(--gold);
            color: #FFFFFF;
            padding: 12px 24px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: background 0.2s ease;
        }

        .btn-shop:hover {
            background-color: var(--gold-hover);
        }

        @media (max-width: 640px) {
            .order-header {
                flex-direction: column;
                align-items: flex-start;
            }
            .order-footer {
                flex-direction: column;
                align-items: stretch;
            }
            .order-total-box {
                justify-content: space-between;
            }
            .btn-detail {
                justify-content: center;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <x-navbar />

    <main>
        <h1 class="header-title">Pesanan Saya</h1>
        <p class="header-subtitle">Pantau status konfirmasi pembayaran dan pengiriman barang pesanan Anda</p>

        @if(session('success'))
            <div class="alert-box alert-success">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if($pesananList->isEmpty())
            <div class="empty-orders">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"></path>
                    <path d="M3 6h18"></path>
                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                </svg>
                <h3>Belum Ada Riwayat Pesanan</h3>
                <p>Anda belum pernah melakukan pemesanan. Yuk temukan batik sasirangan favorit Anda sekarang!</p>
                <a href="{{ route('katalog') }}" class="btn-shop">
                    Mulai Belanja Sekarang
                </a>
            </div>
        @else
            <div class="order-list">
                @foreach($pesananList as $pesanan)
                    <div class="order-card">
                        <!-- Header -->
                        <div class="order-header">
                            <div class="order-meta">
                                <span class="order-id">#{{ $pesanan->pemesanan_id }}</span>
                                <span class="order-date">{{ $pesanan->created_at->format('d M Y, H:i') }} WIB</span>
                                @if($pesanan->bukti_bayar)
                                    <span style="font-size:11.5px;color:#059669;display:inline-flex;align-items:center;gap:4px;">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                                        Bukti Diunggah
                                    </span>
                                @else
                                    <span style="font-size:11.5px;color:#D97706;display:inline-flex;align-items:center;gap:4px;">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                        Belum Ada Bukti TF
                                    </span>
                                @endif
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
                                    'menunggu' => 'Menunggu Verifikasi',
                                    'diproses' => 'Sedang Diproses',
                                    'dikirim' => 'Sedang Dikirim',
                                    'selesai' => 'Selesai',
                                    'dibatalkan' => 'Dibatalkan',
                                    default => ucfirst($pesanan->status_pesanan),
                                };
                            @endphp
                            <span class="badge {{ $badgeClass }}">
                                {{ $statusLabel }}
                            </span>
                        </div>

                        <!-- Body (Item Preview) -->
                        <div class="order-body">
                            <div class="items-preview">
                                @foreach($pesanan->details as $detail)
                                    @php
                                        $motif = $detail->motif;
                                        $produk = $motif->produk ?? null;
                                        $gambar = $motif->gambar_depan ?? ($produk->gambar_produk ?? null);
                                    @endphp
                                    <div class="item-row">
                                        @if($gambar && file_exists(public_path('assets/image/produk/' . $gambar)))
                                            <img src="{{ asset('assets/image/produk/' . $gambar) }}" alt="{{ $produk->nama_produk ?? 'Batik' }}" class="item-thumb">
                                        @else
                                            <div class="item-thumb" style="display:grid;place-items:center;color:#999;">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="4" width="18" height="16" rx="2"/><circle cx="9" cy="10" r="1.6"/><path d="m21 16-5-5-8 8"/></svg>
                                            </div>
                                        @endif
                                        <div class="item-info">
                                            <div class="item-name">{{ $produk->nama_produk ?? 'Produk Rabita' }}</div>
                                            <div class="item-sub">
                                                {{ $produk->kategori->nama_kategori ?? 'Sasirangan' }} · Motif {{ $motif->nama_motif ?? '-' }} · {{ $detail->jumlah }} pcs
                                            </div>
                                        </div>
                                        <div class="item-price">
                                            Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="order-footer">
                            <div class="tracking-status">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="1" y="3" width="15" height="13"></rect>
                                    <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                                    <circle cx="5.5" cy="18.5" r="2.5"></circle>
                                    <circle cx="18.5" cy="18.5" r="2.5"></circle>
                                </svg>
                                <span>
                                    <strong>{{ $pesanan->kurir }}</strong>:
                                    @if(!empty($pesanan->no_resi))
                                        <span style="font-family:monospace;font-weight:600;color:#1A1A1A;">{{ $pesanan->no_resi }}</span>
                                    @else
                                        <span style="color:#888;">Menunggu nomor resi dari admin</span>
                                    @endif
                                </span>
                            </div>

                            <div class="order-total-box">
                                <div>
                                    <div class="total-label">Total Pesanan</div>
                                    <div class="total-amount">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</div>
                                </div>
                                <a href="{{ route('pesanan.user.show', $pesanan->pemesanan_id) }}" class="btn-detail">
                                    Lihat Detail
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div style="margin-top:28px;">
                {{ $pesananList->links() }}
            </div>
        @endif
    </main>

    <x-footer />
</body>
</html>
