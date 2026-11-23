<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>Katalog Produk | Rabita</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600&family=Lato:wght@400;500&family=Playball&display=swap" rel="stylesheet">
    <style>
        :root{--nav:#151515;--foot:#1A1A1A;--gold:#C9A66B;--gold2:#B8935A;--bg1:#F5F4EF;--bg2:#F3F3F7;--card:#E9E5DE;--ink:#111;--tx:#5A5A5A;--ph:#E4E0D8;--ft:#CFCFCF;--fm:#7D7D7D;}
        box-sizing:border-box;padding-top:env(safe-area-inset-top,0px);padding-bottom:env(safe-area-inset-bottom,0px)}
        html{background:var(--nav);scroll-padding-top:env(safe-area-inset-top,0px)}
        *{box-sizing:border-box;margin:0;padding:0}
        body{font-family:'Plus Jakarta Sans',system-ui,sans-serif;background:var(--bg1);color:var(--tx)}
        svg{display:block}
        button{font-family:inherit;cursor:pointer}
        .wrap{max-width:1264px;margin:0 auto;padding:0 20px}
        
        /* KATEGORI CAROUSEL */
        .cats{background:var(--bg1);padding:38px 0 60px}
        .crumb-row{display:flex;justify-content:space-between;align-items:flex-end;height:46px;margin-bottom:18px}
        .crumb{font-size:12px;color:#7A7A7A;display:flex;gap:12px;padding-bottom:0}
        .crumb a{color:inherit;text-decoration:none}
        .crumb a:hover{color:var(--ink)}
        .crumb b{font-weight:500;color:var(--ink)}
        .crumb i{font-style:normal;color:#BDBDBD}
        .arrows{display:flex;gap:9px}
        .arrows button{width:46px;height:46px;border-radius:50%;border:1px solid var(--ink);background:transparent;font-size:22px;color:var(--ink);line-height:1}
        .catrow{display:grid;grid-auto-flow:column;grid-auto-columns:calc((100% - 68px)/5);gap:17px;overflow-x:auto;scroll-snap-type:x mandatory;scrollbar-width:none}
        .catrow::-webkit-scrollbar{display:none}
        .cat{background:var(--card);height:300px;scroll-snap-align:start;display:flex;flex-direction:column;align-items:center;justify-content:space-between;padding:40px 16px 24px;text-decoration:none;border-radius:6px;transition:all 0.2s}
        .cat:hover, .cat.active{background:#DDD8CE;box-shadow:0 4px 12px rgba(0,0,0,0.06)}
        .cat .ph{width:140px;height:140px;background:#D0CBC0;border-radius:4px;overflow:hidden;display:flex;align-items:center;justify-content:center}
        .cat .ph img{width:100%;height:100%;object-fit:cover}
        .cat span{font-size:18px;font-weight:500;color:var(--ink)}

        /* PRODUK LIST */
        .prod{background:var(--bg2);padding:70px 0 60px}
        .prod h2{text-align:center;font-weight:500;font-size:29px;color:var(--ink);letter-spacing:-.2px}
        .bar{margin-top:40px;background:#fff;border-radius:10px;box-shadow:0 2px 6px rgba(0,0,0,.08);height:56px;display:flex;align-items:center;justify-content:space-between;padding:0 26px}
        .bar b{font-weight:500;font-size:14px;color:var(--ink)}
        .sort{display:flex;align-items:center;gap:19px;font-size:12px;color:#8A8A8A}
        .sel{position:relative}
        .sel select{appearance:none;-webkit-appearance:none;border:1px solid #CFCFD4;border-radius:4px;background:#fff;height:34px;padding:0 34px 0 12px;font:500 12px 'Plus Jakarta Sans',sans-serif;color:var(--ink);cursor:pointer}
        .sel svg{position:absolute;right:11px;top:13px;stroke:var(--ink);pointer-events:none}
        .grid{display:grid;grid-template-columns:repeat(4,1fr);gap:48px 17px;margin-top:60px}
        .card{text-align:center;text-decoration:none;color:inherit;display:block}
        .card-thumb{aspect-ratio:297/457;width:100%;background:var(--ph);border-radius:4px;overflow:hidden;display:flex;align-items:center;justify-content:center}
        .card-thumb img{width:100%;height:100%;object-fit:cover;transition:transform 0.25s}
        .card:hover .card-thumb img{transform:scale(1.03)}
        .card h3{font-weight:400;font-size:21px;color:var(--ink);margin-top:18px}
        .price{font-size:14px;color:var(--tx);margin-top:6px}
        .dots{display:flex;justify-content:center;gap:8px;margin-top:12px}
        .dot{width:18px;height:18px;border-radius:50%;border:0;padding:0;background:#888}
        .empty{grid-column:1/-1;padding:100px 0;text-align:center;font-size:16px;color:#8A8A8A}

        /* PAGINATION */
        .pager{display:flex;justify-content:center;align-items:center;gap:6px;margin-top:60px}
        .pager a, .pager span{min-width:32px;height:32px;padding:0 8px;border-radius:4px;border:1px solid #DCDCE0;background:#fff;font-size:12px;color:var(--tx);display:inline-flex;align-items:center;justify-content:center;text-decoration:none;transition:all 0.15s}
        .pager a:hover{border-color:var(--gold2);color:var(--gold2)}
        .pager .on{background:var(--gold2);border-color:var(--gold2);color:#fff}

        @media(max-width:900px){
            .catrow{grid-auto-columns:46%}.cat{height:250px}
            .grid{grid-template-columns:repeat(2,1fr);gap:32px 14px}
            .bar{padding:0 16px;flex-direction:column;height:auto;padding:12px;gap:8px}
        }
    </style>
</head>
<body>
    <x-navbar />
    <main>
        <!-- Kategori Carousel -->
        <section class="cats">
            <div class="wrap">
                <div class="crumb-row">
                    <div class="crumb">
                        <a href="{{ route('home') }}">Beranda</a>
                        <i>/</i>
                        <b>{{ $selectedKategori ? $selectedKategori->nama_kategori : 'Semua Produk' }}</b>
                    </div>
                    <div class="arrows">
                        <button id="prev" aria-label="Sebelumnya">&lt;</button>
                        <button id="next" aria-label="Berikutnya">&gt;</button>
                    </div>
                </div>

                <div class="catrow" id="catrow">
                    <a href="{{ route('katalog') }}" class="cat {{ !$selectedKategori ? 'active' : '' }}">
                        <div class="ph">
                            <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#666" stroke-width="1.6"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                        </div>
                        <span>Semua Kategori</span>
                    </a>
                    @foreach($kategoriList as $c)
                        <a href="{{ route('katalog', ['kategori' => $c->kategori_id]) }}" class="cat {{ ($selectedKategori && $selectedKategori->kategori_id == $c->kategori_id) ? 'active' : '' }}">
                            <div class="ph">
                                @if($c->gambar && file_exists(public_path('assets/image/kategori/' . $c->gambar)))
                                    <img src="{{ asset('assets/image/kategori/' . $c->gambar) }}" alt="{{ $c->nama_kategori }}">
                                @elseif($c->gambar && file_exists(public_path('assets/image/' . $c->gambar)))
                                    <img src="{{ asset('assets/image/' . $c->gambar) }}" alt="{{ $c->nama_kategori }}">
                                @else
                                    <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#666" stroke-width="1.5"><rect x="3" y="4" width="18" height="16" rx="2"/><circle cx="9" cy="10" r="1.6"/><path d="m21 16-5-5-8 8"/></svg>
                                @endif
                            </div>
                            <span>{{ $c->nama_kategori }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Daftar Produk -->
        <section class="prod">
            <div class="wrap">
                <h2>{{ $selectedKategori ? 'Produk Kategori ' . $selectedKategori->nama_kategori : 'Semua Produk Rabita' }}</h2>

                <div class="bar">
                    <b>{{ $totalProduk }} Produk Ditemukan</b>
                    <div class="sort">
                        <label for="sort-select">Urutkan:</label>
                        <div class="sel">
                            <select id="sort-select" onchange="applySort(this.value)">
                                <option value="def" {{ $sort === 'def' ? 'selected' : '' }}>Terbaru</option>
                                <option value="asc" {{ $sort === 'asc' ? 'selected' : '' }}>Harga Terendah</option>
                                <option value="desc" {{ $sort === 'desc' ? 'selected' : '' }}>Harga Tertinggi</option>
                                <option value="az" {{ $sort === 'az' ? 'selected' : '' }}>Nama A-Z</option>
                            </select>
                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"><path d="m1.5 3.5 3.5 3.5 3.5-3.5"/></svg>
                        </div>
                    </div>
                </div>

                <div class="grid">
                    @forelse($produk as $p)
                        @php
                            $img = $p->motif->first()?->gambar_depan;
                        @endphp
                        <a href="{{ route('detail', $p->produk_id) }}" class="card">
                            <div class="card-thumb">
                                @if($img && file_exists(public_path('assets/image/produk/' . $img)))
                                    <img src="{{ asset('assets/image/produk/' . $img) }}" alt="{{ $p->nama_produk }}">
                                @else
                                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#888" stroke-width="1.5"><rect x="3" y="4" width="18" height="16" rx="2"/><circle cx="9" cy="10" r="1.6"/><path d="m21 16-5-5-8 8"/></svg>
                                @endif
                            </div>
                            <h3>{{ $p->nama_produk }}</h3>
                            <div class="price">Rp {{ number_format($p->harga, 0, ',', '.') }}</div>
                            <div class="dots">
                                @foreach($p->motif->take(4) as $m)
                                    <span class="dot" title="{{ $m->nama_motif }}"></span>
                                @endforeach
                            </div>
                        </a>
                    @empty
                        <div class="empty">Tidak ada produk yang ditemukan untuk kategori ini.</div>
                    @endforelse
                </div>

                @if($produk->hasPages())
                    <div class="pager">
                        {{-- Previous Link --}}
                        @if ($produk->onFirstPage())
                            <span style="opacity:0.4;cursor:not-allowed;">&lt;</span>
                        @else
                            <a href="{{ $produk->previousPageUrl() }}">&lt;</a>
                        @endif

                        {{-- Page Links --}}
                        @foreach ($produk->getUrlRange(1, $produk->lastPage()) as $page => $url)
                            @if ($page == $produk->currentPage())
                                <span class="on">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}">{{ $page }}</a>
                            @endif
                        @endforeach

                        {{-- Next Link --}}
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
    <x-footer />

    <script>
        var row = document.getElementById('catrow');
        var prevBtn = document.getElementById('prev');
        var nextBtn = document.getElementById('next');
        if (prevBtn && row) {
            prevBtn.onclick = function() { row.scrollBy({left: -240, behavior: 'smooth'}); };
        }
        if (nextBtn && row) {
            nextBtn.onclick = function() { row.scrollBy({left: 240, behavior: 'smooth'}); };
        }

        function applySort(val) {
            var url = new URL(window.location.href);
            url.searchParams.set('sort', val);
            url.searchParams.set('page', '1');
            window.location.href = url.toString();
        }
    </script>
</body>
</html>
