<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session; // Memanggil fitur Session Laravel

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
        // Mencari admin di database berdasarkan inputan form
        $admin = DB::table('admin')
            ->where('username', $request->username)
            ->where('password', $request->password)
            ->first();

        // Jika data admin ditemukan (Login Sukses)
        if ($admin) {
            
            // Simpan data ke Session Laravel
            Session::put('admin_id', $admin->id_admin);
            Session::put('username', $admin->username);
            Session::put('nama_user', $admin->nama_user);

            // Pindah ke halaman dashboard
            return redirect('/dashboard-admin');
            
        } else {
            // Jika gagal, kembalikan ke halaman login dengan membawa pesan error
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