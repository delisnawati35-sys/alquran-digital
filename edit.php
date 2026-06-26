<?php
session_start();
include 'config/koneksi.php';

/*
|--------------------------------------------------------------------------
| Proteksi Login
|--------------------------------------------------------------------------
*/
if(!isset($_SESSION['login'])){
    header("Location: auth/login.php");
    exit;
}

/*
|--------------------------------------------------------------------------
| Ambil ID Materi
|--------------------------------------------------------------------------
*/
if (!isset($_GET['id'])) {
    header("Location: materi.php");
    exit;
}

$id = (int) $_GET['id'];

$query = mysqli_query(
    $koneksi,
    "SELECT * FROM materi_pembelajaran
    WHERE id_materi='$id'"
);

$data = mysqli_fetch_assoc($query);

if(!$data){
    echo "Data tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Edit Materi</title>

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

.preview{
    max-width:200px;
    border-radius:10px;
    margin-top:10px;
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

</div>

<!-- Content -->

<div class="content">

    <nav class="navbar navbar-light bg-white shadow-sm">

        <div class="container-fluid">
            <span class="navbar-brand">
                Edit Materi Pembelajaran
            </span>
        </div>

    </nav>

    <div class="container mt-4">

        <div class="card">

            <div class="card-body">

                <form
                    action="update.php"
                    method="POST"
                    enctype="multipart/form-data">

                    <!-- Hidden Field -->
                    <input
                        type="hidden"
                        name="id_materi"
                        value="<?php echo $data['id_materi']; ?>">

                    <input
                        type="hidden"
                        name="gambar_lama"
                        value="<?php echo $data['gambar_materi']; ?>">

                    <div class="mb-3">

                        <label class="form-label">
                            Kode Materi
                        </label>

                        <input
                            type="text"
                            name="kode_materi"
                            class="form-control"
                            value="<?php echo $data['kode_materi']; ?>"
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
                            value="<?php echo $data['nama_materi']; ?>"
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

                            <option <?php if($data['kategori_materi']=="Huruf Hijaiyah") echo "selected"; ?>>
                                Huruf Hijaiyah
                            </option>

                            <option <?php if($data['kategori_materi']=="Tajwid") echo "selected"; ?>>
                                Tajwid
                            </option>

                            <option <?php if($data['kategori_materi']=="Tahsin") echo "selected"; ?>>
                                Tahsin
                            </option>

                            <option <?php if($data['kategori_materi']=="Hafalan") echo "selected"; ?>>
                                Hafalan
                            </option>

                            <option <?php if($data['kategori_materi']=="Tilawah") echo "selected"; ?>>
                                Tilawah
                            </option>

                        </select>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Tingkat Kesulitan
                        </label>

                        <input
                            type="text"
                            name="tingkat_kesulitan"
                            class="form-control"
                            value="<?php echo $data['tingkat_kesulitan']; ?>"
                            required>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Deskripsi
                        </label>

                        <textarea
                            name="deskripsi"
                            class="form-control"
                            rows="4"
                            required><?php echo $data['deskripsi']; ?></textarea>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Target Pembelajaran
                        </label>

                        <input
                            type="text"
                            name="target_pembelajaran"
                            class="form-control"
                            value="<?php echo $data['target_pembelajaran']; ?>"
                            required>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Status Materi
                        </label>

                        <select
                            name="status_materi"
                            class="form-select">

                            <option value="Aktif"
                            <?php if($data['status_materi']=="Aktif") echo "selected"; ?>>
                                Aktif
                            </option>

                            <option value="Nonaktif"
                            <?php if($data['status_materi']=="Nonaktif") echo "selected"; ?>>
                                Nonaktif
                            </option>

                        </select>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Gambar Saat Ini
                        </label>

                        <br>

                        <img
                            src="uploads/<?php echo $data['gambar_materi']; ?>"
                            class="preview">

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Ganti Gambar (Opsional)
                        </label>

                        <input
                            type="file"
                            name="gambar_materi"
                            class="form-control"
                            accept=".jpg,.jpeg,.png">

                    </div>

                    <button
                        type="submit"
                        class="btn btn-success">

                        Update Data

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