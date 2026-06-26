<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include __DIR__ . '/config/koneksi.php';/*
|--------------------------------------------------------------------------
| Proteksi Halaman
|--------------------------------------------------------------------------
*/
if (!isset($_SESSION['login'])) {
    header("Location: /alquran_digital/auth/login.php");
    exit;
}

/*
|--------------------------------------------------------------------------
| Statistik Dashboard
|--------------------------------------------------------------------------
*/
$totalMateri = mysqli_fetch_assoc(
    mysqli_query(
        $koneksi,
        "SELECT COUNT(*) as total
        FROM materi_pembelajaran"
    )
);

$totalAktif = mysqli_fetch_assoc(
    mysqli_query(
        $koneksi,
        "SELECT COUNT(*) as total
        FROM materi_pembelajaran
        WHERE status_materi='Aktif'"
    )
);

$totalNonaktif = mysqli_fetch_assoc(
    mysqli_query(
        $koneksi,
        "SELECT COUNT(*) as total
        FROM materi_pembelajaran
        WHERE status_materi='Nonaktif'"
    )
);


?>

<!DOCTYPE html>

<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Dashboard</title>

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
    color:white;
}

.sidebar a{
    color:white;
    text-decoration:none;
    display:block;
    padding:12px;
}

.sidebar a:hover{
    background:rgba(255,255,255,.15);
}

.content{
    margin-left:250px;
}

.card-stat{
    border:none;
    border-radius:15px;
    box-shadow:0 2px 10px rgba(0,0,0,.1);
}

</style>

</head>

<body>

<!-- SIDEBAR -->

<div class="sidebar">

<h3 class="text-center py-4">
    📖 Al-Qur'an Digital
</h3>

<a href="dashboard.php">
    Dashboard
</a>

<a href="materi.php">
    Data Materi
</a>

<a href="tambah.php">
    Tambah Materi
</a>

<a href="laporan.php">
    Laporan PDF
</a>

<a href="auth/logout.php">
    Logout
</a>


</div>

<!-- CONTENT -->

<div class="content">

<!-- NAVBAR -->

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">

    <div class="container-fluid">

        <span class="navbar-brand">
            Dashboard Admin
        </span>

        <span>
            Selamat Datang,
            <strong>
                <?php echo $_SESSION['username']; ?>
            </strong>
        </span>

    </div>

</nav>

<!-- ISI -->

<div class="container mt-4">

    <div class="row">

    <div class="col-md-4 mb-3">

        <div class="card shadow border-0">

            <div class="card-body text-center">

                <h5>Total Materi</h5>

                <h1>
                    <?php echo $totalMateri['total']; ?>
                </h1>

            </div>

        </div>

    </div>

    <div class="col-md-4 mb-3">

        <div class="card shadow border-0">

            <div class="card-body text-center">

                <h5>Materi Aktif</h5>

                <h1>
                    <?php echo $totalAktif['total']; ?>
                </h1>

            </div>

        </div>

    </div>

    <div class="col-md-4 mb-3">

        <div class="card shadow border-0">

            <div class="card-body text-center">

                <h5>Materi Nonaktif</h5>

                <h1>
                    <?php echo $totalNonaktif['total']; ?>
                </h1>

            </div>

        </div>

    </div>

</div>

    <div class="mt-4">

        <div class="card">

            <div class="card-body">

                <h4>
                    Sistem Pembelajaran Al-Qur'an Digital
                </h4>

                <p>
                    Sistem ini digunakan untuk mengelola materi
                    pembelajaran Al-Qur'an seperti Huruf Hijaiyah,
                    Tajwid, Tahsin, Hafalan, dan Tilawah.
                </p>

                <hr>

                <p>
                    Silakan gunakan menu di sebelah kiri untuk
                    menambah, mengubah, menghapus, mencari data,
                    serta mencetak laporan PDF materi pembelajaran.
                  </p>
            </div>

        </div>

    </div>

</div>


</div>

</body>
</html>
