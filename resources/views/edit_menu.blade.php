<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu - Warkop SDB</title>

    <link rel="stylesheet" href="{{ asset('css/edit_menu.css') }}">
</head>
<body>

<div class="form-container">

    <h2 style="text-align:center;">Edit Menu</h2>

    <hr style="border:1px solid #30363d; margin:20px 0;">

    <form action="/edit-menu/{{ $menu->id_menu }}" method="POST">
        
        @csrf

        <div class="form-group">
            <label>Nama Menu</label>
            <input type="text" name="nama_menu" value="{{ $menu->nama_menu }}" required>
        </div>

        <div class="form-group">
            <label>Kategori</label>
            <select name="id_kategori" required>
                @foreach($kategori as $kat)
                    <option value="{{ $kat->id_kategori }}" 
                        {{ $kat->id_kategori == $menu->id_kategori ? 'selected' : '' }}>
                        {{ $kat->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Stok</label>
            <input type="number" name="stok" value="{{ $menu->stok }}" required>
        </div>

        <div class="form-group">
            <label>Harga</label>
            <input type="number" name="harga" value="{{ $menu->harga }}" required>
        </div>

        <div class="btn-box">
            <a href="/stok-barang" class="btn-cancel">Batal</a>
            <button type="submit" class="btn-update">Update Menu</button>
        </div>

    </form>

</div>

</body>
</html>