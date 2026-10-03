<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login — Rabita</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;0,700;0,900;1,400;1,700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-dark: #161716;             
            --accent-gold: #DEC096;         
            --accent-gold-solid: #CCB694;
            --text-muted: #A7A7A7;          
            --text-dark: #000000;           
            --text-white: #FFFFFF;          
        }
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Lato', sans-serif;
        }
        html, body {
            height: 100%;
            background-color: var(--bg-dark);
            color: var(--text-white);
            overflow: hidden;
        }
        .login-layout {
            display: flex;
            height: 100vh;
            width: 100vw;
            max-width: 100%;
            overflow: hidden;
        }

        /* Sisi Kiri: Foto Hero Edge-to-Edge */
        .hero-pane {
            flex: 1;
            max-width: 50%;
            height: 100vh;
            position: relative;
            overflow: hidden;
            background-color: #1A1A1A;
        }
        .hero-pane img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            display: block;
        }

        /* Sisi Kanan: Form Container */
        .form-pane {
            flex: 1;
            max-width: 50%;
            height: 100vh;
            background-color: var(--bg-dark);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 30px;
            overflow: hidden;
        }

        /* Batik Ornaments */
        .batik-top-right {
            position: absolute;
            top: 0;
            right: 0;
            width: 200px;
            height: 200px;
            pointer-events: none;
            z-index: 1;
        }
        .batik-top-right img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            display: block;
        }
        .batik-bottom-left {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 220px;
            height: 220px;
            pointer-events: none;
            z-index: 1;
        }
        .batik-bottom-left img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            display: block;
            transform: rotate(180deg);
        }

        /* Form Wrapper */
        .form-wrapper {
            width: 100%;
            max-width: 440px;
            position: relative;
            z-index: 2;
            display: flex;
            bottom: 80px;
            flex-direction: column;
            align-items: center;
        }

        /* Logo Rabita */
        .logo-wrap {
            margin-bottom: 24px;
            display: flex;
            justify-content: center;
        }
        .logo-wrap img {
            width: 240px;
            height: auto;
            display: block;
        }

        /* Headings */
        .title-text {
            font-size: 32px;
            font-weight: 700;
            color: var(--text-white);
            margin-bottom: 6px;
            text-align: center;
            letter-spacing: -0.2px;
        }
        .subtitle-text {
            font-size: 15px;
            font-weight: 400;
            color: rgba(255, 255, 255, 0.85);
            margin-bottom: 32px;
            text-align: center;
        }

        /* Form Inputs */
        form {
            width: 100%;
        }
        .form-group {
            margin-bottom: 18px;
            width: 100%;
        }
        .input-label {
            display: block;
            font-size: 15px;
            font-weight: 400;
            color: var(--text-white);
            margin-bottom: 8px;
        }
        .input-box {
            border: 1px solid var(--accent-gold);
            border-radius: 8px;
            padding: 0 14px;
            display: flex;
            align-items: center;
            height: 46px;
            width: 100%;
            background: transparent;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .input-box:focus-within {
            border-color: #F0D5B2;
            box-shadow: 0 0 0 1px rgba(222, 192, 150, 0.5);
        }
        .input-box input {
            flex: 1;
            background: transparent;
            border: none;
            outline: none;
            font-size: 15px;
            color: var(--text-white);
            font-family: 'Lato', sans-serif;
        }
        .input-box input::placeholder {
            color: var(--text-muted);
            font-size: 14px;
        }
        .input-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            cursor: pointer;
            width: 24px;
            height: 24px;
        }
        .input-icon svg,
        .input-icon img {
            width: 22px;
            height: 22px;
            display: block;
        }
        .input-icon svg {
            stroke: var(--text-muted);
            stroke-width: 1.6;
            fill: none;
        }

        /* Error validation */
        .error-feedback {
            color: #FF7675;
            font-size: 13px;
            margin-top: 5px;
        }

        /* Submit Button */
        .btn-submit {
            background-color: var(--accent-gold);
            border-radius: 8px;
            height: 48px;
            width: 100%;
            border: none;
            cursor: pointer;
            font-size: 17px;
            font-weight: 600;
            color: var(--text-dark);
            font-family: 'Lato', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.2s, transform 0.1s;
        }
        .btn-submit:hover {
            background-color: #B79361;
        }
        .btn-submit:active {
            transform: scale(0.99);
        }

        /* Footer text */
        .signup-hint {
            margin-top: 24px;
            text-align: center;
            font-size: 14px;
            color: var(--text-white);
        }
        .signup-hint a {
            color: var(--accent-gold);
            text-decoration: none;
            font-weight: 500;
            margin-left: 4px;
        }
        .signup-hint a:hover {
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 900px) {
            .hero-pane {
                display: none;
            }
            .form-pane {
                max-width: 100%;
                flex: 1;
            }
            .batik-top-right { width: 260px; height: 282px; }
            .batik-bottom-left { width: 280px; height: 304px; }
        }
        @media (max-height: 850px) {
            .form-pane { padding: 16px 24px; }
            .logo-wrap { margin-bottom: 16px; }
            .logo-wrap img { width: 190px; }
            .title-text { font-size: 26px; margin-bottom: 4px; }
            .subtitle-text { font-size: 13px; margin-bottom: 20px; }
            .form-group { margin-bottom: 12px; }
            .input-box { height: 42px; }
            .options-row { margin-bottom: 16px; }
            .btn-login { height: 42px; margin-bottom: 14px; }
            .batik-top-right { width: 260px; height: 282px; }
            .batik-bottom-left { width: 280px; height: 304px; }
        }
        @media (max-height: 700px) {
            .batik-top-right { width: 200px; height: 217px; }
            .batik-bottom-left { width: 215px; height: 233px; }
        }
    </style>
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

                <!-- Email Input -->
                <div class="form-group">
                    <label class="input-label" for="email">Email</label>
                    <div class="input-box">
                        <input type="text" id="email" name="email" value="{{ old('email') }}" placeholder="Type your email" required autofocus autocomplete="username">
                        <span class="input-icon">
                            <img src="{{ asset('assets/image/formkit_person.svg') }}" alt="User">
                        </span>
                    </div>
                    @error('email')
                        <div class="error-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password Input -->
                <div class="form-group">
                    <label class="input-label" for="password">Password</label>
                    <div class="input-box">
                        <input type="password" id="password" name="password" placeholder="Type your password" required autocomplete="current-password">
                        <span class="input-icon" onclick="togglePassword()" title="Lihat Password">
                            <img id="eye-icon" src="{{ asset('assets/image/formkit_eyeclosed.svg') }}" alt="Toggle Password">
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
