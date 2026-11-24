@extends('layouts.user')

@section('head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>Katalog Produk | Rabita</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600&family=Lato:wght@400;500&family=Playball&display=swap"
        rel="stylesheet">
    @vite(['resources/css/user/pages/katalog.css', 'resources/css/user/components.css'])
@endsection

@section('content')
    <main>
        <section class="cats">
            <div class="wrap">
                <div class="crumb-row">
                    <div class="crumb">
                        <a href="{{ route('home') }}">Beranda</a>
                        <i>/</i>
                        <b>{{ $selectedKategori ? $selectedKategori->nama_kategori : 'Semua Produk' }}</b>
                    </div>
                    @if ($kategoriList->count() + 1 > 5)
                        <div class="arrows" aria-label="Navigasi kategori">
                            <button id="prev" type="button" aria-label="Kategori sebelumnya">
                                <svg viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="m15 18-6-6 6-6"></path>
                                </svg>
                            </button>
                            <button id="next" type="button" aria-label="Kategori berikutnya">
                                <svg viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="m9 18 6-6-6-6"></path>
                                </svg>
                            </button>
                        </div>
                    @endif
                </div>

                <div class="catrow" id="catrow">
                    <a href="{{ route('katalog') }}" class="cat {{ !$selectedKategori ? 'active' : '' }}">
                        <div class="ph">
                            <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#666"
                                stroke-width="1.6">
                                <rect x="3" y="3" width="7" height="7" />
                                <rect x="14" y="3" width="7" height="7" />
                                <rect x="14" y="14" width="7" height="7" />
                                <rect x="3" y="14" width="7" height="7" />
                            </svg>
                        </div>
                        <span>Semua Kategori</span>
                    </a>
                    @foreach ($kategoriList as $c)
                        <a href="{{ route('katalog', ['kategori' => $c->kategori_id]) }}"
                            class="cat {{ $selectedKategori && $selectedKategori->kategori_id == $c->kategori_id ? 'active' : '' }}">
                            <div class="ph">
                                @if ($c->gambar && file_exists(public_path('assets/image/kategori/' . $c->gambar)))
                                    <img src="{{ asset('assets/image/kategori/' . $c->gambar) }}"
                                        alt="{{ $c->nama_kategori }}">
                                @elseif($c->gambar && file_exists(public_path('assets/image/' . $c->gambar)))
                                    <img src="{{ asset('assets/image/' . $c->gambar) }}" alt="{{ $c->nama_kategori }}">
                                @else
                                    <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#666"
                                        stroke-width="1.5">
                                        <rect x="3" y="4" width="18" height="16" rx="2" />
                                        <circle cx="9" cy="10" r="1.6" />
                                        <path d="m21 16-5-5-8 8" />
                                    </svg>
                                @endif
                            </div>
                            <span>{{ $c->nama_kategori }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="prod">
            <div class="wrap">
                <h2>{{ $selectedKategori ? 'Produk Kategori ' . $selectedKategori->nama_kategori : 'Semua Produk Rabita' }}
                </h2>

                <div class="bar">
                    <b>{{ $totalProduk }} Produk Ditemukan</b>
                    <div class="sort">
                        <label for="sort-select">Urutkan:</label>
                        <div class="sel">
                            <select id="sort-select" onchange="applySort(this.value)">
                                <option value="def" {{ $sort === 'def' ? 'selected' : '' }}>Terbaru</option>
                                <option value="asc" {{ $sort === 'asc' ? 'selected' : '' }}>Harga Terendah</option>
                                <option value="desc" {{ $sort === 'desc' ? 'selected' : '' }}>Harga Tertinggi
                                </option>
                                <option value="az" {{ $sort === 'az' ? 'selected' : '' }}>Nama A-Z</option>
                            </select>
                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none" stroke-width="1.4"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="m1.5 3.5 3.5 3.5 3.5-3.5" />
                            </svg>
                        </div>
                    </div>
                </div>

                <p id="sort-error" class="sort-error" role="alert" hidden></p>

                <div class="grid">
                    @forelse($produk as $p)
                        @php
                            $firstMotif = $p->motif->first();
                            $img = $firstMotif->gambar_depan ?? ($firstMotif->gambar_kanan ?? ($firstMotif->gambar_kiri ?? ($firstMotif->gambar_dalam ?? null)));
                            $palette = ['#22C55E', '#8A5A1E'];
                        @endphp
                        <div class="card">
                            <a href="{{ route('detail', $p->produk_id) }}" class="card-link">
                                <div class="card-thumb">
                                    @if ($img && file_exists(public_path('assets/image/produk/' . $img)))
                                        <img class="product-card-image" src="{{ asset('assets/image/produk/' . $img) }}"
                                            alt="{{ $p->nama_produk }}">
                                    @else
                                        <img class="product-card-image" src="" alt="{{ $p->nama_produk }}"
                                            style="display:none;">
                                        <svg class="product-card-placeholder" width="32" height="32"
                                            viewBox="0 0 24 24" fill="none" stroke="#888" stroke-width="1.5">
                                            <rect x="3" y="4" width="18" height="16" rx="2" />
                                            <circle cx="9" cy="10" r="1.6" />
                                            <path d="m21 16-5-5-8 8" />
                                        </svg>
                                    @endif
                                </div>
                                <h3>{{ \Illuminate\Support\Str::words($p->nama_produk, 3, '') }}</h3>
                                <div class="price">Rp {{ number_format($p->harga, 0, ',', '.') }}</div>
                            </a>
                            <div class="dots">
                                @foreach ($p->motif->take(2) as $idx => $m)
                                    @php
                                        $motifImage = $m->gambar_depan ?? ($m->gambar_kanan ?? ($m->gambar_kiri ?? $m->gambar_dalam));
                                        $motifImageUrl = $motifImage ? asset('assets/image/produk/' . $motifImage) : '';
                                    @endphp
                                    <button type="button" class="dot {{ $loop->first ? 'active' : '' }}"
                                        style="background:{{ $palette[$idx % count($palette)] }};"
                                        title="{{ $m->nama_motif }}" aria-label="Pilih motif {{ $m->nama_motif }}"
                                        aria-pressed="{{ $loop->first ? 'true' : 'false' }}"
                                        data-image="{{ $motifImageUrl }}" data-motif="{{ $m->nama_motif }}"></button>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <div class="empty">Tidak ada produk yang ditemukan untuk kategori ini.</div>
                    @endforelse
                </div>

                @if ($produk->hasPages())
                    <div class="pager">
                        @if ($produk->onFirstPage())
                            <span style="opacity:0.4;cursor:not-allowed;">&lt;</span>
                        @else
                            <a href="{{ $produk->previousPageUrl() }}">&lt;</a>
                        @endif

                        @foreach ($produk->getUrlRange(1, $produk->lastPage()) as $page => $url)
                            @if ($page == $produk->currentPage())
                                <span class="on">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}">{{ $page }}</a>
                            @endif
                        @endforeach

                        @if ($produk->hasMorePages())
                            <a href="{{ $produk->nextPageUrl() }}">&gt;</a>
                        @else
                            <span style="opacity:0.4;cursor:not-allowed;">&gt;</span>
                        @endif
                    </div>
                @endif
            </div>
        </section>
    </main>
@endsection

@section('scripts')
    <script>
        var row = document.getElementById('catrow');
        var prevBtn = document.getElementById('prev');
        var nextBtn = document.getElementById('next');
        if (row && prevBtn && nextBtn) {
            function updateCategoryArrows() {
                var maxScroll = row.scrollWidth - row.clientWidth;
                prevBtn.disabled = row.scrollLeft <= 1;
                nextBtn.disabled = row.scrollLeft >= maxScroll - 1;
            }

            function scrollCategory(direction) {
                var card = row.querySelector('.cat');
                if (!card) return;

                var gap = parseFloat(window.getComputedStyle(row).columnGap) || 0;
                row.scrollBy({
                    left: direction * (card.getBoundingClientRect().width + gap),
                    behavior: 'smooth'
                });
            }

            prevBtn.addEventListener('click', function() {
                scrollCategory(-1);
            });
            nextBtn.addEventListener('click', function() {
                scrollCategory(1);
            });
            row.addEventListener('scroll', updateCategoryArrows);
            window.addEventListener('resize', updateCategoryArrows);
            updateCategoryArrows();
        }

        document.addEventListener('click', function(event) {
            var dot = event.target.closest('.dots .dot');
            if (!dot) return;

            var card = dot.closest('.card');
            if (!card) return;

            card.querySelectorAll('.dots .dot').forEach(function(item) {
                item.classList.remove('active');
                item.setAttribute('aria-pressed', 'false');
            });
            dot.classList.add('active');
            dot.setAttribute('aria-pressed', 'true');

            var image = card.querySelector('.product-card-image');
            var imageUrl = dot.getAttribute('data-image');
            if (image && imageUrl) {
                image.src = imageUrl;
                image.style.display = 'block';
                image.alt = dot.getAttribute('data-motif') || image.alt;
                var placeholder = card.querySelector('.product-card-placeholder');
                if (placeholder) placeholder.style.display = 'none';
            }
        });

        var sortSelect = document.getElementById('sort-select');
        var currentSort = sortSelect.value;
        var sortRequest = null;

        async function loadSortedProducts(url, addHistoryEntry) {
            if (sortRequest) sortRequest.abort();

            var controller = new AbortController();
            sortRequest = controller;
            var scrollPosition = window.scrollY;
            var sortError = document.getElementById('sort-error');

            sortSelect.disabled = true;
            sortError.hidden = true;
            sortError.textContent = '';

            try {
                var response = await fetch(url.toString(), {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    signal: controller.signal
                });
                if (!response.ok) {
                    throw new Error('Sort request failed with status ' + response.status);
                }

                var responseDocument = new DOMParser().parseFromString(await response.text(), 'text/html');
                var nextCount = responseDocument.querySelector('.prod .bar b');
                var nextGrid = responseDocument.querySelector('.prod .grid');
                var nextPager = responseDocument.querySelector('.prod .pager');
                var currentCount = document.querySelector('.prod .bar b');
                var currentGrid = document.querySelector('.prod .grid');

                if (!nextCount || !nextGrid || !currentCount || !currentGrid) {
                    throw new Error('Sort response did not contain product results');
                }

                currentCount.textContent = nextCount.textContent;
                currentGrid.replaceWith(nextGrid);

                var currentPager = document.querySelector('.prod .pager');
                if (currentPager && nextPager) {
                    currentPager.replaceWith(nextPager);
                } else if (currentPager) {
                    currentPager.remove();
                } else if (nextPager) {
                    nextGrid.insertAdjacentElement('afterend', nextPager);
                }

                currentSort = url.searchParams.get('sort') || 'def';
                sortSelect.value = currentSort;
                if (addHistoryEntry) {
                    window.history.pushState({ sort: currentSort }, '', url);
                }
                window.scrollTo(0, scrollPosition);
            } catch (error) {
                if (error.name === 'AbortError') return;

                console.error('Gagal mengurutkan produk:', error);
                sortSelect.value = currentSort;
                sortError.textContent = 'Gagal mengurutkan produk. Silakan coba lagi.';
                sortError.hidden = false;
            } finally {
                if (sortRequest === controller) {
                    sortRequest = null;
                    sortSelect.disabled = false;
                }
            }
        }

        function applySort(val) {
            var url = new URL(window.location.href);
            url.searchParams.set('sort', val);
            url.searchParams.set('page', '1');
            loadSortedProducts(url, true);
        }

        window.addEventListener('popstate', function() {
            var url = new URL(window.location.href);
            sortSelect.value = url.searchParams.get('sort') || 'def';
            loadSortedProducts(url, false);
        });
    </script>
@endsection
