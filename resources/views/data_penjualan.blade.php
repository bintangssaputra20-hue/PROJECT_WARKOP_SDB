<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penjualan - Warkop SDB</title>
    <link rel="stylesheet" href="{{ asset('css/data_penjualan.css') }}">
</head>

<body>

<div class="container">

    <header>
        <div>
            <h2>Data Penjualan</h2>
            <p style="color:#888;font-size:12px;">
                Monitoring Transaksi Real-time
            </p>
        </div>

        <form method="GET" action="/data-penjualan">
            <input 
                type="date" 
                name="tanggal"
                value="{{ $tanggal }}"
                onchange="this.form.submit()"
            >
        </form>
    </header>

    <table>
        <thead>
            <tr>
                <th class="text-center">No Meja</th>
                <th>Jam</th>
                <th>Nama Pelanggan</th>
                <th>Metode Bayar</th>
                <th class="text-right">Subtotal</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data_penjualan as $data)
                <tr>
                    <td class="text-center">
                        <b>{{ $data->no_meja }}</b>
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($data->tanggal_pesan)->format('H:i') }}
                    </td>
                    <td>
                        {{ $data->nama_user }}
                    </td>
                    <td>
                        {{ $data->metode_bayar }}
                    </td>
                    <td class="text-right">
                        Rp {{ number_format($data->subtotal, 0, ',', '.') }}
                    </td>
                    <td class="text-right">
                        <b>Rp {{ number_format($data->total_harga, 0, ',', '.') }}</b>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center" style="padding:40px;color:#777;">
                        Belum ada transaksi pada tanggal {{ \Carbon\Carbon::parse($tanggal)->format('d-m-Y') }}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        <a href="/dashboard-admin" style="color: #fff; text-decoration: none; padding: 10px 20px; background: #333; border-radius: 5px;">← Kembali ke Dashboard</a>
    </div>

</div>

</body>
</html>