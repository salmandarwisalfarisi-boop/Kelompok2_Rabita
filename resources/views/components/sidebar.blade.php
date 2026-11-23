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
        font-size: 16px;
        font-weight: 400;
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

        <a href="{{ route('kategori.index') }}"
           class="{{ request()->is('kategori*') ? 'on' : '' }}">
            <img src="{{ asset('images/reicon_category.svg') }}" alt="Kategori">
            <span>Kategori</span>
        </a>

        <a href="{{ route('pesanan.index') }}"
           class="{{ request()->is('pesanan*') ? 'on' : '' }}">
            <img src="{{ asset('images/Vector.svg') }}" alt="Pesanan">
            <span>Pesanan</span>
        </a>

        <a href="{{ route('blog.index') }}"
           class="{{ request()->is('blog*') ? 'on' : '' }}">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                <polyline points="14 2 14 8 20 8"></polyline>
                <line x1="16" y1="13" x2="8" y2="13"></line>
                <line x1="16" y1="17" x2="8" y2="17"></line>
                <polyline points="10 9 9 9 8 9"></polyline>
            </svg>
            <span>Blog</span>
        </a>

        <a href="{{ route('pengguna.index') }}"
           class="{{ request()->is('pengguna*') ? 'on' : '' }}">
            <img src="{{ asset('assets/image/Vector (1).svg') }}" alt="Pengguna">
            <span>Pengguna</span>
        </a>
    </nav>

</aside>

<script>
    // Anti BFCache / Prevent Back History: Paksa reload ke server saat halaman dibuka dari riwayat Back/Forward
    window.addEventListener('pageshow', function (event) {
        if (event.persisted || (window.performance && (window.performance.navigation.type === 2 || (window.performance.getEntriesByType && window.performance.getEntriesByType("navigation")[0]?.type === "back_forward")))) {
            window.location.reload();
        }
    });
</script>
