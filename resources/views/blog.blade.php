<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>Blog | Rabita</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600&family=Lato:wght@400;500&family=Playball&display=swap" rel="stylesheet">
    <style>
        :root{--nav:#151515;--foot:#1A1A1A;--gold:#C9A66B;--gold2:#B8935A;--bg1:#F5F4EF;--ink:#111;--tx:#5A5A5A;--ph:#E4E0D8;--ft:#CFCFCF;--fm:#7D7D7D;}
        box-sizing:border-box;padding-top:env(safe-area-inset-top,0px);padding-bottom:env(safe-area-inset-bottom,0px)}
        html{background:var(--nav);scroll-padding-top:env(safe-area-inset-top,0px)}
        *{box-sizing:border-box;margin:0;padding:0}
        body{font-family:'Plus Jakarta Sans',system-ui,sans-serif;background:var(--bg1);color:var(--tx)}
        svg{display:block}
        button{font-family:inherit;cursor:pointer}
        .wrap{max-width:1264px;margin:0 auto;padding:0 20px}
        /* BLOG */
        .blog{padding:36px 0 60px}
        .crumb{display:flex;justify-content:center;gap:12px;font-size:12px;color:#7A7A7A}
        .crumb a{color:inherit;text-decoration:none}
        .crumb a:hover{color:var(--ink)}
        .crumb b{font-weight:500;color:var(--ink)}
        .crumb i{font-style:normal;color:#BDBDBD}
        .blog h1{text-align:center;font-weight:500;font-size:29px;color:var(--ink);letter-spacing:-.2px;margin-top:36px}
        .grid{display:grid;grid-template-columns:repeat(3,1fr);gap:49px 56px;margin-top:70px}
        .card{display:flex;flex-direction:column}
        .thumb-box{aspect-ratio:370/449;width:100%;overflow:hidden;background:var(--ph);display:flex;align-items:center;justify-content:center;border-radius:2px}
        .thumb-box img{width:100%;height:100%;object-fit:cover;transition:transform 0.3s ease}
        .card:hover .thumb-box img{transform:scale(1.03)}
        .ph{background:var(--ph);display:flex;flex-direction:column;align-items:center;justify-content:center;gap:8px;color:#8F897E;font-size:13px;text-align:center;width:100%;height:100%}
        .ph svg{stroke:#8F897E}
        .card h3{font-weight:400;font-size:25px;color:var(--ink);margin-top:28px;line-height:32px}
        .lihat{display:inline-flex;align-items:center;gap:8px;margin-top:22px;font-size:16px;font-weight:500;color:var(--ink);text-decoration:none;border-bottom:1.5px solid var(--ink);padding-bottom:2px;align-self:flex-start}
        .lihat:focus-visible{outline:2px solid var(--gold);outline-offset:4px}
        .empty{grid-column:1/-1;padding:140px 0;text-align:center;font-size:16px;color:#8A8A8A}
        /* PAGER */
        .pager{display:flex;justify-content:center;align-items:center;gap:6px;margin-top:70px}
        .pager a, .pager span{width:32px;height:32px;border-radius:4px;border:1px solid #DCDCE0;background:#fff;font-size:12px;color:var(--tx);display:inline-flex;align-items:center;justify-content:center;text-decoration:none;transition:all 0.15s}
        .pager a:hover{border-color:var(--gold2);color:var(--gold2)}
        .pager a.on, .pager span.on{background:var(--gold2);border-color:var(--gold2);color:#fff}
        .pager svg{stroke:currentColor}
        .pager a:focus-visible{outline:2px solid var(--gold);outline-offset:2px}
        /* FOOTER */
        footer{background:var(--foot);padding:132px 0 0;color:var(--ft)}
        .fgrid{display:flex;padding-left:149px;min-height:180px}
        .f1{width:558px}.f2{width:487px}
        .f1 .logo{font-size:38px;display:block;margin-bottom:22px}
        .f1 p{font-size:12px;line-height:1.35;max-width:300px}
        footer h4{font-weight:500;font-size:13px;letter-spacing:.4px;color:#fff;text-transform:uppercase;margin-bottom:14px}
        .f2 a{display:block;font-size:13px;color:#B9B6AF;text-decoration:none;margin-bottom:14px}
        .f2 a:hover{color:var(--gold)}
        .soc{display:flex;align-items:center;gap:10px;font-size:13px;color:#B9B6AF;margin-bottom:12px}
        .soc i{width:30px;height:30px;border:1px solid var(--gold);border-radius:50%;display:grid;place-items:center}
        .soc svg{fill:var(--gold)}
        .fbar{margin:60px 107px 0;border-top:1px solid #333;padding:14px 0 18px;text-align:center;font-size:12px;letter-spacing:2.2px;color:var(--fm)}
        @media(max-width:900px){
            nav{display:none}header{padding:0 20px}.login{padding:0 18px;margin-left:4px}
            .grid{grid-template-columns:repeat(2,1fr);gap:36px 16px;margin-top:44px}.card h3{font-size:19px;margin-top:18px;line-height:26px}.lihat{margin-top:12px;font-size:14px}
            .fgrid{flex-direction:column;gap:32px;padding:0 24px}.f1,.f2{width:auto}footer{padding-top:64px}.fbar{margin:40px 24px 0}
            .blog h1{font-size:24px}}
        @media(max-width:520px){.grid{grid-template-columns:1fr}}
    </style>
</head>
<body>
    @php
        $blogs = $blogs ?? \App\Models\Blog::where('status_blog', true)->latest('blog_id')->paginate(9);
    @endphp

    <x-navbar />

    <main class="blog">
        <div class="wrap">
            <div class="crumb"><a href="{{ route('home') }}">Beranda</a><i>/</i><b>Blog</b></div>
            <h1>Semua Blog Kami</h1>

            <div class="grid" id="grid">
                @forelse($blogs as $item)
                    <article class="card">
                        <div class="thumb-box">
                            @if($item->thumbnail && file_exists(public_path('assets/image/blog/' . $item->thumbnail)))
                                <img src="{{ asset('assets/image/blog/' . $item->thumbnail) }}" alt="{{ $item->judul }}">
                            @elseif($item->thumbnail)
                                <img src="{{ asset('assets/image/blog/' . $item->thumbnail) }}" alt="{{ $item->judul }}">
                            @else
                                <div class="ph">
                                    <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="4" width="18" height="16" rx="2"/>
                                        <circle cx="9" cy="10" r="1.6"/>
                                        <path d="m21 16-5-5-8 8"/>
                                    </svg>
                                    <span>Belum ada foto</span>
                                </div>
                            @endif
                        </div>
                        <h3>{{ $item->judul }}</h3>
                        <a class="lihat" href="{{ route('blog.show.public', $item->blog_id) }}">
                            Lihat 
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2.5 8h11M9 3.5 13.5 8 9 12.5"/>
                            </svg>
                        </a>
                    </article>
                @empty
                    <div class="empty">Belum ada artikel blog yang dipublikasikan.</div>
                @endforelse
            </div>

            @if($blogs->hasPages())
                <div class="pager" id="pager">
                    {{-- Previous Page Link --}}
                    @if ($blogs->onFirstPage())
                        <span style="opacity:0.4;cursor:not-allowed;">
                            <svg width="8" height="8" viewBox="0 0 8 8" fill="none" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 1 2 4l3 3"/></svg>
                        </span>
                    @else
                        <a href="{{ $blogs->previousPageUrl() }}" aria-label="Halaman sebelumnya">
                            <svg width="8" height="8" viewBox="0 0 8 8" fill="none" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 1 2 4l3 3"/></svg>
                        </a>
                    @endif

                    {{-- Page Numbers --}}
                    @foreach ($blogs->getUrlRange(1, $blogs->lastPage()) as $page => $url)
                        @if ($page == $blogs->currentPage())
                            <span class="on">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($blogs->hasMorePages())
                        <a href="{{ $blogs->nextPageUrl() }}" aria-label="Halaman berikutnya">
                            <svg width="8" height="8" viewBox="0 0 8 8" fill="none" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"><path d="M3 1 6 4 3 7"/></svg>
                        </a>
                    @else
                        <span style="opacity:0.4;cursor:not-allowed;">
                            <svg width="8" height="8" viewBox="0 0 8 8" fill="none" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"><path d="M3 1 6 4 3 7"/></svg>
                        </span>
                    @endif
                </div>
            @endif
        </div>
    </main>

    <x-footer />
</body>
</html>
