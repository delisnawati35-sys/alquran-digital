<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once __DIR__ . '/config/koneksi.php';


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
| Ambil Data Form
|--------------------------------------------------------------------------
*/
$kode_materi        = mysqli_real_escape_string($koneksi,$_POST['kode_materi']);
$nama_materi        = mysqli_real_escape_string($koneksi,$_POST['nama_materi']);
$kategori_materi    = mysqli_real_escape_string($koneksi,$_POST['kategori_materi']);
$tingkat_kesulitan  = mysqli_real_escape_string($koneksi,$_POST['tingkat_kesulitan']);
$deskripsi          = mysqli_real_escape_string($koneksi,$_POST['deskripsi']);
$target_pembelajaran= mysqli_real_escape_string($koneksi,$_POST['target_pembelajaran']);
$tanggal_input      = $_POST['tanggal_input'];
$status_materi      = $_POST['status_materi'];


/*
|/*
|--------------------------------------------------------------------------
| Upload Gambar ke Folder uploads
|--------------------------------------------------------------------------
*/

$namaBaru = "";

if (isset($_FILES['gambar_materi']) && $_FILES['gambar_materi']['error'] == 0) {

    $ekstensiValid = ['jpg', 'jpeg', 'png'];

    $namaFile = $_FILES['gambar_materi']['name'];
    $tmpFile  = $_FILES['gambar_materi']['tmp_name'];

    $ekstensi = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));

    if (!in_array($ekstensi, $ekstensiValid)) {

        echo "<script>
            alert('Format gambar harus JPG, JPEG, atau PNG');
            window.location='tambah.php';
        </script>";
        exit;

    }

    // Nama file baru agar tidak bentrok
    $namaBaru = uniqid('img_') . "." . $ekstensi;

    // Path tujuan upload
    $tujuan = __DIR__ . "/uploads/" . $namaBaru;

    // Pindahkan file
    if (!move_uploaded_file($tmpFile, $tujuan)) {
        die("Gagal mengupload gambar ke folder uploads.");
    }

} else {
    die("Tidak ada gambar yang dipilih atau terjadi kesalahan upload.");
}
/*
|--------------------------------------------------------------------------
| Simpan ke Database
|--------------------------------------------------------------------------
*/
$query = mysqli_query(
    $koneksi,
    "INSERT INTO materi_pembelajaran
    (
        kode_materi,
        nama_materi,
        kategori_materi,
        tingkat_kesulitan,
        deskripsi,
        target_pembelajaran,
        tanggal_input,
        status_materi,
        gambar_materi
    )
    VALUES
    (
        '$kode_materi',
        '$nama_materi',
        '$kategori_materi',
        '$tingkat_kesulitan',
        '$deskripsi',
        '$target_pembelajaran',
        '$tanggal_input',
        '$status_materi',
        '$namaBaru'
    )"
);

/*
|--------------------------------------------------------------------------
| Redirect
|--------------------------------------------------------------------------
*/
if($query){

    echo "
    <script>
        alert('Data berhasil disimpan');
        window.location='materi.php';
    </script>
    ";

}else{

    echo "
    <script>
        alert('Data gagal disimpan');
        window.location='tambah.php';
    </script>
    ";

}
?>
