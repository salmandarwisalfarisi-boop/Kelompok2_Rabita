@extends('layouts.user')

@section('head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>Hasil Pencarian | Rabita</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    @vite(['resources/css/user/pages/pencarian.css', 'resources/css/user/components.css'])
@endsection

@section('content')
    <main class="wrap">
        <h1>Hasil Pencarian</h1>
        <p class="count">{{ $produk->total() }} produk ditemukan{{ $query !== '' ? ' untuk “' . $query . '”' : '' }}
        </p>

        <div class="grid">
            @forelse($produk as $item)
                @php $image = $item->motif->first()?->gambar_depan; @endphp
                <a class="card" href="{{ route('detail', $item->produk_id) }}">
                    <div class="thumb">
                        @if ($image && file_exists(public_path('assets/image/produk/' . $image)))
                            <img src="{{ asset('assets/image/produk/' . $image) }}" alt="{{ $item->nama_produk }}">
                        @else
                            <span>Rabita</span>
                        @endif
                    </div>
                    <h2>{{ $item->nama_produk }}</h2>
                    <div class="price">Rp {{ number_format($item->harga, 0, ',', '.') }}</div>
                </a>
            @empty
                <div class="empty">Produk tidak ditemukan</div>
            @endforelse
        </div>

        @if ($produk->hasPages())
            <div class="pager">
                @if ($produk->onFirstPage())
                    <span aria-disabled="true">&lt;</span>
                @else
                    <a href="{{ $produk->previousPageUrl() }}">&lt;</a>
                @endif
                @foreach ($produk->getUrlRange(1, $produk->lastPage()) as $page => $url)
                    @if ($page === $produk->currentPage())
                        <span class="current">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
                @if ($produk->hasMorePages())
                    <a href="{{ $produk->nextPageUrl() }}">&gt;</a>
                @else
                    <span aria-disabled="true">&gt;</span>
                @endif
            </div>
        @endif
    </main>
@endsection
