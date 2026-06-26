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
if(!isset($_GET['id'])){
    header("Location: materi.php");
    exit;
}

$id_materi = $_GET['id'];

/*
|--------------------------------------------------------------------------
| Ambil Data Materi
|--------------------------------------------------------------------------
*/
$queryData = mysqli_query(
    $koneksi,
    "SELECT * FROM materi_pembelajaran
     WHERE id_materi='$id_materi'"
);

$data = mysqli_fetch_assoc($queryData);

if(!$data){
    echo "
    <script>
        alert('Data tidak ditemukan');
        window.location='materi.php';
    </script>
    ";
    exit;
}

/*
|--------------------------------------------------------------------------
| Hapus File Gambar
|--------------------------------------------------------------------------
*/
$fileGambar = __DIR__ . "/uploads/" . $data['gambar_materi'];

if(file_exists($fileGambar)){
    unlink($fileGambar);
}

/*
|--------------------------------------------------------------------------
| Hapus Data Database
|--------------------------------------------------------------------------
*/
$queryHapus = mysqli_query(
    $koneksi,
    "DELETE FROM materi_pembelajaran
     WHERE id_materi='$id_materi'"
);

/*
|--------------------------------------------------------------------------
| Redirect
|--------------------------------------------------------------------------
*/
if($queryHapus){

    echo "
    <script>
        alert('Data berhasil dihapus');
        window.location='materi.php';
    </script>
    ";

}else{

    echo "
    <script>
        alert('Data gagal dihapus');
        window.location='materi.php';
    </script>
    ";

}
?>