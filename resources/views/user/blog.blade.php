@extends('layouts.user')

@section('head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>Blog | Rabita</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600&family=Lato:wght@400;500&family=Playball&display=swap"
        rel="stylesheet">
    @vite(['resources/css/user/pages/blog.css', 'resources/css/user/components.css'])
@endsection

@section('content')
    @php
        $blogs = $blogs ?? \App\Models\Blog::where('status_blog', true)->latest('blog_id')->paginate(9);
    @endphp



    <main class="blog">
        <div class="wrap">
            <div class="crumb"><a href="{{ route('home') }}">Beranda</a><i>/</i><b>Blog</b></div>
            <h1>Semua Blog Kami</h1>

            <div class="grid" id="grid">
                @forelse($blogs as $item)
                    <article class="card">
                        <a class="thumb-link" href="{{ route('blog.show.public', $item->blog_id) }}"
                            aria-label="Baca artikel: {{ $item->judul }}">
                            <div class="thumb-box">
                                @if ($item->thumbnail && file_exists(public_path('assets/image/blog/' . $item->thumbnail)))
                                    <img src="{{ asset('assets/image/blog/' . $item->thumbnail) }}"
                                        alt="{{ $item->judul }}">
                                @elseif($item->thumbnail)
                                    <img src="{{ asset('assets/image/blog/' . $item->thumbnail) }}"
                                        alt="{{ $item->judul }}">
                                @else
                                    <div class="ph">
                                        <svg width="34" height="34" viewBox="0 0 24 24" fill="none"
                                            stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="3" y="4" width="18" height="16" rx="2" />
                                            <circle cx="9" cy="10" r="1.6" />
                                            <path d="m21 16-5-5-8 8" />
                                        </svg>
                                        <span>Belum ada foto</span>
                                    </div>
                                @endif
                            </div>
                        </a>
                        <h3>{{ $item->judul }}</h3>
                        <a class="lihat" href="{{ route('blog.show.public', $item->blog_id) }}">
                            Lihat
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor"
                                stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2.5 8h11M9 3.5 13.5 8 9 12.5" />
                            </svg>
                        </a>
                    </article>
                @empty
                    <div class="empty">Belum ada artikel blog yang dipublikasikan.</div>
                @endforelse
            </div>

            @if ($blogs->hasPages())
                <div class="pager" id="pager">
                    @if ($blogs->onFirstPage())
                        <span style="opacity:0.4;cursor:not-allowed;">
                            <svg width="8" height="8" viewBox="0 0 8 8" fill="none" stroke-width="1.4"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 1 2 4l3 3" />
                            </svg>
                        </span>
                    @else
                        <a href="{{ $blogs->previousPageUrl() }}" aria-label="Halaman sebelumnya">
                            <svg width="8" height="8" viewBox="0 0 8 8" fill="none" stroke-width="1.4"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 1 2 4l3 3" />
                            </svg>
                        </a>
                    @endif

                    @foreach ($blogs->getUrlRange(1, $blogs->lastPage()) as $page => $url)
                        @if ($page == $blogs->currentPage())
                            <span class="on">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if ($blogs->hasMorePages())
                        <a href="{{ $blogs->nextPageUrl() }}" aria-label="Halaman berikutnya">
                            <svg width="8" height="8" viewBox="0 0 8 8" fill="none" stroke-width="1.4"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 1 6 4 3 7" />
                            </svg>
                        </a>
                    @else
                        <span style="opacity:0.4;cursor:not-allowed;">
                            <svg width="8" height="8" viewBox="0 0 8 8" fill="none" stroke-width="1.4"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 1 6 4 3 7" />
                            </svg>
                        </span>
                    @endif
                </div>
            @endif
        </div>
    </main>
@endsection
