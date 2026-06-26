<?php
session_start();
include 'config/koneksi.php';/*
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
| Pencarian Data
|--------------------------------------------------------------------------
*/
$cari = "";

if(isset($_GET['cari'])){
    $cari = mysqli_real_escape_string(
        $koneksi,
        $_GET['cari']
    );

    $query = mysqli_query(
        $koneksi,
        "SELECT * FROM materi_pembelajaran
        WHERE kode_materi LIKE '%$cari%'
        OR nama_materi LIKE '%$cari%'
        ORDER BY id_materi DESC"
    );

} else {

    $query = mysqli_query(
        $koneksi,
        "SELECT * FROM materi_pembelajaran
        ORDER BY id_materi DESC"
    );

}
?>

<!DOCTYPE html>

<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Data Materi</title>

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

img{
    border-radius:8px;
}

</style>

</head>

<body>

<!-- SIDEBAR -->

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

<!-- CONTENT -->

<div class="content">


<nav class="navbar navbar-light bg-white shadow-sm">

    <div class="container-fluid">

        <span class="navbar-brand">
            Data Materi Pembelajaran
        </span>

        <span>
            <?php echo $_SESSION['username']; ?>
        </span>

    </div>

</nav>

<div class="container mt-4">

    <div class="card">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">

                <div>

                    <a href="tambah.php"
                    class="btn btn-success">
                    + Tambah Materi
                    </a>

                    <a href="laporan.php"
                    target="_blank"
                    class="btn btn-danger">
                    Cetak PDF
                    </a>

                </div>

                <form method="GET">

                    <div class="input-group">

                        <input
                            type="text"
                            name="cari"
                            class="form-control"
                            placeholder="Cari Materi..."
                            value="<?php echo $cari; ?>">

                        <button
                            class="btn btn-primary">
                            Cari
                        </button>

                    </div>

                </form>

            </div>

            <div class="table-responsive">

                <table class="table table-bordered table-striped">

                    <thead class="table-success">

                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Kode</th>
                            <th>Nama Materi</th>
                            <th>Kategori</th>
                            <th>Tingkat</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>

                    </thead>

                    <tbody>

                    <?php
                    $no = 1;

                    while($data =
                        mysqli_fetch_assoc($query))
                    {
                    ?>

                    <tr>

                        <td>
                            <?php echo $no++; ?>
                        </td>

                        <td>
                            <?php if (!empty($data['gambar_materi'])): ?>
                                <img src="uploads/<?php echo $data['gambar_materi']; ?>" style="max-width:200px;">
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php echo $data['kode_materi']; ?>
                        </td>

                        <td>
                            <?php echo $data['nama_materi']; ?>
                        </td>

                        <td>
                            <?php echo $data['kategori_materi']; ?>
                        </td>

                        <td>
                            <?php echo $data['tingkat_kesulitan']; ?>
                        </td>

                        <td>
                            <?php echo $data['status_materi']; ?>
                        </td>

                        <td>

                            <a href="edit.php?id=<?php echo $data['id_materi']; ?>"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <a href="hapus.php?id=<?php echo $data['id_materi']; ?>"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Yakin ingin menghapus data?')">
                                Hapus
                            </a>

                        </td>

                    </tr>

                    <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

</div>

</body>
</html>
