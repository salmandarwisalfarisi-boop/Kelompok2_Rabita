@extends('layouts.user')

@section('head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>Tentang | Rabita</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600&family=Lato:wght@400;500&family=Playball&display=swap"
        rel="stylesheet">
    @vite(['resources/css/user/pages/tentang.css', 'resources/css/user/components.css'])
@endsection

@section('content')
    <main>
        <img src="{{ asset('images/tentangbanner.png') }}" alt="Tidak Ada Banner" class="imgbanner" />

        </section>

        <section class="story">
            <h2>Cerita Kami</h2>
            <div class="t">
                <p>Rabita merupakan brand lokal asal Banjarbaru, Kalimantan Selatan, yang berdiri sejak tahun 2017.
                    Berawal dari kecintaan terhadap budaya dan kerajinan lokal, Rabita hadir dengan membawa kain
                    Sasirangan sebagai salah satu warisan budaya khas Banjar yang memiliki keunikan motif, warna, dan
                    nilai tradisi.</p>
                <p>Melalui perpaduan kain Sasirangan dengan desain modern, Rabita mengembangkan berbagai produk tas yang
                    tidak hanya memiliki nilai estetika, tetapi juga mencerminkan identitas budaya lokal. Setiap produk
                    dirancang dengan memperhatikan kreativitas, pemilihan bahan, serta detail pengerjaan, sehingga
                    menghasilkan karya yang memiliki karakter dan keunikan tersendiri.</p>
                <p>Lebih dari sekadar menghadirkanZ produk, Rabita berupaya menjaga agar budaya Banjar tetap hidup dan
                    dikenal oleh masyarakat luas, termasuk generasi muda. Dengan terus berinovasi dan mengembangkan
                    kreativitas, Rabita ingin menjadikan warisan budaya lokal sebagai bagian dari gaya hidup modern
                    sekaligus memperkenalkan keindahan Sasirangan kepada lebih banyak orang.</p>
            </div>
        </section>

        <section class="philo">
            <h2>Filosofi Kami</h2>
            <div class="cols">
                <div class="col">
                    <svg width="46" height="46" viewBox="0 0 48 48" style="fill:var(--gold2);stroke:none">
                        <path
                            d="M24 3l4.2 10.1L38 8.6l-2.6 10.5L45.4 24l-10 4.9L38 39.4l-9.8-4.5L24 45l-4.2-10.1L10 39.4l2.6-10.5L2.6 24l10-4.9L10 8.6l9.8 4.5L24 3Z" />
                        <circle cx="24" cy="24" r="3.2" style="fill:var(--bg2)" />
                    </svg>
                    <h3>Budaya</h3>
                    <p>Mengubah motif tradisional menjadi produk dengan desain modern.</p>
                </div>
                <div class="col">
                    <svg width="40" height="46" viewBox="0 0 24 28" stroke-width="1.6" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path
                            d="M12 2a8 8 0 0 0-4.6 14.5c.9.7 1.4 1.6 1.4 2.7V21h6.4v-1.8c0-1.1.5-2 1.4-2.7A8 8 0 0 0 12 2Z" />
                        <path d="M9.5 24.5h5" />
                    </svg>
                    <h3>Kreativitas</h3>
                    <p>Menjaga identitas budaya Banjar melalui kain Sasirangan.</p>
                </div>
                <div class="col">
                    <svg width="46" height="42" viewBox="0 0 26 24" stroke-width="1.5" stroke-linejoin="round"
                        stroke-linecap="round">
                        <path d="M7 2h12l6 7-12 13L1 9l6-7Z" />
                        <path d="M1 9h24M9.5 9 13 22l3.5-13M7 2l2.5 7L13 2l3.5 7L19 2" />
                    </svg>
                    <h3>Kualitas</h3>
                    <p>Menghargai proses, keterampilan, dan detail dalam setiap karya.</p>
                </div>
            </div>
        </section>

        <section class="commit">
            <h2>Komitmen Kami</h2>
            <div class="tabs" role="tablist">
                <button role="tab" aria-selected="true" data-i="0">Manusia</button>
                <button role="tab" aria-selected="false" data-i="1">Bumi</button>
                <button role="tab" aria-selected="false" data-i="2">Keuntungan</button>
            </div>
            <p class="tab-body" id="body">Rabita percaya bahwa perkembangan sebuah usaha kreatif tidak hanya
                ditentukan oleh produk yang dihasilkan, tetapi juga oleh orang-orang dan keterampilan yang ada di
                baliknya. Melalui keterlibatan pengrajin lokal, kolaborasi, serta kegiatan pembelajaran pembuatan tas,
                Rabita ingin membuka kesempatan bagi masyarakat untuk mengembangkan kreativitas dan keterampilan yang
                bernilai. Dengan memperkenalkan teknik pembuatan tas, berbagi pengetahuan, dan mendukung potensi
                individu, Rabita berupaya menciptakan lingkungan yang mendorong kemandirian, pertumbuhan keterampilan,
                serta peluang ekonomi yang berkelanjutan bagi para pengrajin dan komunitas lokal.</p>
        </section>
    </main>
@endsection

@section('scripts')
    <script>
        (function() {
            var texts = [null,
                "Rabita percaya bahwa kelestarian bumi tidak hanya ditentukan oleh keindahan alam yang terlihat, tetapi juga oleh kesadaran dan tanggung jawab di balik setiap proses produksi. Melalui pemilihan material yang ramah lingkungan, kolaborasi dengan pengrajin lokal, serta edukasi gaya hidup berkelanjutan, Rabita ingin membuka kesempatan bagi masyarakat untuk ikut menjaga kelestarian alam. Dengan menerapkan prinsip minim limbah dalam pembuatan tas, berbagi pengetahuan tentang pengelolaan sumber daya, dan mendukung gerakan hijau, Rabita berupaya menciptakan ekosistem usaha yang mendorong keseimbangan alam, pengurangan jejak karbon, serta masa depan bumi yang lebih lestari bagi generasi mendatang.",
                "Rabita percaya bahwa pencapaian keuntungan jangka panjang tidak hanya ditentukan oleh tingginya angka penjualan, tetapi juga oleh nilai dan kepercayaan yang dibangun di baliknya. Melalui pengelolaan strategi yang tepat, kolaborasi dengan pengrajin lokal, serta inovasi produk tas yang relevan, Rabita ingin membuka kesempatan untuk meraih pertumbuhan finansial yang sehat dan kompetitif. Dengan mengoptimalkan efisiensi produksi, berbagi manfaat dengan pelanggan, dan mendukung kesejahteraan tim, Rabita berupaya menciptakan ekosistem usaha yang mendorong profitabilitas, stabilitas keuangan, serta keuntungan yang berkelanjutan bagi seluruh pemangku kepentingan dan komunitas di masa depan."
            ];
            var body = document.getElementById('body'),
                first = body.textContent;
            texts[0] = first;
            document.querySelectorAll('.tabs button').forEach(function(b) {
                b.addEventListener('click', function() {
                    document.querySelectorAll('.tabs button').forEach(function(x) {
                        x.setAttribute('aria-selected', 'false')
                    });
                    b.setAttribute('aria-selected', 'true');
                    body.textContent = texts[+b.dataset.i];
                });
            });
        })();
    </script>
@endsection
