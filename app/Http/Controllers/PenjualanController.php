<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataPenjualan; // Memanggil model yang baru dibuat
use Carbon\Carbon;

class PenjualanController extends Controller
{
    public function index(Request $request)
    {
        // Menangkap filter tanggal, default ke hari ini
        $tanggal = $request->input('tanggal', Carbon::today()->toDateString());

        // Mengambil data menggunakan Eloquent ORM DataPenjualan
        $data_penjualan = DataPenjualan::whereDate('tanggal_pesan', $tanggal)
            ->orderBy('id_transaksi', 'desc')
            ->get();

        return view('data_penjualan', compact('data_penjualan', 'tanggal'));
    }
}