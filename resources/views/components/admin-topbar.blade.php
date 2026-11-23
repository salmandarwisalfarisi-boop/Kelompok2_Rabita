<style>
    /* ===== Admin Topbar Component Styles ===== */
    .topbar {
        height: 83px;
        background-color: var(--dark-header, #191919);
        display: flex;
        align-items: center;
        justify-content: flex-end;
        padding: 0 34px;
        position: sticky;
        top: 0;
        z-index: 90;
        border-bottom: 1px solid #B79361;
        gap: 12px;
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
        background-color: var(--gold, #B79361);
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
        color: var(--gold, #B79361);
    }

    .user-chevron {
        color: var(--gold, #B79361);
        transition: transform 0.2s ease;
        margin-left: 2px;
    }

    /* Dropdown Menu */
    .user-dropdown {
        position: absolute;
        right: 0;
        top: calc(100% + 8px);
        min-width: 210px;
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

    /* Link item (Pengaturan) */
    .dropdown-item-link {
        display: flex;
        align-items: center;
        gap: 10px;
        width: 100%;
        padding: 10px 16px;
        border: none;
        background: transparent;
        font-size: 13px;
        font-family: 'Lato', sans-serif;
        color: #1A1A1A;
        cursor: pointer;
        text-decoration: none;
        transition: background-color 0.15s ease;
    }

    .dropdown-item-link:hover {
        background-color: #F5F3EE;
        color: #B79361;
    }

    .dropdown-item-link svg {
        color: #B79361;
        flex-shrink: 0;
    }

    /* Keluar (merah) */
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
        border-top: 1px solid #F0F0F0;
        margin-top: 4px;
    }

    .dropdown-item:hover {
        background-color: #FEF2F2;
    }
</style>

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
                <span class="user-name">{{ Auth::user()->username ?? Auth::user()->name ?? 'Admin' }}</span>
                <span class="user-role">{{ ucfirst(Auth::user()->level ?? 'Administrator') }}</span>
            </span>
            <svg class="user-chevron" id="userPillChevron" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="6 9 12 15 18 9"></polyline>
            </svg>
        </button>

        <div class="user-dropdown" id="userDropdown">
            <div class="dropdown-user-info">
                <p>Login sebagai:</p>
                <b>{{ Auth::user()->username ?? Auth::user()->name ?? 'Admin' }}</b>
                <span style="font-size: 11px; color: var(--gold, #B79361);">{{ Auth::user()->email ?? 'admin@rabita.com' }}</span>
            </div>

            {{-- Link Pengaturan --}}
            <a href="{{ route('admin.pengaturan') }}" class="dropdown-item-link">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="3"></circle>
                    <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                </svg>
                Pengaturan
            </a>

            {{-- Tombol Keluar --}}
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

<script>
    (function () {
        const userBtn = document.getElementById('userPillBtn');
        const userDropdown = document.getElementById('userDropdown');
        const userChevron = document.getElementById('userPillChevron');

        if (userBtn && userDropdown) {
            userBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                const isShown = userDropdown.classList.contains('show');
                userDropdown.classList.toggle('show', !isShown);
                if (userChevron) {
                    userChevron.style.transform = isShown ? 'rotate(0deg)' : 'rotate(180deg)';
                }
            });

            document.addEventListener('click', function () {
                userDropdown.classList.remove('show');
                if (userChevron) userChevron.style.transform = 'rotate(0deg)';
            });
        }
    })();
</script>