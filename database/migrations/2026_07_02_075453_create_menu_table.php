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
        // GANTI DI SINI
        Schema::create('menu', function (Blueprint $table) {
            $table->id('id_menu');
            
            // Relasi ke tabel kategori_menu
            $table->foreignId('id_kategori')->constrained('kategori_menu', 'id_kategori')->cascadeOnUpdate()->cascadeOnDelete();
            
            $table->string('nama_menu', 100);
            $table->integer('harga');
            $table->integer('stok')->default(0);
            $table->decimal('rating', 3, 1)->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu');
    }
};