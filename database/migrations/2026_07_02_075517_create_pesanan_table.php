<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id('id_pesanan');
            
            // Relasi ke transaksi dan menu
            $table->foreignId('id_transaksi')->constrained('transaksi', 'id_transaksi')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('id_menu')->constrained('menu', 'id_menu')->cascadeOnUpdate()->cascadeOnDelete();
            
            $table->integer('jumlah');
            $table->integer('harga_satuan');
            $table->string('status_pesanan', 50)->default('belum selesai');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};