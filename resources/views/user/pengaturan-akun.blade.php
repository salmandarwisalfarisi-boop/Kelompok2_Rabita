@extends('layouts.user')

@section('head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>Pengaturan Akun | Rabita</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    @vite(['resources/css/user/pages/pengaturan-akun.css', 'resources/css/user/components.css'])
@endsection

@section('content')
    <main>
        <section class="account-card">
            <h1>Pengaturan Akun</h1>
            <p class="intro">Perbarui username, nomor telepon, atau password akun Anda.</p>

            @if (session('success'))
                <div class="alert">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('pengaturan.akun.update') }}">
                @csrf
                @method('PUT')

                <div class="field">
                    <label for="username">Username</label>
                    <input id="username" name="username" type="text"
                        value="{{ old('username', Auth::user()->username) }}" required autocomplete="username">
                    @error('username')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label for="no_hp">Nomor telepon</label>
                    <input id="no_hp" name="no_hp" type="tel" value="{{ old('no_hp', Auth::user()->no_hp) }}"
                        required autocomplete="tel">
                    @error('no_hp')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label for="current_password">Password lama (Wajib)</label>
                    <input id="current_password" name="current_password" type="password" required
                        autocomplete="current-password">
                    @error('current_password')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label for="password">Password baru (Opsional)</label>
                    <input id="password" name="password" type="password" autocomplete="new-password">
                    <div class="hint">Minimal 6 karakter. Kosongkan jika tidak ingin mengubah password.</div>
                    @error('password')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label for="password_confirmation">Konfirmasi password baru (Opsional)</label>
                    <input id="password_confirmation" name="password_confirmation" type="password"
                        autocomplete="new-password">
                </div>

                <button class="submit" type="submit">Simpan Pengaturan</button>
            </form>
        </section>
    </main>
@endsection
