<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StokBarangController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\MenuCustController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\CheckoutController;

// --- RUTE UTAMA & LOGIN ---
Route::get('/', fn() => view('welcome'));
Route::get('/login', [AdminController::class, 'index']);
Route::post('/login', [AdminController::class, 'authenticate']);
Route::get('/logout', [AdminController::class, 'logout']);

// --- RUTE DASHBOARD ---
Route::get('/dashboard-admin', function () {
    if (!session()->has('admin_id')) return redirect('/login')->with('error', 'Login dulu!');
    return view('dashboard_admin', ['nama_admin' => session('nama_user')]);
});

// --- RUTE MENU & STOK (Admin) ---
Route::get('/stok-barang', [StokBarangController::class, 'index']);
Route::get('/tambah-menu', [StokBarangController::class, 'create']);
Route::post('/tambah-menu', [StokBarangController::class, 'store']);
Route::get('/edit-menu/{id}', [StokBarangController::class, 'edit']);
Route::post('/edit-menu/{id}', [StokBarangController::class, 'update']);
Route::get('/hapus-menu/{id}', [StokBarangController::class, 'destroy']);

// --- RUTE PESANAN ---
Route::get('/pesanan', [PesananController::class, 'index']);
// Gw benerin parameternya supaya sama dengan Controller lu
Route::get('/pesanan/selesai/{id_transaksi}', [PesananController::class, 'selesai']);

// --- RUTE MENU CUSTOMER ---
Route::get('/menu', [MenuCustController::class, 'index']);

// --- RUTE PENJUALAN ---
Route::get('/data-penjualan', [PenjualanController::class, 'index']);

// Rute untuk NAMPILIN halaman checkout (dari menu_cust)
Route::get('/checkout', function () {
    return view('checkout'); // Pastikan nama file view lu 'checkout.blade.php'
});

// Rute untuk PROSES data pas tombol Konfirmasi di checkout diklik
Route::post('/checkout/proses', [CheckoutController::class, 'store']);

// Rute untuk NAMPILIN struk
Route::get('/halaman-struk', [CheckoutController::class, 'struk']);