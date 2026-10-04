<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Produk - Rabita Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #F5F5F0;
            --card: #FFFFFF;
            --gold: #B79361;
            --gold-light: #DEC096;
            --dark-sidebar: #191919;
            --tx: #1A1A1A;
            --mut: #888888;
            --ln: #F0EDE8;
            --red: #EF4444;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Inter, Arial, sans-serif;
            background: var(--bg);
            color: var(--tx);
            display: flex;
            min-height: 100vh;
        }

        /* --- Sidebar --- */
        aside {
            width: 206px;
            flex: none;
            background: var(--dark-sidebar);
            color: #fff;
            position: sticky;
            top: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .lg {
            height: 83px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-bottom: 1px solid var(--gold-light);
        }

        .lg img {
            height: 79px;
        }

        nav {
            padding: 28px 18px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            flex: 1;
        }

        nav a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 10px;
            height: 37px;
            border-radius: 5px;
            color: #fff;
            text-decoration: none;
            font-size: 16.5px;
            transition: all .2s;
        }

        nav a:hover {
            background: var(--gold-light);
        }

        nav a.on {
            background: var(--gold);
        }

        nav img {
            width: 22px;
            height: 22px;
        }

        .sidebar-logout {
            padding: 18px;
        }

        .sidebar-logout form {
            margin: 0;
        }

        .sidebar-logout button {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            height: 37px;
            padding: 0 12px;
            border: 1px solid rgba(222, 192, 150, .3);
            border-radius: 5px;
            background: transparent;
            color: var(--gold-light);
            font-size: 14px;
            cursor: pointer;
            transition: all .2s;
        }

        .sidebar-logout button:hover {
            background: rgba(222, 192, 150, .15);
        }

        /* --- Main Content --- */
        main {
            flex: 1;
            padding: 28px 32px 40px;
        }

        .page-header {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 28px;
        }

        h1 {
            font-size: 22px;
            font-weight: 700;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--mut);
            text-decoration: none;
            font-size: 14px;
            transition: color .2s;
        }

        .back-btn:hover {
            color: var(--tx);
        }

        /* --- Form Card --- */
        .form-card {
            background: var(--card);
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .08);
            padding: 32px;
        }

        .section-title {
            font-size: 15px;
            font-weight: 700;
            color: var(--tx);
            margin: 0 0 16px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--ln);
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-full {
            grid-column: 1 / -1;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        label {
            font-size: 14px;
            font-weight: 600;
            color: var(--tx);
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid #E0DDD8;
            border-radius: 8px;
            font-size: 14px;
            font-family: Inter, Arial, sans-serif;
            background: #FAFAF8;
            color: var(--tx);
            transition: border .2s;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: var(--gold);
            background: #fff;
        }

        textarea {
            resize: vertical;
            min-height: 110px;
        }

        .error {
            color: var(--red);
            font-size: 12px;
            margin-top: 4px;
        }

        /* --- Photo Upload Grid --- */
        .photo-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
        }

        .photo-slot {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .photo-slot label {
            font-size: 13px;
            font-weight: 600;
            color: var(--tx);
            text-align: center;
        }

        .photo-label-hint {
            font-size: 11px;
            color: var(--mut);
            text-align: center;
        }

        .photo-box {
            width: 100%;
            aspect-ratio: 1;
            border: 2px dashed #E0DDD8;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: border .2s, background .2s;
            overflow: hidden;
            position: relative;
            background: #FAFAF8;
        }

        .photo-box:hover {
            border-color: var(--gold);
            background: #fff;
        }

        .photo-box img.preview {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            inset: 0;
        }

        .photo-box .upload-icon {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            color: var(--mut);
            font-size: 11px;
            text-align: center;
            padding: 8px;
        }

        .photo-box input[type="file"] {
            display: none;
        }

        /* --- Form Actions --- */
        .form-actions {
            display: flex;
            gap: 12px;
            margin-top: 28px;
            justify-content: flex-end;
        }

        .btn-save {
            background: var(--gold);
            color: #fff;
            padding: 11px 28px;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background .2s;
        }

        .btn-save:hover {
            background: #a07c4c;
        }

        .btn-cancel {
            display: inline-flex;
            align-items: center;
            background: transparent;
            color: var(--mut);
            padding: 11px 24px;
            border: 1.5px solid #D1CEC8;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            transition: all .2s;
        }

        .btn-cancel:hover {
            border-color: var(--tx);
            color: var(--tx);
        }
    </style>
</head>
<body>

    @include('components.sidebar')

    <main>
        <div class="page-header">
            <a href="{{ route('produk.index') }}" class="back-btn">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
                Kembali
            </a>
            <h1>Edit Produk</h1>
        </div>

        <form action="{{ route('produk.update', $produk->produk_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-card">
                <p class="section-title">Informasi Produk</p>
                <div class="form-grid">

                    <div class="form-group form-full">
                        <label for="nama_produk">Nama Produk</label>
                        <input type="text" id="nama_produk" name="nama_produk"
                               value="{{ old('nama_produk', $produk->nama_produk) }}"
                               placeholder="Nama produk">
                        @error('nama_produk')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="kategori_id">Kategori</label>
                        <select id="kategori_id" name="kategori_id">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($kategori as $k)
                                <option value="{{ $k->kategori_id }}"
                                    {{ old('kategori_id', $produk->kategori_id) == $k->kategori_id ? 'selected' : '' }}>
                                    {{ $k->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">1
                        <label for="status">Status</label>
                        <select id="status" name="status">
                            <option value="aktif"    {{ old('status', $produk->status) === 'aktif'    ? 'selected' : '' }}>Aktif</option>
                            <option value="sold_out" {{ old('status', $produk->status) === 'sold_out'  ? 'selected' : '' }}>Sold Out</option>
                            <option value="arsip"    {{ old('status', $produk->status) === 'arsip'     ? 'selected' : '' }}>Arsip</option>
                        </select>
                        @error('status')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="harga">Harga (Rp)</label>
                        <input type="number" id="harga" name="harga"
                               value="{{ old('harga', $produk->harga) }}" min="0">
                        @error('harga')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="stok">Stok</label>
                        <input type="number" id="stok" name="stok"
                               value="{{ old('stok', $produk->stok) }}" min="0">
                        @error('stok')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="berat_gram">Berat (gram)</label>
                        <input type="number" id="berat_gram" name="berat_gram"
                               value="{{ old('berat_gram', $produk->berat_gram) }}" min="0">
                        @error('berat_gram')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group form-full">
                        <label for="deskripsi_produk">Deskripsi Produk</label>
                        <textarea id="deskripsi_produk" name="deskripsi_produk">{{ old('deskripsi_produk', $produk->deskripsi_produk) }}</textarea>
                        @error('deskripsi_produk')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group form-full">
                        <label>Gambar Produk</label>
                        @php
                            $imgPath = public_path('assets/image/produk/' . $produk->gambar_produk);
                            $imgSrc  = file_exists($imgPath)
                                ? asset('assets/image/produk/' . $produk->gambar_produk)
                                : 'https://placehold.co/120x120/F0EDE8/B79361?text=No+Img';
                        @endphp
                        <div style="display: flex; align-items: flex-end; gap: 16px; flex-wrap: wrap; margin-top: 6px;">
                            <div>
                                <img id="currentImg" src="{{ $imgSrc }}" alt="{{ $produk->nama_produk }}" class="current-img">
                                <p class="img-label">Gambar saat ini</p>
                            </div>
                            <div>
                                <img id="imgPreview" class="img-preview" src="" alt="Preview baru">
                                <p class="img-label" id="newImgLabel" style="display: none;">Gambar baru</p>
                            </div>
                        </div>
                        <input type="file" id="gambar_produk" name="gambar_produk"
                               accept="image/*" style="margin-top: 10px;" onchange="previewImg(this)">
                        <span style="font-size: 12px; color: var(--mut);">
                            Kosongkan jika tidak ingin mengganti gambar. JPG, PNG, WEBP &middot; Maks 2MB.
                        </span>
                        @error('gambar_produk')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>

            {{-- Foto Produk --}}
            <div class="form-card" style="margin-top: 20px;">
                <p class="section-title">Foto Produk</p>
                <p style="font-size: 13px; color: var(--mut); margin-bottom: 20px;">
                    Upload foto produk dari berbagai sudut. Klik kotak foto untuk mengganti gambar.
                    Format: JPG, PNG, WEBP &middot; Maks 2MB per foto.
                </p>

                <div class="photo-grid">
                    @php
                        $fotoSlots = [
                            ['field' => 'gambar_produk', 'label' => 'Foto Depan',         'hint' => '(Utama)',     'current' => $produk->gambar_produk],
                            ['field' => 'gambar_kanan',  'label' => 'Foto Samping Kanan',   'hint' => '(Opsional)',  'current' => $produk->gambar_kanan],
                            ['field' => 'gambar_kiri',   'label' => 'Foto Samping Kiri',    'hint' => '(Opsional)',  'current' => $produk->gambar_kiri],
                            ['field' => 'gambar_dalam',  'label' => 'Foto Dalam',           'hint' => '(Opsional)',  'current' => $produk->gambar_dalam],
                        ];
                    @endphp

                    @foreach ($fotoSlots as $slot)
                        @php
                            $curFile = $slot['current'] ? public_path('assets/image/produk/' . $slot['current']) : null;
                            $hasImg  = $curFile && file_exists($curFile);
                            $curSrc  = $hasImg ? asset('assets/image/produk/' . $slot['current']) : '';
                        @endphp
                        <div class="photo-slot">
                            <label>{{ $slot['label'] }}</label>
                            <div class="photo-box" id="box-{{ $slot['field'] }}"
                                 onclick="document.getElementById('{{ $slot['field'] }}').click()">
                                <img class="preview" id="preview-{{ $slot['field'] }}"
                                     src="{{ $curSrc }}"
                                     alt="{{ $slot['label'] }}"
                                     style="{{ $hasImg ? 'display:block;' : 'display:none;' }}">
                                <div class="upload-icon" id="icon-{{ $slot['field'] }}"
                                     style="{{ $hasImg ? 'display:none;' : 'display:flex;' }}">
                                    <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                                        <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                        <polyline points="21 15 16 10 5 21"></polyline>
                                    </svg>
                                    <span>Klik untuk upload</span>
                                </div>
                                <input type="file" id="{{ $slot['field'] }}" name="{{ $slot['field'] }}"
                                       accept="image/*" onchange="previewImg(this, '{{ $slot['field'] }}')">
                            </div>
                            <span class="photo-label-hint">{{ $slot['hint'] }}</span>
                            @error($slot['field'])
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('produk.index') }}" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-save">Simpan Perubahan</button>
            </div>
        </form>
    </main>

    <script>
        function previewImg(input, field) {
            const preview = document.getElementById('preview-' + field);
            const icon    = document.getElementById('icon-' + field);

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => {
                    preview.src           = e.target.result;
                    preview.style.display = 'block';
                    icon.style.display    = 'none';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

</body>
</html>