<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StokBarangController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\MenuCustController;
use App\Http\controllers\PenjualanController;

// Rute untuk halaman utama (Landing Page)
Route::get('/', function () {
    return view('welcome');
});

// --- RUTE LOGIN & LOGOUT ---
Route::get('/login', [AdminController::class, 'index']);
Route::post('/login', [AdminController::class, 'authenticate']);
Route::get('/logout', [AdminController::class, 'logout']);


// --- RUTE DASHBOARD (Diupdate) ---
Route::get('/dashboard-admin', function () {
    // Cek apakah admin sudah login (session admin_id ada isinya)
    if (!session()->has('admin_id')) {
        return redirect('/login')->with('error', 'Silakan login terlebih dahulu!');
    }

    // Mengambil nama user langsung dari Session
    return view('dashboard_admin', [
        'nama_admin' => session('nama_user') 
    ]);
});

Route::get('/stok-barang', [StokBarangController::class, 'index']);

// Rute untuk menampilkan form tambah menu
Route::get('/tambah-menu', [StokBarangController::class, 'create']);

// Rute untuk memproses pengiriman data dari form
Route::post('/tambah-menu', [StokBarangController::class, 'store']);

// Rute untuk menampilkan form edit (menerima parameter {id})
Route::get('/edit-menu/{id}', [StokBarangController::class, 'edit']);

// Rute untuk memproses pengiriman data update
Route::post('/edit-menu/{id}', [StokBarangController::class, 'update']);

// Rute untuk memproses penghapusan data
Route::get('/hapus-menu/{id}', [StokBarangController::class, 'destroy']);

// rute pesanan
Route::get('/pesanan', [PesananController::class, 'index']);
Route::get('/pesanan/selesai/{nama}/{meja}', [PesananController::class, 'selesai']);

//route menu
Route::get('/menu', [MenuCustController::class, 'index']);

// route data penjualan
Route::get('/data-penjualan', [PenjualanController::class, 'index']);
