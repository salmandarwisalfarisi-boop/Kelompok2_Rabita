<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Rabita - Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #F5F5F0;            
            --card: #FFFFFF;           
            --gold: #B79361;           
            --gold-light: #DEC096;     
            --dark-sidebar: #191919;   
            --tx: #1A1A1A;             
            --mut: #888888;            
            --muted-light: #AAAAAA;    
            --ln: #F0EDE8;             
            --icon-bg: #F5F0E8;        
            --green: #22C55E;          
            --badge-proc-bg: #FEF3C7;  
            --badge-proc-tx: #D97706;  
            --badge-warn-bg: #FEE2E2;  
            --badge-warn-tx: #EF4444;  
            box-sizing: border-box;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Inter, 'Segoe UI', Arial, sans-serif;
            background: var(--bg);
            color: var(--tx);
            display: flex;
            min-height: 100vh;
        }

        /* --- Sidebar Navigation --- */
        aside {
            width: 206px;
            flex: none;
            background-color: var(--dark-sidebar);
            color: #FFFFFF;
            font-family: Lato, "Segoe UI", Arial, sans-serif;
            position: sticky;
            top: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .lg {
            height: 83px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-bottom: 1px solid var(--gold-light);
        }

        .lg img {
            height: 79px;
        }

        nav {
            padding: 28px 18px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            flex: 1;
        }

        nav a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 10px;
            height: 37px;
            border-radius: 5px;
            color: #FFFFFF;
            text-decoration: none;
            font-size: 16.5px;
            transition: all 0.2s ease;
        }

        nav a:hover {
            background-color: var(--gold-light); /* #DEC096 */
            color: #FFFFFF;
        }

        nav a.on {
            background-color: var(--gold);
        }

        nav a.on:hover {
            background-color: var(--gold);
        }

        nav svg,
        nav img {
            width: 22px;
            height: 22px;
            flex: none;
            display: block;
            object-fit: contain;
        }

        .sidebar-logout {
            padding: 18px;
            margin-top: auto;
        }

        .sidebar-logout form {
            margin: 0;
        }

        .sidebar-logout button {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            height: 37px;
            padding: 0 12px;
            border: 1px solid rgba(222, 192, 150, 0.3);
            border-radius: 5px;
            background: transparent;
            color: var(--gold-light);
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .sidebar-logout button:hover {
            background: rgba(222, 192, 150, 0.15);
            border-color: var(--gold-light);
        }

        /* --- Main Content Area --- */
        main {
            flex: 1;
            min-width: 0;
            padding: 24px 28px 40px 32px;
        }

        h1 {
            font-size: 24px;
            color: var(--tx);
        }

        .hs {
            color: var(--mut);
            font-size: 14px;
            margin-top: 2px;
        }

        .card {
            background: var(--card);
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            padding: 20px;
        }

        /* --- Statistics Cards --- */
        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 38px;
            margin: 24px 0;
        }

        .stat {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 20px 22px;
            min-height: 120px;
            box-sizing: border-box;
        }

        .stat-info {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 80px;
        }

        .stat small {
            color: var(--mut);
            font-size: 14px;
            line-height: 1.2;
        }

        .stat b {
            display: block;
            font-size: 32px;
            line-height: 1.2;
            margin: 6px 0 12px;
            color: var(--tx);
        }

        .stat b.stat-curr {
            font-size: 24px;
            letter-spacing: -0.5px;
        }

        .stat em {
            font-style: normal;
            color: var(--green);
            font-size: 12px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            line-height: 1;
        }

        .stat em img,
        .stat em svg {
            width: 12px;
            height: 12px;
            display: inline-block;
            flex: none;
        }

        .stat em.trend-up    { color: var(--green); }
        .stat em.trend-down  { color: #EF4444; }
        .stat em.trend-neutral { color: var(--mut); }

        .ic {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: var(--gold);
            display: grid;
            place-items: center;
            color: #FFFFFF;
        }

        .ic svg,
        .ic img {
            width: 22px;
            height: 22px;
            fill: none;
            stroke: currentColor;
            stroke-width: 1.6;
            stroke-linecap: round;
            stroke-linejoin: round;
            object-fit: contain;
        }

        /* --- Grid Layout 2 Columns --- */
        .g2 {
            display: grid;
            grid-template-columns: minmax(0, 1.65fr) minmax(0, 1fr);
            gap: 40px;
            margin-bottom: 28px;
        }

        .hd {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 6px;
        }

        h2 {
            font-size: 16px;
            font-weight: 600;
            color: var(--tx);
        }

        select {
            border: 1px solid var(--ln);
            background: #F6F6F2;
            border-radius: 6px;
            padding: 6px 10px;
            font: inherit;
            font-size: 13px;
            color: var(--mut);
        }

        svg.ch {
            width: 100%;
            height: auto;
            display: block;
        }

        /* --- Popular Products Bar Card --- */
        .card.pc {
            display: flex;
            flex-direction: column;
        }

        .pp {
            margin-top: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding-bottom: 6px;
        }

        .pp > div {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 2px 10px;
            font-size: 13px;
            font-weight: 600;
        }

        .pp .p {
            color: var(--gold);
            text-align: right;
        }

        .pp small {
            color: var(--muted-light);
            font-weight: 400;
            font-size: 11px;
            text-align: right;
            grid-column: 2;
            grid-row: 2 / 4;
        }

        .bar {
            grid-column: 1;
            height: 5px;
            border-radius: 3px;
            background: var(--ln);
            margin-top: 4px;
            overflow: hidden;
        }

        .bar i {
            display: block;
            height: 100%;
            background: var(--gold);
            border-radius: 3px;
        }

        /* --- Tables --- */
        .tw {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            table-layout: fixed;
        }

        th {
            text-align: left;
            color: var(--muted-light);
            font-weight: 400;
            font-size: 12px;
            padding: 10px 0;
            border-bottom: 1px solid var(--ln);
        }

        td {
            padding: 11px 0;
            border-bottom: 1px solid var(--ln);
        }

        tr:last-child td {
            border: 0;
        }

        td b {
            display: block;
            color: var(--tx);
        }

        td small {
            color: var(--muted-light);
            font-size: 11px;
        }

        .b {
            display: inline-block;
            width: 120px;
            max-width: 100%;
            text-align: center;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 12px;
        }

        .y {
            background: var(--badge-proc-bg);
            color: var(--badge-proc-tx);
        }

        .r {
            background: var(--badge-warn-bg);
            color: var(--badge-warn-tx);
        }

        .g {
            background: #DCFCE7;
            color: #15803D;
        }

        .it {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .th {
            width: 44px;
            height: 44px;
            flex: none;
            border-radius: 10px;
            background: #F6F3ED;
            display: grid;
            place-items: center;
            color: var(--gold);
            overflow: hidden;
            border: 1px solid #ECE7DE;
        }

        .th img.thumb-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .th svg,
        .th img.thumb-icon {
            width: 22px;
            height: 22px;
            object-fit: contain;
        }

        /* --- Order & Stock Section Specifics --- */
        #oc {
            padding: 28px 32px 32px;
        }

        #sc {
            padding: 28px 32px 32px;
        }

        .all {
            color: var(--gold);
            font-size: 14px;
            text-decoration: none;
        }

        #ot th {
            font-size: 13px;
            font-weight: 500;
            color: var(--muted-light);
            padding: 14px 0 18px;
            border-bottom: 1.5px solid var(--ln);
            letter-spacing: 0.3px;
        }

        #ord td {
            padding: 24px 0;
            font-size: 14.5px;
            vertical-align: middle;
            border-bottom: 1px solid var(--ln);
        }

        #ord td b {
            font-weight: 600;
            font-size: 14.5px;
            color: var(--tx);
        }

        #ord small {
            display: block;
            color: var(--muted-light);
            font-size: 12.5px;
            margin-top: 6px;
            line-height: 1.3;
        }

        #ord .b {
            display: inline-block;
            width: auto;
            min-width: 105px;
            max-width: 130px;
            color: var(--badge-proc-tx);
            font-weight: 600;
            padding: 7px 16px;
            border-radius: 20px;
            text-align: center;
            font-size: 12.5px;
        }

        .rd {
            color: #EF4444;
            font-weight: 700;
            font-size: 14.5px;
            text-align: center;
        }

        #stk td {
            padding: 16px 0;
            vertical-align: middle;
            border-bottom: 1px solid var(--ln);
        }

        #stk b {
            font-weight: 600;
            font-size: 14px;
            color: var(--tx);
            display: block;
            margin-bottom: 3px;
        }

        #stk small {
            color: var(--muted-light);
            font-size: 12px;
            display: block;
        }

        #stk .b {
            display: inline-block;
            width: auto;
            min-width: 105px;
            max-width: 125px;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-align: center;
        }

        #stk .b.r {
            background: #FDE8E8;
            color: #E05252;
        }

        #stk .b.g {
            background: #DCFCE7;
            color: #15803D;
        }

        /* --- Responsive Queries --- */
        @media (max-width: 1100px) {
            .stats {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }

            .g2 {
                grid-template-columns: minmax(0, 1fr);
                gap: 24px;
            }
        }

        @media (max-width: 760px) {
            body {
                flex-direction: column;
            }

            aside {
                width: 100%;
                height: auto;
                position: static;
                background-image: none;
            }

            .lg {
                height: 64px;
            }

            nav {
                flex-direction: row;
                overflow-x: auto;
                padding: 10px;
            }

            nav a {
                font-size: 14px;
                white-space: nowrap;
            }

            main {
                padding: 20px 16px;
            }

            .stats {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    @include('components.sidebar')

    <main>
        <h1>Selamat Datang, {{ Auth::user()->username ?? Auth::user()->name ?? 'Admin' }}</h1>
        <p class="hs">Semoga hari-hari produktif dan penuh semangat!</p>

        <section class="stats" id="stats">
            <div class="card stat">
                <div class="stat-info">
                    <small>Total Produk</small>
                    <b>{{ $totalProduk }}</b>
                    <em class="trend-{{ $trendProduk }}">@if($trendProduk === 'up')<img src="{{ asset('images/trending-up.svg') }}" alt="">@elseif($trendProduk === 'down')<img src="{{ asset('images/trending-down.svg') }}" alt="">@else<span style="font-size:13px">─</span>@endif {{ $diffProduk }}</em>
                </div>
                <div class="ic"><img src="{{ asset('images/package.svg') }}" alt="Total Produk"></div>
            </div>

            <div class="card stat">
                <div class="stat-info">
                    <small>Total Pesanan</small>
                    <b>{{ $totalPemesanan }}</b>
                    <em class="trend-{{ $trendPemesanan }}">@if($trendPemesanan === 'up')<img src="{{ asset('images/trending-up.svg') }}" alt="">@elseif($trendPemesanan === 'down')<img src="{{ asset('images/trending-down.svg') }}" alt="">@else<span style="font-size:13px">─</span>@endif {{ $diffPemesanan }}</em>
                </div>
                <div class="ic"><img src="{{ asset('images/shopping-cart.svg') }}" alt="Total Pesanan"></div>
            </div>

            <div class="card stat">
                <div class="stat-info">
                    <small>Total Pendapatan</small>
                    <b class="stat-curr">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</b>
                    <em class="trend-{{ $trendPendapatan }}">@if($trendPendapatan === 'up')<img src="{{ asset('images/trending-up.svg') }}" alt="">@elseif($trendPendapatan === 'down')<img src="{{ asset('images/trending-down.svg') }}" alt="">@else<span style="font-size:13px">─</span>@endif {{ $diffPendapatan }}</em>
                </div>
                <div class="ic"><img src="{{ asset('images/dollar-sign.svg') }}" alt="Total Pendapatan"></div>
            </div>

            <div class="card stat">
                <div class="stat-info">
                    <small>Total Pengguna</small>
                    <b>{{ $totalPengguna }}</b>
                    <em class="trend-{{ $trendPengguna }}">@if($trendPengguna === 'up')<img src="{{ asset('images/trending-up.svg') }}" alt="">@elseif($trendPengguna === 'down')<img src="{{ asset('images/trending-down.svg') }}" alt="">@else<span style="font-size:13px">─</span>@endif {{ $diffPengguna }}</em>
                </div>
                <div class="ic"><img src="{{ asset('images/users.svg') }}" alt="Total Pengguna"></div>
            </div>
        </section>

        <section class="g2">
            <div class="card">
                <div class="hd">
                    <h2>Grafik Pendapatan</h2>
                    <select id="chartRangeSelect" onchange="updateChart()">
                        <option value="7">7 Hari Terakhir</option>
                        <option value="30">30 Hari Terakhir</option>
                    </select>
                </div>
                <svg class="ch" id="ch" viewBox="0 0 640 270"></svg>
            </div>
            <div class="card pc">
                <h2>Produk Paling Diminati</h2>
                <div class="pp" id="pp">
                    @forelse($produkTerlaris as $item)
                        @php
                            $nama = $item->produk->nama_produk ?? 'Produk Rabita';
                            $harga = $item->produk->harga ?? 0;
                            $terjual = $item->total_terjual ?? 1;
                            $barWidth = min(100, max(20, $terjual * 15));
                        @endphp
                        <div>
                            <span title="{{ $nama }}" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 220px;">{{ $nama }}</span>
                            <span class="p">Rp {{ number_format($harga, 0, ',', '.') }}</span>
                            <div class="bar" style="width: 100%"><i style="width: {{ $barWidth }}%"></i></div>
                            <small>{{ $terjual }} terjual</small>
                        </div>
                    @empty
                        <p style="color: var(--mut); font-size: 13px;">Belum ada data produk terjual.</p>
                    @endforelse
                </div>
            </div>
        </section>

        <section class="g2">
            <div class="card" id="oc">
                <div class="hd" style="margin-bottom: 16px;">
                    <h2>Pesanan Terbaru</h2>
                    <a href="#" class="all">Lihat Semua</a>
                </div>
                <div class="tw">
                    <table id="ot" style="min-width:520px">
                        <colgroup>
                            <col style="width:23%">
                            <col style="width:36%">
                            <col style="width:23%">
                            <col style="width:18%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>No. Pesanan</th>
                                <th>Produk</th>
                                <th>Total</th>              
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="ord">
                            @forelse($pesananTerbaru as $order)
                                @php
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
                                @endphp
                                <tr>
                                    <td>
                                        <b>#ORD-{{ str_pad($order->pemesanan_id, 4, '0', STR_PAD_LEFT) }}</b>
                                        <small>{{ \Carbon\Carbon::parse($order->tanggal_pesan)->format('d M Y, H:i') }}</small>
                                    </td>
                                    <td>
                                        <b title="{{ $namaProduk }}" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 210px; display: block;">
                                            {{ Str::limit($namaProduk, 28) }}
                                        </b>
                                        @if($extraCount > 0)
                                            <small>+{{ $extraCount }} produk lainnya</small>
                                        @else
                                            <small>{{ $order->user->username ?? 'Customer' }}</small>
                                        @endif
                                    </td>
                                    <td><b>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</b></td>
                                    <td style="text-align: left;">
                                        <span class="b {{ $badgeClass }}">{{ $statusLabel }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" style="text-align:center; color: var(--mut); padding: 20px;">Belum ada pesanan terbaru.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card" id="sc">
                <div class="hd" style="margin-bottom: 16px;">
                    <h2>Stok Hampir Habis</h2>
                </div>
                <div class="tw">
                    <table>
                        <colgroup>
                            <col style="width:52%">
                            <col style="width:16%">
                            <col style="width:32%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th style="text-align:center">Stok</th>
                                <th style="text-align:center">Status</th>
                            </tr>
                        </thead>
                        <tbody id="stk">
                            @forelse($stokMenipis as $item)
                                @php
                                    $fotoPath = $item->gambar_produk ? public_path('assets/image/produk/' . $item->gambar_produk) : null;
                                    $fotoUrl  = ($fotoPath && file_exists($fotoPath)) ? asset('assets/image/produk/' . $item->gambar_produk) : null;
                                @endphp
                                <tr>
                                    <td>
                                        <div class="it">
                                            <div class="th">
                                                @if($fotoUrl)
                                                    <img src="{{ $fotoUrl }}" alt="{{ $item->nama_produk }}" class="thumb-img">
                                                @else
                                                    <img src="{{ asset('images/package.svg') }}" alt="" class="thumb-icon" style="filter: brightness(0) saturate(100%) invert(64%) sepia(35%) saturate(541%) hue-rotate(356deg) brightness(91%) contrast(87%);">
                                                @endif
                                            </div>
                                            <div style="min-width: 0;">
                                                <b title="{{ $item->nama_produk }}" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 210px; display: block;">{{ Str::limit($item->nama_produk, 26) }}</b>
                                                <small>{{ $item->kategori->nama_kategori ?? 'Sasirangan' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="rd">{{ $item->stok }}</td>
                                    <td style="text-align:center">
                                        <span class="b r">Hampir Habis</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" style="text-align:center; color: var(--mut); padding: 28px 10px;">Semua stok produk masih aman (&ge; 16).</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>

    <script>
        const $ = id => document.getElementById(id);

        const data7 = {
            labels: {!! json_encode($chart7Labels) !!},
            values: {!! json_encode($chart7Values) !!}
        };

        const data30 = {
            labels: {!! json_encode($chart30Labels) !!},
            values: {!! json_encode($chart30Values) !!}
        };

        function renderChart(labels, values) {
            const maxVal = Math.max(...values, 0);
            let step = 100000;
            if (maxVal > 5000000) step = 2000000;
            else if (maxVal > 2000000) step = 1000000;
            else if (maxVal > 1000000) step = 500000;
            else if (maxVal > 500000) step = 200000;
            else step = 100000;

            const maxValue = step * 5;
            const x0 = 82, x1 = 625, y0 = 225, h = 190;
            let s = '';

            // Sumbu Y: 6 Garis Horizontal (0 s/d 5)
            for (let i = 0; i <= 5; i++) {
                const yy = y0 - i * (h / 5);
                const val = step * i;
                const formattedVal = val === 0 ? 'Rp.0' : 'Rp.' + val.toLocaleString('id-ID');

                s += `<line x1="${x0}" x2="${x1}" y1="${yy}" y2="${yy}" stroke="#F0EDE8"/>` +
                     `<text x="${x0-8}" y="${yy+4}" text-anchor="end" font-size="9" fill="#AAAAAA">${formattedVal}</text>`;
            }

            const totalPoints = values.length;
            const px = i => x0 + i * (x1 - x0) / Math.max(1, totalPoints - 1);
            const py = val => y0 - (val / maxValue) * h;

            // Sumbu X: Garis Vertikal & Label Tanggal
            const skipLabel = totalPoints > 15 ? 5 : 1;
            labels.forEach((label, i) => {
                s += `<line x1="${px(i)}" x2="${px(i)}" y1="${y0-h}" y2="${y0}" stroke="#F0EDE8"/>`;
                if (i % skipLabel === 0 || i === totalPoints - 1) {
                    s += `<text x="${px(i)}" y="${y0+18}" text-anchor="middle" font-size="9" fill="#AAAAAA">${label}</text>`;
                }
            });

            // Garis Grafik Polyline (#DEC096, tebal 2.5)
            const points = values.map((val, i) => `${px(i)},${py(val)}`).join(' ');
            s += `<polyline fill="none" stroke="#DEC096" stroke-width="2.5" points="${points}"/>`;

            // Titik Lingkaran Solid (#B79361)
            const rSize = totalPoints > 15 ? 3.5 : 5;
            values.forEach((val, i) => {
                s += `<circle cx="${px(i)}" cy="${py(val)}" r="${rSize}" fill="#B79361">` +
                     `<title>${labels[i]}: Rp ${val.toLocaleString('id-ID')}</title></circle>`;
            });

            const chElem = $('ch');
            if (chElem) {
                chElem.innerHTML = s;
            }
        }

        function updateChart() {
            const rangeSelect = $('chartRangeSelect');
            const range = rangeSelect ? rangeSelect.value : '7';
            if (range === '30') {
                renderChart(data30.labels, data30.values);
            } else {
                renderChart(data7.labels, data7.values);
            }
        }

        updateChart();
    </script>
</body>
</html>
