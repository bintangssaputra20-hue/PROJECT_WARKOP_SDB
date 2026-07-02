<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StokBarangController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\MenuCustController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\CheckoutController;

// Rute untuk halaman utama
Route::get('/', function () {
    return view('welcome');
});

// --- RUTE LOGIN & LOGOUT ---
Route::get('/login', [AdminController::class, 'index']);
Route::post('/login', [AdminController::class, 'authenticate']);
Route::get('/logout', [AdminController::class, 'logout']);

// --- RUTE DASHBOARD ---
Route::get('/dashboard-admin', function () {
    if (!session()->has('admin_id')) {
        return redirect('/login')->with('error', 'Silakan login terlebih dahulu!');
    }
    return view('dashboard_admin', [
        'nama_admin' => session('nama_user') 
    ]);
});

// --- RUTE STOK BARANG ---
Route::get('/stok-barang', [StokBarangController::class, 'index']);
Route::get('/tambah-menu', [StokBarangController::class, 'create']);
Route::post('/tambah-menu', [StokBarangController::class, 'store']);
Route::get('/edit-menu/{id}', [StokBarangController::class, 'edit']);
Route::post('/edit-menu/{id}', [StokBarangController::class, 'update']);
Route::get('/hapus-menu/{id}', [StokBarangController::class, 'destroy']);

// --- RUTE PESANAN ---
Route::get('/pesanan', [PesananController::class, 'index']);
Route::get('/pesanan/selesai/{id_transaksi}', [PesananController::class, 'selesai']);

// --- RUTE MENU CUSTOMER ---
Route::get('/menu', [MenuCustController::class, 'index']);

// --- RUTE DATA PENJUALAN ---
Route::get('/data-penjualan', [PenjualanController::class, 'index']);


// Kalau lu butuh halaman checkout, pake GET. Kalau buat proses bayar, pake POST.
Route::get('/checkout', [CheckoutController::class, 'index']); 
Route::post('/checkout', [CheckoutController::class, 'store']); // Ganti dari /checkout/proses jadi /checkout
Route::get('/halaman-struk', [CheckoutController::class, 'struk']);