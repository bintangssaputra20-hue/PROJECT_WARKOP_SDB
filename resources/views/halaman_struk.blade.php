@extends('layouts.app')

@section('title', 'Struk Pembayaran - Warkop SDB')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            
            <div class="text-center mb-4">
                <h2>Pesanan Berhasil!</h2>
                <p class="text-secondary">Terima kasih, silakan tunggu pesanan Anda</p>
            </div>

            <div class="card text-dark rounded-4 shadow p-4">
                
                <div class="d-flex justify-content-between pb-3" style="border-bottom: 1px dashed #ccc;">
                    <strong>Warkop SDB</strong>
                    <span class="text-muted">
                        {{ date('d M Y H:i', strtotime($transaksi->tanggal_pesan)) }}
                    </span>
                </div>

                <div class="text-center my-4 pb-3" style="border-bottom: 1px dashed #ccc;">
                    <span class="text-muted d-block small">No. Meja</span>
                    <h1 class="display-1 fw-bold text-primary m-0">
                        {{ str_pad($transaksi->no_meja, 2, "0", STR_PAD_LEFT) }}
                    </h1>
                </div>

                <div class="mb-3">
                    @foreach($pesanan as $row)
                        <div class="border-bottom border-light pb-2 mb-2">
                            <div class="fw-bold">{{ $row->nama_menu }}</div>
                            <div class="text-muted small">Jumlah Pesanan: {{ $row->jumlah }}</div>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-between align-items-center border-top pt-3 fw-bold fs-5">
                    <span>Total Bayar</span>
                    <span class="text-success">
                        Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                    </span>
                </div>

            </div>

            <a href="/menu" class="btn btn-outline-light w-100 py-3 mt-4 fw-bold rounded-3">
                <i class="fas fa-chevron-left me-2"></i> Kembali ke Menu
            </a>

        </div>
    </div>
</div>
@endsection