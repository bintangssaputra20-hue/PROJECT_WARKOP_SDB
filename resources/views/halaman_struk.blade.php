<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran - Warkop SDB</title>

    <link rel="stylesheet" href="{{ asset('css/struk.css') }}">
</head>

<body>

<div class="container">

    <div style="text-align:center; margin-bottom:20px;">
        <h2>Pesanan Berhasil!</h2>
        <p>Terima kasih, silakan tunggu pesanan Anda</p>
    </div>

    <div class="struk-card">

        <div class="struk-header">
            <strong>Warkop SDB</strong>
            <span>
                {{ date('d M Y H:i', strtotime($transaksi->tanggal_pesan)) }}
            </span>
        </div>

        <div class="no-meja-section">
            <span>No. Meja</span>
            <h1>
                {{ str_pad($transaksi->no_meja, 2, "0", STR_PAD_LEFT) }}
            </h1>
        </div>

        <div class="detail-pesanan">

            @foreach($pesanan as $row)
                <div class="item">
                    <div class="nama-menu">
                        {{ $row->nama_menu }}
                    </div>

                    <div class="jumlah">
                        Jumlah Pesanan : {{ $row->jumlah }}
                    </div>
                </div>
            @endforeach

            <div class="total-row">
                <span>Total Bayar</span>
                <span>
                    Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                </span>
            </div>

        </div>

    </div>

    <a href="/menu" class="btn-kembali">
        Kembali ke Menu
    </a>

</div>

</body>
</html>