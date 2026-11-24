<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Akses Ditolak</title>
    @vite('resources/css/errors/403.css')
</head>

<body>
    <div class="container">
        <p class="code">403</p>
        <p class="message">{{ $exception->getMessage() ?: 'Akses ditolak. Halaman ini hanya dapat diakses oleh Admin.' }}
        </p>
        <button class="btn" onclick="history.back()">← Kembali</button>
        <a class="btn" href="{{ url('/beranda') }}">🏠 Beranda</a>
    </div>
</body>

</html>
