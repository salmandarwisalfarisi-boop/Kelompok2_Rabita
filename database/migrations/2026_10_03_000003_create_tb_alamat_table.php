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
        Schema::create('tb_alamat', function (Blueprint $table) {
            $table->id('alamat_id');
            $table->foreignId('user_id')->constrained('tb_user', 'user_id')->cascadeOnDelete();
            $table->string('label_alamat', 30);
            $table->string('nama_penerima', 100);
            $table->string('no_hp_penerima', 15);
            $table->string('alamat_lengkap', 254);
            $table->string('catatan_kurir', 125)->nullable();
            $table->string('area_wilayah', 150);
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->boolean('alamat_utama')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_alamat');
    }
};
