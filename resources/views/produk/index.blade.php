<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Produk - Rabita Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #F5F5F0;
            --card: #FFFFFF;
            --gold: #B79361;
            --gold-light: #DEC096;
            --dark-sidebar: #191919;
            --tx: #1A1A1A;
            --tx-mid: #555555;
            --mut: #888888;
            --mut-light: #AAAAAA;
            --placeholder: #BBBBBB;
            --ln: #F0EDE8;
            --border: #E8E2D9;
            --footer-bg: #FAFAF8;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Inter, Arial, sans-serif;
            background: var(--bg);
            color: var(--tx);
            display: flex;
            min-height: 100vh;
        }

        /* ================================
           SIDEBAR
        ================================ */
        aside {
            width: 206px;
            flex: none;
            background: var(--dark-sidebar);
            color: #fff;
            position: sticky;
            top: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .lg {
            height: 83px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-bottom: 1px solid var(--gold-light);
        }

        .lg img {
            height: 79px;
        }

        nav {
            padding: 28px 18px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            flex: 1;
        }

        nav a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 10px;
            height: 37px;
            border-radius: 5px;
            color: #fff;
            text-decoration: none;
            font-size: 16.5px;
            transition: all .2s;
        }

        nav a:hover {
            background: var(--gold-light);
        }

        nav a.on {
            background: var(--gold);
        }

        nav img {
            width: 22px;
            height: 22px;
        }

        .sidebar-logout {
            padding: 18px;
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
            border: 1px solid rgba(222, 192, 150, .3);
            border-radius: 5px;
            background: transparent;
            color: var(--gold-light);
            font-size: 14px;
            cursor: pointer;
            transition: all .2s;
        }

        .sidebar-logout button:hover {
            background: rgba(222, 192, 150, .15);
        }

        /* ================================
           MAIN
        ================================ */
        main {
            flex: 1;
            padding: 28px 32px 40px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* --- Page Title --- */
        .page-title h1 {
            font-size: 22px;
            font-weight: 700;
            color: var(--tx);
        }

        .page-title p {
            font-size: 13px;
            color: var(--mut);
            margin-top: 3px;
        }

        /* --- Toolbar (search, filter, add) --- */
        .toolbar {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .search-wrap {
            position: relative;
            flex: 0 0 260px;
        }

        .search-wrap svg {
            position: absolute;
            left: 11px;
            top: 50%;
            transform: translateY(-50%);
            width: 16px;
            height: 16px;
            color: var(--placeholder);
        }

        .search-wrap input {
            width: 100%;
            padding: 9px 14px 9px 34px;
            border: 1.5px solid var(--border);
            border-radius: 6px;
            font-size: 13px;
            font-family: Inter, Arial, sans-serif;
            background: var(--card);
            color: var(--tx);
            outline: none;
            transition: border .2s;
        }

        .search-wrap input::placeholder {
            color: var(--placeholder);
        }

        .search-wrap input:focus {
            border-color: var(--gold);
        }

        .toolbar select {
            padding: 9px 32px 9px 12px;
            border: 1.5px solid var(--border);
            border-radius: 6px;
            font-size: 13px;
            font-family: Inter, Arial, sans-serif;
            color: var(--tx-mid);
            background: var(--card);
            outline: none;
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' fill='none' stroke='%23888' stroke-width='2' viewBox='0 0 24 24'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 10px center;
            transition: border .2s;
        }

        .toolbar select:focus {
            border-color: var(--gold);
        }

        .spacer {
            flex: 1;
        }

        .btn-add {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: var(--gold);
            color: #fff;
            padding: 9px 18px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            white-space: nowrap;
            transition: background .2s;
        }

        .btn-add:hover {
            background: #a07c4c;
        }

        /* --- Alert --- */
        .alert {
            padding: 12px 18px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        /* ================================
           TABLE CARD
        ================================ */
        .table-card {
            background: var(--card);
            border-radius: 10px;
            border: 1px solid var(--border);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        /* Gold header */
        thead tr {
            background: var(--gold);
        }

        th {
            padding: 12px 16px;
            text-align: left;
            font-size: 13px;
            font-weight: 600;
            color: #fff;
            white-space: nowrap;
        }

        th.center,
        td.center {
            text-align: center;
        }

        td {
            padding: 13px 16px;
            font-size: 13px;
            color: var(--tx);
            border-bottom: 1px solid var(--ln);
            vertical-align: middle;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background: #FAFAF8;
        }

        /* --- No column --- */
        td.no {
            color: var(--mut);
            font-size: 13px;
            width: 48px;
        }

        /* --- Produk cell --- */
        .produk-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .produk-img {
            width: 44px;
            height: 44px;
            border-radius: 6px;
            object-fit: cover;
            background: #f0ede8;
            flex: none;
        }

        .produk-name {
            font-weight: 600;
            font-size: 13px;
            color: var(--tx);
        }

        .produk-sku {
            font-size: 11px;
            color: var(--mut-light);
            margin-top: 2px;
        }

        /* --- Price & stock --- */
        td.harga {
            font-weight: 600;
            color: var(--tx);
        }

        td.stok-warn {
            color: #EF4444;
            font-weight: 700;
        }

        /* --- Badges --- */
        .badge {
            display: inline-block;
            padding: 3px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-aktif {
            background: #DCFCE7;
            color: #16A34A;
        }

        .badge-sold_out {
            background: #fee2e2;
            color: #991b1b;
        }

        .badge-arsip {
            background: #f3f4f6;
            color: #6b7280;
        }

        /* --- Action buttons --- */
        .actions {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: opacity .2s;
        }

        .btn-action:hover {
            opacity: .75;
        }

        .btn-action img {
            width: 16px;
            height: 16px;
        }

        .btn-action-view {
            background: #FEF9C3;
            color: #854D0E;
        }

        .btn-action-view svg {
            width: 17px;
            height: 17px;
        }

        .btn-action-edit {
            background: #F0F9FF;
        }

        .btn-action-del {
            background: #FEF2F2;
        }

        /* ================================
           MODAL DETAIL
        ================================ */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
            backdrop-filter: blur(2px);
            z-index: 9999;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal-overlay.open {
            display: flex;
        }

        .modal-card {
            background: #fff;
            border-radius: 14px;
            max-width: 680px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            animation: modalFadeIn .2s ease-out;
        }

        @keyframes modalFadeIn {
            from { opacity: 0; transform: translateY(12px) scale(0.98); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 24px;
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            background: #fff;
            z-index: 10;
        }

        .modal-header h3 {
            margin: 0;
            font-size: 17px;
            font-weight: 700;
            color: var(--tx);
        }

        .modal-close {
            background: none;
            border: none;
            cursor: pointer;
            color: var(--mut);
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            transition: all .15s;
        }

        .modal-close:hover {
            color: var(--tx);
            background: #F0EDE8;
        }

        .modal-body {
            padding: 24px;
        }

        .modal-section-title {
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: var(--gold);
            margin: 0 0 12px;
        }

        /* Foto 4 sisi di modal */
        .modal-photos {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-bottom: 24px;
        }

        .modal-photo-item {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .modal-photo-thumb {
            width: 100%;
            aspect-ratio: 1;
            border-radius: 8px;
            border: 1px solid var(--border);
            overflow: hidden;
            background: #FAFAF8;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-photo-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .modal-photo-thumb .empty-thumb {
            font-size: 11px;
            color: var(--mut);
            text-align: center;
            padding: 8px;
        }

        .modal-photo-label {
            font-size: 12px;
            font-weight: 600;
            color: var(--tx);
            text-align: center;
        }

        /* Detail info grid */
        .modal-info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 14px;
            background: #FAFAF8;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 20px;
            border: 1px solid var(--border);
        }

        .info-row {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .info-label {
            font-size: 12px;
            color: var(--mut);
            font-weight: 500;
        }

        .info-value {
            font-size: 14px;
            font-weight: 600;
            color: var(--tx);
        }

        .modal-desc-box {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 14px;
            font-size: 13.5px;
            color: var(--tx-mid);
            line-height: 1.6;
            white-space: pre-wrap;
        }

        /* ================================
           FOOTER / PAGINATION
        ================================ */
        .table-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 16px;
            background: var(--footer-bg);
            border-top: 1px solid var(--border);
            font-size: 13px;
            color: var(--mut);
        }

        .pagination {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .page-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            border-radius: 5px;
            border: 1.5px solid var(--border);
            background: var(--card);
            color: var(--tx-mid);
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            transition: all .2s;
        }

        .page-btn:hover {
            border-color: var(--gold);
            color: var(--gold);
        }

        .page-btn.active {
            background: var(--gold);
            border-color: var(--gold);
            color: #fff;
            font-weight: 700;
        }

        .page-btn.disabled {
            opacity: .4;
            cursor: not-allowed;
            pointer-events: none;
        }

        /* --- Empty state --- */
        .empty {
            text-align: center;
            padding: 64px 20px;
            color: var(--mut);
        }

        .empty svg {
            width: 48px;
            height: 48px;
            margin-bottom: 12px;
            opacity: .35;
        }

        .empty p {
            font-size: 14px;
        }

        .empty a {
            color: var(--gold);
        }
    </style>
</head>
<body>

    @include('components.sidebar')

    <main>

        {{-- Page Title --}}
        <div class="page-title">
            <h1>Daftar Produk</h1>
            <p>Kelola semua produk yang tersedia di toko Anda</p>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Toolbar --}}
        <div class="toolbar">
            <div class="search-wrap">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input type="text" id="searchInput" placeholder="Cari produk..." oninput="filterTable()">
            </div>

            <select id="filterKategori" onchange="filterTable()">
                <option value="">Semua Kategori</option>
                @foreach ($kategoriList as $k)
                    <option value="{{ $k->nama_kategori }}">{{ $k->nama_kategori }}</option>
                @endforeach
            </select>

            <select id="filterStatus" onchange="filterTable()">
                <option value="">Semua Status</option>
                <option value="aktif">Aktif</option>
                <option value="sold_out">Sold Out</option>
                <option value="arsip">Arsip</option>
            </select>

            <div class="spacer"></div>

            <a href="{{ route('produk.create') }}" class="btn-add">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Tambah Produk
            </a>
        </div>

        {{-- Table --}}
        <div class="table-card">
            @if ($produk->isEmpty())
                <div class="empty">
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"></path>
                    </svg>
                    <p>Belum ada produk. <a href="{{ route('produk.create') }}">Tambah sekarang</a></p>
                </div>
            @else
                <table id="produkTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th class="center">Stok</th>
                            <th class="center">Status</th>
                            <th class="center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @foreach ($produk as $i => $p)
                            @php
                                $imgPath = public_path('assets/image/produk/' . $p->gambar_produk);
                                $imgSrc  = file_exists($imgPath)
                                    ? asset('assets/image/produk/' . $p->gambar_produk)
                                    : null;
                                $labelStatus = $p->status === 'aktif' ? 'Aktif'
                                    : ($p->status === 'sold_out' ? 'Sold Out' : 'Arsip');
                            @endphp
                            <tr data-nama="{{ strtolower($p->nama_produk) }}"
                                data-kategori="{{ $p->kategori->nama_kategori ?? '' }}"
                                data-status="{{ $p->status }}">
                                <td class="no">{{ $i + 1 }}</td>
                                <td>
                                    <div class="produk-cell">
                                        <img src="{{ $imgSrc }}" alt="{{ $p->nama_produk }}" class="produk-img" @if(!$imgSrc) style="visibility:hidden" @endif>
                                        <div>
                                            <div class="produk-name">{{ $p->nama_produk }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $p->kategori->nama_kategori ?? '-' }}</td>
                                <td class="harga">Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                                <td class="center {{ $p->stok <= 5 ? 'stok-warn' : '' }}">{{ $p->stok }}</td>
                                <td class="center">
                                    <span class="badge badge-{{ $p->status }}">{{ $labelStatus }}</span>
                                </td>
                                <td class="center">
                                    <div class="actions">
                                        <a href="#" class="btn-action btn-action-view"
   title="Detail produk"
   onclick="showDetail(event, {
       nama:   {{ json_encode($p->nama_produk) }},
       kat:    {{ json_encode($p->kategori->nama_kategori ?? '-') }},
       harga:  {{ json_encode('Rp ' . number_format($p->harga, 0, ',', '.')) }},
       stok:   {{ $p->stok }},
       berat:  {{ $p->berat_gram }},
       status: {{ json_encode($p->status) }},
       deskripsi: {{ json_encode($p->deskripsi_produk) }},
       depan:  {{ json_encode($p->gambar_produk ? asset('assets/image/produk/' . $p->gambar_produk) : null) }},
       kanan:  {{ json_encode($p->gambar_kanan  ? asset('assets/image/produk/' . $p->gambar_kanan)  : null) }},
       kiri:   {{ json_encode($p->gambar_kiri   ? asset('assets/image/produk/' . $p->gambar_kiri)   : null) }},
       dalam:  {{ json_encode($p->gambar_dalam  ? asset('assets/image/produk/' . $p->gambar_dalam)  : null) }}
   })">
                                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>
                                        </a>
<a href="{{ route('produk.edit', $p->produk_id) }}"
                                           class="btn-action btn-action-edit"
                                           title="Edit produk">
                                            <img src="{{ asset('images/edit.svg') }}" alt="Edit">
                                        </a>
                                        <form method="POST"
                                              action="{{ route('produk.destroy', $p->produk_id) }}"
                                              onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn-action btn-action-del"
                                                    title="Hapus produk">
                                                <img src="{{ asset('images/trash.svg') }}" alt="Hapus">
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Footer / Pagination info --}}
                <div class="table-footer">
                    <span id="infoText">Menampilkan 1&ndash;{{ $produk->count() }} dari {{ $produk->count() }} produk</span>
                    <div class="pagination" id="pagination"></div>
                </div>
            @endif
        {{-- Modal Detail Produk --}}
        <div class="modal-overlay" id="detailModal" onclick="handleModalClick(event)">
            <div class="modal-card">
                <div class="modal-header">
                    <h3 id="modalTitle">Detail Produk</h3>
                    <button type="button" class="modal-close" onclick="closeModal()">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="modal-section-title">Foto Produk dari Berbagai Sudut</p>
                    <div class="modal-photos">
                        <div class="modal-photo-item">
                            <div class="modal-photo-thumb" id="thumbDepanWrap">
                                <img id="thumbDepan" src="" alt="Foto Depan">
                            </div>
                            <span class="modal-photo-label">Depan (Utama)</span>
                        </div>
                        <div class="modal-photo-item">
                            <div class="modal-photo-thumb" id="thumbKananWrap">
                                <img id="thumbKanan" src="" alt="Samping Kanan">
                            </div>
                            <span class="modal-photo-label">Samping Kanan</span>
                        </div>
                        <div class="modal-photo-item">
                            <div class="modal-photo-thumb" id="thumbKiriWrap">
                                <img id="thumbKiri" src="" alt="Samping Kiri">
                            </div>
                            <span class="modal-photo-label">Samping Kiri</span>
                        </div>
                        <div class="modal-photo-item">
                            <div class="modal-photo-thumb" id="thumbDalamWrap">
                                <img id="thumbDalam" src="" alt="Foto Dalam">
                            </div>
                            <span class="modal-photo-label">Dalam</span>
                        </div>
                    </div>

                    <p class="modal-section-title">Informasi Lengkap</p>
                    <div class="modal-info-grid">
                        <div class="info-row">
                            <span class="info-label">Kategori</span>
                            <span class="info-value" id="modalKat">-</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Status</span>
                            <span class="info-value" id="modalStatus">-</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Harga</span>
                            <span class="info-value" id="modalHarga" style="color: var(--gold);">-</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Stok</span>
                            <span class="info-value" id="modalStok">-</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Berat</span>
                            <span class="info-value" id="modalBerat">-</span>
                        </div>
                    </div>

                    <p class="modal-section-title">Deskripsi Produk</p>
                    <div class="modal-desc-box" id="modalDesc">-</div>
                </div>
            </div>
        </div>

    </main>

    <script>
        const PER_PAGE = 8;
        let currentPage = 1;

        const rows        = () => [...document.querySelectorAll('#tableBody tr:not([style*="display: none"])')];
        const allRows     = () => [...document.querySelectorAll('#tableBody tr')];

        function filterTable() {
            const search   = document.getElementById('searchInput').value.toLowerCase();
            const kategori = document.getElementById('filterKategori').value;
            const status   = document.getElementById('filterStatus').value;

            allRows().forEach(row => {
                const nama     = row.dataset.nama     || '';
                const kat      = row.dataset.kategori || '';
                const stat     = row.dataset.status   || '';

                const match =
                    (!search   || nama.includes(search)) &&
                    (!kategori || kat === kategori)       &&
                    (!status   || stat === status);

                row.style.display = match ? '' : 'none';
            });

            currentPage = 1;
            renderPagination();
            showPage(1);
        }

        function showPage(page) {
            currentPage     = page;
            const visible   = rows();
            const start     = (page - 1) * PER_PAGE;
            const end       = start + PER_PAGE;
            const total     = visible.length;

            visible.forEach((row, i) => {
                row.style.display = (i >= start && i < end) ? '' : 'none';
            });

            const from = total ? start + 1 : 0;
            const to   = Math.min(end, total);
            document.getElementById('infoText').innerHTML =
                `Menampilkan ${from}&ndash;${to} dari ${total} produk`;

            renderPagination();
        }

        function renderPagination() {
            const total    = rows().length;
            const pages    = Math.ceil(total / PER_PAGE);
            const pg       = document.getElementById('pagination');
            if (!pg) return;

            let html = '';

            // Prev
            html += `<a class="page-btn ${currentPage === 1 ? 'disabled' : ''}" onclick="showPage(${currentPage - 1})">&#8249;</a>`;

            for (let i = 1; i <= pages; i++) {
                html += `<a class="page-btn ${i === currentPage ? 'active' : ''}" onclick="showPage(${i})">${i}</a>`;
            }

            // Next
            html += `<a class="page-btn ${currentPage === pages || pages === 0 ? 'disabled' : ''}" onclick="showPage(${currentPage + 1})">&#8250;</a>`;

            pg.innerHTML = html;
        }

        // Init
        showPage(1);

        // --- Detail Modal Functions ---
        function setThumb(wrapId, imgId, src) {
            const wrap = document.getElementById(wrapId);
            const img  = document.getElementById(imgId);
            if (src) {
                img.src = src;
                img.style.display = 'block';
                const emptyMsg = wrap.querySelector('.empty-thumb');
                if (emptyMsg) emptyMsg.remove();
            } else {
                img.style.display = 'none';
                if (!wrap.querySelector('.empty-thumb')) {
                    const span = document.createElement('span');
                    span.className = 'empty-thumb';
                    span.textContent = 'Tidak ada foto';
                    wrap.appendChild(span);
                }
            }
        }

        function showDetail(event, data) {
            if (event) event.preventDefault();

            document.getElementById('modalTitle').textContent  = data.nama;
            document.getElementById('modalKat').textContent    = data.kat || '-';
            document.getElementById('modalStatus').innerHTML   = `<span class="badge badge-${data.status}">${data.statusLbl || data.status}</span>`;
            document.getElementById('modalHarga').textContent  = data.harga;
            document.getElementById('modalStok').textContent   = data.stok + ' pcs';
            document.getElementById('modalBerat').textContent  = data.berat ? data.berat + ' gram' : '-';
            document.getElementById('modalDesc').textContent   = data.deskripsi || 'Tidak ada deskripsi.';

            setThumb('thumbDepanWrap', 'thumbDepan', data.depan);
            setThumb('thumbKananWrap', 'thumbKanan', data.kanan);
            setThumb('thumbKiriWrap',  'thumbKiri',  data.kiri);
            setThumb('thumbDalamWrap', 'thumbDalam', data.dalam);

            document.getElementById('detailModal').classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('detailModal').classList.remove('open');
            document.body.style.overflow = '';
        }

        function handleModalClick(e) {
            if (e.target.id === 'detailModal') {
                closeModal();
            }
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeModal();
        });
    </script>

</body>
</html>