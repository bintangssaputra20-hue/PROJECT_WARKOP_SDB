<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        // 1. Simpan ke tabel transaksi
        $id_transaksi = DB::table('transaksi')->insertGetId([
            'no_meja'          => $request->no_meja,
            'nama_user'        => $request->nama_user,
            'total_harga'      => $request->total_harga,
            'status_transaksi' => 'Lunas', // Atau menyesuaikan metode pembayaran
            'created_at'       => now(),
        ]);

        // 2. Ambil array pesanan dari JavaScript
        $keranjang = $request->detail_pesanan; 

        // 3. Simpan detail pesanan
        if ($keranjang) {
            foreach ($keranjang as $item) {
                DB::table('pesanan')->insert([
                    'id_transaksi'   => $id_transaksi,
                    'id_menu'        => $item['id'], // Tadi kita udah masukin id di menu_cust
                    'jumlah'         => $item['qty'],
                    'harga_satuan'   => $item['harga'],
                    'status_pesanan' => 'belum selesai',
                    'created_at'     => now(),
                ]);
            }
        }

        // Jangan redirect dari sini, karena JS di checkout.blade yang bertugas pindah ke halaman struk.
        // Kita cukup kasih tau JavaScript kalau proses sukses.
        return response()->json(['success' => true]);
    }

    public function struk()
    {
        $transaksi = DB::table('transaksi')->orderBy('id_transaksi', 'desc')->first();

        if (!$transaksi) {
            return redirect('/menu')->with('error', 'Tidak ada transaksi ditemukan.');
        }

        $pesanan = DB::table('pesanan')
            ->join('menu', 'pesanan.id_menu', '=', 'menu.id_menu')
            ->where('id_transaksi', $transaksi->id_transaksi)
            ->get();

        return view('halaman_struk', compact('transaksi', 'pesanan'));
    }
}