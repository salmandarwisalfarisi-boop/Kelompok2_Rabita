<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pengaturan Pembayaran & QRIS – Rabita</title>
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
            --border-dashed: #C4BAAF;
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
            font-family: 'Inter', sans-serif;
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

        .page-header {
            margin-bottom: 24px;
        }

        .page-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-dark);
            line-height: 1.2;
        }

        .page-subtitle {
            font-size: 13.5px;
            color: var(--text-muted);
            margin-top: 4px;
        }

        /* Alerts */
        .alert-success {
            background-color: #ECFDF5;
            color: #065F46;
            border: 1px solid #A7F3D0;
            padding: 14px 20px;
            border-radius: 10px;
            margin-bottom: 24px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-error {
            background-color: #FEF2F2;
            color: #991B1B;
            border: 1px solid #FECACA;
            padding: 14px 20px;
            border-radius: 10px;
            margin-bottom: 24px;
            font-size: 14px;
        }

        /* Main Grid & Cards */
        .settings-grid {
            display: grid;
            grid-template-columns: 1fr 1.3fr;
            gap: 24px;
            align-items: start;
        }

        .card-main {
            background: var(--card-bg);
            border-radius: 16px;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.04);
            border: 1px solid var(--border-light);
            padding: 28px;
        }

        .card-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-desc {
            font-size: 13px;
            color: var(--text-muted);
            margin-bottom: 20px;
            line-height: 1.5;
        }

        /* QR Preview Container (Left Card) */
        .qr-display-box {
            background-color: #FAFAF7;
            border: 1px solid #EBE7E0;
            border-radius: 12px;
            padding: 24px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .qr-image-wrapper {
            width: 220px;
            height: 220px;
            background: #FFFFFF;
            border-radius: 12px;
            padding: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            border: 1px solid #E5E7EB;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
        }

        .qr-image-wrapper img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            border-radius: 6px;
            display: block;
        }

        .qr-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 12px;
            border-radius: 9999px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-active {
            background-color: #ECFDF5;
            color: #059669;
            border: 1px solid #A7F3D0;
        }

        .badge-inactive {
            background-color: #FEF3C7;
            color: #D97706;
            border: 1px solid #FDE68A;
        }

        .qr-info-note {
            margin-top: 18px;
            padding: 12px 16px;
            border-radius: 10px;
            background-color: #FFFFFF;
            border: 1px solid #EAE6DE;
            font-size: 12px;
            color: #555555;
            line-height: 1.5;
            display: flex;
            gap: 10px;
            align-items: flex-start;
        }

        /* Upload Area (Right Card) */
        .photo-upload-card {
            border: 2px dashed var(--border-dashed);
            border-radius: 14px;
            background-color: #FAFAF7;
            min-height: 220px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: all 0.2s ease;
            text-align: center;
            padding: 24px;
        }

        .photo-upload-card:hover {
            border-color: var(--gold);
            background-color: #F5F2EB;
        }

        .photo-upload-card.has-image {
            border-style: solid;
            border-color: #E5E7EB;
            background-color: #FFFFFF;
            padding: 0;
        }

        .photo-upload-card img.preview-img {
            width: 100%;
            height: 100%;
            max-height: 240px;
            object-fit: contain;
            display: none;
            padding: 16px;
        }

        .photo-upload-card.has-image img.preview-img {
            display: block;
        }

        .photo-card-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            z-index: 2;
            pointer-events: none;
        }

        .photo-card-content svg {
            color: var(--gold);
        }

        .photo-title {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-dark);
        }

        .photo-sub {
            font-size: 12px;
            color: var(--text-muted);
        }

        .photo-change-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
            color: #FFFFFF;
            font-size: 13px;
            font-weight: 600;
            display: none;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(2px);
            z-index: 10;
        }

        .photo-upload-card.has-image:hover .photo-change-overlay {
            display: flex;
        }

        /* Buttons */
        .btn-submit {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            background-color: var(--gold);
            color: #FFFFFF;
            border: none;
            padding: 14px 24px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.2s ease, transform 0.1s ease;
        }

        .btn-submit:hover {
            background-color: var(--gold-hover);
        }

        .btn-submit:active {
            transform: scale(0.99);
        }

        @media (max-width: 992px) {
            .settings-grid {
                grid-template-columns: 1fr;
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

                    <a href="{{ route('admin.pengaturan') }}" style="display: flex; align-items: center; gap: 10px; width: 100%; padding: 10px 16px; border: none; background: transparent; font-size: 13px; font-family: 'Inter', sans-serif; color: var(--gold); font-weight: 600; cursor: pointer; text-decoration: none; transition: background-color 0.15s ease;">
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

        <!-- MAIN BODY -->
        <main>
            <!-- Title -->
            <div class="page-header">
                <h1 class="page-title">Pengaturan Pembayaran & QRIS</h1>
                <p class="page-subtitle">Kelola foto kode QRIS yang akan ditampilkan kepada pelanggan saat checkout pembayaran</p>
            </div>

            {{-- Flash Alert Sukses --}}
            @if(session('success'))
                <div class="alert-success">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                    <span><strong>Berhasil!</strong> {{ session('success') }}</span>
                </div>
            @endif

            {{-- Flash Alert Error Validasi --}}
            @if($errors->any())
                <div class="alert-error">
                    <p style="font-weight: 600; margin-bottom: 4px;">Gagal mengunggah QRIS:</p>
                    <ul style="padding-left: 20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- 2-Column Grid -->
            <div class="settings-grid">
                
                <!-- Sisi Kiri: Tampilan QRIS Saat Ini -->
                <div class="card-main">
                    <h2 class="card-title">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="7" height="7"></rect>
                            <rect x="14" y="3" width="7" height="7"></rect>
                            <rect x="14" y="14" width="7" height="7"></rect>
                            <rect x="3" y="14" width="7" height="7"></rect>
                        </svg>
                        QRIS Aktif Saat Ini
                    </h2>
                    <p class="card-desc">Ini adalah kode QRIS yang sedang aktif digunakan di sistem toko online.</p>

                    <div class="qr-display-box">
                        <div class="qr-image-wrapper">
                            @if(!empty($qrPath))
                                <img src="{{ $qrPath }}?t={{ time() }}" alt="QRIS Toko Rabita">
                            @else
                                <div style="display:flex; flex-direction:column; align-items:center; gap:8px; color:#A8A29E;">
                                    <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="3" width="7" height="7"></rect>
                                        <rect x="14" y="3" width="7" height="7"></rect>
                                        <rect x="14" y="14" width="7" height="7"></rect>
                                        <rect x="3" y="14" width="7" height="7"></rect>
                                    </svg>
                                    <span style="font-size:12px;">Belum Ada QRIS</span>
                                </div>
                            @endif
                        </div>

                        @if(!empty($qrPath))
                            <span class="qr-badge badge-active">
                                <span style="width:7px; height:7px; background:#10B981; border-radius:50%; display:inline-block;"></span>
                                QRIS Terpasang & Aktif
                            </span>
                        @else
                            <span class="qr-badge badge-inactive">
                                <span style="width:7px; height:7px; background:#F59E0B; border-radius:50%; display:inline-block;"></span>
                                Belum Ada Foto QRIS
                            </span>
                        @endif
                    </div>

                    <div class="qr-info-note">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#B79361" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0; margin-top:2px;">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="16" x2="12" y2="12"></line>
                            <line x1="12" y1="8" x2="12.01" y2="8"></line>
                        </svg>
                        <span>QRIS ini akan langsung otomatis popup saat mereka pencet checkout.</span>
                    </div>
                </div>

                <!-- Sisi Kanan: Form Upload QRIS Baru -->
                <div class="card-main">
                    <h2 class="card-title">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="17 8 12 3 7 8"></polyline>
                            <line x1="12" y1="3" x2="12" y2="15"></line>
                        </svg>
                        Unggah / Perbarui Foto QRIS
                    </h2>
                    <p class="card-desc">Pilih file foto QR Code terbaru toko Anda untuk menggantikan yang lama.</p>

                    <form action="{{ route('admin.pengaturan.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Card Upload Interaktif -->
                        <div class="photo-upload-card" id="qrisUploadCard" onclick="document.getElementById('input_qris').click()">
                            <input type="file" id="input_qris" name="qris" accept="image/png, image/jpeg, image/jpg, image/svg+xml" style="display: none;" onchange="previewQRIS(this)">
                            
                            <img id="preview_qris" class="preview-img" alt="Pratinjau QRIS Baru">
                            
                            <div class="photo-card-content" id="uploadPlaceholder">
                                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="17 8 12 3 7 8"></polyline>
                                    <line x1="12" y1="3" x2="12" y2="15"></line>
                                </svg>
                                <span class="photo-title">Klik untuk memilih file QRIS</span>
                                <span class="photo-sub">Format: PNG, JPG, JPEG, SVG (Maks. 2MB)</span>
                            </div>

                            <div class="photo-change-overlay">
                                <span>Klik untuk ganti file</span>
                            </div>
                        </div>

                        <!-- Tombol Submit -->
                        <button type="submit" class="btn-submit">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                                <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                <polyline points="7 3 7 8 15 8"></polyline>
                            </svg>
                            Simpan & Perbarui QRIS
                        </button>
                    </form>
                </div>

            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script>
        // Dropdown Profil Admin
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

        // Real-time Preview Upload QRIS
        function previewQRIS(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.getElementById('preview_qris');
                    const card = document.getElementById('qrisUploadCard');
                    const placeholder = document.getElementById('uploadPlaceholder');

                    img.src = e.target.result;
                    card.classList.add('has-image');
                    if (placeholder) placeholder.style.display = 'none';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>
