<style>
    /* --- Footer Reusable Component Styles Sesuai Figma --- */
    footer.footer-wrap {
        background-color: #1A1A1A;
        padding-top: 70px;
        padding-bottom: 36px;
        color: #A5A29B;
        font-family: "Plus Jakarta Sans", sans-serif;
    }

    .footer-container {
        max-width: 1264px;
        width: 100%;
        margin: 0 auto;
        padding: 0 clamp(20px, 5vw, 60px);
        box-sizing: border-box;
    }

    .footer-grid {
        display: grid;
        grid-template-columns: 1fr auto 1fr;
        align-items: start;
        gap: 40px;
    }

    .footer-col-left {
        justify-self: start;
        max-width: 320px;
        position: relative;
        right: 45px;
    }

    .footer-col-center {
        justify-self: center;
        min-width: 140px;
        position: relative;
        left: 40px
    }

    .footer-col-right {
        justify-self: end;
        min-width: 180px;
        position: relative;
        left: 110px;
    }

    .footer-brand-logo {
        display: inline-flex;
        align-items: center;
        text-decoration: none;
        position: relative;
        right:14px;
    }

    .footer-brand-logo img {
        height: 70px;
        width: auto;
        object-fit: contain;
        display: block;
    }

    .footer-col-desc {
        font-family: "Plus Jakarta Sans", sans-serif;
        font-size: 14px;
        font-weight: 400;
        line-height: 22px;
        color: #A5A29B;
        margin-top: 18px;
        letter-spacing: 0;
    }

    .footer-heading {
        font-family: "Plus Jakarta Sans", sans-serif;
        font-size: 14px;
        font-weight: 600;
        line-height: 20px;
        color: #FFFFFF;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin-bottom: 20px;
    }

    .footer-links {
        display: flex;
        flex-direction: column;
        gap: 14px;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .footer-links a {
        font-family: "Plus Jakarta Sans", sans-serif;
        font-size: 14px;
        font-weight: 400;
        line-height: 20px;
        color: #A5A29B;
        text-decoration: none;
        letter-spacing: 0;
        transition: color 0.15s ease;
    }

    .footer-links a:hover {
        color: #DEC096;
    }

    .footer-social-list {
        display: flex;
        flex-direction: column;
        gap: 14px;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .footer-social-item {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
        color: #A8A29E;
        font-family: "Plus Jakarta Sans", sans-serif;
        font-size: 14px;
        font-weight: 400;
        line-height: 20px;
        letter-spacing: 0;
        transition: color 0.15s ease;
    }

    .footer-social-item:hover {
        color: #FFFFFF;
    }

    .social-circle-icon {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        border: 1px solid rgba(212, 175, 55, 0.5);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #B79361;
        flex-shrink: 0;
    }

    .social-circle-icon svg {
        width: 15px;
        height: 15px;
        display: block;
    }

    .footer-bottom-divider {
        border: none;
        border-top: 1px solid rgba(165, 162, 155, 0.25);
        margin-top: 56px;
        margin-bottom: 24px;
    }

    .footer-copyright {
        font-family: "Plus Jakarta Sans", sans-serif;
        font-size: 13px;
        font-weight: 500;
        line-height: normal;
        letter-spacing: 0.12em;
        color: rgba(165, 162, 155, 0.45);
        text-align: center;
        text-transform: uppercase;
        position: relative;
        top: 10px
    }

    .footer-copyright .brand-keyword {
        letter-spacing: 0.15em;
    }

    @media (max-width: 820px) {
        .footer-grid {
            grid-template-columns: 1fr;
            gap: 36px;
        }
        .footer-col-left, .footer-col-center, .footer-col-right {
            justify-self: start;
        }
        footer.footer-wrap {
            padding-top: 48px;
        }
    }
</style>

<footer class="footer-wrap">
    <div class="footer-container">
        <div class="footer-grid">
            <!-- Kolom Kiri: Logo & Deskripsi -->
            <div class="footer-col-left">
                <a href="{{ route('home') }}" class="footer-brand-logo">
                    <img src="{{ asset('assets/image/Logo.svg') }}" alt="Rabita">
                </a>
                <p class="footer-col-desc">
                    Tas Sasirangan modern khas Banjar. Pilihan tepat untuk tampil percaya diri di setiap acara.
                </p>
            </div>

            <!-- Kolom Tengah: Tautan (Tepat di Tengah Monitor) -->
            <div class="footer-col-center">
                <h4 class="footer-heading">TAUTAN</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('beranda') }}">Beranda</a></li>
                    <li><a href="{{ route('blog.public') }}">Blog</a></li>
                    <li><a href="{{ route('tentang') }}">Tentang</a></li>
                    <li><a href="{{ route('katalog') }}">Produk</a></li>
                </ul>
            </div>

            <!-- Kolom Kanan: Sosial Media -->
            <div class="footer-col-right">
                <h4 class="footer-heading">SOSIAL MEDIA</h4>
                <ul class="footer-social-list">
                    <!-- Instagram -->
                    <li>
                        <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" class="footer-social-item">
                            <span class="social-circle-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                </svg>
                            </span>
                            <span>Instagram</span>
                        </a>
                    </li>

                    <!-- Facebook -->
                    <li>
                        <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" class="footer-social-item">
                            <span class="social-circle-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                </svg>
                            </span>
                            <span>Facebook</span>
                        </a>
                    </li>

                    <!-- TikTok -->
                    <li>
                        <a href="https://tiktok.com" target="_blank" rel="noopener noreferrer" class="footer-social-item">
                            <span class="social-circle-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"></path>
                                </svg>
                            </span>
                            <span>Tiktok</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Garis Pemisah & Hak Cipta Dinamis -->
        <hr class="footer-bottom-divider">
        <p class="footer-copyright">
            &copy; {{ date('Y') }} <span class="brand-keyword">RABITA</span>. ALL RIGHTS RESERVED.
        </p>
    </div>
</footer>
