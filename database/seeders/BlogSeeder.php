<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use RuntimeException;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $blogs = [
            [
                'judul' => 'Kreativisia Indonesia 2024',
                'thumbnail' => 'KreativisiaIndonesia.png',
                'isi' => <<<'CONTENT'
Kreativesia (Pekan Kreativitas Pemuda Indonesia) 2024 resmi berakhir, namun euforia dan kebanggaan masih sangat terasa bagi seluruh tim Rabita. Sebagai ajang tahunan bergengsi yang diinisiasi oleh Kemenpora RI, perhelatan ini menjadi magnet bagi inovasi, seni, dan budaya, dengan mempertemukan pemuda-pemudi inspiratif dari 38 provinsi di seluruh Indonesia. Pada edisi kali ini, Rabita mendapatkan kehormatan besar untuk ikut ambil bagian sebagai salah satu perwakilan ekshibisi kreatif dan UMKM unggulan dari Kalimantan Selatan.

Digelar pada 29 hingga 31 Agustus 2024, acara ini terasa sangat spesial bagi kami karena berlangsung tepat di rumah sendiri, yaitu di Kawasan Perkantoran Gubernur Kalimantan Selatan, Banjarbaru. Status Banjarbaru sebagai tuan rumah nasional menjadi momen emas bagi Rabita untuk unjuk gigi di panggung kandang. Kami memanfaatkan kesempatan berharga ini untuk memperkenalkan produk kebanggaan kami, yaitu koleksi tas estetik berbahan kain sasirangan dan sasirangan bordir premium, yang memadukan keanggunan budaya lokal dengan sentuhan mode modern yang relevan bagi generasi muda.

Selama tiga hari penuh, stan Bazaar & Fair Rabita ramai dikunjungi oleh para pegiat industri kreatif, masyarakat umum, hingga ratusan delegasi pemuda dari berbagai penjuru nusantara. Kami sangat bersyukur atas apresiasi luar biasa yang diberikan kepada karya-karya kami, yang sekaligus menjadi bahan bakar semangat bagi Rabita untuk terus berinovasi menjaga warisan wastra khas Banjar. Terima kasih kepada Kemenpora RI, Pemerintah Provinsi Kalsel, dan seluruh Sahabat Rabita yang telah mendukung langkah kami di ajang nasional ini—mari terus tumbuh dan berkarya bersama!
CONTENT,
            ],
            [
                'judul' => 'Pameran Dekranasda',
                'thumbnail' => 'PameranDekransdem.png',
                'isi' => <<<'CONTENT'
Pameran Dekranasda menjadi ruang yang mempertemukan karya para pelaku kerajinan dan usaha kreatif daerah. Bagi Rabita, kesempatan untuk hadir dalam suasana seperti ini terasa istimewa karena kami dapat memperkenalkan tas berbahan kain sasirangan kepada lebih banyak orang.

Setiap produk Rabita membawa warna dan motif yang terinspirasi dari kekayaan budaya Banjar. Kami ingin menunjukkan bahwa wastra lokal dapat hadir dalam bentuk yang dekat dengan keseharian, tanpa kehilangan karakter dan nilai yang membuatnya istimewa. Berbagai koleksi tas kami hadirkan agar pengunjung dapat melihat langsung detail bahan, pilihan motif, dan proses kreatif di baliknya.

Apresiasi dan percakapan hangat dengan pengunjung menjadi penyemangat bagi kami untuk terus berkarya. Terima kasih kepada Dekranasda dan semua Sahabat Rabita yang telah mendukung produk lokal. Semoga ruang pamer seperti ini terus membuka kesempatan bagi kerajinan daerah untuk dikenal dan berkembang.
CONTENT,
            ],
            [
                'judul' => 'Gemalindo Kreasi',
                'thumbnail' => 'GemalindoKreasi.png',
                'isi' => <<<'CONTENT'
Gemalindo Kreasi menjadi salah satu cerita tentang semangat berkarya dan memperkenalkan produk lokal. Rabita membawa koleksi tas berbahan kain sasirangan sebagai bentuk kecintaan kami pada wastra Banjar sekaligus upaya menghadirkan budaya daerah dalam gaya yang dapat digunakan sehari-hari.

Dalam setiap koleksi, kami memperhatikan perpaduan motif, warna, dan fungsi agar tas tetap nyaman menemani berbagai aktivitas. Kain sasirangan memberi karakter tersendiri pada setiap produk, sementara sentuhan desain yang lebih modern membuatnya mudah dipadukan dengan gaya masa kini.

Bagi Rabita, bertemu dengan para pencinta produk kreatif adalah kesempatan untuk saling berbagi inspirasi. Dukungan terhadap karya lokal membantu kami terus belajar, berinovasi, dan menjaga agar sasirangan tetap mendapat tempat di hati generasi berikutnya. Terima kasih telah menjadi bagian dari perjalanan Rabita.
CONTENT,
            ],
            [
                'judul' => 'Kreasi Karya Nusa Tenggara',
                'thumbnail' => 'Kreasi Karya NusaTenggara.jpg',
                'isi' => <<<'CONTENT'
Di sudut pameran bertajuk Sepiring Indonesia, beragam karya dan kain dari Nusa Tenggara terlihat berdampingan dengan produk kreatif dari daerah lain. Suasana ini mengingatkan kami bahwa setiap wilayah memiliki warna, motif, dan cerita yang membuat kekayaan budaya Indonesia begitu beragam.

Bagi Rabita, melihat karya dari berbagai daerah menjadi kesempatan untuk saling mengenal dan bertukar inspirasi. Kami juga membawa tas berbahan kain sasirangan sebagai cara memperkenalkan wastra Banjar dalam bentuk yang dekat dengan kegiatan sehari-hari.

Perjumpaan dengan berbagai karya lokal semakin menguatkan semangat kami untuk terus menjaga identitas budaya melalui produk kreatif. Semoga semakin banyak orang mengenal dan mencintai karya dari berbagai penjuru Nusantara.
CONTENT,
            ],
        ];

        foreach ($blogs as $data) {
            $sourcePath = database_path('seeders/images/blog/' . $data['thumbnail']);
            $destinationDirectory = public_path('assets/image/blog');
            $destinationPath = $destinationDirectory . DIRECTORY_SEPARATOR . $data['thumbnail'];

            if (!File::exists($sourcePath)) {
                throw new RuntimeException("Foto seed blog tidak ditemukan: {$sourcePath}");
            }

            File::ensureDirectoryExists($destinationDirectory);
            if (!File::copy($sourcePath, $destinationPath)) {
                throw new RuntimeException("Gagal menyalin foto blog: {$sourcePath}");
            }

            $slug = Str::slug($data['judul']);
            Blog::updateOrCreate(
                ['slug' => $slug],
                [
                    'judul' => $data['judul'],
                    'isi' => $data['isi'],
                    'thumbnail' => $data['thumbnail'],
                    'status_blog' => true,
                ]
            );
        }
    }
}
