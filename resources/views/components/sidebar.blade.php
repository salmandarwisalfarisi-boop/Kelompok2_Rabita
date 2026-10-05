<style>
    /* --- Sidebar Shared Styles --- */
    aside {
        width: 206px;
        flex: none;
        background-color: #191919;
        color: #FFFFFF;
        font-family: Lato, "Segoe UI", Arial, sans-serif;
        position: sticky;
        top: 0;
        height: 100vh;
        display: flex;
        flex-direction: column;
        z-index: 100;
    }

    .sidebar-logo {
        height: 83px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-bottom: 1px solid #DEC096;
    }

    .sidebar-logo img {
        height: 79px;
    }

    .sidebar-nav {
        padding: 28px 18px;
        display: flex;
        flex-direction: column;
        gap: 8px;
        flex: 1;
    }

    .sidebar-nav a {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 0 10px;
        height: 37px;
        border-radius: 5px;
        color: #FFFFFF;
        text-decoration: none;
        font-size: 16.5px;
        font-family: Lato, "Segoe UI", Arial, sans-serif;
        transition: all 0.2s ease;
    }

    .sidebar-nav a:hover {
        background-color: #DEC096;
        color: #FFFFFF;
    }

    .sidebar-nav a.on {
        background-color: #B79361;
    }

    .sidebar-nav a.on:hover {
        background-color: #B79361;
    }

    .sidebar-nav svg,
    .sidebar-nav img {
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
        color: #DEC096;
        font-family: Lato, "Segoe UI", Arial, sans-serif;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .sidebar-logout button:hover {
        background: rgba(222, 192, 150, 0.15);
        border-color: #DEC096;
    }

    @media (max-width: 760px) {
        aside {
            width: 100%;
            height: auto;
            position: static;
        }

        .sidebar-logo {
            height: 64px;
        }

        .sidebar-nav {
            flex-direction: row;
            overflow-x: auto;
            padding: 10px;
        }

        .sidebar-nav a {
            font-size: 14px;
            white-space: nowrap;
        }
    }
</style>

<aside>
    <div class="sidebar-logo">
        <a href="{{ route('dashboard') }}" style="display:flex;align-items:center;justify-content:center;">
            <img alt="Rabita" src="{{ asset('assets/image/Logo.svg') }}">
        </a>
    </div>

    <nav class="sidebar-nav">
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'on' : '' }}">
            <img src="{{ asset('images/famicons_home-outline.svg') }}" alt="Dashboard">
            <span>Dashboard</span>
        </a>

        <a href="{{ route('produk.index') }}"
           class="{{ request()->is('produk*') ? 'on' : '' }}">
            <img src="{{ asset('images/bi_box-seam.svg') }}" alt="Produk">
            <span>Produk</span>
        </a>

        <a href="#">
            <img src="{{ asset('images/reicon_category.svg') }}" alt="Kategori">
            <span>Kategori</span>
        </a>

        <a href="#">
            <img src="{{ asset('images/Vector.svg') }}" alt="Pesanan">
            <span>Pesanan</span>
        </a>

        <a href="#">
            <img src="{{ asset('images/Vector (1).svg') }}" alt="Pengguna">
            <span>Pengguna</span>
        </a>
    </nav>

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

<script>
    // Anti BFCache / Prevent Back History: Paksa reload ke server saat halaman dibuka dari riwayat Back/Forward
    window.addEventListener('pageshow', function (event) {
        if (event.persisted || (window.performance && (window.performance.navigation.type === 2 || (window.performance.getEntriesByType && window.performance.getEntriesByType("navigation")[0]?.type === "back_forward")))) {
            window.location.reload();
        }
    });
</script>
