<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stok Barang</title>

    <link rel="stylesheet" href="{{ asset('css/stok_barang.css') }}">
</head>
<body>

<div class="navbar">
    <h2 class="title">Stok Barang</h2>

    <a href="/dashboard-admin">
        <button class="btn-back">⬅ BACK</button>
    </a>
</div>

<div class="container">

    <div class="slider">
        <div class="slider-box">
            <button class="btn aktif" id="btnMakanan" onclick="filterMenu('Makanan', 'btnMakanan')">
                Makanan
            </button>
            <button class="btn" id="btnMinuman" onclick="filterMenu('Minuman', 'btnMinuman')">
                Minuman
            </button>
            <button class="btn" id="btnCemilan" onclick="filterMenu('Cemilan', 'btnCemilan')">
                Cemilan
            </button>
        </div>
    </div>

    <div class="table-header">
        <div class="col-no">No</div>
        <div class="col-nama">Nama Menu</div>
        <div class="col-stok">Stok</div>
        <div class="col-action">Aksi</div>
    </div>

    <div class="list" id="list-menu">
    </div>

    <div class="bottom-bar">
        <button class="btn-add" onclick="window.location.href='/tambah-menu'">
            + Tambah Menu Baru
        </button>
    </div>

</div>

<script>
// Data menu dari Controller langsung dikonversi ke JSON
const dataMenu = @json($data_menu ?? []);

// FILTER MENU
function filterMenu(kategori, btnId) {
    document.querySelectorAll('.btn').forEach(btn => {
        btn.classList.remove('aktif');
    });

    document.getElementById(btnId).classList.add('aktif');
    const listContainer = document.getElementById("list-menu");
    listContainer.innerHTML = "";

    const menuFiltered = dataMenu.filter(item =>
        item.nama_kategori.toLowerCase() === kategori.toLowerCase()
    );

    if (menuFiltered.length === 0) {
        listContainer.innerHTML = `
            <div class="item" style="justify-content:center;">
                Data ${kategori} belum tersedia
            </div>
        `;
        return;
    }

    menuFiltered.forEach((item, index) => {
        const row = `
            <div class="item">
                <div class="col-no">${index + 1}</div>
                <div class="col-nama">${item.nama_menu}</div>
                <div class="col-stok">${item.stok}</div>
                <div class="col-action">
                    <button class="btn-hapus" onclick="hapusMenu(${item.id_menu})">Hapus</button>
                    <button class="btn-edit" onclick="editMenu(${item.id_menu})">Edit</button>
                </div>
            </div>
        `;
        listContainer.innerHTML += row;
    });
}

// HAPUS MENU
function hapusMenu(id) {
    const konfirmasi = confirm('Apakah Anda yakin ingin menghapus menu ini?');
    if (konfirmasi) {
        window.location.href = '/hapus-menu/' + id;
    }
}

// EDIT MENU
function editMenu(id) {
    window.location.href = '/edit-menu/' + id;
}

// LOAD AWAL
window.onload = function () {
    filterMenu('Makanan', 'btnMakanan');
};
</script>

</body>
</html>