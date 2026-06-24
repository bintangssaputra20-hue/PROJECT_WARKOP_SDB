<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuCust; // Panggil model yang baru di-rename

class MenuCustController extends Controller
{
    public function index()
    {
        // Gunakan MenuCust untuk query
        $data_menu = MenuCust::join('kategori_menu', 'menu.id_kategori', '=', 'kategori_menu.id_kategori')
            ->select('menu.*', 'kategori_menu.nama_kategori')
            ->get();

        $json_menu = json_encode($data_menu);

        // Arahkan ke view menu_cust.blade.php
        return view('menu_cust', compact('json_menu'));
    }
}