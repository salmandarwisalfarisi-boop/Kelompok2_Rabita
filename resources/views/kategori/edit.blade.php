<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Kategori – Rabita</title>
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
            border-bottom: 1px solid #242424;
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
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            line-height: 1.2;
            text-align: left;
        }

        .user-name {
            font-size: 13.5px;
            font-weight: 700;
            color: var(--text-dark);
        }

        .user-role {
            font-size: 11px;
            color: var(--text-muted);
            font-weight: 400;
        }

        .user-chevron {
            color: #777777;
            transition: transform 0.2s ease;
        }

        .user-pill-btn.open .user-chevron {
            transform: rotate(180deg);
        }

        .user-dropdown {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            width: 200px;
            background-color: #FFFFFF;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            padding: 8px;
            display: none;
            z-index: 100;
            border: 1px solid #EAEAEA;
        }

        .user-dropdown.show {
            display: block;
        }

        .dropdown-user-info {
            padding: 10px 12px;
            border-bottom: 1px solid #F0F0F0;
            margin-bottom: 6px;
        }

        .dropdown-user-info p {
            font-size: 11px;
            color: var(--text-muted);
            margin-bottom: 2px;
        }

        .dropdown-user-info b {
            font-size: 13px;
            color: var(--text-dark);
            display: block;
        }

        .dropdown-item {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            background: none;
            border: none;
            color: #DC2626;
            font-size: 13px;
            font-weight: 500;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.15s ease;
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
            max-width: 860px;
        }

        .section-title {
            font-size: 20px;
            font-weight: 700;
            color: #111111;
            margin-bottom: 22px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 7px;
            margin-bottom: 20px;
        }

        .form-label {
            font-size: 14px;
            font-weight: 600;
            color: #111111;
        }

        .form-input {
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

        .form-input::placeholder {
            color: #9CA3AF;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--border-focus);
            box-shadow: 0 0 0 3px rgba(183, 147, 97, 0.15);
        }

        /* Photo Upload Card */
        .photo-upload-card {
            border: 1.5px dashed var(--border-dashed);
            border-radius: 12px;
            background-color: #FFFFFF;
            min-height: 140px;
            max-width: 280px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: border-color 0.2s ease, background-color 0.2s ease;
            text-align: center;
            padding: 16px;
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

        .photo-title {
            font-size: 13.5px;
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

        /* --- Form Bottom Actions --- */
        .form-actions {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 14px;
            margin-top: 26px;
            max-width: 860px;
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
            <h1 class="page-title">Edit Kategori</h1>

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

            <form action="{{ route('kategori.update', $kategori->kategori_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- MAIN CARD -->
                <div class="card-main">
                    <h2 class="section-title">Detail Kategori</h2>

                    <!-- Nama Kategori -->
                    <div class="form-group">
                        <label class="form-label" for="nama_kategori">Nama Kategori</label>
                        <input type="text"
                               id="nama_kategori"
                               name="nama_kategori"
                               class="form-input"
                               placeholder="Contoh: Gamis, Hijab, Pouch..."
                               value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                               required>
                    </div>

                    <!-- Gambar Kategori -->
                    <div class="form-group">
                        <label class="form-label">
                            Gambar / Ikon Kategori
                            <span style="font-weight: 400; font-size: 12px; color: var(--text-muted);">(Klik untuk mengganti, kosongkan jika tidak diubah)</span>
                        </label>
                        @php
                            $hasExisting = !empty($kategori->gambar);
                            $existingUrl = $hasExisting ? asset('assets/image/kategori/' . $kategori->gambar) : '';
                        @endphp
                        <div class="photo-upload-card {{ $hasExisting ? 'has-image' : '' }}" onclick="document.getElementById('input_gambar_kategori').click()">
                            <input type="file"
                                   id="input_gambar_kategori"
                                   name="gambar"
                                   accept="image/*"
                                   style="display: none;"
                                   onchange="previewKategoriPhoto(this)">
                            <img id="preview_kategori"
                                 class="preview-img"
                                 src="{{ $existingUrl }}"
                                 alt="Ikon Kategori"
                                 style="{{ $hasExisting ? 'display: block;' : '' }}">
                            <div class="photo-card-content" id="photoCardContent" style="{{ $hasExisting ? 'display: none;' : '' }}">
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#B79361" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                    <polyline points="21 15 16 10 5 21"></polyline>
                                </svg>
                                <span class="photo-title">Upload Gambar</span>
                                <span class="photo-sub">(Format JPG/PNG max 2MB)</span>
                            </div>
                            <div class="photo-change-overlay">Ganti Gambar</div>
                        </div>
                    </div>
                </div>

                <!-- FORM ACTIONS -->
                <div class="form-actions">
                    <a href="{{ route('kategori.index') }}" class="btn-batal">Batal</a>
                    <button type="submit" class="btn-simpan">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                            <polyline points="17 21 17 13 7 13 7 21"></polyline>
                            <polyline points="7 3 7 8 15 8"></polyline>
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </main>
    </div>

    <script>
        // Toggle User Dropdown
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
            userDropdown.addEventListener('click', (e) => e.stopPropagation());
        }

        // Preview Photo
        function previewKategoriPhoto(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.getElementById('preview_kategori');
                    img.src = e.target.result;
                    img.style.display = 'block';
                    const card = img.closest('.photo-upload-card');
                    card.classList.add('has-image');
                    const content = document.getElementById('photoCardContent');
                    if (content) content.style.display = 'none';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>

