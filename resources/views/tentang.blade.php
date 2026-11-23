<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>Tentang | Rabita</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600&family=Lato:wght@400;500&family=Playball&display=swap" rel="stylesheet">
<style>
:root{--nav:#1A1A1A;--foot:#1A1A1A;--gold:#C9A66B;--goldActive:#DEC096;--gold2:#B8935A;--bg1:#F5F5F0;--bg2:#F0EDE8;--ink:#111;--tx:#4A4A4A;--tx2:#44403C;--line:#1A1A1A;--ph:#55514B;--phtx:#D9D4CA;--ft:#CFCFCF;--fm:#7D7D7D;--navMenuInactive:#A5A29B;--navMenuActive:#DEC096;--navMenuActiveWeight:600;--loginBorder:#DEC096;--loginText:#B79361;}
box-sizing:border-box;padding-top:env(safe-area-inset-top,0px);padding-bottom:env(safe-area-inset-bottom,0px)}
html{background:var(--nav);scroll-padding-top:env(safe-area-inset-top,0px)}
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Plus Jakarta Sans',system-ui,sans-serif;background:var(--bg1);color:var(--tx)}
svg{display:block}
/* BANNER */
.banner{height:clamp(260px,51vw,740px);background:var(--ph);display:flex;flex-direction:column;align-items:center;justify-content:center;gap:12px;color:var(--phtx);text-align:center;padding:0}
.banner svg{stroke:var(--phtx);opacity:.8}
.banner p{font-size:16px}
/* SECTIONS */
h2{font-weight:500;font-size:29px;color:var(--ink);text-align:center;letter-spacing:-.2px}
.story{padding:60px 24px 90px}
.story .t{max-width:960px;margin:36px auto 0}
.story p,.commit .tab-body{font-weight:300;font-size:17.5px;line-height:1.5;text-align:center;color:var(--tx)}
.story p+p{margin-top:28px}
.philo{background:var(--bg2);padding:60px 0 80px}
.cols{display:grid;grid-template-columns:1fr 1fr 1fr;margin-top:40px;height:280px}
.col{display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;padding:0 clamp(24px,7vw,100px)}
.col+.col{border-left:1px solid var(--line)}
.col svg{stroke:var(--gold2);fill:none;margin-bottom:16px}
.col h3{font-weight:500;font-size:20px;color:var(--ink);margin-bottom:22px}
.col p{font-weight:300;font-size:17px;line-height:1.3;max-width:270px}
.commit{padding:60px 24px 100px}
.tabs{display:flex;justify-content:center;gap:52px;margin-top:24px}
.tabs button{background:none;border:0;font:400 16px 'Plus Jakarta Sans',sans-serif;color:var(--tx);padding-bottom:2px;cursor:pointer;border-bottom:1px solid transparent}
.tabs button[aria-selected="true"]{color:var(--ink);border-bottom-color:var(--ink)}
.tabs button:focus-visible{outline:2px solid var(--gold);outline-offset:4px}
.commit .tab-body{max-width:1020px;margin:60px auto 0;min-height:160px}
/* FOOTER */
footer{background:var(--foot);padding:132px 0 0;color:var(--ft)}
.fgrid{display:flex;padding-left:149px;min-height:180px}
.f1{width:558px}.f2{width:487px}
.f1 .logo{font-size:38px;display:block;margin-bottom:22px}
.f1 p{font-size:12px;line-height:1.35;max-width:300px}
footer h4{font-weight:500;font-size:13px;letter-spacing:.4px;color:#fff;text-transform:uppercase;margin-bottom:14px}
.f2 a{display:block;font-size:13px;color:#B9B6AF;text-decoration:none;margin-bottom:14px}
.soc{display:flex;align-items:center;gap:10px;font-size:13px;color:#B9B6AF;margin-bottom:12px}
.soc i{width:30px;height:30px;border:1px solid var(--gold);border-radius:50%;display:grid;place-items:center}
.soc svg{fill:var(--gold)}
.fbar{margin:60px 107px 0;border-top:1px solid #333;padding:14px 0 18px;text-align:center;font-size:12px;letter-spacing:2.2px;color:var(--fm)}
@media(max-width:900px){
nav{display:none}header{padding:0 20px}.login{padding:0 18px;margin-left:4px}
.cols{grid-template-columns:1fr;height:auto}.col{padding:36px 24px}.col+.col{border-left:0;border-top:1px solid var(--line)}
.fgrid{flex-direction:column;gap:32px;padding:0 24px}.f1,.f2{width:auto}footer{padding-top:64px}.fbar{margin:40px 24px 0}
h2{font-size:24px}.story p,.commit .tab-body{font-size:16px}.tabs{gap:28px}}
.imgbanner{
  width: 100%;
  height: 660px;
};
</style>
</head>
<body>

<x-navbar />

<main>
  <!-- GANTI DENGAN FOTO BANNER (tambahkan overlay gelap ±35%) -->
    <img src="{{ asset('images/tentangbanner.png') }}" alt="Tidak Ada Banner" class="imgbanner" />

  </section>

  <section class="story">
    <h2>Cerita Kami</h2>
    <div class="t">
      <p>Rabita merupakan brand lokal asal Banjarbaru, Kalimantan Selatan, yang berdiri sejak tahun 2017. Berawal dari kecintaan terhadap budaya dan kerajinan lokal, Rabita hadir dengan membawa kain Sasirangan sebagai salah satu warisan budaya khas Banjar yang memiliki keunikan motif, warna, dan nilai tradisi.</p>
      <p>Melalui perpaduan kain Sasirangan dengan desain modern, Rabita mengembangkan berbagai produk tas yang tidak hanya memiliki nilai estetika, tetapi juga mencerminkan identitas budaya lokal. Setiap produk dirancang dengan memperhatikan kreativitas, pemilihan bahan, serta detail pengerjaan, sehingga menghasilkan karya yang memiliki karakter dan keunikan tersendiri.</p>
      <p>Lebih dari sekadar menghadirkanZ produk, Rabita berupaya menjaga agar budaya Banjar tetap hidup dan dikenal oleh masyarakat luas, termasuk generasi muda. Dengan terus berinovasi dan mengembangkan kreativitas, Rabita ingin menjadikan warisan budaya lokal sebagai bagian dari gaya hidup modern sekaligus memperkenalkan keindahan Sasirangan kepada lebih banyak orang.</p>
    </div>
  </section>

  <section class="philo">
    <h2>Filosofi Kami</h2>
    <div class="cols">
      <div class="col">
        <svg width="46" height="46" viewBox="0 0 48 48" style="fill:var(--gold2);stroke:none"><path d="M24 3l4.2 10.1L38 8.6l-2.6 10.5L45.4 24l-10 4.9L38 39.4l-9.8-4.5L24 45l-4.2-10.1L10 39.4l2.6-10.5L2.6 24l10-4.9L10 8.6l9.8 4.5L24 3Z"/><circle cx="24" cy="24" r="3.2" style="fill:var(--bg2)"/></svg>
        <h3>Budaya</h3>
        <p>Mengubah motif tradisional menjadi produk dengan desain modern.</p>
      </div>
      <div class="col">
        <svg width="40" height="46" viewBox="0 0 24 28" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a8 8 0 0 0-4.6 14.5c.9.7 1.4 1.6 1.4 2.7V21h6.4v-1.8c0-1.1.5-2 1.4-2.7A8 8 0 0 0 12 2Z"/><path d="M9.5 24.5h5"/></svg>
        <h3>Kreativitas</h3>
        <p>Menjaga identitas budaya Banjar melalui kain Sasirangan.</p>
      </div>
      <div class="col">
        <svg width="46" height="42" viewBox="0 0 26 24" stroke-width="1.5" stroke-linejoin="round" stroke-linecap="round"><path d="M7 2h12l6 7-12 13L1 9l6-7Z"/><path d="M1 9h24M9.5 9 13 22l3.5-13M7 2l2.5 7L13 2l3.5 7L19 2"/></svg>
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
    <p class="tab-body" id="body">Rabita percaya bahwa perkembangan sebuah usaha kreatif tidak hanya ditentukan oleh produk yang dihasilkan, tetapi juga oleh orang-orang dan keterampilan yang ada di baliknya. Melalui keterlibatan pengrajin lokal, kolaborasi, serta kegiatan pembelajaran pembuatan tas, Rabita ingin membuka kesempatan bagi masyarakat untuk mengembangkan kreativitas dan keterampilan yang bernilai. Dengan memperkenalkan teknik pembuatan tas, berbagi pengetahuan, dan mendukung potensi individu, Rabita berupaya menciptakan lingkungan yang mendorong kemandirian, pertumbuhan keterampilan, serta peluang ekonomi yang berkelanjutan bagi para pengrajin dan komunitas lokal.</p>
  </section>
</main>

<x-footer />

<script>
(function(){
  var texts=[null,"Rabita percaya bahwa kelestarian bumi tidak hanya ditentukan oleh keindahan alam yang terlihat, tetapi juga oleh kesadaran dan tanggung jawab di balik setiap proses produksi. Melalui pemilihan material yang ramah lingkungan, kolaborasi dengan pengrajin lokal, serta edukasi gaya hidup berkelanjutan, Rabita ingin membuka kesempatan bagi masyarakat untuk ikut menjaga kelestarian alam. Dengan menerapkan prinsip minim limbah dalam pembuatan tas, berbagi pengetahuan tentang pengelolaan sumber daya, dan mendukung gerakan hijau, Rabita berupaya menciptakan ekosistem usaha yang mendorong keseimbangan alam, pengurangan jejak karbon, serta masa depan bumi yang lebih lestari bagi generasi mendatang.","Rabita percaya bahwa pencapaian keuntungan jangka panjang tidak hanya ditentukan oleh tingginya angka penjualan, tetapi juga oleh nilai dan kepercayaan yang dibangun di baliknya. Melalui pengelolaan strategi yang tepat, kolaborasi dengan pengrajin lokal, serta inovasi produk tas yang relevan, Rabita ingin membuka kesempatan untuk meraih pertumbuhan finansial yang sehat dan kompetitif. Dengan mengoptimalkan efisiensi produksi, berbagi manfaat dengan pelanggan, dan mendukung kesejahteraan tim, Rabita berupaya menciptakan ekosistem usaha yang mendorong profitabilitas, stabilitas keuangan, serta keuntungan yang berkelanjutan bagi seluruh pemangku kepentingan dan komunitas di masa depan."];
  var body=document.getElementById('body'),first=body.textContent;
  texts[0]=first;
  document.querySelectorAll('.tabs button').forEach(function(b){
    b.addEventListener('click',function(){
      document.querySelectorAll('.tabs button').forEach(function(x){x.setAttribute('aria-selected','false')});
      b.setAttribute('aria-selected','true');
      body.textContent=texts[+b.dataset.i];
    });
  });
})();
</script>
</body>
</html>
