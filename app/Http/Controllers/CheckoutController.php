<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class CheckoutController extends Controller
{
    // 1. FUNGSI UNTUK MENAMPILKAN HALAMAN CHECKOUT (Tetap Harus Ada)
    public function index()
    {
        return view('checkout');
    }

    // 2. FUNGSI UNTUK MENYIMPAN DATA PESANAN (Tetap Harus Ada & Sudah Kebal)
    public function store(Request $request)
    {
        $subtotal = $request->total_harga / 1.1;

        // Simpan ke tabel transaksi & langsung tangkap ID-nya
        $id_transaksi = DB::table('transaksi')->insertGetId([
            'no_meja'          => $request->no_meja,
            'metode_bayar'     => $request->metode_bayar,
            'total_harga'      => $request->total_harga,
            'status_transaksi' => 'Lunas',
            'nama_user'        => $request->nama_user,
            'subtotal'         => $subtotal
        ]);

        $detail_pesanan = json_decode($request->detail_pesanan, true);

        if (is_array($detail_pesanan)) {
            foreach ($detail_pesanan as $item) {
                DB::table('pesanan')->insert([
                    'no_meja'        => $request->no_meja,
                    'nama_user'      => $request->nama_user,
                    'nama_menu'      => $item['nama'],
                    'jumlah'         => $item['qty'],
                    'status_pesanan' => 'belum selesai',
                    'id_transaksi'   => $id_transaksi
                ]);
            }
        }

        return response()->json(['status' => 'success']);
    }

    // 3. FUNGSI BARU UNTUK STRUK (Ditaruh di paling bawah sebelum penutup class)
    public function struk()
    {
        // Ambil transaksi terakhir 
        $transaksi = DB::table('transaksi')
            ->orderBy('id_transaksi', 'desc')
            ->first();

        if (!$transaksi) {
            return redirect('/menu')->with('error', 'Data transaksi tidak ditemukan');
        }

        // Ambil data pesanan yang terikat dengan id_transaksi tersebut
        $pesanan = DB::table('pesanan')
            ->where('id_transaksi', $transaksi->id_transaksi)
            ->get();

        // Lempar data ke resources/views/halaman_struk.blade.php
        return view('halaman_struk', compact('transaksi', 'pesanan'));
    }
}