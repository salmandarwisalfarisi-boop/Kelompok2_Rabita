<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Akses Ditolak</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            background: #f8f9fa;
            text-align: center;
        }
        .container {
            padding: 40px;
        }
        .code {
            font-size: 80px;
            font-weight: bold;
            color: #c0392b;
            margin: 0;
        }
        .message {
            font-size: 18px;
            color: #333;
            margin: 12px 0 24px;
        }
        .btn {
            display: inline-block;
            padding: 10px 24px;
            border-radius: 6px;
            border: 1px solid #c0392b;
            background: #fff;
            color: #c0392b;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            margin: 6px;
        }
        .btn:hover {
            background: #c0392b;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <p class="code">403</p>
        <p class="message">{{ $exception->getMessage() ?: 'Akses ditolak. Halaman ini hanya dapat diakses oleh Admin.' }}</p>
        <button class="btn" onclick="history.back()">← Kembali</button>
        <a class="btn" href="{{ url('/beranda') }}">🏠 Beranda</a>
    </div>
</body>
</html>
