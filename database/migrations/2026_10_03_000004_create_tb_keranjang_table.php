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
        Schema::create('tb_keranjang', function (Blueprint $table) {
            $table->id('keranjang_id');
            $table->foreignId('user_id')->constrained('tb_user', 'user_id')->cascadeOnDelete();
            $table->foreignId('motif_id')->constrained('tb_motif', 'motif_id')->cascadeOnDelete();
            $table->integer('jumlah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_keranjang');
    }
};
