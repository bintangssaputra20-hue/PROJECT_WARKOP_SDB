<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Menu</title>

    <link rel="stylesheet" href="{{ asset('css/tambah_menu.css') }}">
</head>
<body>

<div class="form-container">

    <h2 style="text-align:center;">Tambah Menu Baru</h2>

    <hr style="border:1px solid #30363d; margin:20px 0;">

    <form action="/tambah-menu" method="POST">
        
        @csrf

        <div class="form-group">
            <label>Nama Menu</label>
            <input type="text" name="nama_menu" required placeholder="Contoh : Es Teh">
        </div>

        <div class="form-group">
            <label>Kategori</label>
            <select name="id_kategori" required>
                <option value="">-- Pilih Kategori --</option>
                
                @foreach($kategori as $kat)
                    <option value="{{ $kat->id_kategori }}">
                        {{ $kat->nama_kategori }}
                    </option>
                @endforeach

            </select>
        </div>

        <div class="form-group">
            <label>Stok</label>
            <input type="number" name="stok" required placeholder="0">
        </div>

        <div class="form-group">
            <label>Harga</label>
            <input type="number" name="harga" required placeholder="Rp">
        </div>

        <div class="btn-box">
            <a href="/stok-barang" class="btn-cancel">Batal</a>
            <button type="submit" class="btn-save">Simpan Menu</button>
        </div>

    </form>

</div>

</body>
</html>