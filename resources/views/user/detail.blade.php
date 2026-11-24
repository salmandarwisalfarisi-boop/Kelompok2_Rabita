@extends('layouts.user')

@section('head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>{{ $produk->nama_produk }} | Detail Produk Rabita</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600&family=Lato:wght@400;500&family=Playball&display=swap"
        rel="stylesheet">
    @vite(['resources/css/user/pages/detail.css', 'resources/css/user/components.css'])
@endsection

@section('content')
    <main>
        <section class="detail">
            <div class="in">
                <div class="crumb">
                    <a href="{{ route('home') }}">Beranda</a>
                    <i>/</i>
                    <a
                        href="{{ route('katalog', ['kategori' => $produk->kategori_id]) }}">{{ $produk->kategori->nama_kategori ?? 'Koleksi' }}</a>
                    <i>/</i>
                    <b>{{ $produk->nama_produk }}</b>
                </div>

                <div class="cols">
                    <div class="gal">
                        @php
                            $firstMotif = $produk->motif->first();
                            $galleryFields = [
                                'gambar_kanan' => 'Foto kanan',
                                'gambar_kiri' => 'Foto kiri',
                                'gambar_dalam' => 'Foto dalam',
                            ];
                            $mainImg = $firstMotif ? $firstMotif->gambar_depan : null;
                            if (!$mainImg || !file_exists(public_path('assets/image/produk/' . $mainImg))) {
                                foreach ($galleryFields as $field => $label) {
                                    $candidate = $firstMotif ? $firstMotif->{$field} : null;
                                    if ($candidate && file_exists(public_path('assets/image/produk/' . $candidate))) {
                                        $mainImg = $candidate;
                                        break;
                                    }
                                }
                            }
                            $galleryImages = [];
                            $seenImages = $mainImg ? [$mainImg] : [];
                            foreach ($galleryFields as $field => $label) {
                                $filename = $firstMotif ? $firstMotif->{$field} : null;
                                if (
                                    $filename &&
                                    !in_array($filename, $seenImages, true) &&
                                    file_exists(public_path('assets/image/produk/' . $filename))
                                ) {
                                    $galleryImages[] = [
                                        'src' => asset('assets/image/produk/' . $filename),
                                        'alt' => $label,
                                    ];
                                    $seenImages[] = $filename;
                                }
                            }
                        @endphp
                        <div class="main" id="main-gal">
                            @if ($mainImg && file_exists(public_path('assets/image/produk/' . $mainImg)))
                                <img src="{{ asset('assets/image/produk/' . $mainImg) }}" id="main-img"
                                    alt="{{ $produk->nama_produk }}">
                            @else
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#8F897E"
                                    stroke-width="1.4">
                                    <rect x="3" y="4" width="18" height="16" rx="2" />
                                    <circle cx="9" cy="10" r="1.6" />
                                    <path d="m21 16-5-5-8 8" />
                                </svg>
                            @endif
                        </div>
                        <div class="thumbs" id="thumbs-gal" @if (count($galleryImages) === 0) hidden @endif>
                            @foreach ($galleryImages as $image)
                                <button type="button" class="thumb-item" aria-label="{{ $image['alt'] }}"
                                    onclick="switchPhoto(this)">
                                    <img src="{{ $image['src'] }}" alt="{{ $image['alt'] }}">
                                </button>
                            @endforeach
                        </div>
                        <button class="arr l" id="prev-btn" aria-label="Foto sebelumnya"
                            @if (count($galleryImages) <= 2) hidden @endif>&lt;</button>
                        <button class="arr r" id="next-btn" aria-label="Foto berikutnya"
                            @if (count($galleryImages) <= 2) hidden @endif>&gt;</button>
                    </div>

                    <div class="info">
                        <h1>{{ $produk->nama_produk }}</h1>
                        <div class="price">Rp {{ number_format($produk->harga, 0, ',', '.') }}</div>

                        <div class="lbl motif">Motif : <span
                                id="mn">{{ $firstMotif->nama_motif ?? 'Standar' }}</span></div>

                        <div class="dots" id="motif-dots">
                            @php
                                $palette = ['#22C55E', '#8A5A1E'];
                            @endphp
                            @foreach ($produk->motif->take(5) as $idx => $m)
                                @php
                                    $warnaBg = $palette[$idx % count($palette)];
                                    $gambarDepan = $m->gambar_depan;
                                    if (!$gambarDepan || !file_exists(public_path('assets/image/produk/' . $gambarDepan))) {
                                        foreach ($galleryFields as $field => $label) {
                                            $candidate = $m->{$field};
                                            if ($candidate && file_exists(public_path('assets/image/produk/' . $candidate))) {
                                                $gambarDepan = $candidate;
                                                break;
                                            }
                                        }
                                    }
                                    $fDepan = $gambarDepan ? asset('assets/image/produk/' . $gambarDepan) : '';
                                    $motifGallery = [];
                                    $motifSeenImages = $gambarDepan ? [$gambarDepan] : [];
                                    foreach ($galleryFields as $field => $label) {
                                        $filename = $m->{$field};
                                        if (
                                            $filename &&
                                            !in_array($filename, $motifSeenImages, true) &&
                                            file_exists(public_path('assets/image/produk/' . $filename))
                                        ) {
                                            $motifGallery[] = [
                                                'src' => asset('assets/image/produk/' . $filename),
                                                'alt' => $label,
                                            ];
                                            $motifSeenImages[] = $filename;
                                        }
                                    }
                                @endphp
                                <button type="button" class="dot {{ $loop->first ? 'active' : '' }}"
                                    style="background: {{ $warnaBg }};" data-id="{{ $m->motif_id }}"
                                    data-nama="{{ $m->nama_motif }}" data-depan="{{ $fDepan }}"
                                    data-gallery='@json($motifGallery)'
                                    aria-pressed="{{ $loop->first ? 'true' : 'false' }}" title="{{ $m->nama_motif }}"
                                    aria-label="{{ $m->nama_motif }}">
                                </button>
                            @endforeach
                        </div>

                        <div class="lbl qlbl">Kuantitas :</div>
                        <div class="qty">
                            <button type="button" id="minus-btn" aria-label="Kurangi">
                                <svg width="20" height="20" viewBox="0 0 20 20" stroke="currentColor"
                                    stroke-width="1.3">
                                    <path d="M2 10h16" />
                                </svg>
                            </button>
                            <span id="qty-val">1</span>
                            <button type="button" id="plus-btn" aria-label="Tambah">
                                <svg width="20" height="20" viewBox="0 0 20 20" stroke="currentColor"
                                    stroke-width="1.3">
                                    <path d="M10 2v16M2 10h16" />
                                </svg>
                            </button>
                        </div>

                        <div class="hr"></div>

                        <form id="product-action-form" method="POST"
                            action="{{ route('keranjang.add', $produk->produk_id) }}">
                            @csrf
                            <input type="hidden" name="motif_id" id="input_motif_id"
                                value="{{ $firstMotif->motif_id ?? '' }}">
                            <input type="hidden" name="qty" id="input_qty" value="1">

                            <div class="btns">
                                <button type="button" class="buy" id="btn-beli-sekarang">Beli Sekarang</button>
                                <button type="submit" class="cart" id="btn-keranjang">Masukkan Keranjang</button>
                            </div>
                        </form>

                        <div class="sec s1">
                            <h2>Deskripsi Produk</h2>
                            <p>{{ $produk->deskripsi_produk ?: 'Tas Sasirangan eksklusif dari Rabita dengan sentuhan motif etnik khas Banjar bernilai seni tinggi, dipadukan dengan material pilihan yang nyaman dan fungsional untuk kegiatan sehari-hari.' }}
                            </p>
                        </div>

                        <div class="sec s2">
                            <h2>Ukuran</h2>
                            <p>{{ $produk->ukuran ?: 'Standar' }}</p>
                        </div>

                        <div class="sec s3">
                            <h2>Material</h2>
                            <p>{{ $produk->material ?: 'Kain Sasirangan Premium' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="more">
            <div class="wrap">
                <h2>Check Produk Lainnya</h2>
                <div class="grid">
                    @forelse($produkLainnya as $lain)
                        @php
                            $lainImg = $lain->motif->first()?->gambar_depan;
                        @endphp
                        <a href="{{ route('detail', $lain->produk_id) }}" class="card">
                            <div class="card-thumb">
                                @if ($lainImg && file_exists(public_path('assets/image/produk/' . $lainImg)))
                                    <img src="{{ asset('assets/image/produk/' . $lainImg) }}"
                                        alt="{{ $lain->nama_produk }}">
                                @else
                                    <div
                                        style="display:flex;align-items:center;justify-content:center;height:100%;color:#888;">
                                        <span>Rabita</span>
                                    </div>
                                @endif
                            </div>
                            <h3>{{ \Illuminate\Support\Str::words($lain->nama_produk, 3, '') }}</h3>
                            <div class="cp">Rp {{ number_format($lain->harga, 0, ',', '.') }}</div>
                            <div class="dots">
                                @foreach ($lain->motif->take(2) as $idx => $m)
                                    <span class="dot {{ $loop->first ? 'active' : '' }}"
                                        style="background:{{ $palette[$idx % count($palette)] }};"
                                        title="{{ $m->nama_motif }}"></span>
                                @endforeach
                            </div>
                        </a>
                    @empty
                        <p style="text-align:center;grid-column:1/-1;color:#888;">Tidak ada produk lainnya.</p>
                    @endforelse
                </div>
            </div>
        </section>
    </main>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var dotsContainer = document.getElementById('motif-dots');
            var mnText = document.getElementById('mn');
            var inputMotif = document.getElementById('input_motif_id');
            var inputQty = document.getElementById('input_qty');
            var qtyVal = document.getElementById('qty-val');
            var plusBtn = document.getElementById('plus-btn');
            var minusBtn = document.getElementById('minus-btn');
            var btnBeli = document.getElementById('btn-beli-sekarang');
            var mainImg = document.getElementById('main-img');
            var gallery = document.getElementById('thumbs-gal');
            var prevGallery = document.getElementById('prev-btn');
            var nextGallery = document.getElementById('next-btn');
            var currentQty = 1;

            function renderGallery(images) {
                if (!gallery) return;

                gallery.innerHTML = '';
                images.forEach(function(photo) {
                    var item = document.createElement('button');
                    item.type = 'button';
                    item.className = 'thumb-item';
                    item.setAttribute('aria-label', photo.alt);

                    var image = document.createElement('img');
                    image.src = photo.src;
                    image.alt = photo.alt;
                    item.appendChild(image);
                    item.addEventListener('click', function() {
                        if (mainImg) mainImg.src = photo.src;
                    });
                    gallery.appendChild(item);
                });

                gallery.hidden = images.length === 0;
                if (prevGallery) prevGallery.hidden = images.length <= 2;
                if (nextGallery) nextGallery.hidden = images.length <= 2;
                gallery.scrollLeft = 0;
            }

            function scrollGallery(direction) {
                if (!gallery) return;
                var item = gallery.querySelector('.thumb-item');
                var gap = parseFloat(window.getComputedStyle(gallery).columnGap) || 0;
                var distance = item ? item.getBoundingClientRect().width + gap : gallery.clientWidth;
                gallery.scrollBy({ left: direction * distance, behavior: 'smooth' });
            }

            if (prevGallery) {
                prevGallery.addEventListener('click', function() {
                    scrollGallery(-1);
                });
            }
            if (nextGallery) {
                nextGallery.addEventListener('click', function() {
                    scrollGallery(1);
                });
            }

            var initialDot = dotsContainer ? dotsContainer.querySelector('.dot.active') : null;
            if (initialDot) {
                renderGallery(JSON.parse(initialDot.getAttribute('data-gallery') || '[]'));
            }

            plusBtn.addEventListener('click', function() {
                currentQty++;
                qtyVal.textContent = currentQty;
                inputQty.value = currentQty;
            });

            minusBtn.addEventListener('click', function() {
                if (currentQty > 1) {
                    currentQty--;
                    qtyVal.textContent = currentQty;
                    inputQty.value = currentQty;
                }
            });

            if (dotsContainer) {
                dotsContainer.addEventListener('click', function(e) {
                    var dot = e.target.closest('.dot');
                    if (!dot) return;
                    dotsContainer.querySelectorAll('.dot').forEach(function(d) {
                        d.classList.remove('active');
                    });
                    dot.classList.add('active');

                    var nama = dot.getAttribute('data-nama');
                    var id = dot.getAttribute('data-id');
                    var depan = dot.getAttribute('data-depan');
                    var motifGallery = JSON.parse(dot.getAttribute('data-gallery') || '[]');

                    dotsContainer.querySelectorAll('.dot').forEach(function(d) {
                        d.setAttribute('aria-pressed', d === dot ? 'true' : 'false');
                    });

                    if (mnText) mnText.textContent = nama;
                    if (inputMotif) inputMotif.value = id;
                    if (mainImg && depan) {
                        mainImg.src = depan;
                    }
                    renderGallery(motifGallery);
                });
            }

            if (btnBeli) {
                btnBeli.addEventListener('click', function() {
                    var motifId = inputMotif.value;
                    var q = inputQty.value;
                    var checkoutUrl = "{{ route('checkout') }}" + "?buy_now=1&motif_id=" +
                        encodeURIComponent(motifId) + "&qty=" + encodeURIComponent(q);
                    window.location.href = checkoutUrl;
                });
            }
        });

        function switchPhoto(el) {
            var clickedImg = el.querySelector('img');
            var main = document.getElementById('main-img');
            if (clickedImg && main) {
                main.src = clickedImg.src;
            }
        }
    </script>
@endsection
