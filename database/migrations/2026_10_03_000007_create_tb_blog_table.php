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
        Schema::create('tb_blog', function (Blueprint $table) {
            $table->id('blog_id');
            $table->string('judul', 200);
            $table->string('slug', 200)->unique();
            $table->longText('isi');
            $table->string('thumbnail', 255);
            $table->boolean('status_blog')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_blog');
    }
};
