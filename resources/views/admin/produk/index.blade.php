@extends('layouts.admin')

@section('head')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar Produk – Rabita</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/admin/pages/produk/index.css', 'resources/css/admin/components.css'])
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

                    <a href="{{ route('admin.pengaturan') }}"
                        style="display: flex; align-items: center; gap: 10px; width: 100%; padding: 10px 16px; border: none; background: transparent; font-size: 13px; font-family: 'Inter', sans-serif; color: #1A1A1A; cursor: pointer; text-decoration: none; transition: background-color 0.15s ease;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="3"></circle>
                            <path
                                d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z">
                            </path>
                        </svg>
                        Pengaturan
                    </a>

                    <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                <polyline points="16 17 21 12 16 7"></polyline>
                                <line x1="21" y1="12" x2="9" y2="12"></line>
                            </svg>
                            <span>Keluar</span>
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <main>
            <div class="page-header">
                <h1 class="page-title">Daftar Produk</h1>
                <p class="page-subtitle">Kelola semua produk yang tersedia di toko Anda</p>
            </div>

            @if (session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form method="GET" action="{{ route('produk.index') }}" class="toolbar">
                <div class="search-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <input type="text" name="search" class="search-input" value="{{ request('search') }}"
                        placeholder="Cari produk..." onchange="this.form.submit()">
                </div>

                <div class="select-filter-wrap">
                    <select name="kategori" class="select-filter" onchange="this.form.submit()">
                        <option value="">Semua Kategori</option>
                        @foreach ($kategoriList as $kat)
                            <option value="{{ $kat->kategori_id }}"
                                {{ request('kategori') == $kat->kategori_id ? 'selected' : '' }}>
                                {{ $kat->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>

                <div class="select-filter-wrap">
                    <select name="status" class="select-filter" onchange="this.form.submit()">
                        <option value="">Semua Status</option>
                        <option value="aktif" {{ request('status') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="sold_out" {{ request('status') === 'sold_out' ? 'selected' : '' }}>Sold Out
                        </option>
                        <option value="arsip" {{ request('status') === 'arsip' ? 'selected' : '' }}>Arsip</option>
                    </select>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>

                <div class="spacer"></div>

                <a href="{{ route('produk.create') }}" class="btn-add">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    <span>Tambah Produk</span>
                </a>
            </form>

            <div class="table-card">
                <div class="table-responsive">
                    <table class="produk-table">
                        <thead>
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th style="width: 28%;">Produk</th>
                                <th style="width: 17%;">Kategori</th>
                                <th style="width: 17%;">Harga</th>
                                <th class="center" style="width: 11%;">Total Motif</th>
                                <th class="center" style="width: 11%;">Status</th>
                                <th class="center" style="width: 11%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($produk as $index => $item)
                                @php
                                    $firstMotif = $item->motif->first();
                                    $foto = $firstMotif ? $firstMotif->gambar_depan : null;
                                    $fotoPath = $foto ? public_path('assets/image/produk/' . $foto) : null;
                                    $fotoUrl = $fotoPath && file_exists($fotoPath) ? asset('assets/image/produk/' . $foto) : null;
                                    $statusClass = $item->status ?? 'aktif';
                                    $statusLabel = $item->status === 'sold_out' ? 'Sold Out' : ucfirst($item->status);
                                @endphp
                                <tr>
                                    <td>{{ $produk->firstItem() + $index }}</td>
                                    <td>
                                        <div class="cell-product">
                                            <div class="thumb-box">
                                                @if ($fotoUrl)
                                                    <img src="{{ $fotoUrl }}" alt="{{ $item->nama_produk }}">
                                                @else
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="1.6" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                                        <line x1="3" y1="6" x2="21"
                                                            y2="6"></line>
                                                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                                                    </svg>
                                                @endif
                                            </div>
                                            <span class="product-name"
                                                title="{{ $item->nama_produk }}">{{ $item->nama_produk }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                                    <td style="font-weight: 600;">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                    <td style="text-align: center;">{{ $item->motif_count ?? $item->motif->count() }}</td>
                                    <td style="text-align: center;">
                                        <span class="badge-status {{ $statusClass }}">{{ $statusLabel }}</span>
                                    </td>
                                    <td style="text-align: center;">
                                        <div class="action-group">
                                            <button type="button" class="btn-action view" title="Lihat Detail Produk"
                                                onclick="openProductModal('{{ route('produk.show', $item->produk_id) }}')">
                                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                    <circle cx="12" cy="12" r="3"></circle>
                                                </svg>
                                            </button>
                                            <a href="{{ route('produk.edit', $item->produk_id) }}"
                                                class="btn-action edit" title="Edit Produk">
                                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                                    </path>
                                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                                    </path>
                                                </svg>
                                            </a>
                                            <form action="{{ route('produk.destroy', $item->produk_id) }}" method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');"
                                                style="margin: 0;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action delete" title="Hapus Produk">
                                                    <svg width="15" height="15" viewBox="0 0 24 24"
                                                        fill="none" stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path
                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" style="text-align: center; padding: 50px 16px; color: #8A8A8A;">
                                        <div
                                            style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 10px;">
                                            <svg width="38" height="38" viewBox="0 0 24 24" fill="none"
                                                stroke="#D0D0D0" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                                <line x1="3" y1="6" x2="21" y2="6">
                                                </line>
                                                <path d="M16 10a4 4 0 0 1-8 0"></path>
                                            </svg>
                                            <span style="font-size: 14px; font-weight: 500; color: #555555;">Belum ada
                                                produk yang tersedia</span>
                                            <span style="font-size: 12px; color: #9A9A9A;">Silakan tambahkan produk baru
                                                Anda dengan mengklik tombol "+ Tambah Produk" di atas.</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($produk->total() > 0)
                    <div class="table-footer">
                        <div>
                            Menampilkan {{ $produk->firstItem() ?? 0 }}-{{ $produk->lastItem() ?? 0 }} dari
                            {{ $produk->total() ?? 0 }} produk
                        </div>
                        <div class="pagination-container">
                            @if ($produk->onFirstPage())
                                <span class="page-link-btn disabled">&lt;</span>
                            @else
                                <a href="{{ $produk->previousPageUrl() }}" class="page-link-btn">&lt;</a>
                            @endif

                            @foreach ($produk->getUrlRange(1, $produk->lastPage()) as $page => $url)
                                @if ($page == $produk->currentPage())
                                    <span class="page-link-btn active">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" class="page-link-btn">{{ $page }}</a>
                                @endif
                            @endforeach

                            @if ($produk->hasMorePages())
                                <a href="{{ $produk->nextPageUrl() }}" class="page-link-btn">&gt;</a>
                            @else
                                <span class="page-link-btn disabled">&gt;</span>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </main>
    </div>

    <div class="product-detail-overlay" id="productDetailModal" aria-hidden="true">
        <section class="product-detail-dialog" role="dialog" aria-modal="true" aria-labelledby="productDetailTitle">
            <header class="product-detail-header">
                <h2 class="product-detail-title" id="productDetailTitle">Detail Produk</h2>
                <button type="button" class="product-detail-close" aria-label="Tutup"
                    onclick="closeProductModal()">&times;</button>
            </header>
            <div class="product-detail-body" id="productDetailBody" aria-live="polite">
                <p class="product-detail-message">Memuat detail produk...</p>
            </div>
        </section>
    </div>

    <script>
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

        const productDetailModal = document.getElementById('productDetailModal');
        const productDetailTitle = document.getElementById('productDetailTitle');
        const productDetailBody = document.getElementById('productDetailBody');

        function addProductDetail(container, label, value, wide) {
            const item = document.createElement('div');
            item.className = 'product-detail-item' + (wide ? ' wide' : '');

            const itemLabel = document.createElement('span');
            itemLabel.className = 'product-detail-label';
            itemLabel.textContent = label;

            const itemValue = document.createElement('div');
            itemValue.className = 'product-detail-value';
            itemValue.textContent = value === null || value === undefined || value === '' ? '-' : value;

            item.append(itemLabel, itemValue);
            container.appendChild(item);
        }

        function renderProductDetails(product) {
            productDetailTitle.textContent = product.nama_produk || 'Detail Produk';
            productDetailBody.innerHTML = '';

            const productSection = document.createElement('section');
            productSection.className = 'product-detail-section';
            const productHeading = document.createElement('h3');
            productHeading.textContent = 'Informasi Produk';
            const productGrid = document.createElement('div');
            productGrid.className = 'product-detail-grid';
            productSection.append(productHeading, productGrid);

            addProductDetail(productGrid, 'Kategori', product.kategori);
            addProductDetail(productGrid, 'Harga', 'Rp ' + Number(product.harga || 0).toLocaleString('id-ID'));
            addProductDetail(productGrid, 'Material', product.material);
            addProductDetail(productGrid, 'Ukuran', product.ukuran);
            addProductDetail(productGrid, 'Berat', product.berat_gram + ' gram');
            addProductDetail(productGrid, 'Status', product.status === 'sold_out' ? 'Sold Out' : (product.status || '-'));
            addProductDetail(productGrid, 'Deskripsi', product.deskripsi_produk, true);
            productDetailBody.appendChild(productSection);

            const motifSection = document.createElement('section');
            motifSection.className = 'product-detail-section';
            const motifHeading = document.createElement('h3');
            motifHeading.textContent = 'Pilihan Motif (' + product.motif.length + ')';
            motifSection.appendChild(motifHeading);

            if (product.motif.length) {
                const motifGrid = document.createElement('div');
                motifGrid.className = 'motif-detail-grid';
                product.motif.forEach((motif) => {
                    const card = document.createElement('article');
                    card.className = 'motif-detail-card';

                    const name = document.createElement('h4');
                    name.textContent = motif.nama_motif;
                    const meta = document.createElement('p');
                    meta.className = 'motif-detail-meta';
                    meta.textContent = 'Stok: ' + motif.stok + ' · Status: ' + motif.status;
                    const photos = document.createElement('div');
                    photos.className = 'motif-detail-photos';

                    motif.gambar.forEach((source, index) => {
                        const image = document.createElement('img');
                        image.src = source;
                        image.alt = motif.nama_motif + ' - Foto ' + (index + 1);
                        image.loading = 'lazy';
                        photos.appendChild(image);
                    });

                    card.append(name, meta, photos);
                    motifGrid.appendChild(card);
                });
                motifSection.appendChild(motifGrid);
            } else {
                const empty = document.createElement('p');
                empty.className = 'product-detail-message';
                empty.textContent = 'Belum ada motif untuk produk ini.';
                motifSection.appendChild(empty);
            }

            productDetailBody.appendChild(motifSection);
        }

        function openProductModal(detailUrl) {
            productDetailTitle.textContent = 'Detail Produk';
            productDetailBody.innerHTML = '<p class="product-detail-message">Memuat detail produk...</p>';
            productDetailModal.classList.add('active');
            productDetailModal.setAttribute('aria-hidden', 'false');

            fetch(detailUrl, {
                    headers: {
                        Accept: 'application/json'
                    }
                })
                .then((response) => {
                    if (!response.ok) throw new Error('HTTP ' + response.status);
                    return response.json();
                })
                .then((response) => {
                    if (response.status !== 'success' || !response.data) {
                        throw new Error('Respons detail produk tidak valid.');
                    }
                    renderProductDetails(response.data);
                })
                .catch((error) => {
                    console.error(error);
                    productDetailBody.innerHTML =
                        '<p class="product-detail-message">Gagal memuat detail produk. Silakan coba lagi.</p>';
                });
        }

        function closeProductModal() {
            productDetailModal.classList.remove('active');
            productDetailModal.setAttribute('aria-hidden', 'true');
        }

        productDetailModal.addEventListener('click', (event) => {
            if (event.target === productDetailModal) closeProductModal();
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && productDetailModal.classList.contains('active')) {
                closeProductModal();
            }
        });
    </script>
@endsection
