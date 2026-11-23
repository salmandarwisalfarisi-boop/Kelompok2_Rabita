<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_pemesanan', function (Blueprint $table) {
            $table->id('pemesanan_id');
            $table->foreignId('user_id')->constrained('tb_user', 'user_id')->cascadeOnDelete();
            $table->string('nama_penerima', 100);
            $table->string('no_hp_penerima', 20);
            $table->string('provinsi', 100);
            $table->string('kota', 100);
            $table->string('kecamatan', 100);
            $table->text('alamat_lengkap');
            $table->string('kode_pos', 10);
            $table->string('kurir', 50);
            $table->string('layanan_kurir', 50);
            $table->integer('ongkir');
            $table->string('estimasi_tiba', 30)->nullable();
            $table->integer('total_harga');
            $table->string('bukti_bayar', 255)->nullable();
            $table->dateTime('waktu_bayar')->nullable();
            $table->enum('status_pesanan', ['menunggu', 'diproses', 'dikirim', 'selesai', 'dibatalkan'])->default('menunggu');
            $table->string('no_resi', 100)->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_pemesanan');
    }
};
