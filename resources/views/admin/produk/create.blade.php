@extends('layouts.admin')

@section('head')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tambah Produk – Rabita</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Lato:wght@400;700&display=swap"
        rel="stylesheet">
    @vite(['resources/css/admin/pages/produk/create.css', 'resources/css/admin/components.css'])
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
                                d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z">
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
            <h1 class="page-title">Tambah Produk</h1>

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

            <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card-main">

                    <h2 class="section-title">Detail Produk</h2>

                    <div class="grid-2">
                        <div class="form-group">
                            <label class="form-label" for="nama_produk">Nama Produk (Wajib)</label>
                            <input type="text" id="nama_produk" name="nama_produk" class="form-input"
                                placeholder="Masukkan nama produk" value="{{ old('nama_produk') }}" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="kategori_id">Kategori (Wajib)</label>
                            <select id="kategori_id" name="kategori_id" class="form-select" required>
                                <option value="" disabled {{ old('kategori_id') ? '' : 'selected' }}>Pilih Kategori
                                </option>
                                @forelse ($kategori as $k)
                                    <option value="{{ $k->kategori_id }}"
                                        {{ old('kategori_id') == $k->kategori_id ? 'selected' : '' }}>
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
                                placeholder="contoh : kain sasirangan" value="{{ old('material') }}" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="harga">Harga (Wajib)</label>
                            <input type="number" id="harga" name="harga" class="form-input"
                                placeholder="Masukkan harga" value="{{ old('harga') }}" min="0" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="ukuran">Ukuran (Wajib)</label>
                            <input type="text" id="ukuran" name="ukuran" class="form-input"
                                placeholder="P X L X T (cm) Contoh: 30 x 25 x 12" value="{{ old('ukuran') }}" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="berat_gram">Berat (gram) (Wajib)</label>
                            <input type="number" id="berat_gram" name="berat_gram" class="form-input"
                                placeholder="Masukkan berat Produk" value="{{ old('berat_gram') }}" min="0"
                                required>
                        </div>

                        <div class="form-group col-full">
                            <label class="form-label" for="deskripsi_produk">Deskripsi (Wajib)</label>
                            <textarea id="deskripsi_produk" name="deskripsi_produk" class="form-textarea"
                                placeholder="Jelaskan Bahan, Ukuran, dan Keunggulan Produk..." required>{{ old('deskripsi_produk') }}</textarea>
                        </div>
                    </div>

                    <h2 class="section-title" style="margin-top: 36px;">Pilihan Motif</h2>

                    <div id="motifContainer">
                        @foreach (old('motif', [null]) as $index => $motifData)
                            <div class="motif-box motif-card" data-index="{{ $index }}">
                                <div class="motif-badge">Motif {{ $index + 1 }}</div>
                                <button type="button" class="btn-remove-motif"
                                    style="{{ $index === 0 ? 'display: none;' : '' }}">Hapus Motif</button>

                                <div class="grid-motif-fields">
                                    <div class="form-group">
                                        <label class="form-label" for="motif_{{ $index }}_nama_motif">Nama Motif
                                            (Wajib)
                                        </label>
                                        <input type="text" id="motif_{{ $index }}_nama_motif"
                                            name="motif[{{ $index }}][nama_motif]" class="form-input"
                                            placeholder="Contoh: Motif Warna Warni"
                                            value="{{ old("motif.{$index}.nama_motif") }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" for="motif_{{ $index }}_stok">Stok
                                            (Wajib)</label>
                                        <input type="number" id="motif_{{ $index }}_stok"
                                            name="motif[{{ $index }}][stok]" class="form-input" placeholder="0"
                                            value="{{ old("motif.{$index}.stok", 0) }}" min="0" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" for="motif_{{ $index }}_status">Status Motif
                                            (Wajib)</label>
                                        <select id="motif_{{ $index }}_status"
                                            name="motif[{{ $index }}][status]"
                                            class="select-status-motif status-aktif" required>
                                            <option value="aktif"
                                                {{ old("motif.{$index}.status", 'aktif') === 'aktif' ? 'selected' : '' }}>
                                                Aktif</option>
                                            <option value="sold_out"
                                                {{ old("motif.{$index}.status") === 'sold_out' ? 'selected' : '' }}>Sold
                                                Out</option>
                                            <option value="arsip"
                                                {{ old("motif.{$index}.status") === 'arsip' ? 'selected' : '' }}>Arsip
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div style="margin-top: 20px;">
                                    <label class="form-label">Foto Motif (Foto Depan Wajib; lainnya Opsional)</label>

                                    <div class="grid-photos">
                                        <div class="photo-upload-card"
                                            onclick="document.getElementById('input_motif_{{ $index }}_gambar_depan').click()">
                                            <input type="file" id="input_motif_{{ $index }}_gambar_depan"
                                                name="motif[{{ $index }}][gambar_depan]"
                                                accept=".jpg,.jpeg,.png,.webp" style="display: none;"
                                                onchange="previewPhoto(this, 'preview_motif_{{ $index }}_gambar_depan')">
                                            <img id="preview_motif_{{ $index }}_gambar_depan" class="preview-img"
                                                alt="Foto Depan">
                                            <div class="photo-card-content">
                                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <rect x="3" y="3" width="18" height="18" rx="3"
                                                        ry="3"></rect>
                                                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                                    <polyline points="21 15 16 10 5 21"></polyline>
                                                    <line x1="12" y1="3" x2="12" y2="7">
                                                    </line>
                                                    <line x1="10" y1="5" x2="14" y2="5">
                                                    </line>
                                                </svg>
                                                <span class="photo-title">Foto Depan</span>
                                                <span class="photo-sub">(Wajib, JPG/JPEG/PNG/WEBP, maks. 2MB)</span>
                                            </div>
                                            <div class="photo-change-overlay">Ganti Foto</div>
                                        </div>

                                        <div class="photo-upload-card"
                                            onclick="document.getElementById('input_motif_{{ $index }}_gambar_kiri').click()">
                                            <input type="file" id="input_motif_{{ $index }}_gambar_kiri"
                                                name="motif[{{ $index }}][gambar_kiri]"
                                                accept=".jpg,.jpeg,.png,.webp" style="display: none;"
                                                onchange="previewPhoto(this, 'preview_motif_{{ $index }}_gambar_kiri')">
                                            <img id="preview_motif_{{ $index }}_gambar_kiri" class="preview-img"
                                                alt="Foto Kiri">
                                            <div class="photo-card-content">
                                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <rect x="3" y="3" width="18" height="18" rx="3"
                                                        ry="3"></rect>
                                                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                                    <polyline points="21 15 16 10 5 21"></polyline>
                                                    <line x1="12" y1="3" x2="12" y2="7">
                                                    </line>
                                                    <line x1="10" y1="5" x2="14" y2="5">
                                                    </line>
                                                </svg>
                                                <span class="photo-title">Foto Kiri</span>
                                                <span class="photo-sub">(Opsional, JPG/JPEG/PNG/WEBP, maks. 2MB)</span>
                                            </div>
                                            <div class="photo-change-overlay">Ganti Foto</div>
                                        </div>

                                        <div class="photo-upload-card"
                                            onclick="document.getElementById('input_motif_{{ $index }}_gambar_kanan').click()">
                                            <input type="file" id="input_motif_{{ $index }}_gambar_kanan"
                                                name="motif[{{ $index }}][gambar_kanan]"
                                                accept=".jpg,.jpeg,.png,.webp" style="display: none;"
                                                onchange="previewPhoto(this, 'preview_motif_{{ $index }}_gambar_kanan')">
                                            <img id="preview_motif_{{ $index }}_gambar_kanan" class="preview-img"
                                                alt="Foto Kanan">
                                            <div class="photo-card-content">
                                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <rect x="3" y="3" width="18" height="18" rx="3"
                                                        ry="3"></rect>
                                                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                                    <polyline points="21 15 16 10 5 21"></polyline>
                                                    <line x1="12" y1="3" x2="12" y2="7">
                                                    </line>
                                                    <line x1="10" y1="5" x2="14" y2="5">
                                                    </line>
                                                </svg>
                                                <span class="photo-title">Foto Kanan</span>
                                                <span class="photo-sub">(Opsional, JPG/JPEG/PNG/WEBP, maks. 2MB)</span>
                                            </div>
                                            <div class="photo-change-overlay">Ganti Foto</div>
                                        </div>

                                        <div class="photo-upload-card"
                                            onclick="document.getElementById('input_motif_{{ $index }}_gambar_dalam').click()">
                                            <input type="file" id="input_motif_{{ $index }}_gambar_dalam"
                                                name="motif[{{ $index }}][gambar_dalam]"
                                                accept=".jpg,.jpeg,.png,.webp" style="display: none;"
                                                onchange="previewPhoto(this, 'preview_motif_{{ $index }}_gambar_dalam')">
                                            <img id="preview_motif_{{ $index }}_gambar_dalam" class="preview-img"
                                                alt="Foto Dalam">
                                            <div class="photo-card-content">
                                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <rect x="3" y="3" width="18" height="18" rx="3"
                                                        ry="3"></rect>
                                                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                                    <polyline points="21 15 16 10 5 21"></polyline>
                                                    <line x1="12" y1="3" x2="12" y2="7">
                                                    </line>
                                                    <line x1="10" y1="5" x2="14" y2="5">
                                                    </line>
                                                </svg>
                                                <span class="photo-title">Foto Dalam</span>
                                                <span class="photo-sub">(Opsional, JPG/JPEG/PNG/WEBP, maks. 2MB)</span>
                                            </div>
                                            <div class="photo-change-overlay">Ganti Foto</div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>

                    <button type="button" id="addMotifButton" class="btn-add-motif">
                        + Tambah Motif Lain
                    </button>
                    <span id="motifLimitMessage" class="photo-sub" style="display: none;">Maksimal 4 motif untuk satu
                        produk.</span>

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
                        Simpan Produk
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
                    const card = img.closest('.photo-upload-card');
                    card.classList.add('has-image');
                    const content = card.querySelector('.photo-card-content');
                    if (content) content.style.display = 'none';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        const motifContainer = document.getElementById('motifContainer');
        const addMotifButton = document.getElementById('addMotifButton');
        const motifLimitMessage = document.getElementById('motifLimitMessage');

        function renumberMotifs() {
            const cards = motifContainer.querySelectorAll('.motif-card');
            cards.forEach((card, index) => {
                card.dataset.index = index;
                card.querySelector('.motif-badge').textContent = 'Motif ' + (index + 1);
                card.querySelector('.btn-remove-motif').style.display = index === 0 ? 'none' : '';

                card.querySelectorAll('[name]').forEach((field) => {
                    field.name = field.name.replace(/motif\[\d+\]/, 'motif[' + index + ']');
                });
                card.querySelectorAll('[id]').forEach((field) => {
                    field.id = field.id.replace(/motif_\d+_/, 'motif_' + index + '_');
                });
                card.querySelectorAll('label[for]').forEach((label) => {
                    label.htmlFor = label.htmlFor.replace(/motif_\d+_/, 'motif_' + index + '_');
                });
                card.querySelectorAll('[onclick], [onchange]').forEach((element) => {
                    ['onclick', 'onchange'].forEach((attribute) => {
                        const value = element.getAttribute(attribute);
                        if (value) element.setAttribute(attribute, value.replace(/motif_\d+_/g,
                            'motif_' + index + '_'));
                    });
                });
            });

            const atLimit = cards.length >= 4;
            addMotifButton.disabled = atLimit;
            motifLimitMessage.style.display = atLimit ? 'inline' : 'none';
            updateMotifStatusClasses();
        }

        function updateMotifStatusClasses() {
            motifContainer.querySelectorAll('.select-status-motif').forEach((select) => {
                select.classList.remove('status-aktif', 'status-sold_out', 'status-arsip');
                select.classList.add('status-' + select.value);
            });
        }

        addMotifButton.addEventListener('click', () => {
            const firstCard = motifContainer.querySelector('.motif-card');
            const newCard = firstCard.cloneNode(true);
            newCard.querySelectorAll('input').forEach((input) => {
                input.value = input.type === 'number' ? '0' : '';
            });
            newCard.querySelectorAll('select').forEach((select) => {
                select.value = 'aktif';
            });
            newCard.querySelectorAll('.photo-upload-card').forEach((card) => card.classList.remove('has-image'));
            newCard.querySelectorAll('.preview-img').forEach((image) => {
                image.removeAttribute('src');
                image.style.display = '';
            });
            newCard.querySelectorAll('.photo-card-content').forEach((content) => {
                content.style.display = '';
            });
            motifContainer.appendChild(newCard);
            renumberMotifs();
        });

        motifContainer.addEventListener('click', (event) => {
            const removeButton = event.target.closest('.btn-remove-motif');
            if (removeButton) {
                removeButton.closest('.motif-card').remove();
                renumberMotifs();
            }
        });

        motifContainer.addEventListener('change', (event) => {
            if (event.target.matches('.select-status-motif')) updateMotifStatusClasses();
        });

        renumberMotifs();
    </script>
@endsection
