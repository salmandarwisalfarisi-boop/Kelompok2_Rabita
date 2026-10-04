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
        Schema::create('tb_produk', function (Blueprint $table) {
            $table->id('produk_id');
            $table->foreignId('kategori_id')->constrained('tb_kategori', 'kategori_id')->cascadeOnDelete();
            $table->string('nama_produk', 100);
            $table->string('gambar_produk', 255)->nullable();
            $table->string('gambar_kanan', 255)->nullable();
            $table->string('gambar_kiri', 255)->nullable();
            $table->string('gambar_dalam', 255)->nullable();
            $table->text('deskripsi_produk');
            $table->integer('harga');
            $table->integer('stok');
            $table->integer('berat_gram');
            $table->enum('status', ['aktif', 'sold_out', 'arsip'])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_produk');
    }
};
