<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pesanan - Warkop SDB</title>
    <link rel="stylesheet" href="{{ asset('css/pesanan.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body>

    <header class="navbar">
        <div class="nav-left">
            <h1>Pesanan Masuk</h1>
            <p>Monitoring Antrean Warkop SDB</p>
        </div>
        <a href="/dashboard-admin" class="btn-back">
            <i class="fas fa-arrow-left"></i> BACK
        </a>
    </header>

    <main class="container">
    <div class="filter-section">
        <a href="/pesanan/belum-selesai" class="btn-filter {{ $filter == 'belum selesai' ? 'active' : '' }}">
            <i class="fas fa-clock"></i> Belum Selesai
        </a>
    </div>

        <div class="table-card">
            <table>
                <thead>
                    <tr>
                        <th width="80">ID</th>
                        <th>Nama Customer</th>
                        <th>Menu Pesanan</th>
                        <th width="100">Jumlah</th>
                        <th width="100">No. Meja</th>
                        <th width="150" style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Loop data jauh lebih bersih --}}
                    @forelse($pesanan as $row)
                        <tr>
                            <td class="text-muted">INV-{{ $row->id_transaksi }}</td>
                            <td><strong class="user-name">{{ $row->nama_user }}</strong></td>
                            
                            {{-- {!! !!} digunakan agar <br> dari MySQL terproses sebagai HTML --}}
                            <td style="line-height: 1.6; padding: 10px 15px;">
                                {!! $row->list_menu !!}
                            </td>
                            
                            <td><span class="qty-badge">{{ $row->total_qty }} Porsi</span></td>
                            <td><span class="table-badge">Meja {{ $row->no_meja }}</span></td>
                            <td class="action-column" style="text-align: center;">
                                @if($row->status_pesanan == 'belum selesai')
                                    <a href="/pesanan/selesai/{{ $row->id_transaksi }}" class="btn-done">Selesai</a>
                                @else
                                    <span class="status-label">Selesai</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" style="text-align:center; padding: 20px;">Belum ada antrean pesanan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>