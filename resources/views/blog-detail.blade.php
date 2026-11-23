<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>{{ $blog->judul }} | Rabita Blog</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Lato:wght@400;500&family=Playball&display=swap" rel="stylesheet">
    <style>
        :root{--nav:#151515;--foot:#1A1A1A;--gold:#C9A66B;--gold2:#B8935A;--bg1:#F5F4EF;--bg2:#F0EDE8;--ink:#111;--tx:#5A5A5A;--ph:#E4E0D8;--ft:#CFCFCF;--fm:#7D7D7D;}
        *{box-sizing:border-box;margin:0;padding:0}
        body{font-family:'Plus Jakarta Sans',system-ui,sans-serif;background:var(--bg1);color:var(--tx)}
        .wrap{max-width:1100px;margin:0 auto;padding:0 24px}
        
        .blog-detail{padding:40px 0 70px}
        .crumb{display:flex;gap:12px;font-size:13px;color:#7A7A7A;margin-bottom:30px}
        .crumb a{color:inherit;text-decoration:none}
        .crumb a:hover{color:var(--ink)}
        .crumb b{font-weight:500;color:var(--ink)}
        .crumb i{font-style:normal;color:#BDBDBD}
        
        .blog-header{margin-bottom:36px}
        .blog-title{font-size:clamp(26px, 4vw, 42px);font-weight:600;color:var(--ink);line-height:1.25;margin-bottom:14px}
        .blog-meta{font-size:14px;color:#8A8A8A;display:flex;align-items:center;gap:16px}
        
        .blog-main-img{width:100%;max-height:550px;border-radius:12px;overflow:hidden;background:var(--ph);margin-bottom:40px;display:flex;align-items:center;justify-content:center}
        .blog-main-img img{width:100%;height:100%;max-height:550px;object-fit:cover;display:block}
        
        .blog-body{font-size:18px;line-height:1.8;color:#333;font-weight:300}
        .blog-body p{margin-bottom:24px}
        .blog-body h2, .blog-body h3{color:var(--ink);font-weight:600;margin:36px 0 16px;line-height:1.3}
        
        /* Section Rekomendasi Blog (Sama persis dengan Beranda) */
        .other-blogs {
            background-color: #F0EDE8;
            padding-top: 88px;
            padding-bottom: 100px;
        }
        .other-blogs .wrap {
            max-width: 1268px;
        }
        .other-blogs h2 {
            text-align: center;
            font-size: 28px;
            font-weight: 500;
            color: #1A1A1A;
            margin-bottom: 58px;
            line-height: normal;
        }
        .other-blogs .blog-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 58px;
        }
        .other-blogs .blog-card {
            display: flex;
            flex-direction: column;
            text-decoration: none;
        }
        .other-blogs .blog-photo-box {
            width: 100%;
            height: 466px;
            overflow: hidden;
            background: #D9D9D9;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .other-blogs .blog-photo-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        .other-blogs .blog-content {
            margin-top: 18px;
            text-align: left;
        }
        .other-blogs .blog-content .blog-card-title {
            font-family: inherit;
            font-size: 24px;
            font-weight: 500;
            color: #000000;
            line-height: 1.3;
            letter-spacing: 0;
            margin: 0;
        }
        .other-blogs .blog-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 16px;
            font-weight: 500;
            color: #1A1A1A;
            text-decoration: underline;
            margin-top: 10px;
            line-height: normal;
        }
        .other-blogs .blog-link svg {
            width: 14px;
            height: 14px;
        }
        
        @media(max-width:992px){
            .other-blogs .blog-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 32px;
            }
            .other-blogs .blog-photo-box {
                height: 380px;
            }
        }

        @media(max-width:640px){
            .other-blogs {
                padding-top: 50px;
                padding-bottom: 60px;
            }
            .other-blogs h2 {
                font-size: 22px;
                margin-bottom: 32px;
            }
            .other-blogs .blog-grid {
                grid-template-columns: 1fr;
                gap: 36px;
            }
            .other-blogs .blog-photo-box {
                height: 340px;
            }
            .blog-body {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <x-navbar />

    <main class="blog-detail">
        <div class="wrap">
            <div class="crumb">
                <a href="{{ route('home') }}">Beranda</a>
                <i>/</i>
                <a href="{{ route('blog.public') }}">Blog</a>
                <i>/</i>
                <b>{{ Str::limit($blog->judul, 40) }}</b>
            </div>

            <article class="blog-article">
                <header class="blog-header">
                    <h1 class="blog-title">{{ $blog->judul }}</h1>
                    <div class="blog-meta">
                        <span>Dipublikasikan: {{ $blog->created_at ? $blog->created_at->translatedFormat('d F Y') : 'Terbaru' }}</span>
                    </div>
                </header>

                <div class="blog-main-img">
                    @if($blog->thumbnail && file_exists(public_path('assets/image/blog/' . $blog->thumbnail)))
                        <img src="{{ asset('assets/image/blog/' . $blog->thumbnail) }}" alt="{{ $blog->judul }}">
                    @elseif($blog->thumbnail)
                        <img src="{{ asset('assets/image/blog/' . $blog->thumbnail) }}" alt="{{ $blog->judul }}">
                    @else
                        <div style="padding:60px 0;color:#888;text-align:center;">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="margin:0 auto 10px;"><rect x="3" y="4" width="18" height="16" rx="2"/><circle cx="9" cy="10" r="1.6"/><path d="m21 16-5-5-8 8"/></svg>
                            <p>Rabita Blog</p>
                        </div>
                    @endif
                </div>

                <div class="blog-body">
                    {!! nl2br(e($blog->isi)) !!}
                </div>
            </article>
        </div>
    </main>

    @if($blogLainnya->count() > 0)
    <section class="other-blogs">
        <div class="wrap">
            <h2>Baca Blog Seru Lainnya</h2>
            <div class="blog-grid">
                @foreach($blogLainnya as $item)
                <div class="blog-card">
                    <div class="blog-photo-box">
                        @if($item->thumbnail && file_exists(public_path('assets/image/blog/' . $item->thumbnail)))
                            <img src="{{ asset('assets/image/blog/' . $item->thumbnail) }}" alt="{{ $item->judul }}">
                        @elseif($item->thumbnail)
                            <img src="{{ asset('assets/image/blog/' . $item->thumbnail) }}" alt="{{ $item->judul }}">
                        @else
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#888" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                <polyline points="21 15 16 10 5 21"></polyline>
                            </svg>
                        @endif
                    </div>
                    <div class="blog-content">
                        <h3 class="blog-card-title">{{ $item->judul }}</h3>
                        <a href="{{ route('blog.show.public', $item->blog_id) }}" class="blog-link">
                            <span>Lihat</span>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <x-footer />
</body>
</html>
