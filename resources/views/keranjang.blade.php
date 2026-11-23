<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>Keranjang Belanja | Rabita</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600&family=Lato:wght@400;500&family=Playball&display=swap" rel="stylesheet">
<style>
:root{--nav:#151515;--foot:#1A1A1A;--gold:#C9A66B;--bg1:#F5F4EF;--ink:#111;--tx:#666;--line:#555;--ph:#E4E0D8;--ft:#CFCFCF;--fm:#7D7D7D;box-sizing:border-box;padding-top:env(safe-area-inset-top,0px);padding-bottom:env(safe-area-inset-bottom,0px)}
html{background:var(--nav);scroll-padding-top:env(safe-area-inset-top,0px)}
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Plus Jakarta Sans',system-ui,sans-serif;background:var(--bg1);color:var(--tx)}
svg{display:block}
button{font-family:inherit;cursor:pointer}
button:focus-visible,input:focus-visible{outline:2px solid var(--gold);outline-offset:3px}

/* KERANJANG */
.cart{padding:46px 20px 41px}
h1{text-align:center;font-weight:500;font-size:29px;color:var(--ink);letter-spacing:-.2px;line-height:34px}
.box{max-width:1084px;margin:68px auto 0}
@media(min-width:1200px){.box{margin-left:calc(50% - 566px);margin-right:0}}
.tr{display:grid;grid-template-columns:40px 1fr;align-items:start}
.c{display:grid;grid-template-columns:366fr 166fr 378fr 132fr}
.hd .c{border-bottom:1px solid var(--line);height:29px;align-items:start}
.hd .c span{font-size:16px;line-height:24px;color:var(--tx);text-align:center}
.hd .c span:first-child{text-align:left}
.hd .c span:last-child{text-align:right;padding-right:10px}
input[type=checkbox]{appearance:none;-webkit-appearance:none;width:18px;height:18px;border:1px solid var(--line);border-radius:2px;background:transparent;cursor:pointer;margin:0;display:block}
input[type=checkbox]:checked{background:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 18 18' fill='none' stroke='%23555' stroke-width='1.2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m4.5 9.5 3 3 6-7'/%3E%3C/svg%3E") center/100% no-repeat}
.hd input{margin-top:3px}
.row{border-bottom:1px solid var(--line)}
.row .c{padding:32px 0 30px;min-height:229px}
.row>input{align-self:center}
.prod{display:flex;align-items:center;gap:28px;align-self:start}
.ph{width:162px;height:167px;flex:none;background:var(--ph);display:flex;flex-direction:column;align-items:center;justify-content:center;overflow:hidden;border-radius:4px}
.ph img{width:100%;height:100%;object-fit:cover}
.nm{width:160px}
.nm b{display:block;font-weight:500;font-size:16px;line-height:20px;color:var(--ink)}
.nm small{display:block;font-size:14px;color:#777;line-height:18px}
.nm .a{margin-top:8px}.nm .b{margin-top:6px}
.pr,.tt{font-weight:500;font-size:16px;color:var(--ink);text-align:center;line-height:20px;padding-top:69px}
.tt{text-align:right}
.qc{display:flex;flex-direction:column;align-items:center;padding-top:57px}
.qty{display:flex;align-items:center;justify-content:space-between;width:157px;height:47px;border:1px solid #666;padding:0 9px;color:var(--line)}
.qty button{background:none;border:0;width:24px;height:24px;display:grid;place-items:center;color:var(--line)}
.qty span{font-size:20px;font-weight:300;color:var(--line)}
.del{margin-top:17px;background:none;border:0;font-size:16px;color:var(--tx);text-decoration:underline;text-underline-offset:3px;line-height:20px;cursor:pointer}
.sum{width:260px;margin:30px 0 0 auto;text-align:right}
.sum .l{font-size:16px;line-height:22px;color:var(--tx)}
.sum .v{font-weight:500;font-size:22px;line-height:30px;color:var(--ink);margin-top:3px}
.co{margin-top:26px;width:212px;height:59px;border:1px solid var(--ink);border-radius:2px;background:var(--ink);font:500 18px 'Plus Jakarta Sans',sans-serif;color:#fff;display:inline-block;cursor:pointer;transition:all 0.2s}
.co:hover{background:#333}
.empty{padding:90px 0;text-align:center;font-size:16px;color:#8A8A8A;border-bottom:1px solid var(--line)}

@media(max-width:900px){
.hd .c{display:none}.hd{display:none}
.tr{grid-template-columns:28px 1fr}
.c{grid-template-columns:1fr 1fr;gap:16px 12px}.row .c{padding:20px 0;min-height:0}
.prod{grid-column:1/-1;gap:16px}.ph{width:110px;height:113px}
.pr,.tt,.qc{padding-top:0}.pr{text-align:left}.tt{text-align:right}
.pr::before{content:"Harga: ";font-weight:300}.tt::before{content:"Total: ";font-weight:300}
.qc{grid-column:1/-1;flex-direction:row;justify-content:space-between;align-items:center}.del{margin-top:0}
h1{font-size:24px}.box{margin-top:36px}}
</style>
</head>
<body>
<x-navbar />

<main class="cart">
  <h1>Keranjang Belanja</h1>

  @if(session('success'))
    <div style="max-width:1084px;margin:20px auto;padding:12px 20px;background:#E8F5E9;color:#2E7D32;border-radius:4px;font-size:14px;">
      {{ session('success') }}
    </div>
  @endif

  @if(session('error'))
    <div style="max-width:1084px;margin:20px auto;padding:12px 20px;background:#FFEBEE;color:#C62828;border-radius:4px;font-size:14px;">
      {{ session('error') }}
    </div>
  @endif

  <div class="box">
    <div class="tr hd">
      <input type="checkbox" id="check-all" aria-label="Pilih semua" checked>
      <div class="c"><span>Produk</span><span>Harga Satuan</span><span>Kuantitas</span><span>Total Harga</span></div>
    </div>

    <form id="checkout-form" method="GET" action="{{ route('checkout') }}">
      <div id="cart-rows">
        @forelse($items as $it)
          <div class="tr row" data-id="{{ $it['id'] }}" data-price="{{ $it['harga'] }}">
            <!-- Checkbox Select Produk untuk Checkout -->
            <input type="checkbox" class="sel-item" name="selected_ids[]" value="{{ $it['id'] }}" aria-label="Pilih produk" checked>
            
            <div class="c">
              <div class="prod">
                <div class="ph">
                  @if($it['gambar'] && file_exists(public_path('assets/image/produk/' . $it['gambar'])))
                    <img src="{{ asset('assets/image/produk/' . $it['gambar']) }}" alt="{{ $it['nama_produk'] }}">
                  @else
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#8F897E" stroke-width="1.4"><rect x="3" y="4" width="18" height="16" rx="2"/><circle cx="9" cy="10" r="1.6"/><path d="m21 16-5-5-8 8"/></svg>
                  @endif
                </div>
                <div class="nm">
                  <b>{{ $it['nama_produk'] }}</b>
                  <small class="a">{{ $it['kategori'] }}</small>
                  <small class="b">Motif: {{ $it['nama_motif'] }}</small>
                </div>
              </div>

              <div class="pr">Rp {{ number_format($it['harga'], 0, ',', '.') }}</div>

              <div class="qc">
                <div class="qty">
                  <button type="button" class="btn-qty" data-id="{{ $it['id'] }}" data-action="minus" aria-label="Kurangi">
                    <svg width="20" height="20" viewBox="0 0 20 20" stroke="currentColor" stroke-width="1.3"><path d="M2 10h16"/></svg>
                  </button>
                  <span class="qty-num" id="qty-{{ $it['id'] }}">{{ $it['qty'] }}</span>
                  <button type="button" class="btn-qty" data-id="{{ $it['id'] }}" data-action="plus" aria-label="Tambah">
                    <svg width="20" height="20" viewBox="0 0 20 20" stroke="currentColor" stroke-width="1.3"><path d="M10 2v16M2 10h16"/></svg>
                  </button>
                </div>
                
                <a href="{{ route('keranjang.destroy', $it['id']) }}" class="del" onclick="return confirm('Hapus produk ini dari keranjang?')">Hapus</a>
              </div>

              <div class="tt" id="subtotal-{{ $it['id'] }}">Rp {{ number_format($it['subtotal'], 0, ',', '.') }}</div>
            </div>
          </div>
        @empty
          <div class="empty">Keranjang belanja Anda masih kosong.</div>
        @endforelse
      </div>

      @if(count($items) > 0)
        <div class="sum">
          <div class="l" id="total-label">Total ({{ count($items) }} Produk):</div>
          <div class="v" id="total-val">Rp {{ number_format($total, 0, ',', '.') }}</div>
          <button type="submit" class="co" id="btn-checkout">Checkout</button>
        </div>
      @endif
    </form>
  </div>
</main>

<x-footer />

<script>
document.addEventListener('DOMContentLoaded', function() {
  var checkAll = document.getElementById('check-all');
  var selItems = document.querySelectorAll('.sel-item');
  var totalLabel = document.getElementById('total-label');
  var totalVal = document.getElementById('total-val');
  var btnCheckout = document.getElementById('btn-checkout');

  function recalculateTotal() {
    var count = 0;
    var grandTotal = 0;

    document.querySelectorAll('.row').forEach(function(row) {
      var cb = row.querySelector('.sel-item');
      if (cb && cb.checked) {
        var price = parseFloat(row.getAttribute('data-price')) || 0;
        var qty = parseInt(row.querySelector('.qty-num').textContent) || 1;
        grandTotal += (price * qty);
        count++;
      }
    });

    if (totalLabel) totalLabel.textContent = 'Total (' + count + ' Produk Dipilih):';
    if (totalVal) totalVal.textContent = 'Rp ' + grandTotal.toLocaleString('id-ID');
  }

  if (checkAll) {
    checkAll.addEventListener('change', function() {
      var isChecked = checkAll.checked;
      selItems.forEach(function(cb) {
        cb.checked = isChecked;
      });
      recalculateTotal();
    });
  }

  selItems.forEach(function(cb) {
    cb.addEventListener('change', function() {
      var allChecked = Array.from(selItems).every(function(c) { return c.checked; });
      if (checkAll) checkAll.checked = allChecked;
      recalculateTotal();
    });
  });

  // Tombol Plus/Minus Kuantitas
  document.querySelectorAll('.btn-qty').forEach(function(btn) {
    btn.addEventListener('click', function() {
      var id = btn.getAttribute('data-id');
      var action = btn.getAttribute('data-action');
      var row = btn.closest('.row');
      var qtySpan = row.querySelector('.qty-num');
      var currentQty = parseInt(qtySpan.textContent) || 1;

      if (action === 'plus') {
        currentQty++;
      } else if (action === 'minus' && currentQty > 1) {
        currentQty--;
      } else {
        return;
      }

      qtySpan.textContent = currentQty;
      var price = parseFloat(row.getAttribute('data-price')) || 0;
      var subtotal = price * currentQty;
      row.querySelector('.tt').textContent = 'Rp ' + subtotal.toLocaleString('id-ID');

      // Update di server via fetch
      fetch("{{ route('keranjang.update') }}", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ id: id, action: action })
      });

      recalculateTotal();
    });
  });

  // Validasi Checkout: Pastikan minimal 1 produk dipilih
  var checkoutForm = document.getElementById('checkout-form');
  if (checkoutForm) {
    checkoutForm.addEventListener('submit', function(e) {
      var checkedCount = document.querySelectorAll('.sel-item:checked').length;
      if (checkedCount === 0) {
        e.preventDefault();
        alert('Silakan pilih minimal 1 produk yang ingin di-checkout.');
      }
    });
  }
});
</script>
</body>
</html>
