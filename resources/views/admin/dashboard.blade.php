@extends('layouts.admin')

@section('head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Rabita - Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Lato:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    @vite(['resources/css/admin/pages/dashboard.css', 'resources/css/admin/components.css'])
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
                        <span class="user-name">{{ Auth::user()->username ?? (Auth::user()->name ?? 'Salman') }}</span>
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
                        <b>{{ Auth::user()->username ?? (Auth::user()->name ?? 'Salman') }}</b>
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
                            <span>Keluar</span>
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <main>
            <div class="welcome-section">
                <h1 class="welcome-title">Selamat Datang, {{ Auth::user()->username ?? (Auth::user()->name ?? 'Salman') }}
                </h1>
                <p class="welcome-subtitle">Semoga hari-hari produktif dan penuh semangat!</p>
            </div>

            <section class="stats-grid">
                <div class="stat-card">
                    <div class="stat-meta">
                        <div class="stat-label">Total Produk</div>
                        <div class="stat-value" id="stat-produk">{{ $totalProduk ?? 0 }}</div>
                    </div>
                    <div class="stat-icon">
                        <img src="{{ asset('images/package.svg') }}" alt="Total Produk">
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-meta">
                        <div class="stat-label">Total Pemesanan</div>
                        <div class="stat-value" id="stat-pesanan">{{ $totalPemesanan ?? 0 }}</div>
                    </div>
                    <div class="stat-icon">
                        <img src="{{ asset('images/shopping-cart.svg') }}" alt="Total Pemesanan">
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-meta">
                        <div class="stat-label">Pendapatan Hari Ini</div>
                        <div class="stat-value" id="stat-pendapatan">Rp
                            {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</div>
                    </div>
                    <div class="stat-icon">
                        <img src="{{ asset('images/dollar-sign.svg') }}" alt="Pendapatan">
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-meta">
                        <div class="stat-label">Total Pengguna</div>
                        <div class="stat-value" id="stat-pengguna">{{ $totalPengguna ?? 0 }}</div>
                    </div>
                    <div class="stat-icon">
                        <img src="{{ asset('images/users.svg') }}" alt="Total Pengguna">
                    </div>
                </div>
            </section>

            <section class="chart-card">
                <div class="chart-header">
                    <div class="chart-title">
                        <img src="{{ asset('assets/image/bi_bar-chart-fill (1).svg') }}" alt="Grafik Pendapatan"
                            width="18" height="18">
                        <span>Grafik Pendapatan</span>
                    </div>

                    <div class="select-wrapper">
                        <select id="chartRangeSelect" onchange="updateChart()" class="chart-range-select">
                            <option value="7">7 Hari Terakhir</option>
                            <option value="30">30 Hari Terakhir</option>
                        </select>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </div>
                </div>

                <div class="chart-container">
                    <div class="chart-inner">
                        <div class="chart-plot-wrap">
                            <div class="y-labels" id="chartYLabels">
                                <!-- Populated dynamically by JS -->
                            </div>
                            <div class="plot-area">
                                <div class="grid-line" style="top: 0;"></div>
                                <div class="grid-line" style="top: 25%;"></div>
                                <div class="grid-line" style="top: 50%;"></div>
                                <div class="grid-line" style="top: 75%;"></div>
                                <div class="grid-line" style="top: 100%; border-top-color: #D5D5D5;"></div>
                                <div class="bars-track" id="chartBarsTrack">
                                    <!-- Populated dynamically by JS -->
                                </div>
                            </div>
                        </div>

                        <div class="x-labels" id="chartXLabels">
                            <!-- Populated dynamically by JS -->
                        </div>
                    </div>
                </div>
            </section>

            <section class="bottom-grid">

                <div class="orders-card">
                    <div class="orders-header">
                        <div class="orders-title">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            <span>Pesanan Terbaru</span>
                        </div>
                        <a href="{{ route('pesanan.index') }}" class="view-all-link">Lihat Semua</a>
                    </div>

                    <div class="table-responsive">
                        <table class="orders-table">
                            <thead>
                                <tr>
                                    <th style="width: 23%;">Nama Pemesan</th>
                                    <th style="width: 25%;">Email Pemesan</th>
                                    <th style="width: 24%;">Produk</th>
                                    <th class="center" style="width: 15%;">Total</th>
                                    <th class="center" style="width: 13%;">Status</th>
                                </tr>
                            </thead>
                            <tbody id="ord">
                                @forelse($pesananTerbaru as $order)
                                    @php
                                        $firstItem = $order->details->first();
                                        $namaProduk = $firstItem && $firstItem->produk ? $firstItem->produk->nama_produk : 'Pesanan Rabita';
                                        $extraCount = $order->details->count() - 1;

                                        $status = strtolower($order->status_pesanan);
                                        $statusLabel = ucfirst($order->status_pesanan);
                                        $badgeClass = 'pending';
                                        if ($status === 'selesai') {
                                            $badgeClass = 'success';
                                        } elseif ($status === 'batal') {
                                            $badgeClass = 'cancelled';
                                        } elseif ($status === 'diproses') {
                                            $badgeClass = 'processing';
                                        }
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="order-name"
                                                title="{{ $order->user->username ?? ($order->user->name ?? 'Customer') }}">
                                                {{ $order->user->username ?? ($order->user->name ?? 'Customer') }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="order-email" title="{{ $order->user->email ?? '-' }}">
                                                {{ $order->user->email ?? '-' }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="order-product" title="{{ $namaProduk }}">
                                                {{ Str::limit($namaProduk, 16) }}
                                                @if ($extraCount > 0)
                                                    <span
                                                        style="color: #888888; font-size: 11px;">(+{{ $extraCount }})</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="order-total">
                                            Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                                        </td>
                                        <td style="text-align: center;">
                                            <span class="status-badge {{ $badgeClass }}">{{ $statusLabel }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5"
                                            style="text-align: center; padding: 40px 16px; color: #8A8A8A;">
                                            <div
                                                style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 8px;">
                                                <svg width="34" height="34" viewBox="0 0 24 24" fill="none"
                                                    stroke="#CCCCCC" stroke-width="1.6" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                    <polyline points="12 6 12 12 16 14"></polyline>
                                                </svg>
                                                <span style="font-size: 13.5px; font-weight: 500; color: #555555;">Belum
                                                    ada pesanan terbaru</span>
                                                <span style="font-size: 11.5px; color: #9A9A9A;">Pesanan yang masuk akan
                                                    otomatis ditampilkan di sini.</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="products-card">
                    <div class="products-header">
                        <svg viewBox="0 0 24 24" stroke-width="1">
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                            </polygon>
                        </svg>
                        <span>Produk Terlaris</span>
                    </div>

                    <ul class="products-list" id="pp">
                        @forelse($produkTerlaris as $item)
                            @php
                                $nama = $item->produk->nama_produk ?? 'Produk Rabita';
                                $terjual = $item->total_terjual ?? 0;
                                $gambar = $item->produk->gambar_produk ?? null;
                                $fotoPath = $gambar ? public_path('assets/image/produk/' . $gambar) : null;
                                $fotoUrl = $fotoPath && file_exists($fotoPath) ? asset('assets/image/produk/' . $gambar) : null;
                            @endphp
                            <li class="product-item">
                                <div class="product-left">
                                    <div class="product-thumb">
                                        @if ($fotoUrl)
                                            <img src="{{ $fotoUrl }}" alt="{{ $nama }}">
                                        @else
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                                <line x1="3" y1="6" x2="21" y2="6">
                                                </line>
                                                <path d="M16 10a4 4 0 0 1-8 0"></path>
                                            </svg>
                                        @endif
                                    </div>
                                    <span class="product-title" title="{{ $nama }}">{{ $nama }}</span>
                                </div>
                                <span class="product-sold">{{ $terjual }} terjual</span>
                            </li>
                        @empty
                            <li style="text-align: center; padding: 42px 16px; color: #8A8A8A; list-style: none;">
                                <div
                                    style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 8px;">
                                    <svg width="34" height="34" viewBox="0 0 24 24" fill="none"
                                        stroke="#CCCCCC" stroke-width="1.6" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                        <line x1="3" y1="6" x2="21" y2="6"></line>
                                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                                    </svg>
                                    <span style="font-size: 13.5px; font-weight: 500; color: #555555;">Belum ada data
                                        produk terjual</span>
                                    <span style="font-size: 11.5px; color: #9A9A9A;">Produk yang laris dipesan akan
                                        otomatis tampil di sini.</span>
                                </div>
                            </li>
                        @endforelse
                    </ul>
                </div>

            </section>
        </main>
    </div>

    <script>
        const $ = id => document.getElementById(id);

        const userBtn = $('userPillBtn');
        const userDropdown = $('userDropdown');
        const userChevron = $('userPillChevron');

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

        let currentChartData = {
            '7': {
                labels: {!! json_encode($chart7Labels ?? []) !!},
                values: {!! json_encode($chart7Values ?? []) !!}
            },
            '30': {
                labels: {!! json_encode($chart30Labels ?? []) !!},
                values: {!! json_encode($chart30Values ?? []) !!}
            }
        };

        function getSmartScale(maxVal) {
            if (maxVal <= 0) return {
                step: 50000,
                maxValue: 200000
            };

            const targetStep = maxVal / 4;
            const magnitude = Math.pow(10, Math.floor(Math.log10(targetStep)));
            const residual = targetStep / magnitude;

            let niceFactor;
            if (residual <= 1.2) niceFactor = 1;
            else if (residual <= 2.5) niceFactor = 2;
            else if (residual <= 5) niceFactor = 5;
            else niceFactor = 10;

            const step = Math.max(10000, Math.round(niceFactor * magnitude));
            const maxValue = step * 4;
            return {
                step,
                maxValue
            };
        }

        function renderChart(labels, values) {
            const maxVal = Math.max(...values, 0);
            const {
                step,
                maxValue
            } = getSmartScale(maxVal);

            const yContainer = $('chartYLabels');
            if (yContainer) {
                yContainer.innerHTML = `
                    <span style="top: 0;">Rp ${(maxValue).toLocaleString('id-ID')}</span>
                    <span style="top: 25%;">Rp ${(step * 3).toLocaleString('id-ID')}</span>
                    <span style="top: 50%;">Rp ${(step * 2).toLocaleString('id-ID')}</span>
                    <span style="top: 75%;">Rp ${(step * 1).toLocaleString('id-ID')}</span>
                    <span style="top: 100%;">Rp 0</span>
                `;
            }

            // Render bars and date labels
            const barsContainer = $('chartBarsTrack');
            const xContainer = $('chartXLabels');
            if (barsContainer && xContainer) {
                let barsHtml = '';
                let xHtml = '';
                const count = values.length;
                const barWidth = '56px';
                const fontSize = '14px';
                const plotArea = barsContainer.parentElement;
                plotArea.style.minWidth = (count * 56) + 'px';
                xContainer.style.minWidth = (count * 56) + 'px';

                values.forEach((val, i) => {
                    const heightPct = maxValue > 0 ? Math.min(100, Math.max(0, (val / maxValue) * 100)) : 0;
                    const label = labels[i] || '';
                    const formatted = 'Rp ' + val.toLocaleString('id-ID');

                    barsHtml += `
                        <div class="chart-bar" 
                             style="width: ${barWidth}; height: ${heightPct}%; min-height: ${val > 0 ? '4px' : '0'};" 
                             title="${label}: ${formatted}">
                        </div>
                    `;
                    xHtml += `<span style="width: ${barWidth}; font-size: ${fontSize};">${label}</span>`;
                });

                barsContainer.innerHTML = barsHtml;
                xContainer.innerHTML = xHtml;
            }
        }

        function updateChart() {
            const rangeSelect = $('chartRangeSelect');
            const range = rangeSelect ? rangeSelect.value : '7';
            const activeData = currentChartData[range] || currentChartData['7'];
            renderChart(activeData.labels, activeData.values);
        }

        updateChart();

        async function fetchRealtimeStats() {
            try {
                const response = await fetch('{{ route('dashboard.realtime') }}', {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                if (!response.ok) return;

                const res = await response.json();
                if (res.status === 'success') {
                    const s = res.stats;
                    if ($('stat-produk')) $('stat-produk').textContent = s.totalProduk;
                    if ($('stat-pesanan')) $('stat-pesanan').textContent = s.totalPemesanan;
                    if ($('stat-pendapatan')) $('stat-pendapatan').textContent = s.totalPendapatan;
                    if ($('stat-pengguna')) $('stat-pengguna').textContent = s.totalPengguna;

                    if (res.charts) {
                        currentChartData['7'] = res.charts.chart7;
                        currentChartData['30'] = res.charts.chart30;
                        updateChart();
                    }

                    if ($('ord')) {
                        if (!res.pesananTerbaru || res.pesananTerbaru.length === 0) {
                            $('ord').innerHTML = `
                                <tr>
                                    <td colspan="5" style="text-align: center; padding: 40px 16px; color: #8A8A8A;">
                                        <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 8px;">
                                            <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#CCCCCC" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <polyline points="12 6 12 12 16 14"></polyline>
                                            </svg>
                                            <span style="font-size: 13.5px; font-weight: 500; color: #555555;">Belum ada pesanan terbaru</span>
                                            <span style="font-size: 11.5px; color: #9A9A9A;">Pesanan yang masuk akan otomatis ditampilkan di sini.</span>
                                        </div>
                                    </td>
                                </tr>
                            `;
                        } else {
                            $('ord').innerHTML = res.pesananTerbaru.map(o => {
                                let badgeClass = 'pending';
                                const st = (o.status_label || '').toLowerCase();
                                if (st === 'selesai') badgeClass = 'success';
                                else if (st === 'batal') badgeClass = 'cancelled';
                                else if (st === 'diproses') badgeClass = 'processing';

                                return `
                                    <tr>
                                        <td><div class="order-name" title="${o.customer}">${o.customer}</div></td>
                                        <td><div class="order-email" title="${o.customer_email || '-'}">${o.customer_email || '-'}</div></td>
                                        <td>
                                            <div class="order-product" title="${o.nama_produk}">
                                                ${o.nama_produk_short}
                                                ${o.extra_count > 0 ? `<span style="color: #888888; font-size: 11px;">(+${o.extra_count})</span>` : ''}
                                            </div>
                                        </td>
                                        <td class="order-total">${o.total_harga}</td>
                                        <td style="text-align: center;">
                                            <span class="status-badge ${badgeClass}">${o.status_label}</span>
                                        </td>
                                    </tr>
                                `;
                            }).join('');
                        }
                    }

                    if ($('pp')) {
                        if (!res.produkTerlaris || res.produkTerlaris.length === 0) {
                            $('pp').innerHTML = `
                                <li style="text-align: center; padding: 42px 16px; color: #8A8A8A; list-style: none;">
                                    <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 8px;">
                                        <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#CCCCCC" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                            <line x1="3" y1="6" x2="21" y2="6"></line>
                                            <path d="M16 10a4 4 0 0 1-8 0"></path>
                                        </svg>
                                        <span style="font-size: 13.5px; font-weight: 500; color: #555555;">Belum ada data produk terjual</span>
                                        <span style="font-size: 11.5px; color: #9A9A9A;">Produk yang laris dipesan akan otomatis tampil di sini.</span>
                                    </div>
                                </li>
                            `;
                        } else {
                            $('pp').innerHTML = res.produkTerlaris.map(p => `
                                <li class="product-item">
                                    <div class="product-left">
                                        <div class="product-thumb">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="#B79361" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                                <path d="M16 10a4 4 0 0 1-8 0"></path>
                                            </svg>
                                        </div>
                                        <span class="product-title" title="${p.nama}">${p.nama}</span>
                                    </div>
                                    <span class="product-sold">${p.terjual} terjual</span>
                                </li>
                            `).join('');
                        }
                    }
                }
            } catch (e) {
                // Polling runs again on the next interval.
            }
        }

        setInterval(fetchRealtimeStats, 8000);

        // Reload when restoring the page from browser history cache.
        window.addEventListener('pageshow', function(event) {
            if (event.persisted || (window.performance && (window.performance.navigation.type === 2 || (window
                    .performance.getEntriesByType && window.performance.getEntriesByType("navigation")[0]
                    ?.type === "back_forward")))) {
                window.location.reload();
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.stat-value').forEach(function(el) {
                var txt = el.textContent.trim();
                var length = txt.replace(/[,.]/g, '').length;
                if (length > 5) {
                    el.classList.add('currency');
                }
            });
        });
    </script>
@endsection
