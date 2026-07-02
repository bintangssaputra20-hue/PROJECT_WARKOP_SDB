<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash; // WAJIB TAMBAH INI UNTUK BACA ENKRIPSI

class AdminController extends Controller
{
    // Menampilkan halaman form login
    public function index()
    {
        return view('login');
    }

    // Memproses data yang diketik di form login
    public function authenticate(Request $request)
    {
        // 1. Cari admin berdasarkan username-nya saja dulu
        $admin = DB::table('admin')
            ->where('username', $request->username)
            ->first();

        // 2. Jika username ketemu, cocokkan password inputan dengan password hash di database
        if ($admin && Hash::check($request->password, $admin->password)) {
            
            // Login Sukses: Simpan data ke Session Laravel
            Session::put('admin_id', $admin->id_admin);
            Session::put('username', $admin->username);
            Session::put('nama_user', $admin->nama_user);

            // Pindah ke halaman dashboard
            return redirect('/dashboard-admin');
            
        } else {
            // Jika gagal (username nggak ada ATAU password salah)
            return back()->with('error', 'Username atau Password salah!');
        }
    }

    // Memproses Logout
    public function logout()
    {
        Session::flush(); // Menghapus semua session
        return redirect('/login'); // Kembali ke halaman login
    }
}