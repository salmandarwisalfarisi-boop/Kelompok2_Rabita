<aside id="admin-sidebar" aria-label="Navigasi admin">
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

        <a href="{{ route('produk.index') }}" class="{{ request()->is('produk*') ? 'on' : '' }}">
            <img src="{{ asset('images/bi_box-seam.svg') }}" alt="Produk">
            <span>Produk</span>
        </a>

        <a href="{{ route('kategori.index') }}" class="{{ request()->is('kategori*') ? 'on' : '' }}">
            <img src="{{ asset('images/reicon_category.svg') }}" alt="Kategori">
            <span>Kategori</span>
        </a>

        <a href="{{ route('pesanan.index') }}" class="{{ request()->is('pesanan*') ? 'on' : '' }}">
            <img src="{{ asset('images/Vector.svg') }}" alt="Pesanan">
            <span>Pesanan</span>
        </a>

        <a href="{{ route('blog.index') }}" class="{{ request()->is('blog*') ? 'on' : '' }}">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                <polyline points="14 2 14 8 20 8"></polyline>
                <line x1="16" y1="13" x2="8" y2="13"></line>
                <line x1="16" y1="17" x2="8" y2="17"></line>
                <polyline points="10 9 9 9 8 9"></polyline>
            </svg>
            <span>Blog</span>
        </a>

        <a href="{{ route('pengguna.index') }}" class="{{ request()->is('pengguna*') ? 'on' : '' }}">
            <img src="{{ asset('assets/image/Vector (1).svg') }}" alt="Pengguna">
            <span>Pengguna</span>
        </a>
    </nav>

</aside>

<script>
    // Anti BFCache / Prevent Back History: Paksa reload ke server saat halaman dibuka dari riwayat Back/Forward
    window.addEventListener('pageshow', function(event) {
        if (event.persisted || (window.performance && (window.performance.navigation.type === 2 || (window
                .performance.getEntriesByType && window.performance.getEntriesByType("navigation")[0]
                ?.type === "back_forward")))) {
            window.location.reload();
        }
    });
</script>
