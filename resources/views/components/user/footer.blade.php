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
                        <a href="https://instagram.com" target="_blank" rel="noopener noreferrer"
                            class="footer-social-item">
                            <span class="social-circle-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5">
                                    </rect>
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                </svg>
                            </span>
                            <span>Instagram</span>
                        </a>
                    </li>

                    <!-- Facebook -->
                    <li>
                        <a href="https://facebook.com" target="_blank" rel="noopener noreferrer"
                            class="footer-social-item">
                            <span class="social-circle-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                </svg>
                            </span>
                            <span>Facebook</span>
                        </a>
                    </li>

                    <!-- TikTok -->
                    <li>
                        <a href="https://tiktok.com" target="_blank" rel="noopener noreferrer"
                            class="footer-social-item">
                            <span class="social-circle-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                                    stroke-linecap="round" stroke-linejoin="round">
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
