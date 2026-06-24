<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuCust extends Model
{
    // Tetap arahkan ke tabel 'menu' di database
    protected $table = 'menu';
    
    protected $primaryKey = 'id_menu'; 
    public $timestamps = false; 
    protected $fillable = ['id_kategori', 'nama_menu', 'deskripsi', 'harga', 'stok', 'rating'];
}