<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rabita – Beranda</title>
    <!-- Google Fonts: Inter, Lato, and Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&family=Lato:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    <style>
        :root {
            /* Background */
            --bg-page: #F5F5F0;
            --bg-navbar: #1A1A1A;
            --bg-footer: #1A1A1A;
            --bg-hero: #F0EDE8;
            --bg-collection: #F5F5F0;
            --bg-cat-card: #E9E6DD;
            --bg-product: #F4F4F6;
            --bg-testimonial: #F0EDE8;
            --bg-testimonial-card: #F5F5F0;
            --bg-blog: #F5F5F0;
            --bg-product-image-base: #D9D9D9;

            /* Gold */
            --gold-accent: #B79361;
            --gold-hero-word: #B79361;
            --gold-btn: #DEC096;
            --gold-rating: #D4AF37;

            /* Text */
            --text-dark: #1A1A1A;
            --text-black: #000000;
            --text-heading-hero: #1C1917;
            --text-secondary: #44403C;
            --text-testimonial: #555555;
            --text-muted: #888888;
            --text-white: #FFFFFF;

            /* Navbar */
            --text-nav: #A5A29B;
            --text-nav-active: #DEC096;
            --text-login: #B79361;

            /* Footer */
            --text-footer: #A5A29B;
            --text-social: #A8A29E;
            --text-copyright: rgb(165 162 155 / 40%);
            --border-footer: rgb(165 162 155 / 40%);
            --border-social: rgb(212 175 55 / 40%);

            /* Transparansi teks */
            --text-price: rgb(26 26 26 / 70%);
            --text-tab-inactive: rgb(0 0 0 / 70%);

            /* Pilihan warna produk */
            --swatch-green: #22C55E;
            --swatch-brown: #865B25;
            --swatch-leaf: #6EAA5A;
            --swatch-pink: #DE49A8;
            --swatch-blue: #244E9D;
            --swatch-black: #000000;

            /* Font family */
            --font-primary: "Plus Jakarta Sans", sans-serif;
            --font-navigation: "Lato", sans-serif;
            --font-utility: "Inter", sans-serif;

            /* Font size */
            --font-size-hero: 50px;
            --font-size-section-title: 28px;
            --font-size-blog-title: 24px;
            --font-size-product-name: 22px;
            --font-size-lg: 18px;
            --font-size-base: 16px;
            --font-size-sm: 14px;
            --font-size-price: 13px;
            --font-size-xs: 12px;
            --font-size-email: 11px;
            --font-size-label: 10px;
        }

        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: var(--font-primary);
            color: var(--text-dark);
            background-color: var(--bg-page);
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* Container standard: 1440px wide max, centered with 88px side padding (1264px content) */
        .container {
            max-width: 1440px;
            width: 100%;
            margin: 0 auto;
            padding: 0 88px;
        }

        /* Reusable Placeholder Box Component */
        .placeholder-box {
            background-color: var(--bg-product-image-base);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            user-select: none;
            position: relative;
        }

        .placeholder-box svg {
            width: 32px;
            height: 32px;
            stroke: var(--text-muted);
            opacity: 0.8;
            margin-bottom: 6px;
        }

        .placeholder-box span {
            font-family: var(--font-primary);
            font-size: 11px;
            font-weight: 500;
            color: var(--text-muted);
            letter-spacing: 0.2px;
        }

        .placeholder-box.sm svg {
            width: 24px;
            height: 24px;
            margin-bottom: 4px;
        }

        .placeholder-box.sm span {
            font-size: 10px;
        }

        .placeholder-box.avatar {
            border-radius: 50%;
        }

        .placeholder-box.avatar svg {
            width: 15px;
            height: 15px;
            margin-bottom: 0;
        }

        /* Brand Logo Container */
        .brand-logo {
            display: inline-flex;
            align-items: center;
            text-decoration: none;
        }

        .brand-logo img {
            height: 52px;
            width: auto;
            object-fit: contain;
            display: block;
        }

        .brand-logo.footer-logo img {
            height: 56px;
        }

        /* Section Title & Subtitle Standards */
        .section-header-center {
            text-align: center;
            margin-bottom: 40px;
        }

        .section-label {
            font-family: var(--font-primary);
            font-size: var(--font-size-lg);
            font-weight: 500;
            color: var(--gold-accent);
            line-height: normal;
            margin-bottom: 8px;
            display: block;
            text-align: center;
        }

        .section-title {
            font-family: var(--font-primary);
            font-size: var(--font-size-section-title);
            font-weight: 600;
            color: var(--text-black);
            line-height: normal;
            text-align: center;
        }

        /* ========================================================
           2. HERO SECTION (1440 × 753 px, background #F0EDE8)
           ======================================================== */
        .hero-section {
            background-color: var(--bg-hero);
            min-height: 600px;
            display: flex;
            align-items: center;
            padding: 80px 0;
            overflow: hidden;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1fr auto;
            align-items: center;
            gap: 60px;
            width: 100%;
        }

        .hero-left {
            display: flex;
            flex-direction: column;
            justify-content: center;
            max-width: 680px;
        }

        .hero-title {
            font-family: var(--font-primary);
            font-size: var(--font-size-hero);
            font-weight: 700;
            line-height: 60px;
            color: var(--text-heading-hero);
            letter-spacing: -1.5px;
        }

        .hero-title .brand-word {
            color: var(--gold-hero-word);
        }

        .hero-desc {
            font-family: var(--font-primary);
            font-size: var(--font-size-lg);
            font-weight: 300;
            line-height: 28px;
            color: var(--text-secondary);
            max-width: 520px;
            margin-top: 24px;
            margin-bottom: 36px;
            letter-spacing: 0;
        }

        .hero-buttons {
            display: flex;
            align-items: center;
            gap: 33px;
        }

        .btn-hero-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 194px;
            height: 52px;
            background-color: var(--gold-btn);
            color: var(--text-black);
            font-family: var(--font-navigation);
            font-size: var(--font-size-base);
            font-weight: 600;
            line-height: normal;
            border-radius: 5px;
            border: none;
            text-decoration: none;
            cursor: pointer;
            transition: opacity 0.15s ease;
        }

        .btn-hero-primary:hover {
            opacity: 0.9;
        }

        .btn-hero-secondary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 194px;
            height: 52px;
            background: transparent;
            color: var(--text-black);
            font-family: var(--font-primary);
            font-size: var(--font-size-base);
            font-weight: 600;
            line-height: normal;
            border: 1px solid var(--text-black);
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.15s ease;
        }

        .btn-hero-secondary:hover {
            background-color: var(--text-black);
            color: #FFFFFF;
        }

        .hero-right {
            display: flex;
            justify-content: center;
            position: relative;
        }

        .hero-image-wrapper {
            position: relative;
            display: inline-block;
        }

        .hero-photo-box {
            width: 398px;
            height: 498px;
            border-radius: 30px;
            overflow: hidden;
            background: transparent;
            box-shadow: none;
        }

        .hero-photo-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 30px;
            display: block;
        }

        /* 4-Pointed Decorative Stars */
        .deco-star-tl {
            position: absolute;
            top: -18px;
            left: -18px;
            width: 34px;
            height: 34px;
            pointer-events: none;
            z-index: 2;
        }

        .deco-star-br {
            position: absolute;
            bottom: -20px;
            right: -20px;
            width: 40px;
            height: 40px;
            pointer-events: none;
            z-index: 2;
        }

        /* ========================================================
           3. KOLEKSI KAMI (Background #F5F5F0)
           ======================================================== */
        .koleksi-section {
            background-color: var(--bg-collection);
            padding: 88px 0;
        }

        .koleksi-header-wrap {
            position: relative;
            text-align: center;
            margin-bottom: 40px;
        }

        .koleksi-arrows {
            position: absolute;
            right: 0;
            bottom: 4px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-arrow-round {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: 1px solid #1A1A1A;
            background: transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1A1A1A;
            font-family: var(--font-utility);
            font-size: 24px;
            font-weight: 400;
            line-height: normal;
            cursor: pointer;
            transition: all 0.15s ease;
        }

        .btn-arrow-round:hover {
            background-color: #1A1A1A;
            color: #FFFFFF;
        }

        /* 1263 × 335 px deretan kategori dengan jarak 17px */
        .koleksi-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 17px;
            width: 100%;
        }

        .koleksi-card {
            background-color: var(--bg-cat-card);
            height: 335px;
            border-radius: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            padding: 30px 16px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .koleksi-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
        }

        .koleksi-thumb {
            width: 140px;
            height: 140px;
            border-radius: 0;
        }

        .koleksi-name {
            font-family: var(--font-primary);
            font-size: var(--font-size-lg);
            font-weight: 600;
            line-height: 28px;
            color: var(--text-secondary);
            margin-top: 24px;
            text-align: center;
            letter-spacing: 0;
        }

        /* ========================================================
           4. PRODUK KAMI (Background #F4F4F6)
           ======================================================== */
        .produk-section {
            background-color: var(--bg-product);
            padding: 88px 0;
        }

        .produk-header-bar {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            margin-bottom: 40px;
        }

        .produk-title {
            font-family: var(--font-primary);
            font-size: var(--font-size-section-title);
            font-weight: 600;
            color: var(--text-dark);
            line-height: normal;
        }

        .produk-tabs {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-top: 10px;
        }

        .produk-tab-item {
            font-family: var(--font-primary);
            font-size: var(--font-size-base);
            font-weight: 500;
            line-height: normal;
            background: transparent;
            border: none;
            cursor: pointer;
            padding-bottom: 4px;
            letter-spacing: 0;
        }

        .produk-tab-item.active {
            color: var(--text-dark);
            border-bottom: 2px solid var(--text-dark);
        }

        .produk-tab-item:not(.active) {
            color: var(--text-tab-inactive);
        }

        .btn-view-all {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: 1px solid #1A1A1A;
            border-radius: 2px;
            padding: 6px 14px;
            font-family: var(--font-primary);
            font-size: var(--font-size-base);
            font-weight: 500;
            color: var(--text-dark);
            line-height: normal;
            text-decoration: none;
            background: transparent;
            transition: all 0.15s ease;
        }

        .btn-view-all:hover {
            background-color: #1A1A1A;
            color: #FFFFFF;
        }

        .btn-view-all svg {
            width: 15px;
            height: 15px;
        }

        /* Foto 303 × 466 px, gap horizontal 17px */
        .produk-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 17px;
        }

        .produk-card {
            display: flex;
            flex-direction: column;
            text-decoration: none;
        }

        .produk-photo-box {
            width: 100%;
            height: 466px;
            border-radius: 0;
        }

        .produk-meta {
            text-align: center;
            margin-top: 16px;
        }

        .produk-name {
            font-family: var(--font-primary);
            font-size: var(--font-size-product-name);
            font-weight: 500;
            color: var(--text-dark);
            line-height: normal;
            letter-spacing: 0;
        }

        .produk-price {
            font-family: var(--font-primary);
            font-size: var(--font-size-price);
            font-weight: 500;
            color: var(--text-price);
            margin-top: 6px;
            line-height: normal;
            letter-spacing: 0;
        }

        .color-dots {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 10px;
        }

        .color-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.15);
            display: inline-block;
        }

        /* Swatches dari spesifikasi Figma */
        .dot-green { background-color: var(--swatch-green); }
        .dot-brown { background-color: var(--swatch-brown); }
        .dot-leaf { background-color: var(--swatch-leaf); }
        .dot-pink { background-color: var(--swatch-pink); }
        .dot-blue { background-color: var(--swatch-blue); }
        .dot-black { background-color: var(--swatch-black); }

        /* ========================================================
           5. TESTIMONI (Background #F0EDE8)
           ======================================================== */
        .testimoni-section {
            background-color: var(--bg-testimonial);
            padding: 88px 0;
        }

        /* 4 kartu 278 × 324.7 px, gap horizontal 51px */
        .testimoni-grid {
            display: grid;
            grid-template-columns: repeat(4, 278px);
            justify-content: center;
            gap: 51px;
        }

        .testimoni-card {
            background-color: var(--bg-testimonial-card);
            width: 278px;
            min-height: 324.7px;
            border: 1px solid var(--gold-accent);
            border-radius: 8px;
            padding: 24px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .testimoni-avatar {
            margin-top: 10px; 
            width: 42px;
            height: 42px;
            border-radius: 50%;
            border: 1px solid #B79361;
            box-sizing: border-box;
        }

        /* Variasi weight nama pelanggan sesuai Figma */
        .testimoni-name {
            font-family: var(--font-primary);
            font-size: var(--font-size-base);
            color: var(--text-dark);
            margin-top: 25px;
            line-height: normal;
            letter-spacing: 0;
        }

        .testimoni-name.w-500 { font-weight: 700; }
        .testimoni-name.w-700 { font-weight: 700; }

        /* Variasi weight email pelanggan sesuai Figma */
        .testimoni-email {
            font-family: var(--font-primary);
            font-size: var(--font-size-email);
            line-height: 16.5px;
            color: var(--text-muted);
            margin-top: 2px;
            letter-spacing: 0;
        }

        .testimoni-email.w-400 { font-weight: 300; }
        .testimoni-email.w-300 { font-weight: 300; }

        .testimoni-stars {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 3px;
            margin-top: 8px;
            color: var(--gold-rating);
        }

        .testimoni-stars svg {
            width: 12px;
            height: 12px;
            fill: var(--gold-rating);
        }

        .testimoni-quote {
            font-family: var(--font-primary);
            font-style: italic;
            font-size: var(--font-size-xs);
            font-weight: 400;
            line-height: 19.5px;
            color: var(--text-testimonial);
            margin-top: 12px;
            flex: 1;
            letter-spacing: 0;
        }

        .testimoni-prod-label {
            font-family: var(--font-primary);
            font-size: var(--font-size-label);
            font-weight: 800;
            line-height: 15px;
            color: var(--gold-accent);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: relative;
            bottom : 10px;
        }

        .testimoni-prod-name {
            font-family: var(--font-primary);
            font-size: var(--font-size-xs);
            font-weight: 600;
            line-height: 16px;
            color: var(--text-dark);
            position: relative;
            bottom : 10px;
            letter-spacing: 0;
        }

        /* ========================================================
           6. BLOG (Background #F5F5F0)
           ======================================================== */
        .blog-section {
            background-color: var(--bg-blog);
            padding-top: 88px;
            padding-bottom: 100px; /* Ruang kosong ±100px di bawah */
        }

        /* Foto 384 × 466 px, gap horizontal 58px */
        .blog-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 58px;
        }

        .blog-card {
            display: flex;
            flex-direction: column;
            text-decoration: none;
        }

        .blog-photo-box {
            width: 100%;
            height: 466px;
            border-radius: 0;
        }

        .blog-content {
            margin-top: 18px;
            text-align: left;
        }

        .blog-title {
            font-family: var(--font-primary);
            font-size: var(--font-size-blog-title);
            font-weight: 500;
            color: var(--text-black);
            line-height: normal;
            letter-spacing: 0;
        }

        .blog-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-family: var(--font-utility);
            font-size: var(--font-size-base);
            font-weight: 500;
            color: var(--text-dark);
            text-decoration: underline;
            margin-top: 10px;
            line-height: normal;
        }

        .blog-link svg {
            width: 14px;
            height: 14px;
        }

        /* ========================================================
           7. FOOTER (Tinggi 442px, Background #1A1A1A)
           ======================================================== */
        footer {
            background-color: var(--bg-footer);
            min-height: 442px;
            padding-top: 80px;
            padding-bottom: 40px;
            color: var(--text-footer);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1.4fr 1fr 1fr;
            gap: 60px;
        }

        .footer-col-desc {
            font-family: var(--font-primary);
            font-size: var(--font-size-sm);
            font-weight: 400;
            line-height: normal;
            color: var(--text-footer);
            max-width: 300px;
            margin-top: 16px;
            letter-spacing: 0;
        }

        .footer-heading {
            font-family: var(--font-primary);
            font-size: var(--font-size-sm);
            font-weight: 600;
            line-height: 20px;
            color: var(--text-white);
            text-transform: uppercase;
            letter-spacing: 0.7px;
            margin-bottom: 20px;
        }

        .footer-links {
            display: flex;
            flex-direction: column;
            gap: 14px;
            list-style: none;
        }

        .footer-links a {
            font-family: var(--font-primary);
            font-size: var(--font-size-sm);
            font-weight: 400;
            line-height: 20px;
            color: var(--text-footer);
            text-decoration: none;
            letter-spacing: 0;
            transition: color 0.15s ease;
        }

        .footer-links a:hover {
            color: var(--gold-btn);
        }

        .footer-social-list {
            display: flex;
            flex-direction: column;
            gap: 14px;
            list-style: none;
        }

        .footer-social-item {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: var(--text-social);
            font-family: var(--font-primary);
            font-size: var(--font-size-sm);
            font-weight: 400;
            line-height: 20px;
            letter-spacing: 0;
            transition: color 0.15s ease;
        }

        .footer-social-item:hover {
            color: var(--text-white);
        }

        .social-circle-icon {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            border: 1px solid var(--border-social);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold-btn);
            flex-shrink: 0;
        }

        .social-circle-icon svg {
            width: 14px;
            height: 14px;
        }

        .footer-bottom-divider {
            border: none;
            border-top: 1px solid var(--border-footer);
            margin-top: 60px;
            margin-bottom: 24px;
        }

        .footer-copyright {
            font-family: var(--font-primary);
            font-size: var(--font-size-sm);
            font-weight: 600;
            line-height: normal;
            letter-spacing: 0.1em;
            color: var(--text-copyright);
            text-align: center;
            text-transform: uppercase;
        }

        .footer-copyright .brand-keyword {
            letter-spacing: 0.15em;
        }

        /* ========================================================
           RESPONSIVE BREAKPOINTS
           ======================================================== */
        @media (max-width: 1300px) {
            .testimoni-grid {
                grid-template-columns: repeat(2, 278px);
                gap: 32px;
            }
        }

        @media (max-width: 1200px) {
            .container {
                padding: 0 40px;
            }
            .hero-title {
                font-size: 40px;
                line-height: 50px;
            }
            .koleksi-grid {
                grid-template-columns: repeat(3, 1fr);
            }
            .produk-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .blog-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 0 20px;
            }
            .hero-grid {
                grid-template-columns: 1fr;
                text-align: center;
            }
            .hero-desc {
                margin-left: auto;
                margin-right: auto;
            }
            .hero-buttons {
                justify-content: center;
            }
            .hero-right {
                margin-top: 36px;
            }
            .hero-photo-box {
                width: 100%;
                max-width: 320px;
                height: 400px;
            }
            .koleksi-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .produk-grid {
                grid-template-columns: 1fr;
            }
            .testimoni-grid {
                grid-template-columns: 1fr;
            }
            .testimoni-card {
                width: 100%;
            }
            .blog-grid {
                grid-template-columns: 1fr;
            }
            .footer-grid {
                grid-template-columns: 1fr;
                gap: 36px;
            }
        }
    </style>
