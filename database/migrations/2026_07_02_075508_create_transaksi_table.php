<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->string('no_meja', 10)->nullable();
            $table->timestamp('tanggal_pesan')->useCurrent();
            $table->enum('metode_bayar', ['Tunai', 'Debit', 'QRIS']);
            $table->integer('total_harga');
            $table->enum('status_transaksi', ['Pending', 'Lunas', 'Batal'])->default('Pending');
            $table->string('nama_user', 100)->nullable();
            $table->decimal('subtotal', 10, 2)->nullable();
            $table->decimal('ppn', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};