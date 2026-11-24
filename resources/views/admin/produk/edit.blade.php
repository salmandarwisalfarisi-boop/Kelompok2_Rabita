@extends('layouts.admin')

@section('head')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Produk � Rabita</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Lato:wght@400;700&display=swap"
        rel="stylesheet">
    @vite(['resources/css/admin/pages/produk/edit.css', 'resources/css/admin/components.css'])
@endsection

@section('content')
    <div class="layout-main">

        <header class="topbar">
            <div class="user-pill-container">
                <button type="button" class="user-pill-btn" id="userPillBtn" aria-label="Menu Pengguna">
                    <span class="avatar-circle">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </span>
                    <span class="user-text">
                        <span class="user-name">{{ Auth::user()->username ?? 'Salman' }}</span>
                        <span class="user-role">{{ ucfirst(Auth::user()->level ?? 'Administrator') }}</span>
                    </span>
                    <svg class="user-chevron" id="userPillChevron" width="16" height="16" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                        stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>

                <div class="user-dropdown" id="userDropdown">
                    <div class="dropdown-user-info">
                        <p>Login sebagai:</p>
                        <b>{{ Auth::user()->username ?? 'Salman' }}</b>
                        <span
                            style="font-size: 11px; color: var(--gold);">{{ Auth::user()->email ?? 'admin@rabita.com' }}</span>
                    </div>

                    <a href="{{ route('admin.pengaturan') }}"
                        style="display: flex; align-items: center; gap: 10px; width: 100%; padding: 10px 16px; border: none; background: transparent; font-size: 13px; font-family: 'Inter', sans-serif; color: #1A1A1A; cursor: pointer; text-decoration: none; transition: background-color 0.15s ease;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="3"></circle>
                            <path
                                d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06-.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z">
                            </path>
                        </svg>
                        Pengaturan
                    </a>

                    <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                <polyline points="16 17 21 12 16 7"></polyline>
                                <line x1="21" y1="12" x2="9" y2="12"></line>
                            </svg>
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <main>
            <h1 class="page-title">Edit Produk</h1>

            @if (isset($errors) && $errors->any())
                <div class="alert-error">
                    <b>Terdapat kesalahan pada formulir:</b>
                    <ul>
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('produk.update', $produk->produk_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card-main">

                    <h2 class="section-title">Detail Produk</h2>

                    <div class="grid-2">
                        <div class="form-group">
                            <label class="form-label" for="nama_produk">Nama Produk (Wajib)</label>
                            <input type="text" id="nama_produk" name="nama_produk" class="form-input"
                                placeholder="Masukkan nama produk" value="{{ old('nama_produk', $produk->nama_produk) }}"
                                required>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="kategori_id">Kategori (Wajib)</label>
                            <select id="kategori_id" name="kategori_id" class="form-select" required>
                                <option value="" disabled>Pilih Kategori</option>
                                @forelse ($kategori as $k)
                                    <option value="{{ $k->kategori_id }}"
                                        {{ old('kategori_id', $produk->kategori_id) == $k->kategori_id ? 'selected' : '' }}>
                                        {{ $k->nama_kategori }}
                                    </option>
                                @empty
                                    <option value="" disabled>Belum ada kategori tersedia</option>
                                @endforelse
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="material">Material (Wajib)</label>
                            <input type="text" id="material" name="material" class="form-input"
                                placeholder="contoh : kain sasirangan" value="{{ old('material', $produk->material) }}"
                                required>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="harga">Harga (Rp) (Wajib)</label>
                            <input type="number" id="harga" name="harga" class="form-input"
                                placeholder="Masukkan harga" value="{{ old('harga', $produk->harga) }}" min="0"
                                required>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="ukuran">Ukuran (Wajib)</label>
                            <input type="text" id="ukuran" name="ukuran" class="form-input"
                                placeholder="P X L X T (cm) Contoh: 30 x 25 x 12"
                                value="{{ old('ukuran', $produk->ukuran) }}" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="berat_gram">Berat (gram) (Wajib)</label>
                            <input type="number" id="berat_gram" name="berat_gram" class="form-input"
                                placeholder="Masukkan berat Produk" value="{{ old('berat_gram', $produk->berat_gram) }}"
                                min="0" required>
                        </div>

                        <div class="form-group col-full">
                            <label class="form-label" for="deskripsi_produk">Deskripsi (Wajib)</label>
                            <textarea id="deskripsi_produk" name="deskripsi_produk" class="form-textarea"
                                placeholder="Jelaskan Bahan, Ukuran, dan Keunggulan Produk..." required>{{ old('deskripsi_produk', $produk->deskripsi_produk) }}</textarea>
                        </div>
                    </div>

                    <h2 class="section-title" style="margin-top: 36px;">Pilihan Motif</h2>

                    <div class="motif-box">
                        <div class="motif-badge">Motif 1</div>

                        <div class="grid-motif-fields">
                            <div class="form-group">
                                <label class="form-label" for="nama_motif">Nama Motif (Wajib)</label>
                                <input type="text" id="nama_motif" name="nama_motif" class="form-input"
                                    placeholder="Contoh: Motif Warna Warni"
                                    value="{{ old('nama_motif', $motifPertama->nama_motif ?? 'Motif 1') }}" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="stok">Stok (Wajib)</label>
                                <input type="number" id="stok" name="stok" class="form-input" placeholder="0"
                                    value="{{ old('stok', $motifPertama->stok ?? 0) }}" min="0" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="status_motif_select">Status Motif (Wajib)</label>
                                <select id="status_motif_select" name="status" class="select-status-motif status-aktif"
                                    required>
                                    <option value="aktif"
                                        {{ old('status', $produk->status) === 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="sold_out"
                                        {{ old('status', $produk->status) === 'sold_out' ? 'selected' : '' }}>Sold Out
                                    </option>
                                    <option value="arsip"
                                        {{ old('status', $produk->status) === 'arsip' ? 'selected' : '' }}>Arsip</option>
                                </select>
                            </div>
                        </div>

                        <div style="margin-top: 20px;">
                            <label class="form-label">Foto Motif (Opsional)</label>

                            <div class="grid-photos">
                                @php $hasDepan = !empty($motifPertama->gambar_depan); @endphp
                                <div class="photo-upload-card {{ $hasDepan ? 'has-image' : '' }}"
                                    onclick="document.getElementById('input_gambar_depan').click()">
                                    <input type="file" id="input_gambar_depan" name="gambar_depan"
                                        accept=".jpg,.jpeg,.png,.webp" style="display: none;"
                                        onchange="previewPhoto(this, 'preview_depan')">
                                    <img id="preview_depan" class="preview-img"
                                        src="{{ $hasDepan ? asset('assets/image/produk/' . $motifPertama->gambar_depan) : '' }}"
                                        alt="Foto Depan" style="{{ $hasDepan ? 'display: block;' : '' }}">
                                    <div class="photo-card-content" style="{{ $hasDepan ? 'display: none;' : '' }}">
                                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <rect x="3" y="3" width="18" height="18" rx="3"
                                                ry="3"></rect>
                                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                            <polyline points="21 15 16 10 5 21"></polyline>
                                            <line x1="12" y1="3" x2="12" y2="7"></line>
                                            <line x1="10" y1="5" x2="14" y2="5"></line>
                                        </svg>
                                        <span class="photo-title">Foto Depan</span>
                                        <span class="photo-sub">(Opsional, JPG/JPEG/PNG/WEBP, maks. 2MB)</span>
                                    </div>
                                    <div class="photo-change-overlay">Ganti Foto</div>
                                </div>

                                @php $hasKiri = !empty($motifPertama->gambar_kiri); @endphp
                                <div class="photo-upload-card {{ $hasKiri ? 'has-image' : '' }}"
                                    onclick="document.getElementById('input_gambar_kiri').click()">
                                    <input type="file" id="input_gambar_kiri" name="gambar_kiri"
                                        accept=".jpg,.jpeg,.png,.webp" style="display: none;"
                                        onchange="previewPhoto(this, 'preview_kiri')">
                                    <img id="preview_kiri" class="preview-img"
                                        src="{{ $hasKiri ? asset('assets/image/produk/' . $motifPertama->gambar_kiri) : '' }}"
                                        alt="Foto Kiri" style="{{ $hasKiri ? 'display: block;' : '' }}">
                                    <div class="photo-card-content" style="{{ $hasKiri ? 'display: none;' : '' }}">
                                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <rect x="3" y="3" width="18" height="18" rx="3"
                                                ry="3"></rect>
                                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                            <polyline points="21 15 16 10 5 21"></polyline>
                                            <line x1="12" y1="3" x2="12" y2="7"></line>
                                            <line x1="10" y1="5" x2="14" y2="5"></line>
                                        </svg>
                                        <span class="photo-title">Foto Kiri</span>
                                        <span class="photo-sub">(Opsional, JPG/JPEG/PNG/WEBP, maks. 2MB)</span>
                                    </div>
                                    <div class="photo-change-overlay">Ganti Foto</div>
                                </div>

                                @php $hasKanan = !empty($motifPertama->gambar_kanan); @endphp
                                <div class="photo-upload-card {{ $hasKanan ? 'has-image' : '' }}"
                                    onclick="document.getElementById('input_gambar_kanan').click()">
                                    <input type="file" id="input_gambar_kanan" name="gambar_kanan"
                                        accept=".jpg,.jpeg,.png,.webp" style="display: none;"
                                        onchange="previewPhoto(this, 'preview_kanan')">
                                    <img id="preview_kanan" class="preview-img"
                                        src="{{ $hasKanan ? asset('assets/image/produk/' . $motifPertama->gambar_kanan) : '' }}"
                                        alt="Foto Kanan" style="{{ $hasKanan ? 'display: block;' : '' }}">
                                    <div class="photo-card-content" style="{{ $hasKanan ? 'display: none;' : '' }}">
                                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <rect x="3" y="3" width="18" height="18" rx="3"
                                                ry="3"></rect>
                                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                            <polyline points="21 15 16 10 5 21"></polyline>
                                            <line x1="12" y1="3" x2="12" y2="7"></line>
                                            <line x1="10" y1="5" x2="14" y2="5"></line>
                                        </svg>
                                        <span class="photo-title">Foto Kanan</span>
                                        <span class="photo-sub">(Opsional, JPG/JPEG/PNG/WEBP, maks. 2MB)</span>
                                    </div>
                                    <div class="photo-change-overlay">Ganti Foto</div>
                                </div>

                                @php $hasDalam = !empty($motifPertama->gambar_dalam); @endphp
                                <div class="photo-upload-card {{ $hasDalam ? 'has-image' : '' }}"
                                    onclick="document.getElementById('input_gambar_dalam').click()">
                                    <input type="file" id="input_gambar_dalam" name="gambar_dalam"
                                        accept=".jpg,.jpeg,.png,.webp" style="display: none;"
                                        onchange="previewPhoto(this, 'preview_dalam')">
                                    <img id="preview_dalam" class="preview-img"
                                        src="{{ $hasDalam ? asset('assets/image/produk/' . $motifPertama->gambar_dalam) : '' }}"
                                        alt="Foto Dalam" style="{{ $hasDalam ? 'display: block;' : '' }}">
                                    <div class="photo-card-content" style="{{ $hasDalam ? 'display: none;' : '' }}">
                                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <rect x="3" y="3" width="18" height="18" rx="3"
                                                ry="3"></rect>
                                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                            <polyline points="21 15 16 10 5 21"></polyline>
                                            <line x1="12" y1="3" x2="12" y2="7"></line>
                                            <line x1="10" y1="5" x2="14" y2="5"></line>
                                        </svg>
                                        <span class="photo-title">Foto Dalam</span>
                                        <span class="photo-sub">(Opsional, JPG/JPEG/PNG/WEBP, maks. 2MB)</span>
                                    </div>
                                    <div class="photo-change-overlay">Ganti Foto</div>
                                </div>
                            </div>
                            <span class="photo-sub">JPG/JPEG/PNG/WEBP, maks. 2MB per foto.</span>
                        </div>

                    </div>

                </div>

                <div class="form-actions">
                    <a href="{{ route('produk.index') }}" class="btn-batal">Batal</a>
                    <button type="submit" class="btn-simpan">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                            <polyline points="17 21 17 13 7 13 7 21"></polyline>
                            <polyline points="7 3 7 8 15 8"></polyline>
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </main>
    </div>

    <script>
        const userBtn = document.getElementById('userPillBtn');
        const userDropdown = document.getElementById('userDropdown');
        const userChevron = document.getElementById('userPillChevron');

        if (userBtn && userDropdown) {
            userBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                const isShown = userDropdown.classList.contains('show');
                userDropdown.classList.toggle('show', !isShown);
                if (userChevron) {
                    userChevron.style.transform = isShown ? 'rotate(0deg)' : 'rotate(180deg)';
                }
            });

            document.addEventListener('click', function() {
                userDropdown.classList.remove('show');
                if (userChevron) userChevron.style.transform = 'rotate(0deg)';
            });
        }

        function previewPhoto(input, previewId) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.getElementById(previewId);
                    img.src = e.target.result;
                    img.style.display = 'block';
                    const card = img.closest('.photo-upload-card');
                    card.classList.add('has-image');
                    const content = card.querySelector('.photo-card-content');
                    if (content) content.style.display = 'none';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        const statusSelect = document.getElementById('status_motif_select');
        if (statusSelect) {
            function updateStatusClass() {
                statusSelect.classList.remove('status-aktif', 'status-sold_out', 'status-arsip');
                statusSelect.classList.add('status-' + statusSelect.value);
            }
            statusSelect.addEventListener('change', updateStatusClass);
            updateStatusClass();
        }
    </script>
@endsection
