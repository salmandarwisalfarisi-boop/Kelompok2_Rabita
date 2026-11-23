<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>Kategori | Rabita</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600&family=Playball&display=swap" rel="stylesheet">
<style>
:root{--nav:#151515;--gold:#C9A66B;--bg1:#F5F4EF;--ink:#111;--ft:#CFCFCF;--fm:#7D7D7D;box-sizing:border-box;}
html{background:var(--nav)}
body{font-family:'Plus Jakarta Sans',system-ui,sans-serif;background:var(--bg1);color:var(--ink);margin:0;display:flex;flex-direction:column;min-height:100vh;}
main{flex:1;max-width:1200px;margin:40px auto;padding:0 24px;width:100%;box-sizing:border-box;}
</style>
</head>
<body>
<x-navbar />

<main>
    <h1>Kategori Produk Rabita</h1>
    <p>Silakan jelajahi koleksi produk kami di halaman <a href="{{ route('katalog') }}" style="color:#B8935A;font-weight:600;">Katalog Produk</a>.</p>
</main>

<x-footer />
</body>
</html>
