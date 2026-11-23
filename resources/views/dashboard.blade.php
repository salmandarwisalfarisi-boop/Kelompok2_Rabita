<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Rabita - Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Lato:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #F5F5F0;
            --card-bg: #FFFFFF;
            --gold: #B79361;
            --gold-light: #DEC096;
            --dark-header: #191919;
            --dark-sidebar: #191919;
            --text-dark: #1A1A1A;
            --text-muted: #888888;
            --text-muted-light: #AAAAAA;
            --border-light: #F0EDE8;
            --border-grid: rgba(170, 170, 170, 0.3);
            box-sizing: border-box;
        }

        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--bg);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
        }

        /* --- Layout Container --- */
        .layout-main {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* --- Topbar --- */
        .topbar {
            height: 83px;
            background-color: var(--dark-header);
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 0 34px;
            position: sticky;
            top: 0;
            z-index: 90;
            border-bottom: 1px solid #B79361;
        }

        .user-pill-container {
            position: relative;
        }

        .user-pill-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            height: 48px;
            padding: 0 16px 0 6px;
            background-color: #FFFFFF;
            border-radius: 9999px;
            border: none;
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
            transition: transform 0.15s ease, box-shadow 0.15s ease;
            outline: none;
        }

        .user-pill-btn:hover {
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.12);
        }

        .avatar-circle {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background-color: var(--gold);
            display: grid;
            place-items: center;
            flex-shrink: 0;
            color: #FFFFFF;
        }

        .avatar-circle svg {
            width: 18px;
            height: 18px;
        }

        .user-text {
            text-align: left;
            line-height: 1.25;
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-family: 'Inter', sans-serif;
            font-size: 12px;
            font-weight: 500;
            color: #1A1A1A;
        }

        .user-role {
            font-family: 'Inter', sans-serif;
            font-size: 11px;
            font-weight: 500;
            color: var(--gold);
        }

        .user-chevron {
            color: var(--gold);
            transition: transform 0.2s ease;
            margin-left: 2px;
        }

        /* Dropdown Menu */
        .user-dropdown {
            position: absolute;
            right: 0;
            top: calc(100% + 8px);
            width: 190px;
            background: #FFFFFF;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
            border: 1px solid #ECECEC;
            padding: 8px 0;
            z-index: 100;
            display: none;
        }

        .user-dropdown.show {
            display: block;
        }

        .dropdown-user-info {
            padding: 10px 16px;
            border-bottom: 1px solid #F0F0F0;
        }

        .dropdown-user-info p {
            font-family: 'Inter', sans-serif;
            font-size: 11px;
            color: #888888;
        }

        .dropdown-user-info b {
            font-family: 'Inter', sans-serif;
            font-size: 12px;
            color: #1A1A1A;
            display: block;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            padding: 10px 16px;
            border: none;
            background: transparent;
            font-size: 13px;
            font-family: 'Lato', sans-serif;
            color: #EF4444;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.15s ease;
        }

        .dropdown-item:hover {
            background-color: #FEF2F2;
        }

        /* --- Main Content Area --- */
        main {
            flex: 1;
            padding: 28px 36px 40px;
        }

        /* Welcome Section */
        .welcome-title {
            font-family: 'Inter', sans-serif;
            font-size: 22px;
            font-weight: 700;
            color: var(--text-dark);
            line-height: 1.2;
        }

        .welcome-subtitle {
            font-family: 'Inter', sans-serif;
            font-size: 13px;
            font-weight: 400;
            color: var(--text-muted);
            margin-top: 4px;
        }

        /* Stat Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            margin-top: 20px;
        }

        .stat-card {
            background: var(--card-bg);
            border-radius: 12px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
            padding: 18px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 86px;
        }

        .stat-meta {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .stat-label {
            font-family: 'Inter', sans-serif;
            font-size: 16px;
            font-weight: 500;
            color: var(--text-muted);
            line-height: 1.2;
        }

        .stat-value {
            font-family: 'Inter', sans-serif;
            font-size: 32px;
            font-weight: 700;
            color: var(--text-dark);
            line-height: 1.15;
            margin-top: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .stat-value.currency {
            font-family: 'Inter', sans-serif;
            font-size: clamp(0.9rem, 2vw, 1.1rem);
            font-weight: 700;
            color: var(--text-dark);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        /* ---- Fix for overflow & spacing on the stat‑card ---- */
        .stat-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 24px;   /* keep existing padding */
        }
        .stat-meta {
            flex: 1;
            min-width: 0;          /* allow shrinking */
        }
        .stat-icon {
            margin-left: .5rem;   /* gap between number and icon */
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 22px;
            background-color: var(--gold);
            display: grid;
            place-items: center;
            flex-shrink: 0;
            color: #FFFFFF;
        }

        .stat-icon img,
        .stat-icon svg {
            width: 22px;
            height: 22px;
            object-fit: contain;
            filter: brightness(0) invert(1);
        }

        /* Chart Section */
        .chart-card {
            background: var(--card-bg);
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            padding: 22px 28px 20px;
            margin-top: 24px;
        }

        .chart-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .chart-title {
            display: flex;
            align-items: center;
            gap: 8px;
            font-family: 'Inter', sans-serif;
            font-size: 16px;
            font-weight: 700;
            color: var(--text-dark);
        }

        .chart-title svg,
        .chart-title img {
            width: 18px;
            height: 18px;
            color: var(--gold);
            display: block;
            flex-shrink: 0;
        }

        .select-wrapper {
            position: relative;
            display: inline-block;
        }

        .chart-range-select {
            appearance: none;
            -webkit-appearance: none;
            height: 33px;
            padding: 0 34px 0 16px;
            border-radius: 20px;
            border: 1px solid #000000;
            background: #FFFFFF;
            font-family: 'Inter', sans-serif;
            font-size: 15px;
            font-weight: 400;
            color: #000000;
            cursor: pointer;
            outline: none;
            transition: border-color 0.15s ease;
        }

        .select-wrapper svg {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            color: #000000;
        }

        /* Dynamic Bar Chart */
        .chart-container {
            overflow-x: auto;
            margin-top: 8px;
            padding-top: 10px;
            padding-bottom: 8px;
        }

        .chart-inner {
            min-width: 580px;
            padding-top: 20px;
            padding-bottom: 8px;
        }

        .chart-plot-wrap {
            display: flex;
            height: 200px;
        }

        .y-labels {
            position: relative;
            width: 82px;
            flex-shrink: 0;
            font-family: 'Inter', sans-serif;
            font-size: 12px;
            font-weight: 400;
            color: var(--text-muted-light);
            text-align: right;
            padding-right: 12px;
            line-height: 1;
        }

        .y-labels span {
            position: absolute;
            right: 12px;
            transform: translateY(-50%);
            white-space: nowrap;
            line-height: 1;
        }

        .plot-area {
            position: relative;
            flex: 1;
            height: 200px;
            border-left: 1px solid #D5D5D5;
        }

        .grid-line {
            position: absolute;
            left: 0;
            right: 0;
            border-top: 1px solid var(--border-grid);
        }

        .bars-track {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: flex-end;
            justify-content: space-around;
            padding: 0 14px;
        }

        .chart-bar {
            width: 56px;
            max-width: 12%;
            background-color: var(--gold);
            border-radius: 2px 2px 0 0;
            transition: height 0.3s cubic-bezier(0.4, 0, 0.2, 1), filter 0.15s ease;
            cursor: pointer;
        }

        .chart-bar:hover {
            filter: brightness(1.08);
        }

        .x-labels {
            display: flex;
            justify-content: space-around;
            margin-left: 82px;
            padding: 14px 14px 0;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            font-weight: 400;
            color: var(--text-muted-light);
        }

        .x-labels span {
            width: 56px;
            max-width: 12%;
            text-align: center;
            white-space: nowrap;
        }

        /* Bottom Section: 2 Columns */
        .bottom-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.62fr) minmax(0, 1fr);
            gap: 24px;
            margin-top: 24px;
        }

        /* Pesanan Terbaru Card */
        .orders-card {
            background: var(--card-bg);
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            padding: 24px 28px;
            min-width: 0;
        }

        .orders-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
        }

        .orders-title {
            display: flex;
            align-items: center;
            gap: 8px;
            font-family: 'Inter', sans-serif;
            font-size: 16px;
            font-weight: 700;
            color: var(--text-dark);
        }

        .orders-title svg {
            width: 18px;
            height: 18px;
            color: var(--gold);
        }

        .view-all-link {
            font-family: 'Inter', sans-serif;
            font-size: 10px;
            font-weight: 500;
            color: var(--gold);
            text-decoration: underline;
            transition: color 0.15s ease;
        }

        .view-all-link:hover {
            color: #967447;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .orders-table {
            width: 100%;
            min-width: 540px;
            border-collapse: collapse;
            font-size: 13px;
        }

        .orders-table th {
            text-align: left;
            font-family: 'Inter', sans-serif;
            font-size: 11px;
            font-weight: 600;
            color: var(--text-muted-light);
            padding: 8px 6px;
            border-bottom: 1px solid var(--border-light);
            letter-spacing: 0.2px;
        }

        .orders-table th.center {
            text-align: center;
        }

        .orders-table td {
            padding: 13px 6px;
            border-bottom: 1px solid var(--border-light);
            vertical-align: middle;
            font-family: 'Lato', sans-serif;
            font-size: 13px;
            font-weight: 400;
            color: var(--text-dark);
        }

        .orders-table tr:last-child td {
            border-bottom: none;
        }

        .order-name {
            font-family: 'Lato', sans-serif;
            font-weight: 400;
            font-size: 13px;
            color: var(--text-dark);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 130px;
        }

        .order-email {
            font-family: 'Lato', sans-serif;
            font-size: 13px;
            font-weight: 400;
            color: var(--text-dark);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 140px;
        }

        .order-product {
            font-family: 'Lato', sans-serif;
            font-size: 13px;
            font-weight: 400;
            color: var(--text-dark);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 140px;
        }

        .order-total {
            font-family: 'Lato', sans-serif;
            font-size: 13px;
            font-weight: 400;
            color: var(--text-dark);
            text-align: center;
            white-space: nowrap;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 9999px;
            font-family: 'Lato', sans-serif;
            font-size: 11px;
            font-weight: 600;
            text-align: center;
            white-space: nowrap;
        }

        .status-badge.pending {
            background-color: #FEF3C7;
            color: #D97706;
        }

        .status-badge.success {
            background-color: #DCFCE7;
            color: #16A34A;
        }

        .status-badge.cancelled {
            background-color: #FEF2F2;
            color: #EF4444;
        }

        .status-badge.processing {
            background-color: #E0E7FF;
            color: #4338CA;
        }

        /* Produk Terlaris Card */
        .products-card {
            background: var(--card-bg);
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            padding: 24px 26px;
            min-width: 0;
        }

        .products-header {
            display: flex;
            align-items: center;
            gap: 8px;
            font-family: 'Inter', sans-serif;
            font-size: 16px;
            font-weight: 700;
            color: var(--text-dark);
            padding-bottom: 12px;
            border-bottom: 1px solid var(--border-light);
            margin-bottom: 6px;
        }

        .products-header svg {
            width: 18px;
            height: 18px;
            fill: var(--gold);
            color: var(--gold);
        }

        .products-list {
            list-style: none;
        }

        .product-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 10px 0;
            border-bottom: 1px solid var(--border-light);
        }

        .product-item:last-child {
            border-bottom: none;
        }

        .product-left {
            display: flex;
            align-items: center;
            gap: 14px;
            min-width: 0;
            flex: 1;
        }

        .product-thumb {
            width: 48px;
            height: 48px;
            border-radius: 6px;
            background-color: #F5F5F5;
            display: grid;
            place-items: center;
            overflow: hidden;
            flex-shrink: 0;
            border: 1px solid #ECECEC;
        }

        .product-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .product-thumb svg {
            width: 22px;
            height: 22px;
            color: #888888;
        }

        .product-title {
            font-family: 'Lato', sans-serif;
            font-size: 15px;
            font-weight: 400;
            color: var(--text-dark);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .product-sold {
            font-family: 'Inter', sans-serif;
            font-size: 15px;
            font-weight: 400;
            color: #000000;
            white-space: nowrap;
        }

        /* --- Responsive Breakpoints --- */
        @media (max-width: 1200px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 18px;
            }

            .bottom-grid {
                grid-template-columns: minmax(0, 1fr);
                gap: 20px;
            }
        }

        @media (max-width: 760px) {
            body {
                flex-direction: column;
            }

            .topbar {
                height: 64px;
                padding: 0 16px;
            }

            main {
                padding: 20px 16px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: 14px;
            }
        }
    </style>
