<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar Kategori – Rabita</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Lato:wght@400;500;600;700&display=swap" rel="stylesheet">
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
            font-family: 'Lato', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
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
            font-family: 'Lato', sans-serif;
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
            height: 36px;
            padding: 0 14px 0 38px;
            border: 1px solid var(--border-light);
            border-radius: 8px;
            font-family: 'Lato', sans-serif;
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

        .spacer {
            flex: 1;
        }

        .btn-add {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            height: 36px;
            padding: 0 18px;
            background-color: var(--gold);
            color: #FFFFFF;
            font-family: 'Inter', sans-serif;
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

        .alert-error {
            padding: 12px 18px;
            background-color: #FEF2F2;
            color: #EF4444;
            border: 1px solid #FCA5A5;
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
            min-width: 600px;
            border-collapse: collapse;
            font-size: 13px;
            font-family: 'Lato', sans-serif;
        }

        .produk-table thead tr {
            background-color: var(--gold);
        }

        .produk-table th {
            padding: 12px 16px;
            text-align: left;
            font-family: 'Inter', sans-serif;
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
            color: var(--text-dark);
            font-size: 13px;
            font-family: 'Lato', sans-serif;
        }

        .produk-table tr:last-child td {
            border-bottom: none;
        }

        .produk-table tr:hover td {
            background-color: #FAFAF8;
        }

        /* Category Thumb Box */
        .thumb-box {
            width: 45px;
            height: 45px;
            border-radius: 0;
            overflow: hidden;
            background-color: #F5F5F5;
            display: grid;
            place-items: center;
            flex-shrink: 0;
            border: none;
            margin: 0 auto;
        }

        .thumb-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .thumb-box svg {
            width: 20px;
            height: 20px;
            color: #888888;
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
            transition: all 0.15s ease;
            text-decoration: none;
        }

        .btn-action svg {
            width: 14px;
            height: 14px;
        }

        .btn-edit {
            background-color: #F0F9FF;
            color: #2563EB;
        }

        .btn-edit:hover {
            background-color: #E0F2FE;
        }

        .btn-delete {
            background-color: #FEF2F2;
            color: #EF4444;
        }

        .btn-delete:hover {
            background-color: #FEE2E2;
        }

        /* --- Empty State --- */
        .empty-state {
            padding: 48px 20px;
            text-align: center;
            color: #888888;
        }

        .empty-state svg {
            width: 48px;
            height: 48px;
            margin-bottom: 12px;
            color: #BBBBBB;
        }

        .empty-state h4 {
            font-family: 'Inter', sans-serif;
            font-size: 15px;
            font-weight: 600;
            color: #333333;
            margin-bottom: 4px;
        }

        .empty-state p {
            font-size: 13px;
            color: #888888;
        }

        /* --- Pagination Footer --- */
        .pagination-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 20px;
            border-top: 1px solid var(--border-light);
            flex-wrap: wrap;
            gap: 12px;
        }

        .pagination-info {
            font-family: 'Lato', sans-serif;
            font-size: 12px;
            font-weight: 400;
            color: var(--text-muted);
        }

        .pagination-links {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .page-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 28px;
            height: 28px;
            padding: 0 6px;
            border-radius: 6px;
            font-family: 'Lato', sans-serif;
            font-size: 12px;
            font-weight: 500;
            color: var(--text-dark);
            text-decoration: none;
            background-color: #FFFFFF;
            border: 1px solid var(--border-light);
            transition: all 0.15s ease;
        }

        .page-btn:hover:not(.disabled):not(.active) {
            background-color: #F5F5F0;
            border-color: #D5D5D0;
        }

        .page-btn.active {
            background-color: var(--gold);
            color: #FFFFFF;
            border-color: var(--gold);
            font-weight: 600;
        }

        .page-btn.disabled {
            opacity: 0.4;
            cursor: not-allowed;
            pointer-events: none;
        }

        /* --- Delete Modal --- */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            padding: 16px;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal-card {
            background: #FFFFFF;
            border-radius: 14px;
            width: 100%;
            max-width: 420px;
            padding: 26px 24px 22px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            text-align: center;
            animation: modalPop 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes modalPop {
            from {
                opacity: 0;
                transform: scale(0.94);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .modal-icon-wrap {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            background-color: #FEE2E2;
            color: #EF4444;
            display: grid;
            place-items: center;
            margin: 0 auto 16px;
        }

        .modal-icon-wrap svg {
            width: 26px;
            height: 26px;
        }

        .modal-title {
            font-family: 'Inter', sans-serif;
            font-size: 18px;
            font-weight: 700;
            color: #1A1A1A;
            margin-bottom: 8px;
        }

        .modal-desc {
            font-family: 'Lato', sans-serif;
            font-size: 13px;
            color: var(--text-muted);
            line-height: 1.5;
            margin-bottom: 22px;
        }

        .modal-actions {
            display: flex;
            gap: 12px;
            justify-content: center;
        }

        .modal-btn-cancel {
            flex: 1;
            height: 36px;
            background-color: #F3F4F6;
            color: #374151;
            border-radius: 8px;
            border: none;
            font-family: 'Inter', sans-serif;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.15s ease;
        }

        .modal-btn-cancel:hover {
            background-color: #E5E7EB;
        }

        .modal-btn-confirm {
            flex: 1;
            height: 36px;
            background-color: #EF4444;
            color: #FFFFFF;
            border-radius: 8px;
            border: none;
            font-family: 'Inter', sans-serif;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.15s ease;
        }

        .modal-btn-confirm:hover {
            background-color: #DC2626;
        }

        @media (max-width: 768px) {
            main {
                padding: 20px 16px;
            }
            .toolbar {
                flex-direction: column;
                align-items: stretch;
            }
            .search-wrap, .btn-add {
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
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <!-- MAIN CONTENT -->
        <main>
            <div class="page-header">
                <h1 class="page-title">Daftar Kategori</h1>
                <p class="page-subtitle">Kelola semua kategori yang tersedia di toko Anda</p>
            </div>

            @if (session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert-error">
                    {{ session('error') }}
                </div>
            @endif

            <!-- TOOLBAR -->
            <div class="toolbar">
                <form method="GET" action="{{ route('kategori.index') }}" class="search-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <input type="text"
                           name="search"
                           class="search-input"
                           placeholder="Cari Kategori..."
                           value="{{ request('search') }}">
                </form>

                <div class="spacer"></div>

                <a href="{{ route('kategori.create') }}" class="btn-add">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    <span>Tambah Kategori</span>
                </a>
            </div>

            <!-- TABLE CARD -->
            <div class="table-card">
                <div class="table-responsive">
                    <table class="produk-table">
                        <thead>
                            <tr>
                                <th class="center" style="width: 70px;">No</th>
                                <th>Nama Kategori</th>
                                <th class="center" style="width: 140px;">Gambar</th>
                                <th class="center" style="width: 120px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kategori as $index => $item)
                                <tr>
                                    <td class="center" style="color: #1A1A1A;">
                                        {{ $kategori->firstItem() ? $kategori->firstItem() + $index : $index + 1 }}
                                    </td>
                                    <td>
                                        <span style="color: #1A1A1A; font-weight: 400;">{{ $item->nama_kategori }}</span>
                                    </td>
                                    <td class="center">
                                        <div class="thumb-box">
                                            @if ($item->gambar && file_exists(public_path('assets/image/kategori/' . $item->gambar)))
                                                <img src="{{ asset('assets/image/kategori/' . $item->gambar) }}" alt="{{ $item->nama_kategori }}">
                                            @else
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                                    <polyline points="21 15 16 10 5 21"></polyline>
                                                </svg>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="center">
                                        <div class="action-group">
                                            <a href="{{ route('kategori.edit', $item->kategori_id) }}" class="btn-action btn-edit" title="Edit Kategori">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                </svg>
                                            </a>
                                            <button type="button"
                                                    class="btn-action btn-delete"
                                                    title="Hapus Kategori"
                                                    onclick="openDeleteModal('{{ route('kategori.destroy', $item->kategori_id) }}', '{{ addslashes($item->nama_kategori) }}')">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">
                                        <div class="empty-state">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                <rect x="3" y="3" width="7" height="7"></rect>
                                                <rect x="14" y="3" width="7" height="7"></rect>
                                                <rect x="14" y="14" width="7" height="7"></rect>
                                                <rect x="3" y="14" width="7" height="7"></rect>
                                            </svg>
                                            <h4>Tidak ada data kategori</h4>
                                            <p>{{ request('search') ? 'Tidak ditemukan kategori yang sesuai pencarian.' : 'Belum ada kategori yang ditambahkan.' }}</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($kategori->hasPages())
                    <div class="pagination-footer">
                        <div class="pagination-info">
                            Menampilkan {{ $kategori->firstItem() ?? 0 }} - {{ $kategori->lastItem() ?? 0 }} dari {{ $kategori->total() }} kategori
                        </div>
                        <div class="pagination-links">
                            @if ($kategori->onFirstPage())
                                <span class="page-btn disabled">&lt;</span>
                            @else
                                <a href="{{ $kategori->previousPageUrl() }}" class="page-btn">&lt;</a>
                            @endif

                            @foreach ($kategori->getUrlRange(1, $kategori->lastPage()) as $page => $url)
                                @if ($page == $kategori->currentPage())
                                    <span class="page-btn active">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" class="page-btn">{{ $page }}</a>
                                @endif
                            @endforeach

                            @if ($kategori->hasMorePages())
                                <a href="{{ $kategori->nextPageUrl() }}" class="page-btn">&gt;</a>
                            @else
                                <span class="page-btn disabled">&gt;</span>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </main>
    </div>

    <!-- MODAL KONFIRMASI HAPUS -->
    <div class="modal-overlay" id="deleteModal">
        <div class="modal-card">
            <div class="modal-icon-wrap">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="3 6 5 6 21 6"></polyline>
                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                    <line x1="10" y1="11" x2="10" y2="17"></line>
                    <line x1="14" y1="11" x2="14" y2="17"></line>
                </svg>
            </div>
            <h3 class="modal-title">Hapus Kategori?</h3>
            <p class="modal-desc" id="deleteModalDesc">Apakah Anda yakin ingin menghapus kategori ini? Tindakan ini tidak dapat dibatalkan.</p>
            <form id="deleteForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <div class="modal-actions">
                    <button type="button" class="modal-btn-cancel" onclick="closeDeleteModal()">Batal</button>
                    <button type="submit" class="modal-btn-confirm">Ya, Hapus</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // User pill dropdown
        const userBtn = document.getElementById('userPillBtn');
        const userDropdown = document.getElementById('userDropdown');
        if (userBtn && userDropdown) {
            userBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                userDropdown.classList.toggle('show');
            });
            document.addEventListener('click', () => {
                userDropdown.classList.remove('show');
            });
        }

        // Delete modal
        const deleteModal = document.getElementById('deleteModal');
        const deleteForm = document.getElementById('deleteForm');
        const deleteDesc = document.getElementById('deleteModalDesc');

        function openDeleteModal(actionUrl, itemName) {
            deleteForm.action = actionUrl;
            deleteDesc.innerHTML = `Apakah Anda yakin ingin menghapus kategori <b>"${itemName}"</b>? Tindakan ini tidak dapat dibatalkan.`;
            deleteModal.classList.add('active');
        }

        function closeDeleteModal() {
            deleteModal.classList.remove('active');
        }

        if (deleteModal) {
            deleteModal.addEventListener('click', (e) => {
                if (e.target === deleteModal) closeDeleteModal();
            });
        }
    </script>
</body>
</html>
