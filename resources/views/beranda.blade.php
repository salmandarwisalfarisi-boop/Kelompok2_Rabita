<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Rabita</title>
</head>
<body style="font-family: Arial, sans-serif; padding: 40px; text-align: center;">
    <h1>Halaman Beranda Pengguna</h1>
    <p>Selamat datang, <strong>{{ Auth::user()->username ?? Auth::user()->name }}</strong>!</p>
    <p style="color: #666;">(Halaman ini masih kosong / dalam tahap pengembangan)</p>

    <form method="POST" action="{{ route('logout') }}" style="margin-top: 20px;">
        @csrf
        <button type="submit" style="padding: 10px 20px; cursor: pointer; border-radius: 6px; border: 1px solid #ccc; background: #f0f0f0;">
            Logout
        </button>
    </form>
</body>
</html>
