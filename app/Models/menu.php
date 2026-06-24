<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    protected $primaryKey = 'id_menu';
    public $timestamps = false;

    // $fillable ini wajib ada untuk mengatur kolom mana saja yang boleh diisi secara massal (Mass Assignment) saat fitur Tambah/Edit berjalan[cite: 236, 237].
    protected $fillable = [
        'id_kategori', 
        'nama_menu', 
        'harga', 
        'stok'
    ];
}