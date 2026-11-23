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
        Schema::create('tb_motif', function (Blueprint $table) {
            $table->id('motif_id');
            $table->foreignId('produk_id')->constrained('tb_produk', 'produk_id')->cascadeOnDelete();
            $table->string('nama_motif', 100);
            $table->integer('stok')->default(0);
            $table->string('gambar_depan', 255);
            $table->string('gambar_kanan', 255)->nullable();
            $table->string('gambar_kiri', 255)->nullable();
            $table->string('gambar_dalam', 255)->nullable();
            $table->boolean('status_motif')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_motif');
    }
};
