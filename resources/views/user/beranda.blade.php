@extends('layouts.user')

@section('head')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rabita – Beranda</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&family=Lato:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap"
        rel="stylesheet">
    @vite(['resources/css/user/pages/beranda.css', 'resources/css/user/components.css'])
@endsection

@section('content')
    <!-- Hero -->
    <section class="hero-section">
        <div class="container hero-grid">
            <div class="hero-left">
                <h1 class="hero-title">
                    Dapatkan Beragam Jenis Tas<br>
                    Sasirangan Hanya di <span class="brand-word">Rabita</span>
                </h1>

                <p class="hero-desc">
                    Bunga mawar di tepi telaga, Harumnya semerbak membawa rasa. Pakailah tas sasirangan dari Rabita,
                    Percantik dirimu dengan warisan bangsa.
                </p>

                <div class="hero-buttons">
                    <a href="{{ route('katalog') }}" class="btn-hero-primary">Belanja Sekarang</a>
                    <a href="{{ route('tentang') }}" class="btn-hero-secondary">Tentang Kami</a>
                </div>
            </div>

            <div class="hero-right">
                <div class="hero-image-wrapper">
                    <svg class="deco-star-tl" viewBox="0 0 34 34" fill="#B79361" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M17 0C17 9.38884 9.38884 17 0 17C9.38884 17 17 24.6112 17 34C17 24.6112 24.6112 17 34 17C24.6112 17 17 9.38884 17 0Z" />
                    </svg>

                    <div class="hero-photo-box">
                        <img src="{{ asset('assets/image/berandahero.png') }}" alt="Rabita Hero">
                    </div>

                    <svg class="deco-star-br" viewBox="0 0 40 40" fill="#B79361" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M20 0C20 11.0457 11.0457 20 0 20C11.0457 20 20 28.9543 20 40C20 28.9543 28.9543 20 40 20C28.9543 20 20 11.0457 20 0Z" />
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <!-- Koleksi -->
    <section class="koleksi-section" id="koleksi">
        <div class="container">
            <div class="koleksi-header-wrap">
                <span class="section-label">Kategori Kami</span>
                <h2 class="section-title">Jelajahi Berbagai Kategori</h2>

                @if (($kategori ?? collect())->count() > 5)
                    <div class="koleksi-arrows" aria-label="Navigasi kategori">
                        <button type="button" id="koleksi-prev" class="btn-arrow-round"
                            aria-label="Kategori sebelumnya">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="m15 18-6-6 6-6"></path>
                            </svg>
                        </button>
                        <button type="button" id="koleksi-next" class="btn-arrow-round"
                            aria-label="Kategori berikutnya">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="m9 18 6-6-6-6"></path>
                            </svg>
                        </button>
                    </div>
                @endif
            </div>

            <div class="koleksi-grid" id="koleksi-grid">
                @forelse($kategori ?? [] as $kat)
                    <a href="{{ route('katalog', ['kategori' => $kat->kategori_id]) }}" class="koleksi-card">
                        @if ($kat->gambar)
                            @php
                                $katImg = file_exists(public_path('assets/image/kategori/' . $kat->gambar)) ? asset('assets/image/kategori/' . $kat->gambar) : asset('assets/image/' . $kat->gambar);
                            @endphp
                            <img src="{{ $katImg }}" alt="{{ $kat->nama_kategori }}" class="koleksi-thumb"
                                style="width:140px;height:140px;object-fit:cover;">
                        @else
                            <div class="placeholder-box sm koleksi-thumb">
                                <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2">
                                    </rect>
                                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                    <polyline points="21 15 16 10 5 21"></polyline>
                                </svg>
                                <span>Belum ada gambar</span>
                            </div>
                        @endif
                        <span class="koleksi-name">{{ $kat->nama_kategori }}</span>
                    </a>
                @empty
                    <p style="text-align:center;color:#888;">Belum ada kategori.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Produk Kami -->
    <section class="produk-section" id="produk">
        <div class="container">
            <div class="produk-header-bar">
                <div>
                    <h2 class="produk-title">Produk Kami</h2>
                    <div class="produk-tabs">
                        <button type="button" class="produk-tab-item active" id="tab-terbaru">Terbaru</button>
                        <button type="button" class="produk-tab-item" id="tab-terlaris">Terlaris</button>
                    </div>
                </div>

                <a href="{{ route('katalog') }}" class="btn-view-all">
                    <span>Lihat Semua</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                        stroke-linejoin="round">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </a>
            </div>

            <div class="produk-grid" id="grid-terbaru">
                @forelse($produkTerbaru ?? ($produk ?? []) as $item)
                    @php
                        $motifPertama = $item->motif->first();
                        $gambar = $motifPertama->gambar_depan ?? ($motifPertama->gambar_kanan ?? ($motifPertama->gambar_kiri ?? ($motifPertama->gambar_dalam ?? null)));
                        $palette = ['#22C55E', '#8A5A1E'];
                    @endphp
                    <div class="produk-card">
                        <a href="{{ route('detail', $item->produk_id) }}" class="produk-card-link">
                            <div class="produk-photo-box"
                                style="background:#D9D9D9;width:100%;aspect-ratio:303/466;overflow:hidden;display:flex;align-items:center;justify-content:center;">
                                @if ($gambar)
                                    <img class="produk-card-image" src="{{ asset('assets/image/produk/' . $gambar) }}"
                                        alt="{{ $item->nama_produk }}" style="width:100%;height:100%;object-fit:cover;">
                                @else
                                    <img class="produk-card-image" src="" alt="{{ $item->nama_produk }}"
                                        style="display:none;width:100%;height:100%;object-fit:cover;">
                                    <svg class="produk-card-placeholder" width="32" height="32"
                                        viewBox="0 0 24 24" fill="none" stroke="#888" stroke-width="1.8"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2">
                                        </rect>
                                        <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                        <polyline points="21 15 16 10 5 21"></polyline>
                                    </svg>
                                @endif
                            </div>
                        </a>
                        <div class="produk-meta">
                            <a href="{{ route('detail', $item->produk_id) }}" class="produk-card-link">
                                <h3 class="produk-name">{{ \Illuminate\Support\Str::words($item->nama_produk, 3, '') }}</h3>
                            </a>
                            <p class="produk-price">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                            @if ($item->motif->count() > 0)
                                <div class="color-dots">
                                    @foreach ($item->motif->take(2) as $idx => $motif)
                                        <button type="button" class="color-dot {{ $loop->first ? 'active' : '' }}"
                                            style="background:{{ $palette[$idx % count($palette)] }};"
                                            title="{{ $motif->nama_motif }}"
                                            aria-label="Pilih motif {{ $motif->nama_motif }}"
                                            aria-pressed="{{ $loop->first ? 'true' : 'false' }}"
                                            data-image="{{ $motif->gambar_depan ?? ($motif->gambar_kanan ?? ($motif->gambar_kiri ?? $motif->gambar_dalam)) ? asset('assets/image/produk/' . ($motif->gambar_depan ?? ($motif->gambar_kanan ?? ($motif->gambar_kiri ?? $motif->gambar_dalam)))) : '' }}"
                                            data-motif="{{ $motif->nama_motif }}"></button>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <p style="text-align:center;color:#888;grid-column:1/-1;">Belum ada produk terbaru.</p>
                @endforelse
            </div>

            <div class="produk-grid" id="grid-terlaris" style="display:none;">
                @forelse($produkTerlaris ?? ($produk ?? []) as $item)
                    @php
                        $motifPertama = $item->motif->first();
                        $gambar = $motifPertama->gambar_depan ?? ($motifPertama->gambar_kanan ?? ($motifPertama->gambar_kiri ?? ($motifPertama->gambar_dalam ?? null)));
                        $palette = ['#22C55E', '#8A5A1E'];
                    @endphp
                    <div class="produk-card">
                        <a href="{{ route('detail', $item->produk_id) }}" class="produk-card-link">
                            <div class="produk-photo-box"
                                style="background:#D9D9D9;width:100%;aspect-ratio:303/466;overflow:hidden;display:flex;align-items:center;justify-content:center;">
                                @if ($gambar)
                                    <img class="produk-card-image" src="{{ asset('assets/image/produk/' . $gambar) }}"
                                        alt="{{ $item->nama_produk }}" style="width:100%;height:100%;object-fit:cover;">
                                @else
                                    <img class="produk-card-image" src="" alt="{{ $item->nama_produk }}"
                                        style="display:none;width:100%;height:100%;object-fit:cover;">
                                    <svg class="produk-card-placeholder" width="32" height="32"
                                        viewBox="0 0 24 24" fill="none" stroke="#888" stroke-width="1.8"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2">
                                        </rect>
                                        <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                        <polyline points="21 15 16 10 5 21"></polyline>
                                    </svg>
                                @endif
                            </div>
                        </a>
                        <div class="produk-meta">
                            <a href="{{ route('detail', $item->produk_id) }}" class="produk-card-link">
                                <h3 class="produk-name">{{ \Illuminate\Support\Str::words($item->nama_produk, 3, '') }}</h3>
                            </a>
                            <p class="produk-price">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                            @if ($item->motif->count() > 0)
                                <div class="color-dots">
                                    @foreach ($item->motif->take(2) as $idx => $motif)
                                        <button type="button" class="color-dot {{ $loop->first ? 'active' : '' }}"
                                            style="background:{{ $palette[$idx % count($palette)] }};"
                                            title="{{ $motif->nama_motif }}"
                                            aria-label="Pilih motif {{ $motif->nama_motif }}"
                                            aria-pressed="{{ $loop->first ? 'true' : 'false' }}"
                                            data-image="{{ $motif->gambar_depan ?? ($motif->gambar_kanan ?? ($motif->gambar_kiri ?? $motif->gambar_dalam)) ? asset('assets/image/produk/' . ($motif->gambar_depan ?? ($motif->gambar_kanan ?? ($motif->gambar_kiri ?? $motif->gambar_dalam)))) : '' }}"
                                            data-motif="{{ $motif->nama_motif }}"></button>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <p style="text-align:center;color:#888;grid-column:1/-1;">Belum ada produk terlaris.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Testimoni -->
    <section class="testimoni-section" id="testimoni">
        <div class="container">
            <div class="section-header-center">
                <span class="section-label">Testimoni</span>
                <h2 class="section-title">Yang Pelanggan Kami Katakan</h2>
            </div>

            <div class="testimoni-grid">
                <div class="testimoni-card">
                    <img src="{{ asset('assets/image/testimoni/avatar_laisa.png') }}" alt="Laisa Rachmanita"
                        class="testimoni-avatar" style="border-radius:50%;object-fit:cover;border:1px solid #B79361;">
                    <div class="testimoni-name w-500">Laisa Rachmanita</div>
                    <div class="testimoni-email w-400">Laisarachmanita@gmail.com</div>
                    <div class="testimoni-stars">
                        @for ($i = 0; $i < 5; $i++)
                            <svg viewBox="0 0 24 24">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                </polygon>
                            </svg>
                        @endfor
                    </div>
                    <p class="testimoni-quote">"Produknya bagus banget! Motifnya unik dan warnanya cantik. Tasnya juga
                        cocok digunakan untuk berbagai kegiatan."</p>
                    <div class="testimoni-prod-label">PRODUK:</div>
                    <div class="testimoni-prod-name">Tas Lipat Sasirangan</div>
                </div>

                <div class="testimoni-card">
                    <img src="{{ asset('assets/image/testimoni/avatar_rania.png') }}" alt="Rania Safitri"
                        class="testimoni-avatar" style="border-radius:50%;object-fit:cover;border:1px solid #B79361;">
                    <div class="testimoni-name w-700">Rania Safitri</div>
                    <div class="testimoni-email w-400">RaniaSaftri@gmail.com</div>
                    <div class="testimoni-stars">
                        @for ($i = 0; $i < 5; $i++)
                            <svg viewBox="0 0 24 24">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                </polygon>
                            </svg>
                        @endfor
                    </div>
                    <p class="testimoni-quote">"Suka banget sama desain dan perpaduan motifnya. Tasnya terlihat elegan,
                        cocok dipakai jalan-jalan."</p>
                    <div class="testimoni-prod-label">PRODUK:</div>
                    <div class="testimoni-prod-name">Mini Sling Bag</div>
                </div>

                <div class="testimoni-card">
                    <img src="{{ asset('assets/image/testimoni/avatar_nadia.png') }}" alt="Nadia Putri"
                        class="testimoni-avatar" style="border-radius:50%;object-fit:cover;border:1px solid #B79361;">
                    <div class="testimoni-name w-700">Nadia Putri</div>
                    <div class="testimoni-email w-300">NadiaPutri@gmail.com</div>
                    <div class="testimoni-stars">
                        @for ($i = 0; $i < 5; $i++)
                            <svg viewBox="0 0 24 24">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                </polygon>
                            </svg>
                        @endfor
                    </div>
                    <p class="testimoni-quote">"Ukurannya pas untuk membawa barang penting sehari-hari. motif
                        Sasirangannya bikin tas ini terlihat unik."</p>
                    <div class="testimoni-prod-label">PRODUK:</div>
                    <div class="testimoni-prod-name">Rabita Tas Sasirangan Glowy</div>
                </div>

                <div class="testimoni-card">
                    <img src="{{ asset('assets/image/testimoni/avatar_dinda.png') }}" alt="Dinda Maharani"
                        class="testimoni-avatar" style="border-radius:50%;object-fit:cover;border:1px solid #B79361;">
                    <div class="testimoni-name w-700">Dinda Maharani</div>
                    <div class="testimoni-email w-300">DindaMaharani@gmail.com</div>
                    <div class="testimoni-stars">
                        @for ($i = 0; $i < 5; $i++)
                            <svg viewBox="0 0 24 24">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                </polygon>
                            </svg>
                        @endfor
                    </div>
                    <p class="testimoni-quote">"Modelnya nggak pasaran. Motif Sasirangannya punya ciri khas tersendiri,
                        jadi terasa seperti tas mewah."</p>
                    <div class="testimoni-prod-label">PRODUK:</div>
                    <div class="testimoni-prod-name">Rabita Tas Sasirangan Halfmoon</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog -->
    <section class="blog-section" id="blog">
        <div class="container">
            <div class="section-header-center">
                <span class="section-label">Blog</span>
                <h2 class="section-title">Baca Perjalanan Fair & Bazar Kami</h2>
            </div>

            <div class="blog-grid">
                @forelse($blog ?? [] as $bl)
                    <div class="blog-card">
                        <div class="blog-photo-box"
                            style="width:100%;height:466px;overflow:hidden;background:#D9D9D9;display:flex;align-items:center;justify-content:center;">
                            @if ($bl->thumbnail)
                                <img src="{{ asset('assets/image/blog/' . $bl->thumbnail) }}" alt="{{ $bl->judul }}"
                                    style="width:100%;height:100%;object-fit:cover;">
                            @else
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#888"
                                    stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2">
                                    </rect>
                                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                    <polyline points="21 15 16 10 5 21"></polyline>
                                </svg>
                            @endif
                        </div>
                        <div class="blog-content">
                            <h3 class="blog-title">{{ $bl->judul }}</h3>
                            <a href="{{ route('blog.show.public', $bl->blog_id) }}" class="blog-link">
                                <span>Lihat</span>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <p style="text-align:center;color:#888;grid-column:1/-1;">Belum ada artikel blog.</p>
                @endforelse
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tabTerbaru = document.getElementById('tab-terbaru');
            var tabTerlaris = document.getElementById('tab-terlaris');
            var gridTerbaru = document.getElementById('grid-terbaru');
            var gridTerlaris = document.getElementById('grid-terlaris');

            if (tabTerbaru && tabTerlaris && gridTerbaru && gridTerlaris) {
                tabTerbaru.addEventListener('click', function() {
                    tabTerbaru.classList.add('active');
                    tabTerlaris.classList.remove('active');
                    gridTerbaru.style.display = 'grid';
                    gridTerlaris.style.display = 'none';
                });

                tabTerlaris.addEventListener('click', function() {
                    tabTerlaris.classList.add('active');
                    tabTerbaru.classList.remove('active');
                    gridTerlaris.style.display = 'grid';
                    gridTerbaru.style.display = 'none';
                });
            }

            document.querySelectorAll('.color-dot').forEach(function(dot) {
                dot.addEventListener('click', function() {
                    var card = dot.closest('.produk-card');
                    if (!card) return;

                    card.querySelectorAll('.color-dot').forEach(function(item) {
                        item.classList.remove('active');
                        item.setAttribute('aria-pressed', 'false');
                    });
                    dot.classList.add('active');
                    dot.setAttribute('aria-pressed', 'true');

                    var image = card.querySelector('.produk-card-image');
                    var imageUrl = dot.getAttribute('data-image');
                    if (image && imageUrl) {
                        image.src = imageUrl;
                        image.style.display = 'block';
                        image.alt = dot.getAttribute('data-motif') || image.alt;
                        var placeholder = card.querySelector('.produk-card-placeholder');
                        if (placeholder) placeholder.style.display = 'none';
                    }
                });
            });

            var kategoriRow = document.getElementById('koleksi-grid');
            var kategoriPrev = document.getElementById('koleksi-prev');
            var kategoriNext = document.getElementById('koleksi-next');

            if (kategoriRow && kategoriPrev && kategoriNext) {
                function updateKategoriArrows() {
                    var maxScroll = kategoriRow.scrollWidth - kategoriRow.clientWidth;
                    kategoriPrev.disabled = kategoriRow.scrollLeft <= 1;
                    kategoriNext.disabled = kategoriRow.scrollLeft >= maxScroll - 1;
                }

                function scrollKategori(direction) {
                    var card = kategoriRow.querySelector('.koleksi-card');
                    if (!card) return;

                    var gap = parseFloat(window.getComputedStyle(kategoriRow).columnGap) || 0;
                    kategoriRow.scrollBy({
                        left: direction * (card.getBoundingClientRect().width + gap),
                        behavior: 'smooth'
                    });
                }

                kategoriPrev.addEventListener('click', function() {
                    scrollKategori(-1);
                });
                kategoriNext.addEventListener('click', function() {
                    scrollKategori(1);
                });
                kategoriRow.addEventListener('scroll', updateKategoriArrows);
                window.addEventListener('resize', updateKategoriArrows);
                updateKategoriArrows();
            }
        });
    </script>
@endsection
