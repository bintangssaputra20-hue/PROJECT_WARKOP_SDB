<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        // Pastikan variabel 'keranjang' terkirim dari frontend
        if (!$request->has('keranjang')) {
            return "ERROR: Data 'keranjang' tidak ditemukan. Pastikan JS lu mengirim field dengan nama 'keranjang'";
        }

        $keranjang = json_decode($request->keranjang, true);

        // Simpan ke tabel transaksi
        $id_transaksi = DB::table('transaksi')->insertGetId([
            'no_meja'          => $request->no_meja,
            'nama_user'        => $request->nama_user,
            'total_harga'      => $request->total_harga,
            'status_transaksi' => 'Lunas',
            'created_at'       => now(),
        ]);

        // Simpan detail pesanan
        if ($keranjang) {
            foreach ($keranjang as $item) {
                DB::table('pesanan')->insert([
                    'id_transaksi'   => $id_transaksi,
                    'id_menu'        => $item['id'],
                    'jumlah'         => $item['qty'],
                    'harga_satuan'   => $item['harga'],
                    'status_pesanan' => 'belum selesai',
                    'created_at'     => now(),
                ]);
            }
        }

        return redirect('/menu')->with('success', 'Transaksi berhasil!');
    }
}