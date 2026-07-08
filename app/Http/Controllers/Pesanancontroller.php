<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    // 1. Fungsi untuk nampilin data berdasarkan tab yang diklik
    public function index(Request $request)
    {
        // Ambil status dari URL (kalau gak ada, default-nya 'belum selesai')
        $status = $request->query('status', 'belum selesai');

        $pesanan = DB::table('pesanan')
            ->join('transaksi', 'pesanan.id_transaksi', '=', 'transaksi.id_transaksi')
            ->join('menu', 'pesanan.id_menu', '=', 'menu.id_menu')
            ->select(
                'transaksi.id_transaksi',
                'transaksi.nama_user',
                'transaksi.no_meja',
                'pesanan.status_pesanan',
                // Gabungin menu jadi satu baris HTML
                DB::raw("GROUP_CONCAT(CONCAT(menu.nama_menu, ' (', pesanan.jumlah, ')') SEPARATOR '<br>') as list_menu"),
                DB::raw("SUM(pesanan.jumlah) as total_qty")
            )
            ->where('pesanan.status_pesanan', $status)
            ->groupBy('transaksi.id_transaksi', 'transaksi.nama_user', 'transaksi.no_meja', 'pesanan.status_pesanan')
            ->orderBy('transaksi.id_transaksi', 'desc')
            ->get();

        // Kirim variabel $pesanan dan $status ke View
        return view('pesanan', compact('pesanan', 'status'));
    }

    // 2. Fungsi ketika tombol hijau 'Selesai' di tabel diklik
    public function selesai($id_transaksi)
    {
        // Ubah status di database jadi 'selesai'
        DB::table('pesanan')
            ->where('id_transaksi', $id_transaksi)
            ->update(['status_pesanan' => 'selesai']);

        // Balikin ke halaman pesanan awal
        return redirect('/pesanan')->with('success', 'Pesanan berhasil diselesaikan!');
    }
}