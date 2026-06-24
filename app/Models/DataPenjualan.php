<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataPenjualan extends Model
{
    // Tetap arahkan ke tabel transaksi di database
    protected $table = 'transaksi';
    
    protected $primaryKey = 'id_transaksi';
    public $timestamps = false;
}