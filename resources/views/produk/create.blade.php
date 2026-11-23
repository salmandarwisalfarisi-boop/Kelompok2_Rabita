<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tambah Produk – Rabita</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #F5F5F0;
            --card-bg: #FFFFFF;
            --box-bg: #F4F5F0;
            --gold: #B79361;
            --gold-hover: #9c7847;
            --gold-badge: #DFBD8D;
            --gold-badge-tx: #423015;
            --dark-header: #191919;
            --dark-sidebar: #191919;
            --text-dark: #111111;
            --text-muted: #6B7280;
            --border-input: #D1D5DB;
            --border-focus: #B79361;
            --border-dashed: #9CA3AF;
            --danger: #EF4444;
            box-sizing: border-box;
        }

        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
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

        .dropdown-item:hover {
            background-color: #FEE2E2;
        }

        /* --- Main Content --- */
        main {
            flex: 1;
            padding: 34px 44px 50px;
        }

        .page-title {
            font-size: 24px;
            font-weight: 700;
            color: #111111;
            margin-bottom: 24px;
        }

        /* --- Alert Messages --- */
        .alert-error {
            background-color: #FEE2E2;
            border: 1px solid #FCA5A5;
            color: #991B1B;
            border-radius: 10px;
            padding: 14px 18px;
            margin-bottom: 22px;
            font-size: 13.5px;
        }

        .alert-error ul {
            margin: 6px 0 0 18px;
            padding: 0;
        }

        /* --- White Form Card --- */
        .card-main {
            background-color: var(--card-bg);
            border-radius: 18px;
            padding: 36px 40px 40px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
        }

        .section-title {
            font-size: 20px;
            font-weight: 700;
            color: #111111;
            margin-bottom: 22px;
        }

        /* --- Form Grid --- */
        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            column-gap: 24px;
            row-gap: 18px;
        }

        .col-full {
            grid-column: 1 / -1;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .form-label {
            font-size: 14px;
            font-weight: 600;
            color: #111111;
        }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            height: 46px;
            padding: 0 16px;
            border: 1px solid var(--border-input);
            border-radius: 9px;
            font-size: 14px;
            font-family: inherit;
            color: #111111;
            background-color: #FFFFFF;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .form-input::placeholder,
        .form-textarea::placeholder {
            color: #9CA3AF;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: var(--border-focus);
            box-shadow: 0 0 0 3px rgba(183, 147, 97, 0.15);
        }

        .form-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%236B7280' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            background-size: 16px;
            padding-right: 38px;
            cursor: pointer;
        }

        .form-textarea {
            height: auto;
            min-height: 96px;
            padding: 12px 16px;
            resize: vertical;
            line-height: 1.5;
        }

        /* --- Motif Section --- */
        .motif-box {
            background-color: var(--box-bg);
            border-radius: 14px;
            padding: 24px 28px;
            margin-top: 10px;
        }

        .motif-badge {
            display: inline-block;
            background-color: var(--gold-badge);
            color: var(--gold-badge-tx);
            font-size: 13px;
            font-weight: 600;
            padding: 5px 16px;
            border-radius: 7px;
            margin-bottom: 18px;
        }

        .grid-motif-fields {
            display: grid;
            grid-template-columns: 2fr 1fr 1.2fr;
            gap: 20px;
        }

        /* Status Motif Styled Pill Select */
        .select-status-motif {
            appearance: none;
            background-color: #DCFCE7;
            color: #166534;
            border: 1px solid #86EFAC;
            border-radius: 9px;
            font-size: 14px;
            font-weight: 500;
            height: 46px;
            padding: 0 38px 0 16px;
            width: 100%;
            cursor: pointer;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23166534' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            background-size: 16px;
            transition: all 0.2s ease;
        }

        .select-status-motif.status-sold_out {
            background-color: #FEE2E2;
            color: #991B1B;
            border-color: #FCA5A5;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23991B1B' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
        }

        .select-status-motif.status-arsip {
            background-color: #F3F4F6;
            color: #374151;
            border-color: #D1D5DB;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23374151' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
        }

        /* --- Photo Upload Grid --- */
        .grid-photos {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-top: 12px;
        }

        .photo-upload-card {
            border: 1.5px dashed var(--border-dashed);
            border-radius: 12px;
            background-color: #FFFFFF;
            min-height: 125px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: border-color 0.2s ease, background-color 0.2s ease;
            text-align: center;
            padding: 12px;
        }

        .photo-upload-card:hover {
            border-color: var(--gold);
            background-color: #FAFAF7;
        }

        .photo-upload-card.has-image {
            border-style: solid;
            border-color: #E5E7EB;
            padding: 0;
        }

        .photo-upload-card img.preview-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            inset: 0;
            display: none;
        }

        .photo-upload-card.has-image img.preview-img {
            display: block;
        }

        .photo-card-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            z-index: 2;
            pointer-events: none;
        }

        .photo-card-content svg {
            color: #111111;
        }

        .photo-title {
            font-size: 13px;
            font-weight: 600;
            color: #111111;
        }

        .photo-sub {
            font-size: 11px;
            color: var(--text-muted);
            font-weight: 400;
        }

        .photo-change-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
            display: none;
            align-items: center;
            justify-content: center;
            color: #FFFFFF;
            font-size: 12px;
            font-weight: 600;
            z-index: 3;
        }

        .photo-upload-card.has-image:hover .photo-change-overlay {
            display: flex;
        }

        .btn-add-motif {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: 1px solid var(--gold);
            background-color: #FFFFFF;
            color: var(--gold);
            font-size: 13.5px;
            font-weight: 500;
            padding: 8px 18px;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 20px;
            transition: all 0.2s ease;
        }

        .btn-add-motif:hover {
            background-color: #FAF5EE;
        }

        /* --- Form Bottom Actions --- */
        .form-actions {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 14px;
            margin-top: 26px;
        }

        .btn-batal {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: #FFFFFF;
            border: 1.5px solid #111111;
            color: #111111;
            font-size: 14px;
            font-weight: 600;
            padding: 11px 36px;
            border-radius: 8px;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-batal:hover {
            background-color: #F3F4F6;
        }

        .btn-simpan {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background-color: var(--gold);
            border: none;
            color: #FFFFFF;
            font-size: 14px;
            font-weight: 600;
            padding: 11px 26px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .btn-simpan:hover {
            background-color: var(--gold-hover);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .grid-2 {
                grid-template-columns: 1fr;
            }
            .grid-motif-fields {
                grid-template-columns: 1fr;
            }
            .grid-photos {
                grid-template-columns: 1fr 1fr;
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

        <!-- CONTENT -->
        <main>
            <h1 class="page-title">Tambah Produk</h1>

            @if (isset($errors) && $errors->any())
                <div class="alert-error">
                    <b>Terdapat kesalahan pada formulir:</b>
                    <ul>
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- MAIN WHITE CARD -->
                <div class="card-main">

                    <!-- DETAIL PRODUK -->
                    <h2 class="section-title">Detail Produk</h2>

                    <div class="grid-2">
                        <!-- Nama Produk -->
                        <div class="form-group">
                            <label class="form-label" for="nama_produk">Nama Produk</label>
                            <input type="text"
                                   id="nama_produk"
                                   name="nama_produk"
                                   class="form-input"
                                   placeholder="Masukkan nama produk"
                                   value="{{ old('nama_produk') }}"
                                   required>
                        </div>

                        <!-- Kategori -->
                        <div class="form-group">
                            <label class="form-label" for="kategori_id">Kategori</label>
                            <select id="kategori_id" name="kategori_id" class="form-select" required>
                                <option value="" disabled {{ old('kategori_id') ? '' : 'selected' }}>Pilih Kategori</option>
                                @forelse ($kategori as $k)
                                    <option value="{{ $k->kategori_id }}" {{ old('kategori_id') == $k->kategori_id ? 'selected' : '' }}>
                                        {{ $k->nama_kategori }}
                                    </option>
                                @empty
                                    <option value="" disabled>Belum ada kategori tersedia</option>
                                @endforelse
                            </select>
                        </div>

                        <!-- Material -->
                        <div class="form-group">
                            <label class="form-label" for="material">Material</label>
                            <input type="text"
                                   id="material"
                                   name="material"
                                   class="form-input"
                                   placeholder="contoh : kain sasirangan"
                                   value="{{ old('material') }}"
                                   required>
                        </div>

                        <!-- Harga -->
                        <div class="form-group">
                            <label class="form-label" for="harga">Harga</label>
                            <input type="number"
                                   id="harga"
                                   name="harga"
                                   class="form-input"
                                   placeholder="Masukkan harga"
                                   value="{{ old('harga') }}"
                                   min="0"
                                   required>
                        </div>

                        <!-- Ukuran -->
                        <div class="form-group">
                            <label class="form-label" for="ukuran">Ukuran</label>
                            <input type="text"
                                   id="ukuran"
                                   name="ukuran"
                                   class="form-input"
                                   placeholder="P X L X T (cm) Contoh: 30 x 25 x 12"
                                   value="{{ old('ukuran') }}"
                                   required>
                        </div>

                        <!-- Berat (gram) -->
                        <div class="form-group">
                            <label class="form-label" for="berat_gram">Berat (gram)</label>
                            <input type="number"
                                   id="berat_gram"
                                   name="berat_gram"
                                   class="form-input"
                                   placeholder="Masukkan berat Produk"
                                   value="{{ old('berat_gram') }}"
                                   min="0"
                                   required>
                        </div>

                        <!-- Deskripsi -->
                        <div class="form-group col-full">
                            <label class="form-label" for="deskripsi_produk">Deskripsi</label>
                            <textarea id="deskripsi_produk"
                                      name="deskripsi_produk"
                                      class="form-textarea"
                                      placeholder="Jelaskan Bahan, Ukuran, dan Keunggulan Produk..."
                                      required>{{ old('deskripsi_produk') }}</textarea>
                        </div>
                    </div>

                    <!-- PILIHAN MOTIF -->
                    <h2 class="section-title" style="margin-top: 36px;">Pilihan Motif</h2>

                    <div class="motif-box">
                        <div class="motif-badge">Motif 1</div>

                        <div class="grid-motif-fields">
                            <!-- Nama Motif -->
                            <div class="form-group">
                                <label class="form-label" for="nama_motif">Nama Motif</label>
                                <input type="text"
                                       id="nama_motif"
                                       name="nama_motif"
                                       class="form-input"
                                       placeholder="Contoh: Motif Warna Warni"
                                       value="{{ old('nama_motif') }}"
                                       required>
                            </div>

                            <!-- Stok -->
                            <div class="form-group">
                                <label class="form-label" for="stok">Stok</label>
                                <input type="number"
                                       id="stok"
                                       name="stok"
                                       class="form-input"
                                       placeholder="0"
                                       value="{{ old('stok', 0) }}"
                                       min="0"
                                       required>
                            </div>

                            <!-- Status Motif -->
                            <div class="form-group">
                                <label class="form-label" for="status_motif_select">Status Motif</label>
                                <select id="status_motif_select"
                                        name="status"
                                        class="select-status-motif status-aktif"
                                        required>
                                    <option value="aktif" {{ old('status', 'aktif') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="sold_out" {{ old('status') === 'sold_out' ? 'selected' : '' }}>Sold Out</option>
                                    <option value="arsip" {{ old('status') === 'arsip' ? 'selected' : '' }}>Arsip</option>
                                </select>
                            </div>
                        </div>

                        <!-- Foto Motif -->
                        <div style="margin-top: 20px;">
                            <label class="form-label">Foto Motif</label>

                            <div class="grid-photos">
                                <!-- Slot 1: Foto Depan (WAJIB) -->
                                <div class="photo-upload-card" onclick="document.getElementById('input_gambar_depan').click()">
                                    <input type="file" id="input_gambar_depan" name="gambar_depan" accept="image/*" style="display: none;" onchange="previewPhoto(this, 'preview_depan')">
                                    <img id="preview_depan" class="preview-img" alt="Foto Depan">
                                    <div class="photo-card-content">
                                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="3" y="3" width="18" height="18" rx="3" ry="3"></rect>
                                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                            <polyline points="21 15 16 10 5 21"></polyline>
                                            <line x1="12" y1="3" x2="12" y2="7"></line>
                                            <line x1="10" y1="5" x2="14" y2="5"></line>
                                        </svg>
                                        <span class="photo-title">Foto Depan</span>
                                        <span class="photo-sub">(WAJIB)</span>
                                    </div>
                                    <div class="photo-change-overlay">Ganti Foto</div>
                                </div>

                                <!-- Slot 2: Foto Kiri (OPSIONAL) -->
                                <div class="photo-upload-card" onclick="document.getElementById('input_gambar_kiri').click()">
                                    <input type="file" id="input_gambar_kiri" name="gambar_kiri" accept="image/*" style="display: none;" onchange="previewPhoto(this, 'preview_kiri')">
                                    <img id="preview_kiri" class="preview-img" alt="Foto Kiri">
                                    <div class="photo-card-content">
                                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="3" y="3" width="18" height="18" rx="3" ry="3"></rect>
                                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                            <polyline points="21 15 16 10 5 21"></polyline>
                                            <line x1="12" y1="3" x2="12" y2="7"></line>
                                            <line x1="10" y1="5" x2="14" y2="5"></line>
                                        </svg>
                                        <span class="photo-title">Foto Kiri</span>
                                        <span class="photo-sub">(OPSIONAL)</span>
                                    </div>
                                    <div class="photo-change-overlay">Ganti Foto</div>
                                </div>

                                <!-- Slot 3: Foto Kanan (OPSIONAL) -->
                                <div class="photo-upload-card" onclick="document.getElementById('input_gambar_kanan').click()">
                                    <input type="file" id="input_gambar_kanan" name="gambar_kanan" accept="image/*" style="display: none;" onchange="previewPhoto(this, 'preview_kanan')">
                                    <img id="preview_kanan" class="preview-img" alt="Foto Kanan">
                                    <div class="photo-card-content">
                                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="3" y="3" width="18" height="18" rx="3" ry="3"></rect>
                                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                            <polyline points="21 15 16 10 5 21"></polyline>
                                            <line x1="12" y1="3" x2="12" y2="7"></line>
                                            <line x1="10" y1="5" x2="14" y2="5"></line>
                                        </svg>
                                        <span class="photo-title">Foto Kanan</span>
                                        <span class="photo-sub">(OPSIONAL)</span>
                                    </div>
                                    <div class="photo-change-overlay">Ganti Foto</div>
                                </div>

                                <!-- Slot 4: Foto Dalam (OPSIONAL) -->
                                <div class="photo-upload-card" onclick="document.getElementById('input_gambar_dalam').click()">
                                    <input type="file" id="input_gambar_dalam" name="gambar_dalam" accept="image/*" style="display: none;" onchange="previewPhoto(this, 'preview_dalam')">
                                    <img id="preview_dalam" class="preview-img" alt="Foto Dalam">
                                    <div class="photo-card-content">
                                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="3" y="3" width="18" height="18" rx="3" ry="3"></rect>
                                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                            <polyline points="21 15 16 10 5 21"></polyline>
                                            <line x1="12" y1="3" x2="12" y2="7"></line>
                                            <line x1="10" y1="5" x2="14" y2="5"></line>
                                        </svg>
                                        <span class="photo-title">Foto Dalam</span>
                                        <span class="photo-sub">(OPSIONAL)</span>
                                    </div>
                                    <div class="photo-change-overlay">Ganti Foto</div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Tombol Tambah Motif Lain -->
                    <button type="button" class="btn-add-motif" onclick="alert('Fitur tambah multi-motif tersedia. Sistem saat ini menyimpan motif aktif pertama.')">
                        + Tambah Motif Lain
                    </button>

                </div>

                <!-- FORM ACTIONS (Bottom Right) -->
                <div class="form-actions">
                    <a href="{{ route('produk.index') }}" class="btn-batal">Batal</a>
                    <button type="submit" class="btn-simpan">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                            <polyline points="17 21 17 13 7 13 7 21"></polyline>
                            <polyline points="7 3 7 8 15 8"></polyline>
                        </svg>
                        Simpan Produk
                    </button>
                </div>
            </form>
        </main>
    </div>

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

        // Preview Photo
        function previewPhoto(input, previewId) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.getElementById(previewId);
                    img.src = e.target.result;
                    const card = img.closest('.photo-upload-card');
                    card.classList.add('has-image');
                    const content = card.querySelector('.photo-card-content');
                    if (content) content.style.display = 'none';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Status Motif Color Switcher
        const statusSelect = document.getElementById('status_motif_select');
        if (statusSelect) {
            function updateStatusClass() {
                statusSelect.classList.remove('status-aktif', 'status-sold_out', 'status-arsip');
                statusSelect.classList.add('status-' + statusSelect.value);
            }
            statusSelect.addEventListener('change', updateStatusClass);
            updateStatusClass();
        }
    </script>
</body>
</html>

