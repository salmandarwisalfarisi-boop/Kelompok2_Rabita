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
            $table->string('nama_produk', 150);
            $table->string('slug', 150)->unique();
            $table->text('deskripsi_produk');
            $table->integer('harga');
            $table->integer('berat_gram');
            $table->string('ukuran', 50);
            $table->string('material', 100);
            $table->enum('status', ['aktif', 'sold_out', 'arsip'])->default('aktif');
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
