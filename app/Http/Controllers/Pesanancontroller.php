<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'belum selesai');

        $data_pesanan = DB::table('pesanan')
            ->select(
                DB::raw('MIN(id_pesanan) as id_pesanan'),
                'nama_user',
                'no_meja',
                'status_pesanan',
                DB::raw("GROUP_CONCAT(CONCAT(nama_menu, ' (', jumlah, ')') SEPARATOR '<br>') as list_menu"),
                DB::raw('SUM(jumlah) as total_qty')
            )
            ->where('status_pesanan', $filter)
            ->groupBy('nama_user', 'no_meja', 'status_pesanan')
            ->orderBy('id_pesanan', 'DESC')
            ->get();

        return view('pesanan', compact('data_pesanan', 'filter'));
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