</head>
<body>

    <!-- ========================================================
         1. NAVBAR
         ======================================================== -->
    <x-navbar />

    <!-- ========================================================
         2. HERO SECTION (1440 × 753 px, background #F0EDE8)
         ======================================================== -->
    <section class="hero-section">
        <div class="container hero-grid">
            <!-- Kolom Kiri -->
            <div class="hero-left">
                <!-- Judul Hero (PJS 50px, Bold 700, line-height 60px, letter-spacing -1.5px) -->
                <h1 class="hero-title">
                    Dapatkan Beragam Jenis Tas<br>
                    Sasirangan Hanya di <span class="brand-word">Rabita</span>
                </h1>

                <!-- Paragraf Hero (PJS 18px, Light 300, line-height 28px, #44403C) -->
                <p class="hero-desc">
                    Bunga mawar di tepi telaga, Harumnya semerbak membawa rasa. Pakailah tas sasirangan dari Rabita, Percantik dirimu dengan warisan bangsa.
                </p>

                <!-- Tombol Hero (194 × 52 px, radius 5px, gap 33px) -->
                <div class="hero-buttons">
                    <a href="{{ route('katalog') }}" class="btn-hero-primary">Belanja Sekarang</a>
                    <a href="{{ route('tentang') }}" class="btn-hero-secondary">Tentang Kami</a>
                </div>
            </div>

            <!-- Kolom Kanan (Foto Model 398 × 498 px & Bintang Dekoratif) -->
            <div class="hero-right">
                <div class="hero-image-wrapper">
                    <!-- Bintang Dekoratif Kiri Atas (±34px) -->
                    <svg class="deco-star-tl" viewBox="0 0 34 34" fill="#B79361" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17 0C17 9.38884 9.38884 17 0 17C9.38884 17 17 24.6112 17 34C17 24.6112 24.6112 17 34 17C24.6112 17 17 9.38884 17 0Z"/>
                    </svg>

                    <!-- Foto Hero Model Portrait (398 × 498 px, radius 30px) -->
                    <div class="hero-photo-box">
                        <img src="{{ asset('assets/image/berandahero.png') }}" alt="Rabita Hero">
                    </div>

                    <!-- Bintang Dekoratif Kanan Bawah (±40px) -->
                    <svg class="deco-star-br" viewBox="0 0 40 40" fill="#B79361" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 0C20 11.0457 11.0457 20 0 20C11.0457 20 20 28.9543 20 40C20 28.9543 28.9543 20 40 20C28.9543 20 20 11.0457 20 0Z"/>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================
         3. KOLEKSI KAMI (Background #F5F5F0)
         ======================================================== -->
    <section class="koleksi-section" id="koleksi">
        <div class="container">
            <div class="koleksi-header-wrap">
                <span class="section-label">Koleksi Kami</span>
                <h2 class="section-title">Temukan Koleksi Favoritmu</h2>

                <!-- Tombol Navigasi Bulat Kanan Sejajar Judul (Inter 24px) -->
                <div class="koleksi-arrows">
                    <button type="button" class="btn-arrow-round" aria-label="Sebelumnya">&lt;</button>
                    <button type="button" class="btn-arrow-round" aria-label="Selanjutnya">&gt;</button>
                </div>
            </div>

            <!-- Area deretan kategori (1263 × 335 px, gap 17px, background #E9E6DD) -->
            <div class="koleksi-grid">
                @forelse($kategori ?? [] as $kat)
                <a href="{{ route('katalog', ['kategori' => $kat->kategori_id]) }}" class="koleksi-card">
                    @if($kat->gambar)
                        @php
                            $katImg = file_exists(public_path('assets/image/kategori/' . $kat->gambar))
                                ? asset('assets/image/kategori/' . $kat->gambar)
                                : asset('assets/image/' . $kat->gambar);
                        @endphp
                        <img src="{{ $katImg }}" alt="{{ $kat->nama_kategori }}" class="koleksi-thumb" style="width:140px;height:140px;object-fit:cover;">
                    @else
                        <div class="placeholder-box sm koleksi-thumb">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                <polyline points="21 15 16 10 5 21"></polyline>
                            </svg>
                            <span>Belum ada gambar</span>
                        </div>
                    @endif
                    <span class="koleksi-name">{{ $kat->nama_kategori }}</span>
                </a>
                @empty
                <p style="text-align:center;color:#888;">Belum ada kategori.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- ========================================================
         4. PRODUK KAMI (Background #F4F4F6)
         ======================================================== -->
    <section class="produk-section" id="produk">
        <div class="container">
            <!-- Header Bar -->
            <div class="produk-header-bar">
                <div>
                    <h2 class="produk-title">Produk Kami</h2>
                    <div class="produk-tabs">
                        <button type="button" class="produk-tab-item active" id="tab-terbaru">Terbaru</button>
                        <button type="button" class="produk-tab-item" id="tab-terlaris">Terlaris</button>
                    </div>
                </div>

                <a href="{{ route('katalog') }}" class="btn-view-all">
                    <span>Lihat Semua</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </a>
            </div>

            <!-- Grid 4 Kolom Produk Terbaru -->
            <div class="produk-grid" id="grid-terbaru">
                @forelse($produkTerbaru ?? ($produk ?? []) as $item)
                @php
                    $motifPertama = $item->motif->first();
                    $gambar = $motifPertama->gambar_depan ?? null;
                @endphp
                <a href="{{ route('detail', $item->produk_id) }}" class="produk-card" style="text-decoration:none;color:inherit;">
                    <div class="produk-photo-box" style="background:#D9D9D9;width:100%;aspect-ratio:303/466;overflow:hidden;display:flex;align-items:center;justify-content:center;">
                        @if($gambar)
                            <img src="{{ asset('assets/image/produk/' . $gambar) }}" alt="{{ $item->nama_produk }}" style="width:100%;height:100%;object-fit:cover;">
                        @else
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#888" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                <polyline points="21 15 16 10 5 21"></polyline>
                            </svg>
                        @endif
                    </div>
                    <div class="produk-meta">
                        <h3 class="produk-name">{{ $item->nama_produk }}</h3>
                        <p class="produk-price">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                        @if($item->motif->count() > 0)
                        <div class="color-dots">
                            @foreach($item->motif->take(4) as $motif)
                                <span class="color-dot" style="background:#888;" title="{{ $motif->nama_motif }}"></span>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </a>
                @empty
                <p style="text-align:center;color:#888;grid-column:1/-1;">Belum ada produk terbaru.</p>
                @endforelse
            </div>

            <!-- Grid 4 Kolom Produk Terlaris -->
            <div class="produk-grid" id="grid-terlaris" style="display:none;">
                @forelse($produkTerlaris ?? ($produk ?? []) as $item)
                @php
                    $motifPertama = $item->motif->first();
                    $gambar = $motifPertama->gambar_depan ?? null;
                @endphp
                <a href="{{ route('detail', $item->produk_id) }}" class="produk-card" style="text-decoration:none;color:inherit;">
                    <div class="produk-photo-box" style="background:#D9D9D9;width:100%;aspect-ratio:303/466;overflow:hidden;display:flex;align-items:center;justify-content:center;">
                        @if($gambar)
                            <img src="{{ asset('assets/image/produk/' . $gambar) }}" alt="{{ $item->nama_produk }}" style="width:100%;height:100%;object-fit:cover;">
                        @else
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#888" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                <polyline points="21 15 16 10 5 21"></polyline>
                            </svg>
                        @endif
                    </div>
                    <div class="produk-meta">
                        <h3 class="produk-name">{{ $item->nama_produk }}</h3>
                        <p class="produk-price">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                        @if($item->motif->count() > 0)
                        <div class="color-dots">
                            @foreach($item->motif->take(4) as $motif)
                                <span class="color-dot" style="background:#888;" title="{{ $motif->nama_motif }}"></span>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </a>
                @empty
                <p style="text-align:center;color:#888;grid-column:1/-1;">Belum ada produk terlaris.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- ========================================================
         5. TESTIMONI (Background #F0EDE8)
         ======================================================== -->
    <section class="testimoni-section" id="testimoni">
        <div class="container">
            <div class="section-header-center">
                <span class="section-label">Testimoni</span>
                <h2 class="section-title">Yang Pelanggan Kami Katakan</h2>
            </div>

            <!-- 4 Kartu Testimoni 278 × 324.7 px, gap horizontal 51px -->
            <div class="testimoni-grid">
                <!-- 1. Laisa Rachmanita (Nama weight 500, Email weight 400) -->
                <div class="testimoni-card">
                    <img src="{{ asset('assets/image/testimoni/avatar_laisa.png') }}" alt="Laisa Rachmanita" class="testimoni-avatar" style="border-radius:50%;object-fit:cover;border:1px solid #B79361;">
                    <div class="testimoni-name w-500">Laisa Rachmanita</div>
                    <div class="testimoni-email w-400">Laisarachmanita@gmail.com</div>
                    <div class="testimoni-stars">
                        @for($i = 0; $i < 5; $i++)
                            <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        @endfor
                    </div>
                    <p class="testimoni-quote">"Produknya bagus banget! Motifnya unik dan warnanya cantik. Tasnya juga cocok digunakan untuk berbagai kegiatan."</p>
                    <div class="testimoni-prod-label">PRODUK:</div>
                    <div class="testimoni-prod-name">Tas Lipat Sasirangan</div>
                </div>

                <!-- 2. Rania Safitri (Nama weight 700, Email weight 400) -->
                <div class="testimoni-card">
                    <img src="{{ asset('assets/image/testimoni/avatar_rania.png') }}" alt="Rania Safitri" class="testimoni-avatar" style="border-radius:50%;object-fit:cover;border:1px solid #B79361;">
                    <div class="testimoni-name w-700">Rania Safitri</div>
                    <div class="testimoni-email w-400">RaniaSaftri@gmail.com</div>
                    <div class="testimoni-stars">
                        @for($i = 0; $i < 5; $i++)
                            <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        @endfor
                    </div>
                    <p class="testimoni-quote">"Suka banget sama desain dan perpaduan motifnya. Tasnya terlihat elegan, cocok dipakai jalan-jalan."</p>
                    <div class="testimoni-prod-label">PRODUK:</div>
                    <div class="testimoni-prod-name">Mini Sling Bag</div>
                </div>

                <!-- 3. Nadia Putri (Nama weight 700, Email weight 300) -->
                <div class="testimoni-card">
                    <img src="{{ asset('assets/image/testimoni/avatar_nadia.png') }}" alt="Nadia Putri" class="testimoni-avatar" style="border-radius:50%;object-fit:cover;border:1px solid #B79361;">
                    <div class="testimoni-name w-700">Nadia Putri</div>
                    <div class="testimoni-email w-300">NadiaPutri@gmail.com</div>
                    <div class="testimoni-stars">
                        @for($i = 0; $i < 5; $i++)
                            <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        @endfor
                    </div>
                    <p class="testimoni-quote">"Ukurannya pas untuk membawa barang penting sehari-hari. motif Sasirangannya bikin tas ini terlihat unik."</p>
                    <div class="testimoni-prod-label">PRODUK:</div>
                    <div class="testimoni-prod-name">Rabita Tas Sasirangan Glowy</div>
                </div>

                <!-- 4. Dinda Maharani (Nama weight 700, Email weight 300) -->
                <div class="testimoni-card">
                    <img src="{{ asset('assets/image/testimoni/avatar_dinda.png') }}" alt="Dinda Maharani" class="testimoni-avatar" style="border-radius:50%;object-fit:cover;border:1px solid #B79361;">
                    <div class="testimoni-name w-700">Dinda Maharani</div>
                    <div class="testimoni-email w-300">DindaMaharani@gmail.com</div>
                    <div class="testimoni-stars">
                        @for($i = 0; $i < 5; $i++)
                            <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        @endfor
                    </div>
                    <p class="testimoni-quote">"Modelnya nggak pasaran. Motif Sasirangannya punya ciri khas tersendiri, jadi terasa seperti tas mewah."</p>
                    <div class="testimoni-prod-label">PRODUK:</div>
                    <div class="testimoni-prod-name">Rabita Tas Sasirangan Halfmoon</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================
         6. BLOG (Background #F5F5F0)
         ======================================================== -->
    <section class="blog-section" id="blog">
        <div class="container">
            <div class="section-header-center">
                <span class="section-label">Blog</span>
                <h2 class="section-title">Baca Perjalanan Fair & Bazar Kami</h2>
            </div>

            <!-- Grid 3 Kolom Blog (Foto 384 × 466 px, gap horizontal 58px) -->
            <div class="blog-grid">
                @forelse($blog ?? [] as $bl)
                <div class="blog-card">
                    <div class="blog-photo-box" style="width:100%;height:466px;overflow:hidden;background:#D9D9D9;display:flex;align-items:center;justify-content:center;">
                        @if($bl->thumbnail)
                            <img src="{{ asset('assets/image/blog/' . $bl->thumbnail) }}" alt="{{ $bl->judul }}" style="width:100%;height:100%;object-fit:cover;">
                        @else
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#888" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                <polyline points="21 15 16 10 5 21"></polyline>
                            </svg>
                        @endif
                    </div>
                    <div class="blog-content">
                        <h3 class="blog-title">{{ $bl->judul }}</h3>
                        <a href="{{ route('blog.show.public', $bl->blog_id) }}" class="blog-link">
                            <span>Lihat</span>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </div>
                </div>
                @empty
                <p style="text-align:center;color:#888;grid-column:1/-1;">Belum ada artikel blog.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- ========================================================
         7. FOOTER
         ======================================================== -->
    <x-footer />

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tabTerbaru = document.getElementById('tab-terbaru');
            var tabTerlaris = document.getElementById('tab-terlaris');
            var gridTerbaru = document.getElementById('grid-terbaru');
            var gridTerlaris = document.getElementById('grid-terlaris');

            if (tabTerbaru && tabTerlaris && gridTerbaru && gridTerlaris) {
                tabTerbaru.addEventListener('click', function() {
                    tabTerbaru.classList.add('active');
                    tabTerlaris.classList.remove('active');
                    gridTerbaru.style.display = 'grid';
                    gridTerlaris.style.display = 'none';
                });

                tabTerlaris.addEventListener('click', function() {
                    tabTerlaris.classList.add('active');
                    tabTerbaru.classList.remove('active');
                    gridTerlaris.style.display = 'grid';
                    gridTerbaru.style.display = 'none';
                });
            }
        });
    </script>
</body>
</html>