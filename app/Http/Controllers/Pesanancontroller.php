<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    public function index()
{
    $pesanan = DB::table('pesanan')
        ->join('transaksi', 'pesanan.id_transaksi', '=', 'transaksi.id_transaksi')
        ->join('menu', 'pesanan.id_menu', '=', 'menu.id_menu')
        ->select(
            'transaksi.id_transaksi',
            'transaksi.nama_user',
            'transaksi.no_meja',
            'pesanan.status_pesanan',
            // Kita bungkus data yang mau dikelompokkan
            DB::raw("GROUP_CONCAT(CONCAT(menu.nama_menu, ' (', pesanan.jumlah, ')') SEPARATOR '<br>') as list_menu"),
            DB::raw("SUM(pesanan.jumlah) as total_qty")
        )
        ->where('pesanan.status_pesanan', 'belum selesai')
        ->groupBy('transaksi.id_transaksi', 'transaksi.nama_user', 'transaksi.no_meja', 'pesanan.status_pesanan')
        ->orderBy('transaksi.id_transaksi', 'desc')
        ->get();

    $filter = 'belum selesai';
    return view('pesanan', compact('pesanan', 'filter')); 
}

    public function selesai($nama, $meja)
    {
        DB::table('pesanan')
            ->where('nama_user', $nama)
            ->where('no_meja', $meja)
            ->where('status_pesanan', 'belum selesai')
            ->update(['status_pesanan' => 'selesai']);

        return redirect('/pesanan')->with('success', 'Pesanan selesai!');
    }
}