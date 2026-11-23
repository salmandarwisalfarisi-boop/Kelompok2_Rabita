<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>Checkout | Rabita</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600&family=Playball&display=swap" rel="stylesheet">
<style>
:root{--nav:#151515;--gold:#C9A66B;--bg1:#F5F4EF;--bg2:#E9E5DE;--ink:#111;--tx:#555;--mu:#777;--bd:#8A8A8A;--ph:#DAD4C9;--err:#B3261E;--ft:#CFCFCF;--fm:#7D7D7D;box-sizing:border-box;padding-top:env(safe-area-inset-top,0px);padding-bottom:env(safe-area-inset-bottom,0px)}
html{background:var(--nav);scroll-padding-top:env(safe-area-inset-top,0px)}
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Plus Jakarta Sans',system-ui,sans-serif;background:var(--bg1);color:var(--ink);min-height:100vh;display:flex;flex-direction:column}
svg{display:block}
button{font-family:inherit;cursor:pointer}
button:focus-visible,input:focus-visible,select:focus-visible{outline:2px solid var(--gold);outline-offset:3px}

/* LAYOUT */
.page{flex:1;display:grid;grid-template-columns:724fr 716fr}
.left{padding:61px 0 59px 118px;width:100%}
.left .in{width:491px;max-width:100%}
.right{background:var(--bg2);padding:67px 0 40px 80px}
.right .in{width:539px;max-width:100%;padding-right:97px}

/* FORM */
h2{font-weight:500;font-size:22px;line-height:30px;color:var(--ink)}
.f1{margin-top:13px}
.fld{position:relative;height:56px;margin-top:16px}
.fld:first-of-type{margin-top:0}
.fld input,.fld select{width:100%;height:100%;border:1px solid var(--bd);border-radius:10px;background:transparent;padding:0 12px;font:400 13px 'Plus Jakarta Sans',sans-serif;color:var(--ink);appearance:none;-webkit-appearance:none}
.fld input::placeholder{color:var(--mu)}
.fld select{padding-right:44px;cursor:pointer;color:var(--ink)}
.fld .lb{position:absolute;left:12px;top:7px;font-size:11px;color:var(--mu);pointer-events:none}
.fld .ch{position:absolute;right:19px;top:25px;pointer-events:none;stroke:var(--tx)}
.row2{display:grid;grid-template-columns:1fr 1fr;gap:21px}
.row2 .fld{margin-top:0}
.r2a{margin-top:16px}.r2b{margin-top:14px}.cat{margin-top:18px}
.h2b{margin-top:30px;padding-left:1px}
.ship{margin:16px 0 0 1px;padding:16px;border-radius:10px;background:#fff;border:1px solid #CFCFD4;font-size:14px;color:var(--ink);display:flex;justify-content:space-between;align-items:center}
.h2c{margin-top:22px;padding-left:0}
.pay-group{display:flex;gap:12px;margin-top:12px}
.pay{padding:10px 20px;border:1px solid #666;background:transparent;font:500 14px 'Plus Jakarta Sans',sans-serif;color:var(--ink);border-radius:6px;cursor:pointer;transition:all 0.15s}
.pay.active{border-color:var(--ink);background:var(--ink);color:#fff}
.go{display:block;margin-top:30px;width:100%;height:62px;border:0;border-radius:10px;background:#000;color:#fff;font:500 18px 'Plus Jakarta Sans',sans-serif;cursor:pointer;transition:background 0.2s}
.go:hover{background:#222}
.msg{margin-top:12px;font-size:13px;line-height:18px;min-height:18px;color:var(--err)}

/* RINGKASAN */
.items-list{display:flex;flex-direction:column;gap:18px;max-height:400px;overflow-y:auto;padding-right:8px}
.item{display:flex;align-items:center;gap:18px;position:relative}
.img{position:relative;width:76px;height:78px;flex:none;background:var(--ph);border-radius:6px;overflow:hidden;display:flex;align-items:center;justify-content:center}
.img img{width:100%;height:100%;object-fit:cover}
.badge{position:absolute;top:-8px;right:-8px;width:22px;height:22px;border-radius:50%;background:#000;color:#fff;font-size:11px;display:grid;place-items:center;font-weight:600}
.nm{flex:1}
.nm b{display:block;font-weight:500;font-size:15px;line-height:20px;color:#222}
.nm small{display:block;font-size:13px;color:var(--mu);margin-top:3px}
.ip{font-weight:500;font-size:15px;color:#222}
.hr{height:1px;background:#8A877F;margin:25px 0 0 0}
.ln{display:flex;justify-content:space-between;align-items:center;font-size:15px;color:var(--ink)}
.ln.a{margin-top:24px}.ln.b{margin-top:16px}.ln.c{margin-top:20px}
.ln span:last-child{font-weight:500}
.ln.b span:last-child{font-weight:400;font-size:14px;color:var(--tx)}
.ln.c span:first-child{font-weight:600;font-size:18px}
.ln.c span:last-child{font-weight:600;font-size:20px}

@media(max-width:900px){
.page{grid-template-columns:1fr}
.right{order:-1;padding:28px 20px}.right .in{padding-right:0;width:100%}
.left{padding:28px 20px 40px}.left .in{width:100%}
.row2{gap:12px}}
</style>
</head>
<body>
<x-navbar />

<main class="page">
  <!-- Sisi Kiri: Form Pengiriman (Terhubung ke tb_pemesanan & tb_pemesanan_detail) -->
  <section class="left">
    <div class="in">
      <h2>Alamat Pengiriman</h2>

      @if($errors->any())
        <div style="margin-top:14px;padding:12px 16px;background:#FFEBEE;color:#C62828;border-radius:6px;font-size:13px;">
          <ul style="margin-left:16px;">
            @foreach($errors->all() as $err)
              <li>{{ $err }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      @if(session('error'))
        <div style="margin-top:14px;padding:12px 16px;background:#FFEBEE;color:#C62828;border-radius:6px;font-size:13px;">
          {{ session('error') }}
        </div>
      @endif

      <form id="checkout-submit-form" method="POST" action="{{ route('checkout.store') }}" enctype="multipart/form-data">
        @csrf
        <input type="file" name="bukti_bayar" id="input_bukti_bayar" accept="image/png,image/jpeg,image/jpg" style="display:none;">

        {{-- Hidden Items Data untuk tb_pemesanan_detail --}}
        @foreach($checkoutItems as $index => $item)
          <input type="hidden" name="items[{{ $index }}][motif_id]" value="{{ $item['motif_id'] }}">
          <input type="hidden" name="items[{{ $index }}][qty]" value="{{ $item['qty'] }}">
          <input type="hidden" name="items[{{ $index }}][cart_id]" value="{{ $item['cart_id'] }}">
        @endforeach

        <div class="f1">
          <div class="fld">
            <span class="lb">Negara / Wilayah</span>
            <select aria-label="Negara" style="padding-top:14px;">
              <option value="ID" selected>Indonesia</option>
            </select>
            <svg class="ch" width="10" height="6" viewBox="0 0 10 6" fill="none" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="m1 1 4 4 4-4"/></svg>
          </div>

          <div class="fld">
            <input type="text" name="nama_penerima" placeholder="Nama Lengkap Penerima" value="{{ old('nama_penerima', Auth::user()->name ?? '') }}" required>
          </div>

          <!-- Autocomplete Pencarian Wilayah Tujuan (RajaOngkir) -->
          <div class="fld" style="position:relative;">
            <input type="text" id="dest_search_input" placeholder="Ketik Kota / Kecamatan Tujuan (Contoh: Surabaya, Banjarmasin)..." autocomplete="off" required style="padding-right:36px;">
            <div id="dest_spinner" style="display:none;position:absolute;right:14px;top:18px;">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#C9A66B" stroke-width="2.5" class="spin"><circle cx="12" cy="12" r="10" stroke-opacity="0.25"/><path d="M12 2a10 10 0 0 1 10 10"/></svg>
            </div>
            <!-- Dropdown Hasil Pencarian -->
            <div id="dest_dropdown" class="dest-dropdown" style="display:none;"></div>
          </div>

          <!-- Hidden Input untuk Database tb_pemesanan -->
          <input type="hidden" name="destination_id" id="input_destination_id" value="">
          <input type="hidden" name="provinsi" id="input_provinsi" value="{{ old('provinsi', 'Kalimantan Selatan') }}">
          <input type="hidden" name="kota" id="input_kota" value="{{ old('kota', 'Banjarmasin') }}">
          <input type="hidden" name="kecamatan" id="input_kecamatan" value="{{ old('kecamatan', 'Banjarmasin') }}">
          <input type="hidden" name="kode_pos" id="input_kode_pos" value="{{ old('kode_pos', '70111') }}">
          <input type="hidden" id="input_weight" value="{{ $totalWeight ?? 1000 }}">

          <div class="fld">
            <input type="text" name="alamat_lengkap" placeholder="Alamat Lengkap (Nama Jalan, No. Rumah, RT/RW, Patokan)" value="{{ old('alamat_lengkap') }}" required>
          </div>

          <div class="row2 r2b">
            <div class="fld">
              <input type="tel" name="no_hp_penerima" placeholder="Nomor Telepon / WhatsApp" value="{{ old('no_hp_penerima') }}" required>
            </div>
            <div class="fld">
              <input type="text" id="display_kode_pos" placeholder="Kode Pos" value="{{ old('kode_pos', '70111') }}" readonly style="background:#F2EFE9;cursor:not-allowed;">
            </div>
          </div>

          <div class="fld cat">
            <input type="text" name="catatan" placeholder="Catatan Pengiriman (Opsional)" value="{{ old('catatan') }}">
          </div>
        </div>

        <div style="display:flex;align-items:center;justify-content:space-between;margin-top:30px;">
          <h2 class="h2b" style="margin:0;">Pilihan Ekspedisi & Ongkir</h2>
          <span style="font-size:12px;color:#777;background:#EAE6DE;padding:3px 10px;border-radius:12px;">
            Berat: {{ number_format(($totalWeight ?? 1000) / 1000, 1) }} kg
          </span>
        </div>

        <!-- Container Pilihan Ongkir Real-time dari RajaOngkir -->
        <div id="shipping_section" style="margin-top:14px;">
          <div id="shipping_placeholder" style="padding:16px;border-radius:10px;background:#FFF;border:1px dashed #C4BAAF;font-size:13px;color:#777;text-align:center;">
            Silakan pilih kota / kecamatan tujuan di atas untuk melihat tarif resmi J&T, JNE, dan POS Indonesia.
          </div>

          <div id="shipping_loading" style="display:none;padding:24px;border-radius:10px;background:#FFF;border:1px solid #E5E7EB;text-align:center;color:#666;font-size:13px;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#C9A66B" stroke-width="2.5" class="spin" style="margin:0 auto 8px;"><circle cx="12" cy="12" r="10" stroke-opacity="0.25"/><path d="M12 2a10 10 0 0 1 10 10"/></svg>
            <span>Menghitung ongkir resmi dari Banjarbaru...</span>
          </div>

          <div id="shipping_options_list" style="display:none;flex-direction:column;gap:10px;"></div>
        </div>

        <!-- Hidden input data pengiriman terpilih -->
        <input type="hidden" name="ongkir" id="input_ongkir" value="{{ $ongkir ?? 20000 }}">
        <input type="hidden" name="kurir" id="input_kurir" value="J&T Express">
        <input type="hidden" name="layanan_kurir" id="input_layanan_kurir" value="Reguler">
        <input type="hidden" name="estimasi_tiba" id="input_estimasi_tiba" value="2-3 Hari">

        <h2 class="h2c" style="margin-top:26px;">Metode Pembayaran</h2>
        <div class="pay-group">
          <button type="button" class="pay active" data-method="qris">QRIS</button>
          <button type="button" class="pay" data-method="transfer">Transfer Bank</button>
        </div>

        <button type="submit" class="go" id="go-btn">Bayar Sekarang · Rp {{ number_format($total, 0, ',', '.') }}</button>
      </form>
    </div>
  </section>

  <!-- Sisi Kanan: Ringkasan Produk Riil yang Dipilih -->
  <aside class="right">
    <div class="in">
      <h2 style="margin-bottom:20px;">Ringkasan Pesanan</h2>

      <div class="items-list">
        @foreach($checkoutItems as $it)
          <div class="item">
            <div class="img">
              @if($it['gambar'] && file_exists(public_path('assets/image/produk/' . $it['gambar'])))
                <img src="{{ asset('assets/image/produk/' . $it['gambar']) }}" alt="{{ $it['nama_produk'] }}">
              @else
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#8F897E" stroke-width="1.5"><rect x="3" y="4" width="18" height="16" rx="2"/><circle cx="9" cy="10" r="1.6"/><path d="m21 16-5-5-8 8"/></svg>
              @endif
              <i class="badge" style="font-style:normal">{{ $it['qty'] }}</i>
            </div>
            <div class="nm">
              <b>{{ $it['nama_produk'] }}</b>
              <small>{{ $it['kategori'] }} · Motif {{ $it['nama_motif'] }}</small>
            </div>
            <div class="ip">Rp {{ number_format($it['subtotal'], 0, ',', '.') }}</div>
          </div>
        @endforeach
      </div>

      <div class="hr"></div>

      <div class="ln a">
        <span>Subtotal · {{ count($checkoutItems) }} Produk</span>
        <span id="display_subtotal" data-subtotal="{{ $subtotal }}">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
      </div>

      <div class="ln b">
        <span>Biaya Pengiriman</span>
        <span id="display_ongkir">Rp {{ number_format($ongkir, 0, ',', '.') }}</span>
      </div>

      <div class="ln c">
        <span>Total Pembayaran</span>
        <span id="display_total">Rp {{ number_format($total, 0, ',', '.') }}</span>
      </div>
    </div>
  </aside>
</main>

<!-- MODAL PEMBAYARAN QRIS -->
<div id="qrisModalOverlay" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.65);backdrop-filter:blur(4px);-webkit-backdrop-filter:blur(4px);z-index:99999;align-items:center;justify-content:center;padding:20px;">
  <div style="background:#FFFFFF;border-radius:18px;max-width:480px;width:100%;max-height:92vh;overflow-y:auto;box-shadow:0 20px 40px rgba(0,0,0,0.25);position:relative;animation:modalPop 0.25s ease-out;">
    
    <!-- Modal Header -->
    <div style="padding:20px 24px 16px;border-bottom:1px solid #EAE6DE;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;background:#FFFFFF;z-index:10;border-radius:18px 18px 0 0;">
      <div>
        <h3 style="font-size:18px;font-weight:700;color:#1A1A1A;margin:0;">Pembayaran QRIS</h3>
        <p style="font-size:12px;color:#777;margin-top:2px;">Selesaikan pembayaran melalui kode QR di bawah ini</p>
      </div>
      <button type="button" id="closeQrisModalBtn" style="background:#F5F4EF;border:none;width:34px;height:34px;border-radius:50%;display:grid;place-items:center;color:#666;font-size:16px;cursor:pointer;transition:background 0.2s;" onmouseover="this.style.background='#E8E2D9'" onmouseout="this.style.background='#F5F4EF'">✕</button>
    </div>

    <!-- Modal Body -->
    <div style="padding:22px 24px;">
      
      <!-- Total Tagihan Box -->
      <div style="background:#FAF8F5;border:1px solid #DEC096;border-radius:12px;padding:14px 18px;text-align:center;margin-bottom:20px;">
        <span style="font-size:12px;color:#888;display:block;text-transform:uppercase;letter-spacing:0.5px;font-weight:500;">Total Tagihan Pembayaran</span>
        <span id="modal_display_total" style="font-size:24px;font-weight:700;color:#C9A66B;display:block;margin-top:4px;">Rp {{ number_format($total, 0, ',', '.') }}</span>
      </div>

      <!-- Kode QRIS Image -->
      <div style="display:flex;flex-direction:column;align-items:center;margin-bottom:20px;">
        <div style="background:#FFFFFF;padding:12px;border-radius:14px;border:1.5px solid #E5E7EB;box-shadow:0 4px 12px rgba(0,0,0,0.06);max-width:260px;width:100%;display:flex;align-items:center;justify-content:center;">
          @if(!empty($qrPath))
            <img src="{{ $qrPath }}" alt="QRIS Rabita" style="width:100%;height:auto;max-height:260px;object-fit:contain;border-radius:8px;display:block;">
          @else
            <div style="padding:40px 10px;text-align:center;color:#999;font-size:12px;">
              <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#C9A66B" stroke-width="1.5" style="margin:0 auto 10px;"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
              QRIS Sedang Disiapkan Admin
            </div>
          @endif
        </div>
        <span style="font-size:11.5px;color:#777;margin-top:10px;display:inline-flex;align-items:center;gap:6px;">
          <span style="width:7px;height:7px;background:#10B981;border-radius:50%;display:inline-block;"></span>
          Mendukung Semua Bank & E-Wallet (BCA, Mandiri, BRI, GoPay, OVO, Dana)
        </span>
      </div>

      <!-- Upload Bukti Transfer -->
      <div style="margin-bottom:20px;">
        <label style="display:block;font-size:13px;font-weight:600;color:#1A1A1A;margin-bottom:6px;">
          Unggah Bukti Transfer <span style="font-size:11px;font-weight:400;color:#888;">(Bisa sekarang atau di Riwayat Pesanan)</span>
        </label>
        
        <div id="modalUploadCard" onclick="document.getElementById('modal_file_input').click()" style="border:2px dashed #C4BAAF;border-radius:12px;background:#FAFAF7;padding:16px;text-align:center;cursor:pointer;transition:all 0.2s;">
          <input type="file" id="modal_file_input" accept="image/png,image/jpeg,image/jpg" style="display:none;">
          <div id="modalUploadEmpty" style="display:flex;flex-direction:column;align-items:center;gap:6px;">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#C9A66B" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/>
            </svg>
            <span style="font-size:12.5px;font-weight:600;color:#333;">Pilih Foto Bukti Transfer</span>
            <span style="font-size:11px;color:#888;">Format JPG, PNG (Maks. 4MB)</span>
          </div>
          <div id="modalUploadPreview" style="display:none;align-items:center;gap:12px;text-align:left;">
            <img id="modalPreviewImg" src="" alt="Preview" style="width:54px;height:54px;object-fit:cover;border-radius:8px;border:1px solid #DDD;">
            <div style="flex:1;overflow:hidden;">
              <div id="modalFileName" style="font-size:12.5px;font-weight:600;color:#222;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;"></div>
              <span style="font-size:11px;color:#10B981;">✓ File terpilih. Klik untuk mengganti</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Action Buttons -->
      <div style="display:flex;flex-direction:column;gap:10px;">
        <button type="button" id="confirmAndSubmitBtn" style="width:100%;height:50px;background:#151515;color:#FFFFFF;border:none;border-radius:10px;font-family:'Plus Jakarta Sans',sans-serif;font-size:15px;font-weight:600;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;transition:background 0.2s;" onmouseover="this.style.background='#C9A66B'" onmouseout="this.style.background='#151515'">
          <span>Kirim & Selesaikan Pesanan</span>
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
        </button>

        <button type="button" id="cancelModalBtn" style="width:100%;height:40px;background:transparent;color:#777;border:none;border-radius:10px;font-size:13px;cursor:pointer;">
          Kembali ke Form Checkout
        </button>
      </div>

    </div>
  </div>
</div>

<style>
@keyframes modalPop {
  0% { opacity: 0; transform: scale(0.95); }
  100% { opacity: 1; transform: scale(1); }
}

@keyframes spin {
  100% { transform: rotate(360deg); }
}
.spin {
  animation: spin 0.8s linear infinite;
}

/* Autocomplete Dropdown RajaOngkir */
.dest-dropdown {
  position: absolute;
  top: calc(100% + 4px);
  left: 0;
  right: 0;
  background: #FFFFFF;
  border: 1px solid #C4BAAF;
  border-radius: 10px;
  box-shadow: 0 10px 25px rgba(0,0,0,0.12);
  max-height: 240px;
  overflow-y: auto;
  z-index: 99;
}
.dest-item {
  padding: 11px 14px;
  font-size: 12.5px;
  color: #222;
  cursor: pointer;
  border-bottom: 1px solid #F0ECE4;
  line-height: 1.35;
  transition: all 0.15s ease;
}
.dest-item:last-child {
  border-bottom: none;
}
.dest-item:hover {
  background: #FAF7F2;
  color: #C9A66B;
}

/* Shipping Option Cards */
.ship-card {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 12px 16px;
  border-radius: 10px;
  background: #FFFFFF;
  border: 1.5px solid #E2DDD5;
  cursor: pointer;
  transition: all 0.2s ease;
  user-select: none;
}
.ship-card:hover {
  border-color: #C9A66B;
}
.ship-card.active {
  border-color: #151515;
  background: #FAF8F5;
  box-shadow: 0 2px 8px rgba(0,0,0,0.06);
}

.courier-badge {
  display: inline-block;
  padding: 2px 8px;
  border-radius: 4px;
  font-size: 11px;
  font-weight: 700;
  text-transform: uppercase;
  margin-right: 6px;
}
.badge-jne { background: #E0F2FE; color: #0369A1; }
.badge-jnt { background: #FEE2E2; color: #B91C1C; }
.badge-pos { background: #FFEDD5; color: #C2410C; }
</style>

<x-footer />

<script>
document.addEventListener('DOMContentLoaded', function() {
  var csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';

  // Toggle metode pembayaran tab visual
  var payButtons = document.querySelectorAll('.pay');
  payButtons.forEach(function(btn) {
    btn.addEventListener('click', function() {
      payButtons.forEach(function(b) { b.classList.remove('active'); });
      btn.classList.add('active');
    });
  });

  // Data ringkasan belanja
  var displaySubtotalElem = document.getElementById('display_subtotal');
  var subtotal = parseInt(displaySubtotalElem ? displaySubtotalElem.getAttribute('data-subtotal') : 0) || 0;
  var displayOngkirElem = document.getElementById('display_ongkir');
  var displayTotalElem = document.getElementById('display_total');
  var goBtn = document.getElementById('go-btn');
  var modalDisplayTotalElem = document.getElementById('modal_display_total');

  var inputOngkir = document.getElementById('input_ongkir');
  var inputKurir = document.getElementById('input_kurir');
  var inputLayanan = document.getElementById('input_layanan_kurir');
  var inputEstimasi = document.getElementById('input_estimasi_tiba');
  var inputWeight = document.getElementById('input_weight');

  function formatRupiah(num) {
    return 'Rp ' + num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
  }

  function updateOrderTotals(ongkirAmount) {
    var newTotal = subtotal + ongkirAmount;
    if (inputOngkir) inputOngkir.value = ongkirAmount;
    if (displayOngkirElem) displayOngkirElem.textContent = formatRupiah(ongkirAmount);
    if (displayTotalElem) displayTotalElem.textContent = formatRupiah(newTotal);
    if (modalDisplayTotalElem) modalDisplayTotalElem.textContent = formatRupiah(newTotal);
    if (goBtn) goBtn.textContent = 'Bayar Sekarang · ' + formatRupiah(newTotal);
  }

  // --- 1. RAJAONGKIR: AUTOCOMPLETE PENCARIAN TUJUAN ---
  var destSearchInput = document.getElementById('dest_search_input');
  var destDropdown = document.getElementById('dest_dropdown');
  var destSpinner = document.getElementById('dest_spinner');

  var inputDestinationId = document.getElementById('input_destination_id');
  var inputProvinsi = document.getElementById('input_provinsi');
  var inputKota = document.getElementById('input_kota');
  var inputKecamatan = document.getElementById('input_kecamatan');
  var inputKodePos = document.getElementById('input_kode_pos');
  var displayKodePos = document.getElementById('display_kode_pos');

  var searchTimer = null;

  if (destSearchInput && destDropdown) {
    destSearchInput.addEventListener('input', function() {
      var query = this.value.trim();
      clearTimeout(searchTimer);

      if (query.length < 3) {
        destDropdown.style.display = 'none';
        destDropdown.innerHTML = '';
        return;
      }

      destSpinner.style.display = 'block';

      searchTimer = setTimeout(function() {
        fetch('{{ route("rajaongkir.destination") }}?search=' + encodeURIComponent(query))
          .then(function(res) { return res.json(); })
          .then(function(json) {
            destSpinner.style.display = 'none';
            var items = json.data || [];
            if (items.length === 0) {
              destDropdown.innerHTML = '<div style="padding:12px;font-size:12px;color:#888;text-align:center;">Wilayah tidak ditemukan. Coba ketik nama kota/kecamatan lain.</div>';
              destDropdown.style.display = 'block';
              return;
            }

            var html = '';
            items.forEach(function(item) {
              html += '<div class="dest-item" data-json="' + encodeURIComponent(JSON.stringify(item)) + '">' +
                        '<div style="font-weight:600;">' + item.label + '</div>' +
                      '</div>';
            });
            destDropdown.innerHTML = html;
            destDropdown.style.display = 'block';

            // Bind click ke setiap item
            destDropdown.querySelectorAll('.dest-item').forEach(function(el) {
              el.addEventListener('click', function() {
                var data = JSON.parse(decodeURIComponent(this.getAttribute('data-json')));
                destSearchInput.value = data.label;
                inputDestinationId.value = data.id;
                inputProvinsi.value = data.province_name;
                inputKota.value = data.city_name;
                inputKecamatan.value = data.district_name;
                inputKodePos.value = data.zip_code;
                if (displayKodePos) displayKodePos.value = data.zip_code;

                destDropdown.style.display = 'none';

                // Langsung hitung ongkir real-time
                fetchShippingCosts(data.id);
              });
            });
          })
          .catch(function(err) {
            destSpinner.style.display = 'none';
            console.error('Error fetching destinations:', err);
          });
      }, 350);
    });

    // Tutup dropdown saat klik di luar
    document.addEventListener('click', function(e) {
      if (!destSearchInput.contains(e.target) && !destDropdown.contains(e.target)) {
        destDropdown.style.display = 'none';
      }
    });
  }

  // --- 2. RAJAONGKIR: HITUNG ONGKOS KIRIM REAL-TIME ---
  var shippingPlaceholder = document.getElementById('shipping_placeholder');
  var shippingLoading = document.getElementById('shipping_loading');
  var shippingOptionsList = document.getElementById('shipping_options_list');

  function fetchShippingCosts(destinationId) {
    if (shippingPlaceholder) shippingPlaceholder.style.display = 'none';
    if (shippingOptionsList) shippingOptionsList.style.display = 'none';
    if (shippingLoading) shippingLoading.style.display = 'block';

    var weight = inputWeight ? parseInt(inputWeight.value) || 1000 : 1000;

    fetch('{{ route("rajaongkir.cost") }}', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
        'Accept': 'application/json'
      },
      body: JSON.stringify({
        destination: destinationId,
        weight: weight
      })
    })
    .then(function(res) { return res.json(); })
    .then(function(json) {
      if (shippingLoading) shippingLoading.style.display = 'none';

      var services = json.data || [];
      if (!services || services.length === 0) {
        if (shippingOptionsList) {
          shippingOptionsList.innerHTML = '<div style="padding:14px;background:#FFFBEB;color:#B45309;border-radius:10px;font-size:12.5px;">Tarif otomatis tidak ditemukan untuk rute ini. Menggunakan tarif reguler default Rp 20.000.</div>';
          shippingOptionsList.style.display = 'flex';
        }
        updateOrderTotals(20000);
        return;
      }

      var html = '';
      services.forEach(function(srv, idx) {
        var badgeClass = 'badge-' + (srv.courier_code || 'jne');
        var isSelected = (idx === 0);
        var costFormatted = formatRupiah(srv.cost);

        html += '<div class="ship-card ' + (isSelected ? 'active' : '') + '" ' +
                     'data-courier="' + srv.courier_name + '" ' +
                     'data-service="' + srv.service + '" ' +
                     'data-cost="' + srv.cost + '" ' +
                     'data-etd="' + srv.etd + '">' +
                  '<div style="display:flex;align-items:center;gap:10px;">' +
                    '<input type="radio" name="shipping_radio" style="accent-color:#151515;" ' + (isSelected ? 'checked' : '') + '>' +
                    '<div>' +
                      '<div style="display:flex;align-items:center;gap:6px;">' +
                        '<span class="courier-badge ' + badgeClass + '">' + srv.courier_code + '</span>' +
                        '<strong style="font-size:13.5px;color:#1A1A1A;">' + srv.service + '</strong>' +
                      '</div>' +
                      '<div style="font-size:11.5px;color:#777;margin-top:2px;">' +
                        (srv.description ? srv.description + ' · ' : '') + 'Estimasi tiba ' + srv.etd +
                      '</div>' +
                    '</div>' +
                  '</div>' +
                  '<div style="font-size:14.5px;font-weight:700;color:#1A1A1A;">' + costFormatted + '</div>' +
                '</div>';
      });

      if (shippingOptionsList) {
        shippingOptionsList.innerHTML = html;
        shippingOptionsList.style.display = 'flex';

        // Auto pilih opsi pertama
        var first = services[0];
        if (inputKurir) inputKurir.value = first.courier_name;
        if (inputLayanan) inputLayanan.value = first.service;
        if (inputEstimasi) inputEstimasi.value = first.etd;
        updateOrderTotals(first.cost);

        // Bind klik ke setiap kartu opsi
        shippingOptionsList.querySelectorAll('.ship-card').forEach(function(card) {
          card.addEventListener('click', function() {
            shippingOptionsList.querySelectorAll('.ship-card').forEach(function(c) {
              c.classList.remove('active');
              var r = c.querySelector('input[type="radio"]');
              if (r) r.checked = false;
            });

            card.classList.add('active');
            var radio = card.querySelector('input[type="radio"]');
            if (radio) radio.checked = true;

            var courierName = card.getAttribute('data-courier');
            var serviceName = card.getAttribute('data-service');
            var cost = parseInt(card.getAttribute('data-cost')) || 0;
            var etd = card.getAttribute('data-etd');

            if (inputKurir) inputKurir.value = courierName;
            if (inputLayanan) inputLayanan.value = serviceName;
            if (inputEstimasi) inputEstimasi.value = etd;

            updateOrderTotals(cost);
          });
        });
      }
    })
    .catch(function(err) {
      if (shippingLoading) shippingLoading.style.display = 'none';
      if (shippingOptionsList) {
        shippingOptionsList.innerHTML = '<div style="padding:12px;background:#FEF2F2;color:#991B1B;border-radius:10px;font-size:12.5px;">Gagal memuat tarif ongkir. Menggunakan tarif flat Rp 20.000.</div>';
        shippingOptionsList.style.display = 'flex';
      }
      updateOrderTotals(20000);
      console.error('Error calculating cost:', err);
    });
  }

  // --- 3. MODAL QRIS LOGIC ---
  var checkoutForm = document.getElementById('checkout-submit-form');
  var modalOverlay = document.getElementById('qrisModalOverlay');
  var closeQrisModalBtn = document.getElementById('closeQrisModalBtn');
  var cancelModalBtn = document.getElementById('cancelModalBtn');
  var confirmAndSubmitBtn = document.getElementById('confirmAndSubmitBtn');
  var modalFileInput = document.getElementById('modal_file_input');
  var formFileInput = document.getElementById('input_bukti_bayar');

  // Preview elements
  var modalUploadEmpty = document.getElementById('modalUploadEmpty');
  var modalUploadPreview = document.getElementById('modalUploadPreview');
  var modalPreviewImg = document.getElementById('modalPreviewImg');
  var modalFileName = document.getElementById('modalFileName');

  if (goBtn && checkoutForm && modalOverlay) {
    goBtn.addEventListener('click', function(e) {
      // 1. Cek validitas form pengiriman terlebih dahulu
      if (!checkoutForm.checkValidity()) {
        checkoutForm.reportValidity();
        return;
      }

      e.preventDefault();
      // Buka modal
      modalOverlay.style.display = 'flex';
      document.body.style.overflow = 'hidden';
    });

    function closeModal() {
      modalOverlay.style.display = 'none';
      document.body.style.overflow = '';
    }

    if (closeQrisModalBtn) closeQrisModalBtn.addEventListener('click', closeModal);
    if (cancelModalBtn) cancelModalBtn.addEventListener('click', closeModal);

    // Tutup saat klik luar modal
    modalOverlay.addEventListener('click', function(e) {
      if (e.target === modalOverlay) closeModal();
    });

    // Tangani input file bukti transfer di modal
    if (modalFileInput) {
      modalFileInput.addEventListener('change', function(e) {
        if (this.files && this.files[0]) {
          var file = this.files[0];
          modalFileName.textContent = file.name;

          var reader = new FileReader();
          reader.onload = function(evt) {
            modalPreviewImg.src = evt.target.result;
            modalUploadEmpty.style.display = 'none';
            modalUploadPreview.style.display = 'flex';
          };
          reader.readAsDataURL(file);

          // Sinkronkan ke input file form yang sebenarnya
          var dataTransfer = new DataTransfer();
          dataTransfer.items.add(file);
          formFileInput.files = dataTransfer.files;
        }
      });
    }

    // Tombol Kirim & Selesaikan di dalam modal
    if (confirmAndSubmitBtn) {
      confirmAndSubmitBtn.addEventListener('click', function() {
        confirmAndSubmitBtn.disabled = true;
        confirmAndSubmitBtn.innerHTML = '<span>Memproses Pesanan...</span>';
        checkoutForm.submit();
      });
    }
  }
});
</script>
</body>
</html>
