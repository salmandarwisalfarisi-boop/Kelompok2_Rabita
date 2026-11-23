<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>{{ $produk->nama_produk }} | Detail Produk Rabita</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600&family=Lato:wght@400;500&family=Playball&display=swap" rel="stylesheet">
<style>
:root{--nav:#151515;--foot:#1A1A1A;--gold:#C9A66B;--gold2:#B8935A;--bg1:#F5F4EF;--bg2:#F0EDE8;--btn:#DEC194;--ink:#111;--tx:#5A5A5A;--ph:#E4E0D8;--ft:#CFCFCF;--fm:#7D7D7D;
box-sizing:border-box;padding-top:env(safe-area-inset-top,0px);padding-bottom:env(safe-area-inset-bottom,0px)}
html{background:var(--nav);scroll-padding-top:env(safe-area-inset-top,0px)}
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Plus Jakarta Sans',system-ui,sans-serif;background:var(--bg1);color:var(--tx)}
svg{display:block}
button{font-family:inherit;cursor:pointer}
button:focus-visible{outline:2px solid var(--gold);outline-offset:3px}

/* DETAIL */
.detail{background:var(--bg1);padding:36px 0 51px}
.in{max-width:1440px;margin:0 auto;padding:0 clamp(20px,3.9vw,56px) 0 clamp(20px,6.25vw,90px)}
.crumb{display:flex;gap:12px;font-size:12px;color:#7A7A7A;margin-left:-2px;flex-wrap:wrap}
.crumb a{color:inherit;text-decoration:none}
.crumb a:hover{color:var(--ink)}
.crumb b{font-weight:500;color:var(--ink)}
.crumb i{font-style:normal;color:#BDBDBD}
.cols{display:grid;grid-template-columns:665fr 575fr;gap:54px;margin-top:29px}
.gal{position:relative}
.main{width:100%;aspect-ratio:665/754;background:var(--ph);overflow:hidden;border-radius:4px;display:flex;align-items:center;justify-content:center}
.main img{width:100%;height:100%;object-fit:cover;display:block}
.thumbs{display:grid;grid-template-columns:1fr 1fr;gap:19px;margin-top:17px}
.thumb-item{aspect-ratio:323/293;background:#DDD8CE;overflow:hidden;border-radius:4px;cursor:pointer;display:flex;align-items:center;justify-content:center}
.thumb-item img{width:100%;height:100%;object-fit:cover;display:block;transition:transform 0.2s}
.thumb-item:hover img{transform:scale(1.03)}
.arr{position:absolute;top:calc(100% - 160px);width:46px;height:46px;border-radius:50%;border:1px solid var(--ink);background:#fff;font-size:22px;color:var(--ink);line-height:1;box-shadow:0 2px 8px rgba(0,0,0,0.1)}
.arr.l{left:-25px}.arr.r{right:-23px}
.info h1{font-weight:500;font-size:42px;line-height:60px;color:var(--ink);letter-spacing:-.3px;margin-top:-3px}
.info .price{font-weight:600;font-size:40px;line-height:60px;color:var(--ink);letter-spacing:-.3px}
.lbl{font-size:21px;color:var(--ink);line-height:28px}
.motif{margin-top:13px}
.dots{display:flex;gap:12px;margin-top:11px}
.dot{width:24px;height:24px;border-radius:50%;border:1px solid #ccc;padding:0;cursor:pointer;transition:all 0.15s;position:relative}
.dot.on{outline:2px solid var(--ink);outline-offset:2px}
.qlbl{margin:23px 0 0 4px}
.qty{display:flex;align-items:center;justify-content:space-between;width:157px;height:47px;border:1px solid #444;margin:9px 0 0 4px;padding:0 10px;color:var(--ink)}
.qty button{background:none;border:0;width:24px;height:24px;display:grid;place-items:center;color:var(--ink)}
.qty span{font-size:18px;font-weight:300}
.hr{max-width:514px;height:1px;background:#D6D3CC;margin:31px 0 16px}
.btns{display:grid;grid-template-columns:1fr 1fr;gap:17px;max-width:571px}
.btns button{height:59px;border-radius:2px;font:400 16px 'Plus Jakarta Sans',sans-serif;color:var(--ink);transition:all 0.15s}
.buy{background:var(--btn);border:1px solid var(--btn)}
.buy:hover{background:#D4B482}
.cart{background:transparent;border:1px solid var(--ink)}
.cart:hover{background:rgba(0,0,0,.05)}
.sec{margin:0 0 0 2px}
.sec h2{font-weight:400;font-size:21px;color:var(--ink);line-height:28px}
.sec p{font-weight:300;font-size:18px;line-height:28px;color:var(--tx);margin-top:13px;text-align:justify}
.sec p+p{margin-top:14px}
.s1{margin-top:46px}.s2{margin-top:32px}.s3{margin-top:26px}
.s2 p,.s3 p{text-align:left;margin-top:14px}

/* LAINNYA */
.more{background:var(--bg2);padding:65px 0 46px}
.more h2{text-align:center;font-weight:500;font-size:29px;color:var(--ink);letter-spacing:-.2px;line-height:34px}
.wrap{max-width:1264px;margin:0 auto;padding:0 20px}
.grid{display:grid;grid-template-columns:repeat(4,1fr);gap:17px;margin-top:47px}
.card{text-align:center;text-decoration:none;color:inherit;display:block}
.card-thumb{aspect-ratio:303/466;background:var(--ph);overflow:hidden;border-radius:4px}
.card-thumb img{width:100%;height:100%;object-fit:cover;transition:transform 0.25s}
.card:hover .card-thumb img{transform:scale(1.03)}
.card h3{font-weight:400;font-size:23px;color:var(--ink);margin-top:18px}
.cp{font-size:14px;color:var(--tx);margin-top:6px}
.card .dots{justify-content:center;gap:9px;margin-top:12px}
.card .dot{width:19px;height:19px}

@media(max-width:900px){
.cols{grid-template-columns:1fr;gap:32px}.arr.l{left:-10px}.arr.r{right:-10px}
.info h1{font-size:30px;line-height:42px}.info .price{font-size:28px;line-height:42px}.btns{grid-template-columns:1fr}
.grid{grid-template-columns:repeat(2,1fr);gap:28px 14px}.card h3{font-size:18px}
.more h2{font-size:24px}}
</style>
</head>
<body>
<x-navbar />
<main>
  <section class="detail">
    <div class="in">
      <div class="crumb">
        <a href="{{ route('home') }}">Beranda</a>
        <i>/</i>
        <a href="{{ route('katalog', ['kategori' => $produk->kategori_id]) }}">{{ $produk->kategori->nama_kategori ?? 'Koleksi' }}</a>
        <i>/</i>
        <b>{{ $produk->nama_produk }}</b>
      </div>

      <div class="cols">
        <!-- Galeri Foto Produk -->
        <div class="gal">
          @php
            $firstMotif = $produk->motif->first();
            $mainImg = $firstMotif ? ($firstMotif->gambar_depan ?? '') : '';
            $subImg1 = $firstMotif ? ($firstMotif->gambar_kanan ?? $firstMotif->gambar_kiri) : '';
            $subImg2 = $firstMotif ? ($firstMotif->gambar_dalam ?? $firstMotif->gambar_depan) : '';
          @endphp
          <div class="main" id="main-gal">
            @if($mainImg && file_exists(public_path('assets/image/produk/' . $mainImg)))
              <img src="{{ asset('assets/image/produk/' . $mainImg) }}" id="main-img" alt="{{ $produk->nama_produk }}">
            @else
              <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#8F897E" stroke-width="1.4"><rect x="3" y="4" width="18" height="16" rx="2"/><circle cx="9" cy="10" r="1.6"/><path d="m21 16-5-5-8 8"/></svg>
            @endif
          </div>
          <div class="thumbs" id="thumbs-gal">
            <div class="thumb-item" onclick="switchPhoto(this)">
              @if($subImg1 && file_exists(public_path('assets/image/produk/' . $subImg1)))
                <img src="{{ asset('assets/image/produk/' . $subImg1) }}" alt="Detail 1">
              @else
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#8F897E" stroke-width="1.4"><rect x="3" y="4" width="18" height="16" rx="2"/></svg>
              @endif
            </div>
            <div class="thumb-item" onclick="switchPhoto(this)">
              @if($subImg2 && file_exists(public_path('assets/image/produk/' . $subImg2)))
                <img src="{{ asset('assets/image/produk/' . $subImg2) }}" alt="Detail 2">
              @else
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#8F897E" stroke-width="1.4"><rect x="3" y="4" width="18" height="16" rx="2"/></svg>
              @endif
            </div>
          </div>
          <button class="arr l" id="prev-btn" aria-label="Foto sebelumnya">&lt;</button>
          <button class="arr r" id="next-btn" aria-label="Foto berikutnya">&gt;</button>
        </div>

        <!-- Info Produk -->
        <div class="info">
          <h1>{{ $produk->nama_produk }}</h1>
          <div class="price">Rp {{ number_format($produk->harga, 0, ',', '.') }}</div>

          <div class="lbl motif">Motif : <span id="mn">{{ $firstMotif->nama_motif ?? 'Standar' }}</span></div>
          
          <!-- Bulatan Motif Interaktif Sesuai Banyaknya Motif di Database -->
          <div class="dots" id="motif-dots">
            @php
              $palette = ['#22B35E', '#8A5A1E', '#1E4FA8', '#D6409F', '#333333', '#C9A66B'];
            @endphp
            @foreach($produk->motif as $idx => $m)
              @php
                $warnaBg = $palette[$idx % count($palette)];
                $fDepan = $m->gambar_depan ? asset('assets/image/produk/' . $m->gambar_depan) : '';
                $fKanan = $m->gambar_kanan ? asset('assets/image/produk/' . $m->gambar_kanan) : '';
                $fDalam = $m->gambar_dalam ? asset('assets/image/produk/' . $m->gambar_dalam) : '';
              @endphp
              <button type="button" 
                      class="dot {{ $loop->first ? 'on' : '' }}" 
                      style="background: {{ $warnaBg }};" 
                      data-id="{{ $m->motif_id }}" 
                      data-nama="{{ $m->nama_motif }}"
                      data-depan="{{ $fDepan }}"
                      data-kanan="{{ $fKanan }}"
                      data-dalam="{{ $fDalam }}"
                      title="{{ $m->nama_motif }}"
                      aria-label="{{ $m->nama_motif }}">
              </button>
            @endforeach
          </div>

          <div class="lbl qlbl">Kuantitas :</div>
          <div class="qty">
            <button type="button" id="minus-btn" aria-label="Kurangi">
              <svg width="20" height="20" viewBox="0 0 20 20" stroke="currentColor" stroke-width="1.3"><path d="M2 10h16"/></svg>
            </button>
            <span id="qty-val">1</span>
            <button type="button" id="plus-btn" aria-label="Tambah">
              <svg width="20" height="20" viewBox="0 0 20 20" stroke="currentColor" stroke-width="1.3"><path d="M10 2v16M2 10h16"/></svg>
            </button>
          </div>

          <div class="hr"></div>

          <!-- Form Aksi: Beli Sekarang & Masukkan Keranjang -->
          <form id="product-action-form" method="POST" action="{{ route('keranjang.add', $produk->produk_id) }}">
            @csrf
            <input type="hidden" name="motif_id" id="input_motif_id" value="{{ $firstMotif->motif_id ?? '' }}">
            <input type="hidden" name="qty" id="input_qty" value="1">
            
            <div class="btns">
              <button type="button" class="buy" id="btn-beli-sekarang">Beli Sekarang</button>
              <button type="submit" class="cart" id="btn-keranjang">Masukkan Keranjang</button>
            </div>
          </form>

          <div class="sec s1">
            <h2>Deskripsi Produk</h2>
            <p>{{ $produk->deskripsi_produk ?: 'Tas Sasirangan eksklusif dari Rabita dengan sentuhan motif etnik khas Banjar bernilai seni tinggi, dipadukan dengan material pilihan yang nyaman dan fungsional untuk kegiatan sehari-hari.' }}</p>
          </div>

          <div class="sec s2">
            <h2>Ukuran</h2>
            <p>{{ $produk->ukuran ?: 'Standar' }}</p>
          </div>

          <div class="sec s3">
            <h2>Material</h2>
            <p>{{ $produk->material ?: 'Kain Sasirangan Premium' }}</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Section Check Produk Lainnya (Maksimal 4 Produk Acak) -->
  <section class="more">
    <div class="wrap">
      <h2>Check Produk Lainnya</h2>
      <div class="grid">
        @forelse($produkLainnya as $lain)
          @php
            $lainImg = $lain->motif->first()?->gambar_depan;
          @endphp
          <a href="{{ route('detail', $lain->produk_id) }}" class="card">
            <div class="card-thumb">
              @if($lainImg && file_exists(public_path('assets/image/produk/' . $lainImg)))
                <img src="{{ asset('assets/image/produk/' . $lainImg) }}" alt="{{ $lain->nama_produk }}">
              @else
                <div style="display:flex;align-items:center;justify-content:center;height:100%;color:#888;">
                  <span>Rabita</span>
                </div>
              @endif
            </div>
            <h3>{{ $lain->nama_produk }}</h3>
            <div class="cp">Rp {{ number_format($lain->harga, 0, ',', '.') }}</div>
            <div class="dots">
              @foreach($lain->motif->take(3) as $m)
                <span class="dot" style="background:#888;" title="{{ $m->nama_motif }}"></span>
              @endforeach
            </div>
          </a>
        @empty
          <p style="text-align:center;grid-column:1/-1;color:#888;">Tidak ada produk lainnya.</p>
        @endforelse
      </div>
    </div>
  </section>
</main>
<x-footer />

<script>
document.addEventListener('DOMContentLoaded', function() {
  var dotsContainer = document.getElementById('motif-dots');
  var mnText = document.getElementById('mn');
  var inputMotif = document.getElementById('input_motif_id');
  var inputQty = document.getElementById('input_qty');
  var qtyVal = document.getElementById('qty-val');
  var plusBtn = document.getElementById('plus-btn');
  var minusBtn = document.getElementById('minus-btn');
  var btnBeli = document.getElementById('btn-beli-sekarang');
  var mainImg = document.getElementById('main-img');
  var currentQty = 1;

  // Ubah Kuantitas
  plusBtn.addEventListener('click', function() {
    currentQty++;
    qtyVal.textContent = currentQty;
    inputQty.value = currentQty;
  });

  minusBtn.addEventListener('click', function() {
    if (currentQty > 1) {
      currentQty--;
      qtyVal.textContent = currentQty;
      inputQty.value = currentQty;
    }
  });

  // Ganti Motif
  if (dotsContainer) {
    dotsContainer.addEventListener('click', function(e) {
      var dot = e.target.closest('.dot');
      if (!dot) return;
      dotsContainer.querySelectorAll('.dot').forEach(function(d) { d.classList.remove('on'); });
      dot.classList.add('on');
      
      var nama = dot.getAttribute('data-nama');
      var id = dot.getAttribute('data-id');
      var depan = dot.getAttribute('data-depan');
      
      if (mnText) mnText.textContent = nama;
      if (inputMotif) inputMotif.value = id;
      if (mainImg && depan) {
        mainImg.src = depan;
      }
    });
  }

  // Tombol "Beli Sekarang" Langsung Mengarahkan ke Checkout
  if (btnBeli) {
    btnBeli.addEventListener('click', function() {
      var motifId = inputMotif.value;
      var q = inputQty.value;
      var checkoutUrl = "{{ route('checkout') }}" + "?buy_now=1&motif_id=" + encodeURIComponent(motifId) + "&qty=" + encodeURIComponent(q);
      window.location.href = checkoutUrl;
    });
  }
});

function switchPhoto(el) {
  var clickedImg = el.querySelector('img');
  var main = document.getElementById('main-img');
  if (clickedImg && main) {
    var temp = main.src;
    main.src = clickedImg.src;
    clickedImg.src = temp;
  }
}
</script>
</body>
</html>
