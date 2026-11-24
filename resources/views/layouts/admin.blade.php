<!DOCTYPE html>
<html lang="id">

<head>
    @yield('head')
</head>

<body>
    <button type="button" class="admin-menu-toggle" id="adminMenuToggle" aria-label="Buka menu admin"
        aria-controls="admin-sidebar" aria-expanded="false">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round">
            <path d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>
    <div class="admin-sidebar-backdrop" id="adminSidebarBackdrop"></div>
    @include('components.admin.sidebar')
    @yield('content')

    <script>
        (function() {
            var toggle = document.getElementById('adminMenuToggle');
            var backdrop = document.getElementById('adminSidebarBackdrop');

            if (!toggle || !backdrop) return;

            function setSidebarOpen(isOpen) {
                document.body.classList.toggle('admin-sidebar-open', isOpen);
                toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                toggle.setAttribute('aria-label', isOpen ? 'Tutup menu admin' : 'Buka menu admin');
            }

            toggle.addEventListener('click', function() {
                setSidebarOpen(!document.body.classList.contains('admin-sidebar-open'));
            });
            backdrop.addEventListener('click', function() {
                setSidebarOpen(false);
            });
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') setSidebarOpen(false);
            });
        })();
    </script>
</body>

</html>
