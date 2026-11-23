<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar Produk – Rabita</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #F5F5F0;
            --card-bg: #FFFFFF;
            --gold: #B79361;
            --gold-hover: #9c7847;
            --gold-light: #DEC096;
            --dark-header: #191919;
            --dark-sidebar: #191919;
            --text-dark: #1A1A1A;
            --text-muted: #888888;
            --border-light: #E8E2D9;
            --border-ln: #F0EDE8;
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
            outline: none;
            transition: transform 0.15s ease, box-shadow 0.15s ease;
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
            font-family: 'Inter', sans-serif;
            color: #EF4444;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.15s ease;
        }

        .dropdown-item:hover {
            background-color: #FEF2F2;
        }

        /* --- Main Content --- */
        main {
            flex: 1;
            padding: 28px 36px 40px;
        }

        .page-header {
            margin-bottom: 22px;
        }

        .page-title {
            font-family: 'Inter', sans-serif;
            font-size: 22px;
            font-weight: 700;
            color: var(--text-dark);
            line-height: 1.2;
        }

        .page-subtitle {
            font-family: 'Inter', sans-serif;
            font-size: 13px;
            font-weight: 400;
            color: var(--text-muted);
            margin-top: 4px;
        }

        /* --- Filter Toolbar --- */
        .toolbar {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .search-wrap {
            position: relative;
            flex: 0 0 280px;
            max-width: 100%;
        }

        .search-wrap svg {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            width: 16px;
            height: 16px;
            color: #9A9A9A;
        }

        .search-input {
            width: 100%;
            height: 40px;
            padding: 0 14px 0 38px;
            border: 1.2px solid var(--border-light);
            border-radius: 8px;
            font-family: inherit;
            font-size: 13px;
            background-color: #FFFFFF;
            color: var(--text-dark);
            outline: none;
            transition: border-color 0.15s ease;
        }

        .search-input::placeholder {
            color: #BBBBBB;
        }

        .search-input:focus {
            border-color: var(--gold);
        }

        .select-filter-wrap {
            position: relative;
            display: inline-block;
        }

        .select-filter {
            appearance: none;
            -webkit-appearance: none;
            height: 40px;
            padding: 0 36px 0 16px;
            border: 1.2px solid var(--border-light);
            border-radius: 8px;
            font-family: inherit;
            font-size: 13px;
            background-color: #FFFFFF;
            color: #555555;
            cursor: pointer;
            outline: none;
            transition: border-color 0.15s ease;
        }

        .select-filter:focus {
            border-color: var(--gold);
        }

        .select-filter-wrap svg {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            color: #666666;
        }

        .spacer {
            flex: 1;
        }

        .btn-add {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            height: 40px;
            padding: 0 20px;
            background-color: var(--gold);
            color: #FFFFFF;
            font-family: inherit;
            font-size: 13px;
            font-weight: 600;
            border-radius: 8px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: background-color 0.15s ease;
            white-space: nowrap;
        }

        .btn-add:hover {
            background-color: var(--gold-hover);
        }

        /* --- Alert Notification --- */
        .alert-success {
            padding: 12px 18px;
            background-color: #DCFCE7;
            color: #16A34A;
            border: 1px solid #BBF7D0;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 20px;
        }

        /* --- Table Container --- */
        .table-card {
            background: #FFFFFF;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            border: none;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .produk-table {
            width: 100%;
            min-width: 760px;
            border-collapse: collapse;
            font-size: 13px;
        }

        /* Thead Cokelat/Emas Sesuai Figma */
        .produk-table thead tr {
            background-color: var(--gold);
        }

        .produk-table th {
            padding: 14px 16px;
            text-align: left;
            font-size: 11px;
            font-weight: 600;
            color: #FFFFFF;
            white-space: nowrap;
        }

        .produk-table th.center {
            text-align: center;
        }

        .produk-table td {
            padding: 14px 16px;
            border-bottom: 1px solid var(--border-ln);
            vertical-align: middle;
            font-size: 13px;
            font-weight: 400;
            color: var(--text-dark);
        }

        .produk-table tr:last-child td {
            border-bottom: none;
        }

        .produk-table tr:hover td {
            background-color: #FAFAF8;
        }

        /* Produk Info Cell */
        .cell-product {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .thumb-box {
            width: 48px;
            height: 48px;
            border-radius: 6px;
            overflow: hidden;
            background-color: #F5F5F0;
            display: grid;
            place-items: center;
            flex-shrink: 0;
            border: 1px solid #ECECEC;
        }

        .thumb-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .thumb-box svg {
            width: 22px;
            height: 22px;
            color: #888888;
        }

        .product-name {
            font-weight: 400;
            color: var(--text-dark);
            font-size: 13px;
            line-height: 1.3;
        }

        .badge-status {
            display: inline-block;
            padding: 3px 14px;
            border-radius: 9999px;
            font-size: 11px;
            font-weight: 600;
            text-align: center;
            white-space: nowrap;
        }

        .badge-status.aktif {
            background-color: #DCFCE7;
            color: #16A34A;
        }

        .badge-status.sold_out {
            background-color: #FEE2E2;
            color: #EF4444;
        }

        .badge-status.arsip {
            background-color: #F3F4F6;
            color: #6B7280;
        }

        /* Action Buttons */
        .action-group {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            transition: opacity 0.15s ease, transform 0.1s ease;
            text-decoration: none;
        }

        .btn-action:hover {
            opacity: 0.85;
            transform: scale(1.04);
        }

        .btn-action.view {
            background-color: #FFEFD9;
            color: #EB9825;
        }

        .btn-action.edit {
            background-color: #F0F9FF;
            color: #2563EB;
        }

        .btn-action.delete {
            background-color: #FEF2F2;
            color: #EF4444;
        }

        /* --- Footer Pagination Sesuai Figma --- */
        .table-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 20px;
            background-color: #FFFFFF;
            border-top: 1px solid var(--border-light);
            font-size: 12px;
            color: var(--text-muted);
            flex-wrap: wrap;
            gap: 12px;
        }

        .pagination-container {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .page-link-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 32px;
            height: 32px;
            padding: 0 8px;
            border-radius: 6px;
            border: 1px solid #E8E2D9;
            background-color: #FFFFFF;
            color: #555555;
            font-size: 12px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.15s ease;
        }

        .page-link-btn:hover {
            border-color: var(--gold);
            color: var(--gold);
        }

        .page-link-btn.active {
            background-color: var(--gold);
            border-color: var(--gold);
            color: #FFFFFF;
            font-weight: 600;
        }

        .page-link-btn.disabled {
            opacity: 0.4;
            pointer-events: none;
            cursor: not-allowed;
        }

        /* --- Responsive Queries --- */
        @media (max-width: 768px) {
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

            .toolbar {
                flex-direction: column;
                align-items: stretch;
            }

            .search-wrap,
            .select-filter-wrap,
            .select-filter,
            .btn-add {
                width: 100%;
            }
        }
    </style>
</head>
<body>

    <!-- SIDEBAR (Komponen Valid Sesuai Figma) -->
    @include('components.sidebar')

    <!-- MAIN WRAPPER -->
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
                        <span class="user-name">{{ Auth::user()->username ?? 'Salman' }}</span>
                        <span class="user-role">{{ ucfirst(Auth::user()->level ?? 'Administrator') }}</span>
                    </span>
                    <svg class="user-chevron" id="userPillChevron" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>

                <div class="user-dropdown" id="userDropdown">
                    <div class="dropdown-user-info">
                        <p>Login sebagai:</p>
                        <b>{{ Auth::user()->username ?? 'Salman' }}</b>
                        <span style="font-size: 11px; color: var(--gold);">{{ Auth::user()->email ?? 'admin@rabita.com' }}</span>
                    </div>

                    <a href="{{ route('admin.pengaturan') }}" style="display: flex; align-items: center; gap: 10px; width: 100%; padding: 10px 16px; border: none; background: transparent; font-size: 13px; font-family: 'Inter', sans-serif; color: #1A1A1A; cursor: pointer; text-decoration: none; transition: background-color 0.15s ease;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="3"></circle>
                            <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
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

        <!-- MAIN BODY -->
        <main>
            <!-- Title -->
            <div class="page-header">
                <h1 class="page-title">Daftar Produk</h1>
                <p class="page-subtitle">Kelola semua produk yang tersedia di toko Anda</p>
            </div>

            @if(session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Toolbar (Filter, Search, Tambah) -->
            <form method="GET" action="{{ route('produk.index') }}" class="toolbar">
                <!-- Search Input -->
                <div class="search-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <input type="text" name="search" class="search-input" value="{{ request('search') }}" placeholder="Cari produk..." onchange="this.form.submit()">
                </div>

                <!-- Dropdown Kategori -->
                <div class="select-filter-wrap">
                    <select name="kategori" class="select-filter" onchange="this.form.submit()">
                        <option value="">Semua Kategori</option>
                        @foreach($kategoriList as $kat)
                            <option value="{{ $kat->kategori_id }}" {{ request('kategori') == $kat->kategori_id ? 'selected' : '' }}>
                                {{ $kat->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>

                <!-- Dropdown Status -->
                <div class="select-filter-wrap">
                    <select name="status" class="select-filter" onchange="this.form.submit()">
                        <option value="">Semua Status</option>
                        <option value="aktif" {{ request('status') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="sold_out" {{ request('status') === 'sold_out' ? 'selected' : '' }}>Sold Out</option>
                        <option value="arsip" {{ request('status') === 'arsip' ? 'selected' : '' }}>Arsip</option>
                    </select>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>

                <div class="spacer"></div>

                <!-- Tombol Tambah Produk -->
                <a href="{{ route('produk.create') }}" class="btn-add">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    <span>Tambah Produk</span>
                </a>
            </form>

            <!-- Table Card -->
            <div class="table-card">
                <div class="table-responsive">
                    <table class="produk-table">
                        <thead>
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th style="width: 28%;">Produk</th>
                                <th style="width: 17%;">Kategori</th>
                                <th style="width: 17%;">Harga</th>
                                <th class="center" style="width: 11%;">Total Motif</th>
                                <th class="center" style="width: 11%;">Status</th>
                                <th class="center" style="width: 11%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($produk as $index => $item)
                                @php
                                    $firstMotif = $item->motif->first();
                                    $foto = $firstMotif ? $firstMotif->gambar_depan : null;
                                    $fotoPath = $foto ? public_path('assets/image/produk/' . $foto) : null;
                                    $fotoUrl = ($fotoPath && file_exists($fotoPath)) ? asset('assets/image/produk/' . $foto) : null;
                                    $statusClass = $item->status ?? 'aktif';
                                    $statusLabel = $item->status === 'sold_out' ? 'Sold Out' : ucfirst($item->status);
                                @endphp
                                <tr>
                                    <td>{{ $produk->firstItem() + $index }}</td>
                                    <td>
                                        <div class="cell-product">
                                            <div class="thumb-box">
                                                @if($fotoUrl)
                                                    <img src="{{ $fotoUrl }}" alt="{{ $item->nama_produk }}">
                                                @else
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                                        <line x1="3" y1="6" x2="21" y2="6"></line>
                                                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                                                    </svg>
                                                @endif
                                            </div>
                                            <span class="product-name" title="{{ $item->nama_produk }}">{{ $item->nama_produk }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                                    <td style="font-weight: 600;">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                    <td style="text-align: center;">{{ $item->motif_count ?? $item->motif->count() }}</td>
                                    <td style="text-align: center;">
                                        <span class="badge-status {{ $statusClass }}">{{ $statusLabel }}</span>
                                    </td>
                                    <td style="text-align: center;">
                                        <div class="action-group">
                                            <!-- View / Eye Icon -->
                                            <a href="{{ route('produk.edit', $item->produk_id) }}" class="btn-action view" title="Lihat Detail Produk">
                                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                    <circle cx="12" cy="12" r="3"></circle>
                                                </svg>
                                            </a>
                                            <!-- Edit Icon -->
                                            <a href="{{ route('produk.edit', $item->produk_id) }}" class="btn-action edit" title="Edit Produk">
                                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                </svg>
                                            </a>
                                            <!-- Delete Icon -->
                                            <form action="{{ route('produk.destroy', $item->produk_id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');" style="margin: 0;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action delete" title="Hapus Produk">
                                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" style="text-align: center; padding: 50px 16px; color: #8A8A8A;">
                                        <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 10px;">
                                            <svg width="38" height="38" viewBox="0 0 24 24" fill="none" stroke="#D0D0D0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                                <path d="M16 10a4 4 0 0 1-8 0"></path>
                                            </svg>
                                            <span style="font-size: 14px; font-weight: 500; color: #555555;">Belum ada produk yang tersedia</span>
                                            <span style="font-size: 12px; color: #9A9A9A;">Silakan tambahkan produk baru Anda dengan mengklik tombol "+ Tambah Produk" di atas.</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Footer Pagination -->
                @if($produk->total() > 0)
                    <div class="table-footer">
                        <div>
                            Menampilkan {{ $produk->firstItem() ?? 0 }}-{{ $produk->lastItem() ?? 0 }} dari {{ $produk->total() ?? 0 }} produk
                        </div>
                        <div class="pagination-container">
                            {{-- Previous Page Link --}}
                            @if ($produk->onFirstPage())
                                <span class="page-link-btn disabled">&lt;</span>
                            @else
                                <a href="{{ $produk->previousPageUrl() }}" class="page-link-btn">&lt;</a>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($produk->getUrlRange(1, $produk->lastPage()) as $page => $url)
                                @if ($page == $produk->currentPage())
                                    <span class="page-link-btn active">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" class="page-link-btn">{{ $page }}</a>
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($produk->hasMorePages())
                                <a href="{{ $produk->nextPageUrl() }}" class="page-link-btn">&gt;</a>
                            @else
                                <span class="page-link-btn disabled">&gt;</span>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script>
        const userBtn = document.getElementById('userPillBtn');
        const userDropdown = document.getElementById('userDropdown');
        const userChevron = document.getElementById('userPillChevron');

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
    </script>
</body>
</html>

