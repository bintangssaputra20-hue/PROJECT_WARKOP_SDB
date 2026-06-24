<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// 1. Panggil kedua Model yang baru kamu buat!
use App\Models\Menu;
use App\Models\KategoriMenu;

class StokBarangController extends Controller
{
    // MENAMPILKAN DATA (READ)
    public function index()
    {
        // Menggunakan Model Menu untuk mengambil data
        $data_menu = Menu::join('kategori_menu', 'menu.id_kategori', '=', 'kategori_menu.id_kategori')
            ->select('menu.*', 'kategori_menu.nama_kategori')
            ->get();

        return view('stok_barang', compact('data_menu'));
    }

    // MENAMPILKAN FORM TAMBAH
    public function create()
    {
        // Menggunakan Model KategoriMenu (Jauh lebih singkat kan?)
        $kategori = KategoriMenu::all();

        return view('tambah_menu', compact('kategori'));
    }

    // MEMPROSES SIMPAN DATA (CREATE)
    public function store(Request $request)
    {
        $request->validate([
            'nama_menu'   => 'required',
            'id_kategori' => 'required',
            'stok'        => 'required|numeric',
            'harga'       => 'required|numeric',
        ]);

        // Menyimpan data menggunakan Model Menu
        Menu::create([
            'id_kategori' => $request->id_kategori,
            'nama_menu'   => $request->nama_menu,
            'harga'       => $request->harga,
            'stok'        => $request->stok,
        ]);

        return redirect('/stok-barang')->with('success', 'Menu berhasil ditambahkan!');
    }

    // MENAMPILKAN FORM EDIT
    public function edit($id)
    {
        // Mencari menu berdasarkan ID menggunakan Model Menu
        $menu = Menu::find($id);
        $kategori = KategoriMenu::all();

        return view('edit_menu', compact('menu', 'kategori'));
    }

    // MEMPROSES UPDATE DATA (UPDATE)
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_menu'   => 'required',
            'id_kategori' => 'required',
            'stok'        => 'required|numeric',
            'harga'       => 'required|numeric',
        ]);

        // Mengupdate data menggunakan Model Menu
        Menu::where('id_menu', $id)->update([
            'id_kategori' => $request->id_kategori,
            'nama_menu'   => $request->nama_menu,
            'harga'       => $request->harga,
            'stok'        => $request->stok,
        ]);

        return redirect('/stok-barang')->with('success', 'Menu berhasil diupdate!');
    }

    // MEMPROSES HAPUS DATA (DELETE)
    public function destroy($id)
    {
        // Menghapus data menggunakan Model Menu
        Menu::where('id_menu', $id)->delete();

        return redirect('/stok-barang')->with('success', 'Menu berhasil dihapus!');
    }
}