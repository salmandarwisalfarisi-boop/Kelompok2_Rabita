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
            $table->foreignId('alamat_id')->constrained('tb_alamat', 'alamat_id')->cascadeOnDelete();
            $table->integer('total_harga');
            $table->string('kurir', 50);
            $table->string('layanan_kurir', 50);
            $table->integer('ongkir');
            $table->string('estimasi_tiba', 30)->nullable();
            $table->enum('metode_bayar', ['qris']);
            $table->enum('status_bayar', ['pending', 'berhasil', 'gagal'])->default('pending');
            $table->enum('status_pesanan', ['diproses', 'dikemas', 'dikirim', 'selesai', 'batal'])->default('diproses');
            $table->dateTime('tanggal_pesan');
            $table->dateTime('waktu_bayar')->nullable();
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
