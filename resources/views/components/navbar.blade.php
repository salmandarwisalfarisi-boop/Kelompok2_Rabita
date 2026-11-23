<style>
    /* --- Navbar Reusable Component Styles --- */
    .navbar-wrap {
        background-color: #1A1A1A;
        height: 76px;
        display: flex;
        align-items: center;
        position: sticky;
        top: 0;
        z-index: 1000;
        font-family: "Plus Jakarta Sans", sans-serif;
    }

    .navbar-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        max-width: 1440px;
        margin: 0 auto;
        padding: 0 clamp(16px, 5.8vw, 88px);
        box-sizing: border-box;
        position: relative;
    }

    .navbar-brand-logo {
        display: inline-flex;
        align-items: center;
        text-decoration: none;
        z-index: 2;
    }

    .navbar-brand-logo img {
        height: 70px;
        width: auto;
        object-fit: contain;
        display: block;
    }

    .navbar-nav-center {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1;
    }

    .navbar-menu {
        display: flex;
        align-items: center;
        gap: 32px;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .navbar-menu a {
        font-family: "Lato", sans-serif;
        font-size: 16px;
        font-weight: 500;
        color: #A5A29B;
        text-decoration: none;
        line-height: normal;
        transition: color 0.15s ease;
    }

    .navbar-menu a.active,
    .navbar-menu a:hover {
        color: #DEC096;
    }

    .navbar-actions {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .nav-icon-btn {
        background: transparent;
        border: none;
        color: #FFFFFF;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 4px;
        text-decoration: none;
        transition: color 0.15s ease;
    }

    .nav-icon-btn:hover {
        color: #B79361;
    }

    .nav-icon-btn svg {
        width: 22px;
        height: 22px;
        display: block;
    }

    .nav-login-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #B79361;
        border-radius: 4px;
        padding: 8px 28px;
        font-family: "Lato", sans-serif;
        color: #B79361;
        font-size: 16px;
        font-weight: 500;
        line-height: normal;
        text-decoration: none;
        background: transparent;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .nav-login-btn:hover {
        background-color: #B79361;
        color: #1A1A1A;
    }

    @media (max-width: 820px) {
        .navbar-menu {
            display: none;
        }
        .navbar-wrap {
            height: 68px;
        }
        .navbar-brand-logo img {
            height: 42px;
        }
    }
</style>

<header class="navbar-wrap">
    <div class="navbar-content">
        <!-- Logo Kiri -->
        <a href="{{ route('home') }}" class="navbar-brand-logo">
            <img src="{{ asset('assets/image/Logo.svg') }}" alt="Rabita">
        </a>

        <!-- Menu Tengah Terkunci Presisi di Tengah (Absolute Center) -->
        <nav class="navbar-nav-center">
            <ul class="navbar-menu">
                <li>
                    <a href="{{ route('beranda') }}" class="{{ request()->routeIs('home', 'beranda') ? 'active' : '' }}">
                        Beranda
                    </a>
                </li>
                <li>
                    <a href="{{ route('tentang') }}" class="{{ request()->routeIs('tentang') ? 'active' : '' }}">
                        Tentang
                    </a>
                </li>
                <li>
                    <a href="{{ route('blog.public') }}" class="{{ request()->routeIs('blog.public', 'blogs*', 'blog.show.public') ? 'active' : '' }}">
                        Blog
                    </a>
                </li>
                <li>
                    <a href="{{ route('katalog') }}" class="{{ request()->routeIs('katalog*', 'detail*') ? 'active' : '' }}">
                        Produk
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Aksi Kanan -->
        <div class="navbar-actions">
            <!-- Search Icon -->
            <a href="{{ route('katalog') }}" class="nav-icon-btn" aria-label="Cari">
                <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14.4768 15.8774C12.697 17.2995 10.4403 17.9861 8.17014 17.7962C5.89997 17.6063 3.78867 16.5543 2.26988 14.8563C0.751086 13.1582 -0.0599119 10.9431 0.00345188 8.6657C0.0668156 6.38835 0.999731 4.2217 2.61059 2.61074C4.22145 0.999788 6.38798 0.0668195 8.6652 0.00345208C10.9424 -0.0599153 13.1575 0.751129 14.8554 2.27001C16.5534 3.78889 17.6053 5.90031 17.7952 8.17061C17.9851 10.4409 17.2985 12.6978 15.8765 14.4776L22.6848 21.285C22.7821 21.3757 22.8601 21.485 22.9143 21.6065C22.9684 21.728 22.9975 21.8591 22.9998 21.9921C23.0022 22.1251 22.9777 22.2572 22.9279 22.3805C22.8781 22.5038 22.804 22.6159 22.7099 22.7099C22.6159 22.804 22.5039 22.8781 22.3806 22.9279C22.2572 22.9777 22.1252 23.0022 21.9922 22.9998C21.8592 22.9975 21.7281 22.9684 21.6066 22.9143C21.4851 22.8601 21.3758 22.7821 21.2851 22.6848L14.4768 15.8774ZM4.01084 13.8147C3.04168 12.8454 2.3816 11.6105 2.11402 10.2662C1.84644 8.92177 1.98337 7.52823 2.50751 6.26166C3.03165 4.99509 3.91948 3.91233 5.05878 3.15022C6.19808 2.38811 7.53772 1.98086 8.90839 1.97993C10.2791 1.97901 11.6193 2.38446 12.7596 3.14503C13.8999 3.90561 14.7892 4.98717 15.315 6.25304C15.8409 7.51891 15.9797 8.91226 15.7139 10.257C15.4481 11.6017 14.7897 12.8375 13.8219 13.8081L13.8153 13.8147L13.8087 13.82C12.5081 15.1176 10.7458 15.8459 8.90866 15.8449C7.07156 15.8439 5.30997 15.1137 4.01084 13.8147Z" fill-rule="evenodd" clip-rule="evenodd" fill="currentColor"/>
                </svg>
            </a>

            <!-- Shopping Bag Icon -->
            <a href="{{ route('keranjang') }}" class="nav-icon-btn" aria-label="Tas Belanja">
                <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 0.75C0 0.551088 0.0790176 0.360322 0.21967 0.21967C0.360322 0.0790176 0.551088 0 0.75 0H3C3.1673 4.62172e-05 3.32978 0.056026 3.4616 0.159037C3.59342 0.262048 3.68701 0.406176 3.7275 0.5685L4.335 3H21.75C21.8601 3.0001 21.9689 3.02445 22.0685 3.07133C22.1682 3.1182 22.2563 3.18644 22.3266 3.27121C22.3969 3.35597 22.4477 3.45518 22.4753 3.56178C22.5029 3.66838 22.5068 3.77976 22.4865 3.888L20.2365 15.888C20.2043 16.0599 20.1131 16.2151 19.9786 16.3268C19.8442 16.4386 19.6749 16.4998 19.5 16.5H6C5.82515 16.4998 5.65585 16.4386 5.52137 16.3268C5.38688 16.2151 5.29567 16.0599 5.2635 15.888L3.015 3.9105L2.415 1.5H0.75C0.551088 1.5 0.360322 1.42098 0.21967 1.28033C0.0790176 1.13968 0 0.948912 0 0.75ZM4.653 4.5L6.6225 15H18.8775L20.847 4.5H4.653ZM7.5 16.5C6.70435 16.5 5.94129 16.8161 5.37868 17.3787C4.81607 17.9413 4.5 18.7044 4.5 19.5C4.5 20.2956 4.81607 21.0587 5.37868 21.6213C5.94129 22.1839 6.70435 22.5 7.5 22.5C8.29565 22.5 9.05871 22.1839 9.62132 21.6213C10.1839 21.0587 10.5 20.2956 10.5 19.5C10.5 18.7044 10.1839 17.9413 9.62132 17.3787C9.05871 16.8161 8.29565 16.5 7.5 16.5ZM18 16.5C17.2044 16.5 16.4413 16.8161 15.8787 17.3787C15.3161 17.9413 15 18.7044 15 19.5C15 20.2956 15.3161 21.0587 15.8787 21.6213C16.4413 22.1839 17.2044 22.5 18 22.5C18.7957 22.5 19.5587 22.1839 20.1213 21.6213C20.6839 21.0587 21 20.2956 21 19.5C21 18.7044 20.6839 17.9413 20.1213 17.3787C19.5587 16.8161 18.7957 16.5 18 16.5ZM7.5 18C7.89783 18 8.27936 18.158 8.56066 18.4393C8.84196 18.7206 9 19.1022 9 19.5C9 19.8978 8.84196 20.2794 8.56066 20.5607C8.27936 20.842 7.89783 21 7.5 21C7.10218 21 6.72065 20.842 6.43934 20.5607C6.15804 20.2794 6 19.8978 6 19.5C6 19.1022 6.15804 18.7206 6.43934 18.4393C6.72065 18.158 7.10218 18 7.5 18ZM18 18C18.3978 18 18.7794 18.158 19.0607 18.4393C19.342 18.7206 19.5 19.1022 19.5 19.5C19.5 19.8978 19.342 20.2794 19.0607 20.5607C18.7794 20.842 18.3978 21 18 21C17.6022 21 17.2206 20.842 16.9393 20.5607C16.658 20.2794 16.5 19.8978 16.5 19.5C16.5 19.1022 16.658 18.7206 16.9393 18.4393C17.2206 18.158 17.6022 18 18 18Z" fill="currentColor"/>
                </svg>
            </a>
            @auth
                @if(Auth::user()->level === 'admin')
                    <a href="{{ route('dashboard') }}" class="nav-login-btn">Dashboard</a>
                @else
                    <div class="nav-user-wrapper" style="position:relative;display:inline-block;">
                        <button type="button" id="navUserMenuBtn" class="nav-user-btn" style="display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,0.08);border:1px solid rgba(201,166,107,0.4);border-radius:24px;padding:6px 14px;color:#fff;font-family:'Plus Jakarta Sans',sans-serif;font-size:13px;font-weight:500;cursor:pointer;transition:all 0.2s;">
                            <span style="width:24px;height:24px;border-radius:50%;background:#C9A66B;color:#151515;display:inline-flex;align-items:center;justify-content:center;font-weight:700;font-size:11px;">
                                {{ strtoupper(substr(Auth::user()->username ?? 'U', 0, 1)) }}
                            </span>
                            <span>{{ Auth::user()->username ?? 'Akun Saya' }}</span>
                            <svg id="navUserChevron" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="transition:transform 0.2s;"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </button>
                        <div id="navUserDropdown" class="nav-user-dropdown" style="display:none;position:absolute;right:0;top:calc(100% + 8px);width:210px;background:#1E1E1E;border:1px solid rgba(201,166,107,0.3);border-radius:12px;box-shadow:0 10px 25px rgba(0,0,0,0.5);padding:8px 0;z-index:9999;">
                            <div style="padding:8px 16px 10px;border-bottom:1px solid rgba(255,255,255,0.08);">
                                <div style="font-size:11px;color:#888;">Login sebagai:</div>
                                <div style="font-size:13px;font-weight:600;color:#fff;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ Auth::user()->username }}</div>
                                <div style="font-size:11px;color:#C9A66B;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ Auth::user()->email }}</div>
                            </div>
                            <a href="{{ route('pesanan.user.index') }}" style="display:flex;align-items:center;gap:10px;padding:10px 16px;color:#E0E0E0;font-size:13px;text-decoration:none;transition:background 0.15s;" onmouseover="this.style.background='rgba(201,166,107,0.15)';this.style.color='#C9A66B'" onmouseout="this.style.background='transparent';this.style.color='#E0E0E0'">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                                <span>Pesanan Saya</span>
                            </a>
                            <div style="height:1px;background:rgba(255,255,255,0.08);margin:4px 0;"></div>
                            <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                                @csrf
                                <button type="submit" style="display:flex;align-items:center;gap:10px;width:100%;padding:10px 16px;background:transparent;border:none;color:#EF4444;font-size:13px;font-family:'Plus Jakarta Sans',sans-serif;cursor:pointer;text-align:left;transition:background 0.15s;" onmouseover="this.style.background='rgba(239,68,68,0.1)'" onmouseout="this.style.background='transparent'">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                                    <span>Keluar</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            @else
                <a href="{{ route('login') }}" class="nav-login-btn">Login</a>
            @endauth
        </div>
    </div>
</header>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var navUserBtn = document.getElementById('navUserMenuBtn');
    var navUserDropdown = document.getElementById('navUserDropdown');
    var navUserChevron = document.getElementById('navUserChevron');

    if (navUserBtn && navUserDropdown) {
        navUserBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            var isOpen = navUserDropdown.style.display === 'block';
            navUserDropdown.style.display = isOpen ? 'none' : 'block';
            if (navUserChevron) {
                navUserChevron.style.transform = isOpen ? 'rotate(0deg)' : 'rotate(180deg)';
            }
        });

        document.addEventListener('click', function(e) {
            if (!navUserBtn.contains(e.target) && !navUserDropdown.contains(e.target)) {
                navUserDropdown.style.display = 'none';
                if (navUserChevron) navUserChevron.style.transform = 'rotate(0deg)';
            }
        });
    }
});
</script>
