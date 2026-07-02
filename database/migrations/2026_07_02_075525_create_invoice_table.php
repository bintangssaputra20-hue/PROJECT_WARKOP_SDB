<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoice', function (Blueprint $table) {
            $table->id('id_invoice');
            
            $table->foreignId('id_transaksi')->constrained('transaksi', 'id_transaksi')->cascadeOnUpdate()->cascadeOnDelete();
            
            $table->integer('total_bayar');
            $table->dateTime('waktu_cetak')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoice');
    }
};