</head>
<body>

    <!-- SIDEBAR (Komponen Valid Sesuai Figma) -->
    @include('components.sidebar')

    <!-- MAIN WRAPPER (Topbar & Dashboard Content) -->
    <div class="layout-main">

        <!-- TOPBAR PERSIS FIGMA -->
        <header class="topbar">
            <div class="user-pill-container">
                <button type="button" class="user-pill-btn" id="userPillBtn" aria-label="Menu Pengguna">
                    <span class="avatar-circle">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </span>
                    <span class="user-text">
                        <span class="user-name">{{ Auth::user()->username ?? Auth::user()->name ?? 'Salman' }}</span>
                        <span class="user-role">{{ ucfirst(Auth::user()->level ?? 'Administrator') }}</span>
                    </span>
                    <svg class="user-chevron" id="userPillChevron" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>

                <div class="user-dropdown" id="userDropdown">
                    <div class="dropdown-user-info">
                        <p>Login sebagai:</p>
                        <b>{{ Auth::user()->username ?? Auth::user()->name ?? 'Salman' }}</b>
                        <span style="font-size: 11px; color: var(--gold);">{{ Auth::user()->email ?? 'admin@rabita.com' }}</span>
                    </div>

                    <a href="{{ route('admin.pengaturan') }}" style="display: flex; align-items: center; gap: 10px; width: 100%; padding: 10px 16px; border: none; background: transparent; font-size: 13px; font-family: 'Inter', sans-serif; color: #1A1A1A; cursor: pointer; text-decoration: none; transition: background-color 0.15s ease;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="3"></circle>
                            <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06-.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                        </svg>
                        Pengaturan
                    </a>

                    <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                <polyline points="16 17 21 12 16 7"></polyline>
                                <line x1="21" y1="12" x2="9" y2="12"></line>
                            </svg>
                            <span>Keluar</span>
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <!-- DASHBOARD CONTENT -->
        <main>
            <!-- Title & Subtitle -->
            <div class="welcome-section">
                <h1 class="welcome-title">Selamat Datang, {{ Auth::user()->username ?? Auth::user()->name ?? 'Salman' }}</h1>
                <p class="welcome-subtitle">Semoga hari-hari produktif dan penuh semangat!</p>
            </div>

            <!-- 4 Stat Cards -->
            <section class="stats-grid">
                <!-- 1. Total Produk -->
                <div class="stat-card">
                    <div class="stat-meta">
                        <div class="stat-label">Total Produk</div>
                        <div class="stat-value" id="stat-produk">{{ $totalProduk ?? 0 }}</div>
                    </div>
                    <div class="stat-icon">
                        <img src="{{ asset('images/package.svg') }}" alt="Total Produk">
                    </div>
                </div>

                <!-- 2. Total Pemesanan -->
                <div class="stat-card">
                    <div class="stat-meta">
                        <div class="stat-label">Total Pemesanan</div>
                        <div class="stat-value" id="stat-pesanan">{{ $totalPemesanan ?? 0 }}</div>
                    </div>
                    <div class="stat-icon">
                        <img src="{{ asset('images/shopping-cart.svg') }}" alt="Total Pemesanan">
                    </div>
                </div>

                <!-- 3. Pendapatan Hari Ini -->
                <div class="stat-card">
                    <div class="stat-meta">
                        <div class="stat-label">Pendapatan Hari Ini</div>
                        <div class="stat-value" id="stat-pendapatan">Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</div>
                    </div>
                    <div class="stat-icon">
                        <img src="{{ asset('images/dollar-sign.svg') }}" alt="Pendapatan">
                    </div>
                </div>

                <!-- 4. Total Pengguna -->
                <div class="stat-card">
                    <div class="stat-meta">
                        <div class="stat-label">Total Pengguna</div>
                        <div class="stat-value" id="stat-pengguna">{{ $totalPengguna ?? 0 }}</div>
                    </div>
                    <div class="stat-icon">
                        <img src="{{ asset('images/users.svg') }}" alt="Total Pengguna">
                    </div>
                </div>
            </section>

            <!-- Grafik Pendapatan -->
            <section class="chart-card">
                <div class="chart-header">
                    <div class="chart-title">
                        <img src="{{ asset('assets/image/bi_bar-chart-fill (1).svg') }}" alt="Grafik Pendapatan" width="18" height="18">
                        <span>Grafik Pendapatan</span>
                    </div>

                    <div class="select-wrapper">
                        <select id="chartRangeSelect" onchange="updateChart()" class="chart-range-select">
                            <option value="7">7 Hari Terakhir</option>
                            <option value="30">30 Hari Terakhir</option>
                        </select>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </div>
                </div>

                <div class="chart-container">
                    <div class="chart-inner">
                        <div class="chart-plot-wrap">
                            <!-- Y Labels -->
                            <div class="y-labels" id="chartYLabels">
                                <!-- Populated dynamically by JS -->
                            </div>
                            <!-- Plot Area with horizontal gridlines and bars -->
                            <div class="plot-area">
                                <div class="grid-line" style="top: 0;"></div>
                                <div class="grid-line" style="top: 25%;"></div>
                                <div class="grid-line" style="top: 50%;"></div>
                                <div class="grid-line" style="top: 75%;"></div>
                                <div class="grid-line" style="top: 100%; border-top-color: #D5D5D5;"></div>
                                <div class="bars-track" id="chartBarsTrack">
                                    <!-- Populated dynamically by JS -->
                                </div>
                            </div>
                        </div>

                        <!-- X Labels -->
                        <div class="x-labels" id="chartXLabels">
                            <!-- Populated dynamically by JS -->
                        </div>
                    </div>
                </div>
            </section>

            <!-- Bottom Section: Pesanan Terbaru & Produk Terlaris -->
            <section class="bottom-grid">

                <!-- Pesanan Terbaru -->
                <div class="orders-card">
                    <div class="orders-header">
                        <div class="orders-title">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            <span>Pesanan Terbaru</span>
                        </div>
                        <a href="{{ route('pesanan.index') }}" class="view-all-link">Lihat Semua</a>
                    </div>

                    <div class="table-responsive">
                        <table class="orders-table">
                            <thead>
                                <tr>
                                    <th style="width: 23%;">Nama Pemesan</th>
                                    <th style="width: 25%;">Email Pemesan</th>
                                    <th style="width: 24%;">Produk</th>
                                    <th class="center" style="width: 15%;">Total</th>
                                    <th class="center" style="width: 13%;">Status</th>
                                </tr>
                            </thead>
                            <tbody id="ord">
                                @forelse($pesananTerbaru as $order)
                                    @php
                                        $firstItem = $order->details->first();
                                        $namaProduk = $firstItem && $firstItem->produk ? $firstItem->produk->nama_produk : 'Pesanan Rabita';
                                        $extraCount = $order->details->count() - 1;
                                        
                                        $status = strtolower($order->status_pesanan);
                                        $statusLabel = ucfirst($order->status_pesanan);
                                        $badgeClass = 'pending';
                                        if ($status === 'selesai') {
                                            $badgeClass = 'success';
                                        } elseif ($status === 'batal') {
                                            $badgeClass = 'cancelled';
                                        } elseif ($status === 'diproses') {
                                            $badgeClass = 'processing';
                                        }
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="order-name" title="{{ $order->user->username ?? $order->user->name ?? 'Customer' }}">
                                                {{ $order->user->username ?? $order->user->name ?? 'Customer' }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="order-email" title="{{ $order->user->email ?? '-' }}">
                                                {{ $order->user->email ?? '-' }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="order-product" title="{{ $namaProduk }}">
                                                {{ Str::limit($namaProduk, 16) }}
                                                @if($extraCount > 0)
                                                    <span style="color: #888888; font-size: 11px;">(+{{ $extraCount }})</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="order-total">
                                            Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                                        </td>
                                        <td style="text-align: center;">
                                            <span class="status-badge {{ $badgeClass }}">{{ $statusLabel }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" style="text-align: center; padding: 40px 16px; color: #8A8A8A;">
                                            <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 8px;">
                                                <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#CCCCCC" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                    <polyline points="12 6 12 12 16 14"></polyline>
                                                </svg>
                                                <span style="font-size: 13.5px; font-weight: 500; color: #555555;">Belum ada pesanan terbaru</span>
                                                <span style="font-size: 11.5px; color: #9A9A9A;">Pesanan yang masuk akan otomatis ditampilkan di sini.</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Produk Terlaris -->
                <div class="products-card">
                    <div class="products-header">
                        <svg viewBox="0 0 24 24" stroke-width="1">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                        </svg>
                        <span>Produk Terlaris</span>
                    </div>

                    <ul class="products-list" id="pp">
                        @forelse($produkTerlaris as $item)
                            @php
                                $nama = $item->produk->nama_produk ?? 'Produk Rabita';
                                $terjual = $item->total_terjual ?? 0;
                                $gambar = $item->produk->gambar_produk ?? null;
                                $fotoPath = $gambar ? public_path('assets/image/produk/' . $gambar) : null;
                                $fotoUrl = ($fotoPath && file_exists($fotoPath)) ? asset('assets/image/produk/' . $gambar) : null;
                            @endphp
                            <li class="product-item">
                                <div class="product-left">
                                    <div class="product-thumb">
                                        @if($fotoUrl)
                                            <img src="{{ $fotoUrl }}" alt="{{ $nama }}">
                                        @else
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                                <path d="M16 10a4 4 0 0 1-8 0"></path>
                                            </svg>
                                        @endif
                                    </div>
                                    <span class="product-title" title="{{ $nama }}">{{ $nama }}</span>
                                </div>
                                <span class="product-sold">{{ $terjual }} terjual</span>
                            </li>
                        @empty
                            <li style="text-align: center; padding: 42px 16px; color: #8A8A8A; list-style: none;">
                                <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 8px;">
                                    <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#CCCCCC" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                        <line x1="3" y1="6" x2="21" y2="6"></line>
                                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                                    </svg>
                                    <span style="font-size: 13.5px; font-weight: 500; color: #555555;">Belum ada data produk terjual</span>
                                    <span style="font-size: 11.5px; color: #9A9A9A;">Produk yang laris dipesan akan otomatis tampil di sini.</span>
                                </div>
                            </li>
                        @endforelse
                    </ul>
                </div>

            </section>
        </main>
    </div>

    <!-- Scripts -->
    <script>
        const $ = id => document.getElementById(id);

        // User Pill Dropdown
        const userBtn = $('userPillBtn');
        const userDropdown = $('userDropdown');
        const userChevron = $('userPillChevron');

        if (userBtn && userDropdown) {
            userBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                const isShown = userDropdown.classList.contains('show');
                userDropdown.classList.toggle('show', !isShown);
                if (userChevron) {
                    userChevron.style.transform = isShown ? 'rotate(0deg)' : 'rotate(180deg)';
                }
            });

            document.addEventListener('click', function() {
                userDropdown.classList.remove('show');
                if (userChevron) userChevron.style.transform = 'rotate(0deg)';
            });
        }

        // Data Grafik Asli dari Controller
        let currentChartData = {
            '7': {
                labels: {!! json_encode($chart7Labels ?? []) !!},
                values: {!! json_encode($chart7Values ?? []) !!}
            },
            '30': {
                labels: {!! json_encode($chart30Labels ?? []) !!},
                values: {!! json_encode($chart30Values ?? []) !!}
            }
        };

        // Skala Y Otomatis
        function getSmartScale(maxVal) {
            if (maxVal <= 0) return { step: 50000, maxValue: 200000 };
            
            const targetStep = maxVal / 4;
            const magnitude = Math.pow(10, Math.floor(Math.log10(targetStep)));
            const residual = targetStep / magnitude;
            
            let niceFactor;
            if (residual <= 1.2) niceFactor = 1;
            else if (residual <= 2.5) niceFactor = 2;
            else if (residual <= 5) niceFactor = 5;
            else niceFactor = 10;
            
            const step = Math.max(10000, Math.round(niceFactor * magnitude));
            const maxValue = step * 4;
            return { step, maxValue };
        }

        function renderChart(labels, values) {
            const maxVal = Math.max(...values, 0);
            const { step, maxValue } = getSmartScale(maxVal);

            // 1. Render Sumbu Y
            const yContainer = $('chartYLabels');
            if (yContainer) {
                yContainer.innerHTML = `
                    <span style="top: 0;">Rp ${(maxValue).toLocaleString('id-ID')}</span>
                    <span style="top: 25%;">Rp ${(step * 3).toLocaleString('id-ID')}</span>
                    <span style="top: 50%;">Rp ${(step * 2).toLocaleString('id-ID')}</span>
                    <span style="top: 75%;">Rp ${(step * 1).toLocaleString('id-ID')}</span>
                    <span style="top: 100%;">Rp 0</span>
                `;
            }

            // 2. Render Batang Grafik & Label Sumbu X
            const barsContainer = $('chartBarsTrack');
            const xContainer = $('chartXLabels');
            if (barsContainer && xContainer) {
                let barsHtml = '';
                let xHtml = '';
                const count = values.length;
                const barWidth = count > 15 ? '16px' : '56px';
                const fontSize = count > 15 ? '11px' : '14px';

                values.forEach((val, i) => {
                    const heightPct = maxValue > 0 ? Math.min(100, Math.max(0, (val / maxValue) * 100)) : 0;
                    const label = labels[i] || '';
                    const formatted = 'Rp ' + val.toLocaleString('id-ID');

                    barsHtml += `
                        <div class="chart-bar" 
                             style="width: ${barWidth}; height: ${heightPct}%; min-height: ${val > 0 ? '4px' : '0'};" 
                             title="${label}: ${formatted}">
                        </div>
                    `;
                    xHtml += `<span style="width: ${barWidth}; font-size: ${fontSize};">${label}</span>`;
                });

                barsContainer.innerHTML = barsHtml;
                xContainer.innerHTML = xHtml;
            }
        }

        function updateChart() {
            const rangeSelect = $('chartRangeSelect');
            const range = rangeSelect ? rangeSelect.value : '7';
            const activeData = currentChartData[range] || currentChartData['7'];
            renderChart(activeData.labels, activeData.values);
        }

        updateChart();

        // Realtime Polling
        async function fetchRealtimeStats() {
            try {
                const response = await fetch('{{ route("dashboard.realtime") }}', {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                if (!response.ok) return;

                const res = await response.json();
                if (res.status === 'success') {
                    const s = res.stats;
                    if ($('stat-produk')) $('stat-produk').textContent = s.totalProduk;
                    if ($('stat-pesanan')) $('stat-pesanan').textContent = s.totalPemesanan;
                    if ($('stat-pendapatan')) $('stat-pendapatan').textContent = s.totalPendapatan;
                    if ($('stat-pengguna')) $('stat-pengguna').textContent = s.totalPengguna;

                    if (res.charts) {
                        currentChartData['7'] = res.charts.chart7;
                        currentChartData['30'] = res.charts.chart30;
                        updateChart();
                    }

                    // Update Pesanan Terbaru
                    if ($('ord')) {
                        if (!res.pesananTerbaru || res.pesananTerbaru.length === 0) {
                            $('ord').innerHTML = `
                                <tr>
                                    <td colspan="5" style="text-align: center; padding: 40px 16px; color: #8A8A8A;">
                                        <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 8px;">
                                            <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#CCCCCC" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <polyline points="12 6 12 12 16 14"></polyline>
                                            </svg>
                                            <span style="font-size: 13.5px; font-weight: 500; color: #555555;">Belum ada pesanan terbaru</span>
                                            <span style="font-size: 11.5px; color: #9A9A9A;">Pesanan yang masuk akan otomatis ditampilkan di sini.</span>
                                        </div>
                                    </td>
                                </tr>
                            `;
                        } else {
                            $('ord').innerHTML = res.pesananTerbaru.map(o => {
                                let badgeClass = 'pending';
                                const st = (o.status_label || '').toLowerCase();
                                if (st === 'selesai') badgeClass = 'success';
                                else if (st === 'batal') badgeClass = 'cancelled';
                                else if (st === 'diproses') badgeClass = 'processing';

                                return `
                                    <tr>
                                        <td><div class="order-name" title="${o.customer}">${o.customer}</div></td>
                                        <td><div class="order-email" title="${o.customer_email || '-'}">${o.customer_email || '-'}</div></td>
                                        <td>
                                            <div class="order-product" title="${o.nama_produk}">
                                                ${o.nama_produk_short}
                                                ${o.extra_count > 0 ? `<span style="color: #888888; font-size: 11px;">(+${o.extra_count})</span>` : ''}
                                            </div>
                                        </td>
                                        <td class="order-total">${o.total_harga}</td>
                                        <td style="text-align: center;">
                                            <span class="status-badge ${badgeClass}">${o.status_label}</span>
                                        </td>
                                    </tr>
                                `;
                            }).join('');
                        }
                    }

                    // Update Produk Terlaris
                    if ($('pp')) {
                        if (!res.produkTerlaris || res.produkTerlaris.length === 0) {
                            $('pp').innerHTML = `
                                <li style="text-align: center; padding: 42px 16px; color: #8A8A8A; list-style: none;">
                                    <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 8px;">
                                        <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#CCCCCC" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                            <line x1="3" y1="6" x2="21" y2="6"></line>
                                            <path d="M16 10a4 4 0 0 1-8 0"></path>
                                        </svg>
                                        <span style="font-size: 13.5px; font-weight: 500; color: #555555;">Belum ada data produk terjual</span>
                                        <span style="font-size: 11.5px; color: #9A9A9A;">Produk yang laris dipesan akan otomatis tampil di sini.</span>
                                    </div>
                                </li>
                            `;
                        } else {
                            $('pp').innerHTML = res.produkTerlaris.map(p => `
                                <li class="product-item">
                                    <div class="product-left">
                                        <div class="product-thumb">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="#B79361" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                                <path d="M16 10a4 4 0 0 1-8 0"></path>
                                            </svg>
                                        </div>
                                        <span class="product-title" title="${p.nama}">${p.nama}</span>
                                    </div>
                                    <span class="product-sold">${p.terjual} terjual</span>
                                </li>
                            `).join('');
                        }
                    }
                }
            } catch (e) {
                // Background poll silent
            }
        }

        setInterval(fetchRealtimeStats, 8000);

        // Anti BFCache / Prevent Back History
        window.addEventListener('pageshow', function (event) {
            if (event.persisted || (window.performance && (window.performance.navigation.type === 2 || (window.performance.getEntriesByType && window.performance.getEntriesByType("navigation")[0]?.type === "back_forward")))) {
                window.location.reload();
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.stat-value').forEach(function (el) {
                // Trim whitespace and remove any HTML tags (should be plain text)
                var txt = el.textContent.trim();
                // Count characters excluding commas and periods for length check
                var length = txt.replace(/[,.]/g, '').length;
                if (length > 5) {
                    el.classList.add('currency');
                }
            });
        });
    </script>
</body>
</html>
