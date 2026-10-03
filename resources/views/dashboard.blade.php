<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard — Rabita</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;0,700;0,900;1,400;1,700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-sidebar: #191919;
            --bg-content: #f9f6f1;
            --accent-gold: #dec096;
            --accent-gold-solid: #ccb694;
            --sidebar-active: #b79361;
            --text-dark: #161716;
            --text-white: #ffffff;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Lato', sans-serif;
        }

        html, body {
            height: 100%;
            width: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: var(--bg-content);
            color: var(--text-dark);
        }

        /* Dashboard Layout */
        .dashboard-container {
            display: flex;
            width: 100%;
            height: 100vh;
            max-height: 100vh;
            overflow: hidden;
            background-color: var(--bg-content);
        }

        .sidebar {
            width: 207px;
            min-width: 207px;
            height: 100vh;
            background-color: var(--bg-sidebar);
            display: flex;
            flex-direction: column;
            position: relative;
            z-index: 10;
            overflow: hidden;
        }

        .sidebar-header {
            padding: 24px 16px 16px 16px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .sidebar-header img {
            width: 110px;
            height: auto;
            display: block;
        }

        .sidebar-divider {
            height: 1px;
            background-color: rgba(255, 255, 255, 0.12);
            margin: 0 14px 18px 14px;
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 6px;
            padding: 0 12px;
            flex: 1;
            position: relative;
            z-index: 2;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            text-decoration: none;
            color: var(--text-white);
            font-size: 15px;
            font-weight: 400;
            border-radius: 6px;
            background: transparent;
            transition: background-color 0.2s, color 0.2s;
        }

        .nav-item svg {
            width: 19px;
            height: 19px;
            stroke: currentColor;
            stroke-width: 1.8;
            fill: none;
            flex-shrink: 0;
        }

        .nav-item:hover:not(.active) {
            background-color: rgba(255, 255, 255, 0.05);
            color: var(--accent-gold);
        }

        .nav-item.active {
            background-color: var(--sidebar-active);
            color: var(--text-white);
            font-weight: 500;
        }

        .sidebar-batik {
            position: absolute;
            bottom: -20px;
            left: -20px;
            width: 190px;
            height: 190px;
            pointer-events: none;
            opacity: 0.13;
            z-index: 1;
        }

        .sidebar-batik img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .sidebar-footer {
            margin-top: auto;
            padding: 16px 12px;
            position: relative;
            z-index: 2;
        }

        .logout-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            padding: 8px 12px;
            background: transparent;
            border: 1px solid rgba(222, 192, 150, 0.2);
            border-radius: 6px;
            color: var(--accent-gold);
            font-size: 13px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .logout-btn:hover {
            background: rgba(222, 192, 150, 0.1);
            border-color: var(--accent-gold);
        }

        .main-content {
            flex: 1;
            background-color: var(--bg-content);
            height: 100vh;
            overflow-y: auto;
            padding: 30px;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
<div class="dashboard-container">

    <!-- Sidebar Kiri -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('assets/image/Logo.svg') }}" alt="Rabita">
            </a>
        </div>
        <div class="sidebar-divider"></div>

        <nav class="sidebar-nav">
            <a href="{{ route('dashboard') }}" class="nav-item active">
                <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
                <span>Dashboard</span>
            </a>

            <a href="#" class="nav-item">
                <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                    <line x1="12" y1="22.08" x2="12" y2="12"></line>
                </svg>
                <span>Produk</span>
            </a>

            <a href="#" class="nav-item">
                <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="7" height="7"></rect>
                    <rect x="14" y="3" width="7" height="7"></rect>
                    <rect x="14" y="14" width="7" height="7"></rect>
                    <rect x="3" y="14" width="7" height="7"></rect>
                </svg>
                <span>Kategori</span>
            </a>

            <a href="#" class="nav-item">
                <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                    <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                    <line x1="9" y1="12" x2="15" y2="12"></line>
                    <line x1="9" y1="16" x2="15" y2="16"></line>
                </svg>
                <span>Pesanan</span>
            </a>

            <a href="#" class="nav-item">
                <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
                <span>Pengguna</span>
            </a>
        </nav>

        <!-- Batik Decorative -->
        <div class="sidebar-batik">
            <img src="{{ asset('assets/image/batikloginform.png') }}" alt="">
        </div>

        <!-- Logout -->
        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Konten Utama Kanan -->
    <main class="main-content">
        <!-- Konten dashboard diletakkan di sini -->
        <h2 style="color: var(--text-dark); font-weight: 700; font-size: 24px; margin-bottom: 8px;">
            Selamat datang, {{ Auth::user()->name ?? 'Admin' }}!
        </h2>
        <p style="color: #666; font-size: 15px;">
            Ini adalah halaman dashboard Rabita. Kelola produk, kategori, pesanan, dan pengguna dari sini.
        </p>
    </main>

</div>
</body>
</html>
