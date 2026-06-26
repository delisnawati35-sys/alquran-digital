<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: auth/login.php");
    exit;
}
?>

<!DOCTYPE html>

<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Tambah Materi</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f4f6f9;
}

.sidebar{
    width:250px;
    height:100vh;
    position:fixed;
    background:#198754;
}

.sidebar a{
    display:block;
    color:white;
    text-decoration:none;
    padding:12px;
}

.sidebar a:hover{
    background:rgba(255,255,255,.15);
}

.content{
    margin-left:250px;
}

</style>

</head>

<body>

<!-- Sidebar -->

<div class="sidebar">

<h3 class="text-center text-white py-4">
    📖 Al-Qur'an Digital
</h3>

<a href="dashboard.php">Dashboard</a>
<a href="materi.php">Data Materi</a>
<a href="tambah.php">Tambah Materi</a>
<a href="laporan.php">Laporan PDF</a>
<a href="auth/logout.php">Logout</a>
```

</div>

<!-- Content -->

<div class="content">

<nav class="navbar navbar-light bg-white shadow-sm">

    <div class="container-fluid">

        <span class="navbar-brand">
            Tambah Materi Pembelajaran
        </span>

    </div>

</nav>

<div class="container mt-4">

    <div class="card">

        <div class="card-body">

            <form
                action="simpan.php"
                method="POST"
                enctype="multipart/form-data">

                <div class="mb-3">

                    <label class="form-label">
                        Kode Materi
                    </label>

                    <input
                        type="text"
                        name="kode_materi"
                        class="form-control"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Nama Materi
                    </label>

                    <input
                        type="text"
                        name="nama_materi"
                        class="form-control"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Kategori Materi
                    </label>

                    <select
                        name="kategori_materi"
                        class="form-select"
                        required>

                        <option value="">
                            -- Pilih Kategori --
                        </option>

                        <option>
                            Huruf Hijaiyah
                        </option>

                        <option>
                            Tajwid
                        </option>

                        <option>
                            Tahsin
                        </option>

                        <option>
                            Hafalan
                        </option>

                        <option>
                            Tilawah
                        </option>

                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Tingkat Kesulitan
                    </label>

                    <select
                        name="tingkat_kesulitan"
                        class="form-select"
                        required>

                        <option value="">
                            -- Pilih Tingkat --
                        </option>

                        <option>
                            Dasar
                        </option>

                        <option>
                            Menengah
                        </option>

                        <option>
                            Lanjutan
                        </option>

                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Deskripsi
                    </label>

                    <textarea
                        name="deskripsi"
                        class="form-control"
                        rows="4"
                        required></textarea>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Target Pembelajaran
                    </label>

                    <input
                        type="text"
                        name="target_pembelajaran"
                        class="form-control"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Tanggal Input
                    </label>

                    <input
                        type="date"
                        name="tanggal_input"
                        class="form-control"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Status Materi
                    </label>

                    <select
                        name="status_materi"
                        class="form-select"
                        required>

                        <option>
                            Aktif
                        </option>

                        <option>
                            Nonaktif
                        </option>

                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Upload Gambar Materi
                    </label>

                    <input
                        type="file"
                        name="gambar_materi"
                        class="form-control"
                        accept=".jpg,.jpeg,.png"
                        required>

                </div>

                <button
                    type="submit"
                    class="btn btn-success">

                    Simpan Data

                </button>

                <a href="materi.php"
                   class="btn btn-secondary">

                    Kembali

                </a>

            </form>

        </div>

    </div>

</div>

</div>

</body>
</html>
