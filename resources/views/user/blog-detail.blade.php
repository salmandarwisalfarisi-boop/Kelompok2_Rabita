@extends('layouts.user')

@section('head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>{{ $blog->judul }} | Rabita Blog</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Lato:wght@400;500&family=Playball&display=swap"
        rel="stylesheet">
    @vite(['resources/css/user/pages/blog-detail.css', 'resources/css/user/components.css'])
@endsection

@section('content')
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
                        <span>Dipublikasikan:
                            {{ $blog->created_at ? $blog->created_at->translatedFormat('d F Y') : 'Terbaru' }}</span>
                    </div>
                </header>

                <div class="blog-main-img">
                    @if ($blog->thumbnail && file_exists(public_path('assets/image/blog/' . $blog->thumbnail)))
                        <img src="{{ asset('assets/image/blog/' . $blog->thumbnail) }}" alt="{{ $blog->judul }}">
                    @elseif($blog->thumbnail)
                        <img src="{{ asset('assets/image/blog/' . $blog->thumbnail) }}" alt="{{ $blog->judul }}">
                    @else
                        <div style="padding:60px 0;color:#888;text-align:center;">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.5" style="margin:0 auto 10px;">
                                <rect x="3" y="4" width="18" height="16" rx="2" />
                                <circle cx="9" cy="10" r="1.6" />
                                <path d="m21 16-5-5-8 8" />
                            </svg>
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

    @if ($blogLainnya->count() > 0)
        <section class="other-blogs">
            <div class="wrap">
                <h2>Baca Blog Seru Lainnya</h2>
                <div class="blog-grid">
                    @foreach ($blogLainnya as $item)
                        <div class="blog-card">
                            <a class="blog-photo-link" href="{{ route('blog.show.public', $item->blog_id) }}"
                                aria-label="Baca artikel: {{ $item->judul }}">
                                <div class="blog-photo-box">
                                    @if ($item->thumbnail && file_exists(public_path('assets/image/blog/' . $item->thumbnail)))
                                        <img src="{{ asset('assets/image/blog/' . $item->thumbnail) }}"
                                            alt="{{ $item->judul }}">
                                    @elseif($item->thumbnail)
                                        <img src="{{ asset('assets/image/blog/' . $item->thumbnail) }}"
                                            alt="{{ $item->judul }}">
                                    @else
                                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none"
                                            stroke="#888" stroke-width="1.8" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2">
                                            </rect>
                                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                            <polyline points="21 15 16 10 5 21"></polyline>
                                        </svg>
                                    @endif
                                </div>
                            </a>
                            <div class="blog-content">
                                <h3 class="blog-card-title">{{ $item->judul }}</h3>
                                <a href="{{ route('blog.show.public', $item->blog_id) }}" class="blog-link">
                                    <span>Lihat</span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                        stroke-linecap="round" stroke-linejoin="round">
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
@endsection
