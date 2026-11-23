<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pesanan – Rabita</title>
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
            font-size: 13px;
            font-weight: 400;
            color: var(--text-muted);
            margin-top: 4px;
        }

        /* --- Stat Cards Grid (4 Cards) --- */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 24px;
        }

        .stat-card {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 22px 20px;
            text-align: center;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
            border: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 4px;
        }

        .stat-label {
            font-family: 'Inter', sans-serif;
            font-size: 12px;
            color: var(--text-muted);
            font-weight: 500;
        }

        .stat-number {
            font-family: 'Inter', sans-serif;
            font-size: 32px;
            font-weight: 700;
            color: var(--text-dark);
            line-height: 1.1;
            margin: 4px 0;
        }

        .stat-sub {
            font-family: 'Inter', sans-serif;
            font-size: 11px;
            font-weight: 400;
            color: #888888;
        }

        .stat-sub.danger {
            color: #EF4444;
            font-weight: 500;
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
            height: 36px;
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

        /* --- Alert Notification --- */
        .alert-success {
            padding: 12px 18px;
            background-color: #DCFCE7;
            color: #15803D;
            border: 1px solid #BBF7D0;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 20px;
        }

        .alert-error {
            padding: 12px 18px;
            background-color: #FEE2E2;
            color: #991B1B;
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
            min-width: 820px;
            border-collapse: collapse;
            font-size: 13px;
        }

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

        /* Status Badges */
        .badge-status {
            display: inline-block;
            padding: 3px 14px;
            border-radius: 9999px;
            font-size: 11px;
            font-weight: 600;
            text-align: center;
            white-space: nowrap;
        }

        .badge-status.menunggu {
            background-color: #FEF3C7;
            color: #D97706;
        }

        .badge-status.diproses {
            background-color: #DBEAFE;
            color: #1D4ED8;
        }

        .badge-status.dikirim {
            background-color: #E0E7FF;
            color: #4338CA;
        }

        .badge-status.selesai {
            background-color: #DCFCE7;
            color: #15803D;
        }

        .badge-status.dibatalkan {
            background-color: #FEE2E2;
            color: #B91C1C;
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
            width: 15px;
            height: 15px;
        }

        .btn-view {
            background-color: #FFEFD9;
            color: #EB9825;
        }

        .btn-view:hover {
            opacity: 0.85;
            transform: scale(1.04);
        }

        .btn-delete {
            background-color: #FEF2F2;
            color: #EF4444;
        }

        .btn-delete:hover {
            opacity: 0.85;
            transform: scale(1.04);
        }

        .btn-check {
            background-color: #F2FFF0;
            color: #299C17;
        }

        .btn-check:hover {
            opacity: 0.85;
            transform: scale(1.04);
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
            font-size: 16px;
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
            font-size: 12px;
            color: var(--text-muted);
        }

        .pagination-info b {
            color: var(--text-dark);
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
            padding: 0 8px;
            border-radius: 6px;
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
            font-size: 18px;
            font-weight: 700;
            color: #111111;
            margin-bottom: 8px;
        }

        .modal-desc {
            font-size: 13.5px;
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
            height: 40px;
            background-color: #F3F4F6;
            color: #374151;
            border-radius: 8px;
            border: none;
            font-size: 13.5px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.15s ease;
        }

        .modal-btn-cancel:hover {
            background-color: #E5E7EB;
        }

        .modal-btn-confirm {
            flex: 1;
            height: 40px;
            background-color: #EF4444;
            color: #FFFFFF;
            border-radius: 8px;
            border: none;
            font-size: 13.5px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.15s ease;
        }

        .modal-btn-confirm:hover {
            background-color: #DC2626;
        }

        /* --- Detail Modal Box --- */
        .detail-modal-box {
            background-color: #FFFFFF;
            border-radius: 16px;
            width: 100%;
            max-width: 680px;
            max-height: 90vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            box-shadow: 0 12px 36px rgba(0, 0, 0, 0.2);
            animation: modalPop 0.25s ease;
        }

        .detail-modal-header {
            padding: 18px 24px;
            border-bottom: 1px solid #ECECEC;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .detail-modal-title {
            font-size: 17px;
            font-weight: 700;
            color: #111111;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-close-modal {
            background: none;
            border: none;
            font-size: 24px;
            line-height: 1;
            color: #999;
            cursor: pointer;
            padding: 4px;
        }

        .btn-close-modal:hover {
            color: #111;
        }

        .detail-modal-body {
            padding: 24px;
            overflow-y: auto;
            flex: 1;
        }

        .detail-section {
            background-color: #FAFAF7;
            border: 1px solid #EAEAEA;
            border-radius: 12px;
            padding: 18px 20px;
            margin-bottom: 16px;
        }

        .detail-sec-title {
            font-size: 14px;
            font-weight: 700;
            color: #111111;
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .grid-detail-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px 18px;
            font-size: 13px;
        }

        .dt-label {
            color: #777777;
            font-size: 11.5px;
            margin-bottom: 2px;
        }

        .dt-val {
            font-weight: 600;
            color: #111111;
        }

        .modal-item-card {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 0;
            border-bottom: 1px solid #EDEDED;
        }

        .modal-item-card:last-child {
            border-bottom: none;
        }

        .item-thumb {
            width: 48px;
            height: 48px;
            border-radius: 6px;
            object-fit: cover;
            border: 1px solid #EAEAEA;
            flex-shrink: 0;
            background-color: #FFFFFF;
        }

        .item-info {
            flex: 1;
        }

        .item-name {
            font-weight: 600;
            color: #111111;
            font-size: 13.5px;
        }

        .item-motif {
            font-size: 12px;
            color: #777777;
        }

        .item-price {
            font-weight: 600;
            color: #111111;
            font-size: 13.5px;
        }

        .bukti-bayar-preview {
            max-width: 100%;
            max-height: 220px;
            border-radius: 8px;
            border: 1px solid #DDD;
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .detail-modal-footer {
            padding: 16px 24px;
            border-top: 1px solid #ECECEC;
            background-color: #FFFFFF;
        }

        .form-update-status {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .select-status-modal {
            height: 38px;
            padding: 0 12px;
            border-radius: 7px;
            border: 1px solid #D1D5DB;
            background: #FFF;
            font-size: 13px;
            font-weight: 500;
        }

        .input-resi-modal {
            height: 38px;
            padding: 0 12px;
            border-radius: 7px;
            border: 1px solid #D1D5DB;
            background: #FFF;
            font-size: 13px;
            width: 180px;
        }

        .btn-save-modal {
            height: 38px;
            padding: 0 18px;
            background: var(--gold);
            color: #FFF;
            border: none;
            border-radius: 7px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.15s ease;
        }

        .btn-save-modal:hover {
            background: var(--gold-hover);
        }

        @media (max-width: 992px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
            main {
                padding: 20px 16px;
            }
            .toolbar,
            .search-wrap,
            .select-filter-wrap,
            .select-filter {
                width: 100%;
            }
            .grid-detail-2 {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    @include('components.sidebar')

    <!-- MAIN WRAPPER -->
    <div class="layout-main">

        <!-- TOPBAR -->
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
                <h1 class="page-title">Pesanan</h1>
                <p class="page-subtitle">Kelola semua pesanan yang tersedia di toko Anda</p>
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

            <!-- 4 STAT CARDS -->
            <div class="stats-grid">
                <div class="stat-card">
                    <span class="stat-label">Total Pesanan</span>
                    <span class="stat-number">{{ $totalPesanan }}</span>
                    <span class="stat-sub">Semua waktu</span>
                </div>
                <div class="stat-card">
                    <span class="stat-label">Menunggu Konfirmasi</span>
                    <span class="stat-number">{{ $menungguKonfirmasi }}</span>
                    <span class="stat-sub danger">Perlu dikonfirmasi</span>
                </div>
                <div class="stat-card">
                    <span class="stat-label">Dalam Pengiriman</span>
                    <span class="stat-number">{{ $dalamPengiriman }}</span>
                    <span class="stat-sub">Sedang dikirim</span>
                </div>
                <div class="stat-card">
                    <span class="stat-label">Pesanan Selesai</span>
                    <span class="stat-number">{{ $pesananSelesai }}</span>
                    <span class="stat-sub">Semua waktu</span>
                </div>
            </div>

            <!-- TOOLBAR -->
            <form action="{{ route('pesanan.index') }}" method="GET" class="toolbar" id="filterForm">
                <div class="search-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <input type="text"
                           name="search"
                           class="search-input"
                           placeholder="Cari nama pemesan..."
                           value="{{ request('search') }}">
                </div>

                <div class="select-filter-wrap">
                    <select name="status" class="select-filter" onchange="document.getElementById('filterForm').submit()">
                        <option value="">Semua Status</option>
                        <option value="menunggu"   {{ request('status') === 'menunggu'   ? 'selected' : '' }}>Menunggu</option>
                        <option value="diproses"   {{ request('status') === 'diproses'   ? 'selected' : '' }}>Diproses</option>
                        <option value="dikirim"    {{ request('status') === 'dikirim'    ? 'selected' : '' }}>Dikirim</option>
                        <option value="selesai"    {{ request('status') === 'selesai'    ? 'selected' : '' }}>Selesai</option>
                        <option value="dibatalkan" {{ request('status') === 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>

                <div class="select-filter-wrap">
                    <select name="tanggal" class="select-filter" onchange="document.getElementById('filterForm').submit()">
                        <option value="">Pilih Tanggal</option>
                        <option value="today"  {{ request('tanggal') === 'today'  ? 'selected' : '' }}>Hari Ini</option>
                        <option value="7days"  {{ request('tanggal') === '7days'  ? 'selected' : '' }}>7 Hari Terakhir</option>
                        <option value="month"  {{ request('tanggal') === 'month'  ? 'selected' : '' }}>Bulan Ini</option>
                    </select>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </form>

            <!-- TABLE CARD -->
            <div class="table-card">
                <div class="table-responsive">
                    <table class="produk-table">
                        <thead>
                            <tr>
                                <th class="center" style="width: 50px;">No</th>
                                <th>Nama Pemesan</th>
                                <th>Email Pemesan</th>
                                <th>Total Harga</th>
                                <th class="center" style="width: 150px;">Status Pesanan</th>
                                <th style="width: 160px;">Tanggal Pesanan</th>
                                <th class="center" style="width: 140px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pesanan as $index => $item)
                                @php
                                    $statusClass = match($item->status_pesanan) {
                                        'menunggu'   => 'menunggu',
                                        'diproses'   => 'diproses',
                                        'dikirim'    => 'dikirim',
                                        'selesai'    => 'selesai',
                                        'dibatalkan' => 'dibatalkan',
                                        default      => 'menunggu'
                                    };
                                    $statusLabel = ucfirst($item->status_pesanan);
                                @endphp
                                <tr>
                                    <td class="center" style="color: #1A1A1A;">
                                        {{ $pesanan->firstItem() ? $pesanan->firstItem() + $index : $index + 1 }}
                                    </td>
                                    <td style="font-size: 13px; font-weight: 600; color: #1A1A1A;">
                                        {{ $item->nama_penerima ?? ($item->user->username ?? 'Pelanggan') }}
                                    </td>
                                    <td style="color: #1A1A1A; font-size: 13px;">
                                        {{ $item->user->email ?? '-' }}
                                    </td>
                                    <td style="font-size: 13px; font-weight: 400; color: #1A1A1A;">
                                        Rp {{ number_format($item->total_harga, 0, ',', '.') }}
                                    </td>
                                    <td class="center">
                                        <span class="badge-status {{ $statusClass }}">{{ $statusLabel }}</span>
                                    </td>
                                    <td style="font-size: 13px; color: #555555;">
                                        <div style="font-weight: 600; color: #555555;">{{ $item->created_at ? $item->created_at->translatedFormat('d M Y') : '-' }}</div>
                                        <div style="font-size: 13px; font-weight: 400; color: #555555;">Jam : {{ $item->created_at ? $item->created_at->format('H.i') : '-' }}</div>
                                    </td>
                                    <td class="center">
                                        <div class="action-group">
                                            <!-- Lihat Detail -->
                                            <button type="button"
                                                    class="btn-action btn-view"
                                                    title="Lihat Detail Pesanan"
                                                    onclick="openDetailModal({{ $item->pemesanan_id }})">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                    <circle cx="12" cy="12" r="3"></circle>
                                                </svg>
                                            </button>

                                            <!-- Hapus Pesanan -->
                                            <button type="button"
                                                    class="btn-action btn-delete"
                                                    title="Hapus Pesanan"
                                                    onclick="openDeleteModal('{{ route('pesanan.destroy', $item->pemesanan_id) }}', '#{{ $item->pemesanan_id }}')">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                </svg>
                                            </button>

                                            <!-- Konfirmasi / Lanjutkan Status -->
                                            @if ($item->status_pesanan !== 'selesai' && $item->status_pesanan !== 'dibatalkan')
                                                <form action="{{ route('pesanan.konfirmasi', $item->pemesanan_id) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Konfirmasi dan lanjutkan status pesanan #{{ $item->pemesanan_id }}?');"
                                                      style="margin: 0; display: inline;">
                                                    @csrf
                                                    <button type="submit" class="btn-action btn-check" title="Konfirmasi / Lanjutkan Status">
                                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                            <polyline points="20 6 9 17 4 12"></polyline>
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">
                                        <div class="empty-state">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"></path>
                                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                                <path d="M16 10a4 4 0 0 1-8 0"></path>
                                            </svg>
                                            <h4>Tidak ada data pesanan</h4>
                                            <p>{{ request('search') || request('status') || request('tanggal') ? 'Tidak ditemukan pesanan dengan kriteria filter yang Anda pilih.' : 'Saat ini belum ada pesanan yang masuk.' }}</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($pesanan->hasPages())
                    <div class="pagination-footer">
                        <div class="pagination-info">
                            Menampilkan <b>{{ $pesanan->firstItem() ?? 0 }}</b> - <b>{{ $pesanan->lastItem() ?? 0 }}</b> dari <b>{{ $pesanan->total() }}</b> pesanan
                        </div>
                        <div class="pagination-links">
                            @if ($pesanan->onFirstPage())
                                <span class="page-btn disabled">&lt;</span>
                            @else
                                <a href="{{ $pesanan->previousPageUrl() }}" class="page-btn">&lt;</a>
                            @endif

                            @foreach ($pesanan->getUrlRange(1, $pesanan->lastPage()) as $page => $url)
                                @if ($page == $pesanan->currentPage())
                                    <span class="page-btn active">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" class="page-btn">{{ $page }}</a>
                                @endif
                            @endforeach

                            @if ($pesanan->hasMorePages())
                                <a href="{{ $pesanan->nextPageUrl() }}" class="page-btn">&gt;</a>
                            @else
                                <span class="page-btn disabled">&gt;</span>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </main>
    </div>

    <!-- MODAL DETAIL PESANAN -->
    <div class="modal-overlay" id="detailModal">
        <div class="detail-modal-box">
            <div class="detail-modal-header">
                <div class="detail-modal-title">
                    <span>Detail Pesanan <span id="m_id" style="color: var(--gold);">#</span></span>
                    <span id="m_status_badge" class="badge-status menunggu" style="font-size: 11px;">-</span>
                </div>
                <button type="button" class="btn-close-modal" onclick="closeDetailModal()">&times;</button>
            </div>

            <div class="detail-modal-body">
                <!-- 1. Data Pemesan & Pengiriman -->
                <div class="detail-section">
                    <div class="detail-sec-title">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        Informasi Penerima & Pengiriman
                    </div>
                    <div class="grid-detail-2">
                        <div>
                            <div class="dt-label">Nama Penerima</div>
                            <div class="dt-val" id="m_nama">-</div>
                        </div>
                        <div>
                            <div class="dt-label">Nomor HP / WhatsApp</div>
                            <div class="dt-val" id="m_hp">-</div>
                        </div>
                        <div>
                            <div class="dt-label">Email Akun</div>
                            <div class="dt-val" id="m_email">-</div>
                        </div>
                        <div>
                            <div class="dt-label">Tanggal Pesanan</div>
                            <div class="dt-val" id="m_tgl">-</div>
                        </div>
                        <div style="grid-column: 1 / -1;">
                            <div class="dt-label">Alamat Lengkap Pengiriman</div>
                            <div class="dt-val" id="m_alamat">-</div>
                        </div>
                        <div>
                            <div class="dt-label">Ekspedisi & Layanan</div>
                            <div class="dt-val" id="m_ekspedisi">-</div>
                        </div>
                        <div>
                            <div class="dt-label">Nomor Resi Pengiriman</div>
                            <div class="dt-val" id="m_resi" style="color: var(--gold);">-</div>
                        </div>
                    </div>
                </div>

                <!-- 2. Produk yang Dipesan -->
                <div class="detail-section">
                    <div class="detail-sec-title">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"></path>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                        </svg>
                        Item Produk yang Dipesan
                    </div>
                    <div id="m_items_list">
                        <!-- Disuntikkan via JS -->
                    </div>

                    <!-- Ringkasan Biaya -->
                    <div style="margin-top: 16px; padding-top: 12px; border-top: 1px dashed #DDD; display: flex; flex-direction: column; gap: 6px; font-size: 13.5px;">
                        <div style="display: flex; justify-content: space-between; color: #666;">
                            <span>Subtotal Produk</span>
                            <span id="m_subtotal_prod">Rp 0</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; color: #666;">
                            <span>Ongkos Kirim</span>
                            <span id="m_ongkir">Rp 0</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; font-weight: 700; font-size: 15px; color: #111; margin-top: 4px;">
                            <span>Total Pembayaran</span>
                            <span id="m_total_harga" style="color: var(--gold);">Rp 0</span>
                        </div>
                    </div>
                </div>

                <!-- 3. Bukti Transfer Pembayaran -->
                <div class="detail-section">
                    <div class="detail-sec-title">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="5" width="20" height="14" rx="2"></rect>
                            <line x1="2" y1="10" x2="22" y2="10"></line>
                        </svg>
                        Bukti Pembayaran Pelanggan
                    </div>
                    <div id="m_bukti_wrap">
                        <!-- Disuntikkan via JS -->
                    </div>
                </div>
            </div>

            <!-- Modal Footer Form: Update Resi & Status -->
            <form id="formUpdateStatusModal" method="POST" class="detail-modal-footer">
                @csrf
                @method('PUT')
                <div class="form-update-status">
                    <label style="font-size: 12.5px; font-weight: 600; color: #333;">Ubah Status:</label>
                    <select name="status_pesanan" id="m_input_status" class="select-status-modal">
                        <option value="menunggu">Menunggu</option>
                        <option value="diproses">Diproses</option>
                        <option value="dikirim">Dikirim</option>
                        <option value="selesai">Selesai</option>
                        <option value="dibatalkan">Dibatalkan</option>
                    </select>

                    <input type="text" name="no_resi" id="m_input_resi" class="input-resi-modal" placeholder="Masukkan nomor resi...">
                    <button type="submit" class="btn-save-modal">Simpan Perubahan</button>
                </div>
            </form>
        </div>
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
            <h3 class="modal-title">Hapus Pesanan?</h3>
            <p class="modal-desc" id="deleteModalDesc">Apakah Anda yakin ingin menghapus pesanan ini? Tindakan ini tidak dapat dibatalkan.</p>
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
            deleteDesc.innerHTML = `Apakah Anda yakin ingin menghapus pesanan <b>${itemName}</b>? Tindakan ini tidak dapat dibatalkan.`;
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

        // Detail Modal Actions
        const detailModal = document.getElementById('detailModal');
        const updateForm = document.getElementById('formUpdateStatusModal');

        function formatRupiah(num) {
            return 'Rp ' + Number(num).toLocaleString('id-ID');
        }

        function openDetailModal(pemesananId) {
            fetch('/pesanan/' + pemesananId, {
                headers: {
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(res => {
                if (res.status === 'success') {
                    const d = res.data;

                    document.getElementById('m_id').innerText = '#' + d.pemesanan_id;
                    const badge = document.getElementById('m_status_badge');
                    badge.className = 'badge-status ' + d.status_pesanan;
                    badge.innerText = d.status_pesanan.charAt(0).toUpperCase() + d.status_pesanan.slice(1);

                    document.getElementById('m_nama').innerText = d.nama_penerima || '-';
                    document.getElementById('m_hp').innerText = d.no_hp_penerima || '-';
                    document.getElementById('m_email').innerText = d.email || '-';
                    document.getElementById('m_tgl').innerText = d.tanggal_pesan || '-';
                    document.getElementById('m_alamat').innerText = (d.alamat_lengkap || '') + ', Kec. ' + (d.kecamatan || '') + ', ' + (d.kota || '') + ', ' + (d.provinsi || '') + ' (' + (d.kode_pos || '') + ')';
                    document.getElementById('m_ekspedisi').innerText = (d.kurir || '-') + ' (' + (d.layanan_kurir || '-') + ') - Estimasi: ' + (d.estimasi_tiba || '-');
                    document.getElementById('m_resi').innerText = d.no_resi || 'Belum ada nomor resi';

                    const itemsContainer = document.getElementById('m_items_list');
                    itemsContainer.innerHTML = '';
                    if (d.items && d.items.length > 0) {
                        d.items.forEach(it => {
                            const imgTag = it.gambar ? `<img src="${it.gambar}" class="item-thumb" alt="${it.nama_produk}">` : `<div class="item-thumb" style="display:grid;place-items:center;color:#999;"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"></rect></svg></div>`;
                            itemsContainer.innerHTML += `
                                <div class="modal-item-card">
                                    ${imgTag}
                                    <div class="item-info">
                                        <div class="item-name">${it.nama_produk}</div>
                                        <div class="item-motif">Motif: ${it.nama_motif} &bull; ${it.jumlah} pcs &times; ${formatRupiah(it.harga_satuan)}</div>
                                    </div>
                                    <div class="item-price">${formatRupiah(it.subtotal)}</div>
                                </div>
                            `;
                        });
                    }

                    document.getElementById('m_subtotal_prod').innerText = formatRupiah(d.subtotal_produk);
                    document.getElementById('m_ongkir').innerText = formatRupiah(d.ongkir);
                    document.getElementById('m_total_harga').innerText = formatRupiah(d.total_harga);

                    const buktiWrap = document.getElementById('m_bukti_wrap');
                    if (d.bukti_bayar) {
                        buktiWrap.innerHTML = `
                            <a href="${d.bukti_bayar}" target="_blank" title="Klik untuk memperbesar">
                                <img src="${d.bukti_bayar}" class="bukti-bayar-preview" alt="Bukti Transfer">
                            </a>
                            <div style="font-size: 11.5px; color: #666; margin-top: 6px;">
                                Waktu konfirmasi pembayaran: <b>${d.waktu_bayar || 'Belum diverifikasi'}</b> (Klik gambar untuk memperbesar)
                            </div>
                        `;
                    } else {
                        buktiWrap.innerHTML = `<div style="font-size: 13px; color: #888; font-style: italic;">Pelanggan belum mengunggah bukti pembayaran transfer.</div>`;
                    }

                    updateForm.action = '/pesanan/' + d.pemesanan_id + '/status';
                    document.getElementById('m_input_status').value = d.status_pesanan;
                    document.getElementById('m_input_resi').value = d.no_resi || '';

                    detailModal.classList.add('active');
                }
            })
            .catch(err => {
                console.error(err);
                alert('Gagal memuat detail pesanan.');
            });
        }

        function closeDetailModal() {
            detailModal.classList.remove('active');
        }

        if (detailModal) {
            detailModal.addEventListener('click', function(e) {
                if (e.target === detailModal) {
                    closeDetailModal();
                }
            });
        }
    </script>
</body>
</html>

