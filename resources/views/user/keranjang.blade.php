@extends('layouts.user')

@section('head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>Keranjang Belanja | Rabita</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600&family=Lato:wght@400;500&family=Playball&display=swap"
        rel="stylesheet">
    @vite(['resources/css/user/pages/keranjang.css', 'resources/css/user/components.css'])
@endsection

@section('content')
    <main class="cart">
        <h1>Keranjang Belanja</h1>

        @if (session('success'))
            <div
                style="max-width:1084px;margin:20px auto;padding:12px 20px;background:#E8F5E9;color:#2E7D32;border-radius:4px;font-size:14px;">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div
                style="max-width:1084px;margin:20px auto;padding:12px 20px;background:#FFEBEE;color:#C62828;border-radius:4px;font-size:14px;">
                {{ session('error') }}
            </div>
        @endif

        <div class="box">
            <div class="tr hd">
                <input type="checkbox" id="check-all" aria-label="Pilih semua" checked>
                <div class="c"><span>Produk</span><span>Harga Satuan</span><span>Kuantitas</span><span>Total
                        Harga</span></div>
            </div>

            <form id="checkout-form" method="GET" action="{{ route('checkout') }}">
                <div id="cart-rows">
                    @forelse($items as $it)
                        <div class="tr row" data-id="{{ $it['id'] }}" data-price="{{ $it['harga'] }}">
                            <input type="checkbox" class="sel-item" name="selected_ids[]" value="{{ $it['id'] }}"
                                aria-label="Pilih produk" checked>

                            <div class="c">
                                <div class="prod">
                                    <div class="ph">
                                        @if ($it['gambar'] && file_exists(public_path('assets/image/produk/' . $it['gambar'])))
                                            <img src="{{ asset('assets/image/produk/' . $it['gambar']) }}"
                                                alt="{{ $it['nama_produk'] }}">
                                        @else
                                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none"
                                                stroke="#8F897E" stroke-width="1.4">
                                                <rect x="3" y="4" width="18" height="16" rx="2" />
                                                <circle cx="9" cy="10" r="1.6" />
                                                <path d="m21 16-5-5-8 8" />
                                            </svg>
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
                                        <button type="button" class="btn-qty" data-id="{{ $it['id'] }}"
                                            data-action="minus" aria-label="Kurangi">
                                            <svg width="20" height="20" viewBox="0 0 20 20" stroke="currentColor"
                                                stroke-width="1.3">
                                                <path d="M2 10h16" />
                                            </svg>
                                        </button>
                                        <span class="qty-num" id="qty-{{ $it['id'] }}">{{ $it['qty'] }}</span>
                                        <button type="button" class="btn-qty" data-id="{{ $it['id'] }}"
                                            data-action="plus" aria-label="Tambah">
                                            <svg width="20" height="20" viewBox="0 0 20 20" stroke="currentColor"
                                                stroke-width="1.3">
                                                <path d="M10 2v16M2 10h16" />
                                            </svg>
                                        </button>
                                    </div>

                                    <a href="{{ route('keranjang.destroy', $it['id']) }}" class="del"
                                        onclick="return confirm('Hapus produk ini dari keranjang?')">Hapus</a>
                                </div>

                                <div class="tt" id="subtotal-{{ $it['id'] }}">Rp
                                    {{ number_format($it['subtotal'], 0, ',', '.') }}</div>
                            </div>
                        </div>
                    @empty
                        <div class="empty">Keranjang belanja Anda masih kosong.</div>
                    @endforelse
                </div>

                @if (count($items) > 0)
                    <div class="sum">
                        <div class="l" id="total-label">Total ({{ count($items) }} Produk):</div>
                        <div class="v" id="total-val">Rp {{ number_format($total, 0, ',', '.') }}</div>
                        <button type="submit" class="co" id="btn-checkout">Checkout</button>
                    </div>
                @endif
            </form>
        </div>
    </main>
@endsection

@section('scripts')
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
                    var allChecked = Array.from(selItems).every(function(c) {
                        return c.checked;
                    });
                    if (checkAll) checkAll.checked = allChecked;
                    recalculateTotal();
                });
            });

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

                    fetch("{{ route('keranjang.update') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            id: id,
                            action: action
                        })
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
@endsection
