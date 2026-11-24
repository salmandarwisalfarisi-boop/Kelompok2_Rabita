<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login — Rabita</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;0,700;0,900;1,400;1,700&display=swap"
        rel="stylesheet">
    @vite('resources/css/auth/login.css')
</head>

<body>

    <div class="login-layout">
        <!-- Kolom Kiri: Foto Hero Edge-to-Edge -->
        <div class="hero-pane">
            <img src="{{ asset('assets/image/sideimage_logjn.png') }}" alt="Rabita Hero">
        </div>

        <!-- Kolom Kanan: Form Login -->
        <div class="form-pane">
            <!-- Motif Batik Sudut Kanan Atas -->
            <div class="batik-top-right">
                <img src="{{ asset('images/ornamenbatik_form.svg') }}" alt="">
            </div>
            <!-- Motif Batik Sudut Kiri Bawah -->
            <div class="batik-bottom-left">
                <img src="{{ asset('images/ornamenbatik_form.svg') }}" alt="">
            </div>

            <div class="form-wrapper">
                <!-- Logo Rabita -->
                <div class="logo-wrap">
                    <img src="{{ asset('assets/image/Logo.svg') }}" alt="Rabita">
                </div>

                <!-- Headings -->
                <h1 class="title-text">Welcome Back!</h1>
                <p class="subtitle-text">Sign in to your Rabita account</p>

                <!-- Form -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Username Input -->
                    <div class="form-group">
                        <label class="input-label" for="username">Username</label>
                        <div class="input-box">
                            <input type="text" id="username" name="username" value="{{ old('username') }}"
                                placeholder="Type your username" required autofocus autocomplete="username">
                            <span class="input-icon">
                                <img src="{{ asset('assets/image/formkit_person.svg') }}" alt="User">
                            </span>
                        </div>
                        @error('username')
                            <div class="error-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div class="form-group">
                        <label class="input-label" for="password">Password</label>
                        <div class="input-box">
                            <input type="password" id="password" name="password" placeholder="Type your password"
                                required autocomplete="current-password">
                            <span class="input-icon" onclick="togglePassword()" title="Lihat Password">
                                <img id="eye-icon" src="{{ asset('assets/image/formkit_eyeclosed.svg') }}"
                                    alt="Toggle Password">
                            </span>
                        </div>
                        @error('password')
                            <div class="error-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <br>

                    <!-- Submit Button -->
                    <button type="submit" class="btn-submit">Sign in</button>

                    <!-- Footer Hint -->

                </form>
            </div>
        </div>
    </div>

    <script>
        const eyeOpenUrl = "{{ asset('assets/image/formkit_eyeopen.svg') }}";
        const eyeClosedUrl = "{{ asset('assets/image/formkit_eyeclosed.svg') }}";

        function togglePassword() {
            const input = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            if (input.type === 'password') {
                input.type = 'text';
                eyeIcon.src = eyeOpenUrl;
            } else {
                input.type = 'password';
                eyeIcon.src = eyeClosedUrl;
            }
        }
    </script>
</body>

</html>
