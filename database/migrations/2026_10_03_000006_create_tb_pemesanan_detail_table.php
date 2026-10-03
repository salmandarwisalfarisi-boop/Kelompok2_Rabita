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
        Schema::create('tb_pemesanan_detail', function (Blueprint $table) {
            $table->id('detail_id');
            $table->foreignId('pemesanan_id')->constrained('tb_pemesanan', 'pemesanan_id')->cascadeOnDelete();
            $table->foreignId('produk_id')->constrained('tb_produk', 'produk_id')->cascadeOnDelete();
            $table->integer('jumlah');
            $table->integer('harga_satuan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_pemesanan_detail');
    }
};
