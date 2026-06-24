<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriMenu extends Model
{
    // Kasih tau Laravel nama tabel aslinya
    protected $table = 'kategori_menu';
    
    // Kasih tau Laravel nama Primary Key aslinya
    protected $primaryKey = 'id_kategori';
    
    // Matikan timestamps karena tabel lama lu nggak punya kolom created_at/updated_at
    public $timestamps = false; 
}