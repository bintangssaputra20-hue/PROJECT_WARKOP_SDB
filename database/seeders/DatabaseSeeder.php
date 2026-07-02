<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Isi Kategori
        DB::table('kategori_menu')->insert([
            ['id_kategori' => 1, 'nama_kategori' => 'Makanan'],
            ['id_kategori' => 2, 'nama_kategori' => 'Minuman'],
            ['id_kategori' => 3, 'nama_kategori' => 'Cemilan'],
        ]);

        // 2. Isi Menu (id_kategori disesuaikan dengan di atas)
        DB::table('menu')->insert([
            ['id_kategori' => 2, 'nama_menu' => 'Kopi Hitam', 'harga' => 5000, 'stok' => 50, 'status' => 'aktif'],
            ['id_kategori' => 2, 'nama_menu' => 'Es Teh Manis', 'harga' => 4000, 'stok' => 100, 'status' => 'aktif'],
            ['id_kategori' => 1, 'nama_menu' => 'Nasi Goreng Warkop', 'harga' => 15000, 'stok' => 30, 'status' => 'aktif'],
            ['id_kategori' => 1, 'nama_menu' => 'Mie Instan Telur', 'harga' => 10000, 'stok' => 40, 'status' => 'aktif'],
            ['id_kategori' => 3, 'nama_menu' => 'Otak-otak Goreng', 'harga' => 8000, 'stok' => 25, 'status' => 'aktif'],
            ['id_kategori' => 3, 'nama_menu' => 'Kentang Goreng', 'harga' => 10000, 'stok' => 25, 'status' => 'aktif'],
        ]);
    }
}