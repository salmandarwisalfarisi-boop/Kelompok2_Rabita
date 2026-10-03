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
            padding: 22px 20px 20px;
        }

        .stat small {
            color: var(--mut);
            font-size: 14px;
        }

        .stat b {
            display: block;
            font-size: 34px;
            margin: 2px 0 14px;
            color: var(--tx);
        }

        .stat em {
            font-style: normal;
            color: var(--green);
            font-size: 12px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .stat em img,
        .stat em svg {
            width: 12px;
            height: 12px;
            display: inline-block;
            flex: none;
        }

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

        .it {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .th {
            width: 36px;
            height: 36px;
            flex: none;
            border-radius: 8px;
            background: var(--icon-bg);
            display: grid;
            place-items: center;
            color: var(--gold);
        }

        .th svg {
            width: 20px;
            fill: none;
            stroke: currentColor;
            stroke-width: 1.6;
        }

        /* --- Order & Stock Section Specifics --- */
        #oc {
            padding: 22px 26px 26px;
        }

        .all {
            color: var(--gold);
            font-size: 14px;
            text-decoration: none;
        }

        #ot th {
            font-size: 12px;
            font-weight: 500;
            color: var(--muted-light);
            padding: 10px 0 9px;
        }

        #ord td {
            padding: 14px 0;
            font-size: 14px;
        }

        #ord td b {
            font-weight: 600;
            font-size: 14px;
        }

        #ord small {
            color: var(--muted-light);
            font-size: 12px;
        }

        #ord .b {
            width: 100%;
            max-width: none;
            color: var(--badge-proc-tx);
            font-weight: 600;
            padding: 4px 8px;
        }

        .rd {
            color: var(--badge-warn-tx);
            font-weight: 700;
            text-align: center;
        }

        #stk td {
            padding: 13px 0;
        }

        #stk b {
            font-weight: 500;
            font-size: 13px;
        }

        #stk small {
            color: var(--muted-light);
        }

        .b.r {
            width: 100%;
            max-width: 156px;
            font-weight: 600;
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
    <aside>
        <div class="lg">
            <a href="{{ route('dashboard') }}" style="display:flex;align-items:center;justify-content:center;">
                <img alt="Rabita" src="{{ asset('assets/image/Logo.svg') }}">
            </a>
        </div>
        <nav id="nav"></nav>
        <div class="sidebar-logout">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <main>
        <h1>Selamat Datang, {{ Auth::user()->username ?? Auth::user()->name ?? 'Admin' }}</h1>
        <p class="hs">Semoga hari-hari produktif dan penuh semangat!</p>

        <section class="stats" id="stats"></section>

        <section class="g2">
            <div class="card">
                <div class="hd">
                    <h2>Total Produk</h2>
                    <select>
                        <option>7 Hari Terakhir</option>
                        <option>30 Hari Terakhir</option>
                    </select>
                </div>
                <svg class="ch" id="ch" viewBox="0 0 640 270"></svg>
            </div>
            <div class="card pc">
                <h2>Produk Paling Diminati</h2>
                <div class="pp" id="pp"></div>
            </div>
        </section>

        <section class="g2">
            <div class="card" id="oc">
                <div class="hd">
                    <h2>Pesanan Terbaru</h2>
                    <a href="#" class="all">Lihat Semua</a>
                </div>
                <div class="tw">
                    <table id="ot" style="min-width:520px">
                        <colgroup>
                            <col style="width:24%">
                            <col style="width:29%">
                            <col style="width:27.5%">
                            <col style="width:19.5%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>No. Pesanan</th>
                                <th>Produk</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="ord"></tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <h2>Stok Hampir Habis</h2>
                <div class="tw">
                    <table>
                        <colgroup>
                            <col style="width:46%">
                            <col style="width:18%">
                            <col style="width:36%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th style="text-align:center">Stok</th>
                                <th style="text-align:center">Status</th>
                            </tr>
                        </thead>
                        <tbody id="stk"></tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>

    <script>
        const $ = id => document.getElementById(id);

        const icons = {
            dashboard:     "{{ asset('images/famicons_home-outline.svg') }}",
            produk:        "{{ asset('images/bi_box-seam.svg') }}",
            kategori:      "{{ asset('images/reicon_category.svg') }}",
            pesanan:       "{{ asset('images/Vector.svg') }}",
            pengguna:      "{{ asset('images/Vector (1).svg') }}",
            statProduk:    "{{ asset('images/package.svg') }}",
            statPemesanan: "{{ asset('images/shopping-cart.svg') }}",
            statPendapatan:"{{ asset('images/dollar-sign.svg') }}",
            statPengguna:  "{{ asset('images/users.svg') }}",
            trendingUp:    "{{ asset('images/trending-up.svg') }}"
        };

        $('nav').innerHTML = [
            [icons.dashboard, 'Dashboard'],
            [icons.produk,    'Produk'],
            [icons.kategori,  'Kategori'],
            [icons.pesanan,   'Pesanan'],
            [icons.pengguna,  'Pengguna']
        ].map((n, i) => `<a href="#" class="${i ? '' : 'on'}"><img src="${n[0]}" alt="${n[1]}"><span>${n[1]}</span></a>`).join('');

        $('stats').innerHTML = [
            ['Total Produk',        icons.statProduk],
            ['Total Pemesanan',     icons.statPemesanan],
            ['Pendapatan Hari Ini', icons.statPendapatan],
            ['Total Pengguna',      icons.statPengguna]
        ].map(s => `<div class="card stat"><div><small>${s[0]}</small><b>23</b><em><img src="${icons.trendingUp}" alt=""> +2 dari bulan lalu</em></div><div class="ic"><img src="${s[1]}" alt="${s[0]}"></div></div>`).join('');

        $('pp').innerHTML = [
            [47, 80],
            [64, 86],
            [64, 86],
            [64, 86]
        ].map(w => `<div><span>Tas Ransel Elgal</span><span class="p">Rp 460.000</span><div class="bar" style="width:${w[0]}%"><i style="width:${w[1]}%"></i></div><small>34 terjual</small></div>`).join('');

        $('ord').innerHTML = Array(5).fill(`<tr><td><b>#INV-00012</b><small>12 Okt 2024</small></td><td>Tas Ransel Elgal</td><td><b>Rp 460.000</b></td><td><span class="b y">Diproses</span></td></tr>`).join('');

        $('stk').innerHTML = Array(5).fill(`<tr><td><div class="it"><div class="th"><img src="${icons.statProduk}" alt="" style="filter: brightness(0) saturate(100%) invert(64%) sepia(35%) saturate(541%) hue-rotate(356deg) brightness(91%) contrast(87%);"></div><div><b>Jaket Denim</b><small>Pakaian</small></div></div></td><td class="rd">3</td><td style="text-align:center"><span class="b r">Hampir Habis</span></td></tr>`).join('');

        (function(){
            const v = [1.9, 3.8, 2.8, 5.4, 2.8, 4.2, 2],
                  d = [17, 18, 19, 20, 21, 22, 23],
                  x0 = 75, x1 = 625, y0 = 225, h = 190;
            let s = '';

            for (let i = 0; i <= 5; i++) {
                const yy = y0 - i * (h / 5);
                s += `<line x1="${x0}" x2="${x1}" y1="${yy}" y2="${yy}" stroke="#F0EDE8"/><text x="${x0-8}" y="${yy+4}" text-anchor="end" font-size="9" fill="#AAAAAA">Rp.${(i*2).toLocaleString('id-ID')}${i?'.000.000':''}</text>`;
            }

            const px = i => x0 + i * (x1 - x0) / 6,
                  py = a => y0 - a / 10 * h;

            v.forEach((a, i) => {
                s += `<line x1="${px(i)}" x2="${px(i)}" y1="${y0-h}" y2="${y0}" stroke="#F0EDE8"/><text x="${px(i)}" y="${y0+18}" text-anchor="middle" font-size="9" fill="#AAAAAA">${d[i]} Sep</text>`;
            });

            s += `<polyline fill="none" stroke="#DEC096" stroke-width="2.5" points="${v.map((a, i) => px(i) + ',' + py(a)).join(' ')}"/>` +
                 v.map((a, i) => `<circle cx="${px(i)}" cy="${py(a)}" r="5" fill="#B79361"/>`).join('');

            $('ch').innerHTML = s;
        })();
    </script>
</body>
</html>
