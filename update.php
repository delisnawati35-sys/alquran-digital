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
| Ambil Data Form
|--------------------------------------------------------------------------
*/
$id_materi          = $_POST['id_materi'];
$gambar_lama        = $_POST['gambar_lama'];

$kode_materi        = mysqli_real_escape_string($koneksi,$_POST['kode_materi']);
$nama_materi        = mysqli_real_escape_string($koneksi,$_POST['nama_materi']);
$kategori_materi    = mysqli_real_escape_string($koneksi,$_POST['kategori_materi']);
$tingkat_kesulitan  = mysqli_real_escape_string($koneksi,$_POST['tingkat_kesulitan']);
$deskripsi          = mysqli_real_escape_string($koneksi,$_POST['deskripsi']);
$target_pembelajaran= mysqli_real_escape_string($koneksi,$_POST['target_pembelajaran']);
$status_materi      = mysqli_real_escape_string($koneksi,$_POST['status_materi']);

/*
|--------------------------------------------------------------------------
| Cek Apakah Upload Gambar Baru
|--------------------------------------------------------------------------
*/
if($_FILES['gambar_materi']['error'] == 0){

    $namaFile = $_FILES['gambar_materi']['name'];
    $tmpFile  = $_FILES['gambar_materi']['tmp_name'];

    $ekstensiValid = ['jpg','jpeg','png'];

    $ekstensi = strtolower(
        pathinfo($namaFile, PATHINFO_EXTENSION)
    );

    if(!in_array($ekstensi, $ekstensiValid)){

        echo "
        <script>
            alert('Format gambar harus JPG, JPEG, atau PNG');
            window.location='edit.php?id=$id_materi';
        </script>
        ";

        exit;
    }

    /*
    |--------------------------------------------------------------------------
    | Hapus Gambar Lama
    |--------------------------------------------------------------------------
    */
    $fileLama = __DIR__ . "/uploads/" . $gambar_lama;

    if(file_exists($fileLama)){
        unlink($fileLama);
    }

    /*
    |--------------------------------------------------------------------------
    | Upload Gambar Baru
    |--------------------------------------------------------------------------
    */
    $namaBaru = time() . "_" . $namaFile;

    $tujuan = __DIR__ . "/uploads/" . $namaBaru;

    move_uploaded_file($tmpFile, $tujuan);

    $gambar_final = $namaBaru;

}else{

    /*
    |--------------------------------------------------------------------------
    | Gunakan Gambar Lama
    |--------------------------------------------------------------------------
    */
    $gambar_final = $gambar_lama;
}

/*
|--------------------------------------------------------------------------
| Update Database
|--------------------------------------------------------------------------
*/
$query = mysqli_query(
    $koneksi,
    "UPDATE materi_pembelajaran SET

        kode_materi='$kode_materi',
        nama_materi='$nama_materi',
        kategori_materi='$kategori_materi',
        tingkat_kesulitan='$tingkat_kesulitan',
        deskripsi='$deskripsi',
        target_pembelajaran='$target_pembelajaran',
        status_materi='$status_materi',
        gambar_materi='$gambar_final'

    WHERE id_materi='$id_materi'"
);

/*
|--------------------------------------------------------------------------
| Redirect
|--------------------------------------------------------------------------
*/
if($query){

    echo "
    <script>
        alert('Data berhasil diupdate');
        window.location='materi.php';
    </script>
    ";

}else{

    echo "
    <script>
        alert('Data gagal diupdate');
        window.location='edit.php?id=$id_materi';
    </script>
    ";

}
?>