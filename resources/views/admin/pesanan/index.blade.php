@extends('layouts.admin')

@section('head')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pesanan – Rabita</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Lato:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    @vite(['resources/css/admin/pages/pesanan/index.css', 'resources/css/admin/components.css'])
@endsection

@section('content')
    <div class="layout-main">

        <header class="topbar">
            <div class="user-pill-container">
                <button type="button" class="user-pill-btn" id="userPillBtn" aria-label="Menu Pengguna">
                    <span class="avatar-circle">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </span>
                    <span class="user-text">
                        <span class="user-name">{{ Auth::user()->username ?? 'Salman' }}</span>
                        <span class="user-role">{{ ucfirst(Auth::user()->level ?? 'Administrator') }}</span>
                    </span>
                    <svg class="user-chevron" id="userPillChevron" width="16" height="16" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                        stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>

                <div class="user-dropdown" id="userDropdown">
                    <div class="dropdown-user-info">
                        <p>Login sebagai:</p>
                        <b>{{ Auth::user()->username ?? 'Salman' }}</b>
                        <span
                            style="font-size: 11px; color: var(--gold);">{{ Auth::user()->email ?? 'admin@rabita.com' }}</span>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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

        <main>
            <div class="page-header">
                <h1 class="page-title">Pesanan</h1>
                <p class="page-subtitle">Kelola semua pesanan yang tersedia di toko Anda</p>
            </div>

            @if (session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert-error">
                    {{ session('error') }}
                </div>
            @endif

            <div class="stats-grid">
                <div class="stat-card">
                    <span class="stat-label">Total Pesanan</span>
                    <span class="stat-number">{{ $totalPesanan }}</span>
                    <span class="stat-sub">Semua waktu</span>
                </div>
                <div class="stat-card">
                    <span class="stat-label">Menunggu Konfirmasi</span>
                    <span class="stat-number">{{ $menungguKonfirmasi }}</span>
                    <span class="stat-sub danger">Perlu dikonfirmasi</span>
                </div>
                <div class="stat-card">
                    <span class="stat-label">Dalam Pengiriman</span>
                    <span class="stat-number">{{ $dalamPengiriman }}</span>
                    <span class="stat-sub">Sedang dikirim</span>
                </div>
                <div class="stat-card">
                    <span class="stat-label">Pesanan Selesai</span>
                    <span class="stat-number">{{ $pesananSelesai }}</span>
                    <span class="stat-sub">Semua waktu</span>
                </div>
            </div>

            <form action="{{ route('pesanan.index') }}" method="GET" class="toolbar" id="filterForm">
                <div class="search-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <input type="text" name="search" class="search-input" placeholder="Cari nama pemesan..."
                        value="{{ request('search') }}">
                </div>

                <div class="select-filter-wrap">
                    <select name="status" class="select-filter"
                        onchange="document.getElementById('filterForm').submit()">
                        <option value="">Semua Status</option>
                        <option value="menunggu" {{ request('status') === 'menunggu' ? 'selected' : '' }}>Menunggu
                        </option>
                        <option value="diproses" {{ request('status') === 'diproses' ? 'selected' : '' }}>Diproses
                        </option>
                        <option value="dikirim" {{ request('status') === 'dikirim' ? 'selected' : '' }}>Dikirim
                        </option>
                        <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>Selesai
                        </option>
                        <option value="dibatalkan" {{ request('status') === 'dibatalkan' ? 'selected' : '' }}>Dibatalkan
                        </option>
                    </select>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>

                <div class="select-filter-wrap">
                    <select name="tanggal" class="select-filter"
                        onchange="document.getElementById('filterForm').submit()">
                        <option value="">Pilih Tanggal</option>
                        <option value="today" {{ request('tanggal') === 'today' ? 'selected' : '' }}>Hari Ini</option>
                        <option value="7days" {{ request('tanggal') === '7days' ? 'selected' : '' }}>7 Hari Terakhir
                        </option>
                        <option value="month" {{ request('tanggal') === 'month' ? 'selected' : '' }}>Bulan Ini</option>
                    </select>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </form>

            <div class="table-card">
                <div class="table-responsive">
                    <table class="produk-table">
                        <thead>
                            <tr>
                                <th class="center" style="width: 50px;">No</th>
                                <th>Nama Pemesan</th>
                                <th>Email Pemesan</th>
                                <th>Total Harga</th>
                                <th class="center" style="width: 150px;">Status Pesanan</th>
                                <th style="width: 160px;">Tanggal Pesanan</th>
                                <th class="center" style="width: 220px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pesanan as $index => $item)
                                @php
                                    $statusClass = match ($item->status_pesanan) {
                                        'menunggu' => 'menunggu',
                                        'diproses' => 'diproses',
                                        'dikirim' => 'dikirim',
                                        'selesai' => 'selesai',
                                        'dibatalkan' => 'dibatalkan',
                                        default => 'menunggu',
                                    };
                                    $statusLabel = ucfirst($item->status_pesanan);
                                    $statusAction = match ($item->status_pesanan) {
                                        'menunggu' => ['label' => 'Proses Pesanan', 'step' => '1/3'],
                                        'diproses' => ['label' => 'Tandai Dikirim', 'step' => '2/3'],
                                        'dikirim' => ['label' => 'Selesaikan Pesanan', 'step' => '3/3'],
                                        default => null,
                                    };
                                @endphp
                                <tr>
                                    <td class="center" style="color: #1A1A1A;">
                                        {{ $pesanan->firstItem() ? $pesanan->firstItem() + $index : $index + 1 }}
                                    </td>
                                    <td style="font-size: 13px; font-weight: 600; color: #1A1A1A;">
                                        {{ $item->nama_penerima ?? ($item->user->username ?? 'Pelanggan') }}
                                    </td>
                                    <td style="color: #1A1A1A; font-size: 13px;">
                                        {{ $item->user->email ?? '-' }}
                                    </td>
                                    <td style="font-size: 13px; font-weight: 400; color: #1A1A1A;">
                                        Rp {{ number_format($item->total_harga, 0, ',', '.') }}
                                    </td>
                                    <td class="center">
                                        <span class="badge-status {{ $statusClass }}">{{ $statusLabel }}</span>
                                    </td>
                                    <td style="font-size: 13px; color: #555555;">
                                        <div style="font-weight: 600; color: #555555;">
                                            {{ $item->created_at ? $item->created_at->translatedFormat('d M Y') : '-' }}
                                        </div>
                                        <div style="font-size: 13px; font-weight: 400; color: #555555;">Jam :
                                            {{ $item->created_at ? $item->created_at->format('H.i') : '-' }}</div>
                                    </td>
                                    <td class="center" style="min-width: 220px; white-space: nowrap;">
                                        <div class="action-group">
                                            <button type="button" class="btn-action btn-view"
                                                title="Lihat Detail Pesanan"
                                                onclick="openDetailModal({{ $item->pemesanan_id }})">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                    <circle cx="12" cy="12" r="3"></circle>
                                                </svg>
                                            </button>

                                            <button type="button" class="btn-action btn-delete" title="Hapus Pesanan"
                                                onclick="openDeleteModal('{{ route('pesanan.destroy', $item->pemesanan_id) }}', '#{{ $item->pemesanan_id }}')">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                    <path
                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                    </path>
                                                </svg>
                                            </button>

                                            @if ($statusAction)
                                                <form action="{{ route('pesanan.konfirmasi', $item->pemesanan_id) }}"
                                                    method="POST" class="status-action-form">
                                                    @csrf
                                                    <button type="submit" class="btn-status-action"
                                                        aria-label="{{ $statusAction['label'] }}"
                                                        title="{{ $statusAction['label'] }}{{ $item->status_pesanan === 'diproses' && blank($item->no_resi) ? '. Isi nomor resi melalui detail pesanan terlebih dahulu.' : '' }}"
                                                        @disabled($item->status_pesanan === 'diproses' && blank($item->no_resi))>
                                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2.5" stroke-linecap="round"
                                                            stroke-linejoin="round" aria-hidden="true">
                                                            <polyline points="20 6 9 17 4 12"></polyline>
                                                        </svg>
                                                    </button>
                                                    <span class="status-step" title="Tahap {{ $statusAction['step'] }}">
                                                        {{ $statusAction['step'] }}</span>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">
                                        <div class="empty-state">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"></path>
                                                <line x1="3" y1="6" x2="21" y2="6">
                                                </line>
                                                <path d="M16 10a4 4 0 0 1-8 0"></path>
                                            </svg>
                                            <h4>Tidak ada data pesanan</h4>
                                            <p>{{ request('search') || request('status') || request('tanggal') ? 'Tidak ditemukan pesanan dengan kriteria filter yang Anda pilih.' : 'Saat ini belum ada pesanan yang masuk.' }}
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($pesanan->hasPages())
                    <div class="pagination-footer">
                        <div class="pagination-info">
                            Menampilkan <b>{{ $pesanan->firstItem() ?? 0 }}</b> - <b>{{ $pesanan->lastItem() ?? 0 }}</b>
                            dari <b>{{ $pesanan->total() }}</b> pesanan
                        </div>
                        <div class="pagination-links">
                            @if ($pesanan->onFirstPage())
                                <span class="page-btn disabled">&lt;</span>
                            @else
                                <a href="{{ $pesanan->previousPageUrl() }}" class="page-btn">&lt;</a>
                            @endif

                            @foreach ($pesanan->getUrlRange(1, $pesanan->lastPage()) as $page => $url)
                                @if ($page == $pesanan->currentPage())
                                    <span class="page-btn active">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" class="page-btn">{{ $page }}</a>
                                @endif
                            @endforeach

                            @if ($pesanan->hasMorePages())
                                <a href="{{ $pesanan->nextPageUrl() }}" class="page-btn">&gt;</a>
                            @else
                                <span class="page-btn disabled">&gt;</span>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </main>
    </div>

    <!-- MODAL DETAIL PESANAN -->
    <div class="modal-overlay" id="detailModal">
        <div class="detail-modal-box">
            <div class="detail-modal-header">
                <div class="detail-modal-title">
                    <span>Detail Pesanan <span id="m_id" style="color: var(--gold);">#</span></span>
                    <span id="m_status_badge" class="badge-status menunggu" style="font-size: 11px;">-</span>
                </div>
                <button type="button" class="btn-close-modal" onclick="closeDetailModal()">&times;</button>
            </div>

            <div class="detail-modal-body">
                <div class="detail-section">
                    <div class="detail-sec-title">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        Informasi Penerima & Pengiriman
                    </div>
                    <div class="grid-detail-2">
                        <div>
                            <div class="dt-label">Nama Penerima</div>
                            <div class="dt-val" id="m_nama">-</div>
                        </div>
                        <div>
                            <div class="dt-label">Nomor HP / WhatsApp</div>
                            <div class="dt-val" id="m_hp">-</div>
                        </div>
                        <div>
                            <div class="dt-label">Email Akun</div>
                            <div class="dt-val" id="m_email">-</div>
                        </div>
                        <div>
                            <div class="dt-label">Tanggal Pesanan</div>
                            <div class="dt-val" id="m_tgl">-</div>
                        </div>
                        <div style="grid-column: 1 / -1;">
                            <div class="dt-label">Alamat Lengkap Pengiriman</div>
                            <div class="dt-val" id="m_alamat">-</div>
                        </div>
                        <div>
                            <div class="dt-label">Ekspedisi & Layanan</div>
                            <div class="dt-val" id="m_ekspedisi">-</div>
                        </div>
                        <div>
                            <div class="dt-label">Nomor Resi Pengiriman</div>
                            <div class="dt-val" id="m_resi" style="color: var(--gold);">-</div>
                        </div>
                    </div>
                </div>

                <div class="detail-section">
                    <div class="detail-sec-title">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"></path>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                        </svg>
                        Item Produk yang Dipesan
                    </div>
                    <div id="m_items_list">
                        <!-- Disuntikkan via JS -->
                    </div>

                    <div
                        style="margin-top: 16px; padding-top: 12px; border-top: 1px dashed #DDD; display: flex; flex-direction: column; gap: 6px; font-size: 13.5px;">
                        <div style="display: flex; justify-content: space-between; color: #666;">
                            <span>Subtotal Produk</span>
                            <span id="m_subtotal_prod">Rp 0</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; color: #666;">
                            <span>Ongkos Kirim</span>
                            <span id="m_ongkir">Rp 0</span>
                        </div>
                        <div
                            style="display: flex; justify-content: space-between; font-weight: 700; font-size: 15px; color: #111; margin-top: 4px;">
                            <span>Total Pembayaran</span>
                            <span id="m_total_harga" style="color: var(--gold);">Rp 0</span>
                        </div>
                    </div>
                </div>

                <div class="detail-section">
                    <div class="detail-sec-title">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="5" width="20" height="14" rx="2"></rect>
                            <line x1="2" y1="10" x2="22" y2="10"></line>
                        </svg>
                        Bukti Pembayaran Pelanggan
                    </div>
                    <div id="m_bukti_wrap">
                        <!-- Disuntikkan via JS -->
                    </div>
                </div>
            </div>

            <form id="formUpdateResiModal" method="POST" class="detail-modal-footer">
                @csrf
                @method('PUT')
                <div class="form-update-resi">
                    <label for="m_input_resi" style="font-size: 12.5px; font-weight: 600; color: #333;">Nomor
                        Resi:</label>
                    <input type="text" name="no_resi" id="m_input_resi" class="input-resi-modal"
                        placeholder="Masukkan nomor resi..." maxlength="100" required>
                    <button type="submit" class="btn-save-modal">Simpan Resi</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL KONFIRMASI HAPUS -->
    <div class="modal-overlay" id="deleteModal">
        <div class="modal-card">
            <div class="modal-icon-wrap">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <polyline points="3 6 5 6 21 6"></polyline>
                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                    <line x1="10" y1="11" x2="10" y2="17"></line>
                    <line x1="14" y1="11" x2="14" y2="17"></line>
                </svg>
            </div>
            <h3 class="modal-title">Hapus Pesanan?</h3>
            <p class="modal-desc" id="deleteModalDesc">Apakah Anda yakin ingin menghapus pesanan ini? Tindakan ini tidak
                dapat dibatalkan.</p>
            <form id="deleteForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <div class="modal-actions">
                    <button type="button" class="modal-btn-cancel" onclick="closeDeleteModal()">Batal</button>
                    <button type="submit" class="modal-btn-confirm">Ya, Hapus</button>
                </div>
            </form>
        </div>
    </div>

    <script>
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
        }

        const deleteModal = document.getElementById('deleteModal');
        const deleteForm = document.getElementById('deleteForm');
        const deleteDesc = document.getElementById('deleteModalDesc');

        function openDeleteModal(actionUrl, itemName) {
            deleteForm.action = actionUrl;
            deleteDesc.innerHTML =
                `Apakah Anda yakin ingin menghapus pesanan <b>${itemName}</b>? Tindakan ini tidak dapat dibatalkan.`;
            deleteModal.classList.add('active');
        }

        function closeDeleteModal() {
            deleteModal.classList.remove('active');
        }

        if (deleteModal) {
            deleteModal.addEventListener('click', (e) => {
                if (e.target === deleteModal) closeDeleteModal();
            });
        }

        const detailModal = document.getElementById('detailModal');
        const updateResiForm = document.getElementById('formUpdateResiModal');

        function formatRupiah(num) {
            return 'Rp ' + Number(num).toLocaleString('id-ID');
        }

        function openDetailModal(pemesananId) {
            fetch('/pesanan/' + pemesananId, {
                    headers: {
                        'Accept': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(res => {
                    if (res.status === 'success') {
                        const d = res.data;

                        document.getElementById('m_id').innerText = '#' + d.pemesanan_id;
                        const badge = document.getElementById('m_status_badge');
                        badge.className = 'badge-status ' + d.status_pesanan;
                        badge.innerText = d.status_pesanan.charAt(0).toUpperCase() + d.status_pesanan.slice(1);

                        document.getElementById('m_nama').innerText = d.nama_penerima || '-';
                        document.getElementById('m_hp').innerText = d.no_hp_penerima || '-';
                        document.getElementById('m_email').innerText = d.email || '-';
                        document.getElementById('m_tgl').innerText = d.tanggal_pesan || '-';
                        document.getElementById('m_alamat').innerText = (d.alamat_lengkap || '') + ', Kec. ' + (d
                            .kecamatan || '') + ', ' + (d.kota || '') + ', ' + (d.provinsi || '') + ' (' + (d
                            .kode_pos || '') + ')';
                        document.getElementById('m_ekspedisi').innerText = (d.kurir || '-') + ' (' + (d.layanan_kurir ||
                            '-') + ') - Estimasi: ' + (d.estimasi_tiba || '-');
                        document.getElementById('m_resi').innerText = d.no_resi || 'Belum ada nomor resi';

                        const itemsContainer = document.getElementById('m_items_list');
                        itemsContainer.innerHTML = '';
                        if (d.items && d.items.length > 0) {
                            d.items.forEach(it => {
                                const imgTag = it.gambar ?
                                    `<img src="${it.gambar}" class="item-thumb" alt="${it.nama_produk}">` :
                                    `<div class="item-thumb" style="display:grid;place-items:center;color:#999;"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"></rect></svg></div>`;
                                itemsContainer.innerHTML += `
                                <div class="modal-item-card">
                                    ${imgTag}
                                    <div class="item-info">
                                        <div class="item-name">${it.nama_produk}</div>
                                        <div class="item-motif">Motif: ${it.nama_motif} &bull; ${it.jumlah} pcs &times; ${formatRupiah(it.harga_satuan)}</div>
                                    </div>
                                    <div class="item-price">${formatRupiah(it.subtotal)}</div>
                                </div>
                            `;
                            });
                        }

                        document.getElementById('m_subtotal_prod').innerText = formatRupiah(d.subtotal_produk);
                        document.getElementById('m_ongkir').innerText = formatRupiah(d.ongkir);
                        document.getElementById('m_total_harga').innerText = formatRupiah(d.total_harga);

                        const buktiWrap = document.getElementById('m_bukti_wrap');
                        if (d.bukti_bayar) {
                            buktiWrap.innerHTML = `
                            <a href="${d.bukti_bayar}" target="_blank" title="Klik untuk memperbesar">
                                <img src="${d.bukti_bayar}" class="bukti-bayar-preview" alt="Bukti Transfer">
                            </a>
                            <div style="font-size: 11.5px; color: #666; margin-top: 6px;">
                                Waktu konfirmasi pembayaran: <b>${d.waktu_bayar || 'Belum diverifikasi'}</b> (Klik gambar untuk memperbesar)
                            </div>
                        `;
                        } else {
                            buktiWrap.innerHTML =
                                `<div style="font-size: 13px; color: #888; font-style: italic;">Pelanggan belum mengunggah bukti pembayaran transfer.</div>`;
                        }

                        updateResiForm.action = '/pesanan/' + d.pemesanan_id + '/resi';
                        document.getElementById('m_input_resi').value = d.no_resi || '';

                        detailModal.classList.add('active');
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert('Gagal memuat detail pesanan.');
                });
        }

        function closeDetailModal() {
            detailModal.classList.remove('active');
        }

        if (detailModal) {
            detailModal.addEventListener('click', function(e) {
                if (e.target === detailModal) {
                    closeDetailModal();
                }
            });
        }
    </script>
@endsection
