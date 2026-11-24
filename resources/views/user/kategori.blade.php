@extends('layouts.user')

@section('head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>Kategori | Rabita</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600&family=Playball&display=swap"
        rel="stylesheet">
    @vite(['resources/css/user/pages/kategori.css', 'resources/css/user/components.css'])
@endsection

@section('content')
    <main>
        <h1>Kategori Produk Rabita</h1>
        <p>Silakan jelajahi koleksi produk kami di halaman <a href="{{ route('katalog') }}"
                style="color:#B8935A;font-weight:600;">Katalog Produk</a>.</p>
    </main>
@endsection
