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
| Panggil Library FPDF
|--------------------------------------------------------------------------
*/
require('fpdf/fpdf.php');

/*
|--------------------------------------------------------------------------
| Buat Objek PDF
|--------------------------------------------------------------------------
*/
$pdf = new FPDF('L','mm','A4');

$pdf->AddPage();

/*
|--------------------------------------------------------------------------
| Judul Laporan
|--------------------------------------------------------------------------
*/
$pdf->SetFont('Arial','B',16);

$pdf->Cell(
    0,
    10,
    'LAPORAN DATA MATERI PEMBELAJARAN AL-QURAN',
    0,
    1,
    'C'
);

$pdf->Ln(5);

/*
|--------------------------------------------------------------------------
| Tanggal Cetak
|--------------------------------------------------------------------------
*/
$pdf->SetFont('Arial','',10);

$pdf->Cell(
    0,
    8,
    'Tanggal Cetak : '.date('d-m-Y'),
    0,
    1
);

$pdf->Ln(2);

/*
|--------------------------------------------------------------------------
| Header Tabel
|--------------------------------------------------------------------------
*/
$pdf->SetFont('Arial','B',10);

$pdf->Cell(10,10,'No',1,0,'C');
$pdf->Cell(30,10,'Kode',1,0,'C');
$pdf->Cell(50,10,'Nama Materi',1,0,'C');
$pdf->Cell(35,10,'Kategori',1,0,'C');
$pdf->Cell(25,10,'Tingkat',1,0,'C');
$pdf->Cell(80,10,'Target Pembelajaran',1,0,'C');
$pdf->Cell(25,10,'Status',1,1,'C');

/*
|--------------------------------------------------------------------------
| Ambil Data dari Database
|--------------------------------------------------------------------------
*/
$pdf->SetFont('Arial','',10);

$query = mysqli_query(
    $koneksi,
    "SELECT * FROM materi_pembelajaran
     ORDER BY id_materi DESC"
);

$no = 1;

while($data = mysqli_fetch_assoc($query)){

    $pdf->Cell(
        10,
        10,
        $no++,
        1,
        0,
        'C'
    );

    $pdf->Cell(
        30,
        10,
        $data['kode_materi'],
        1,
        0
    );

    $pdf->Cell(
        50,
        10,
        $data['nama_materi'],
        1,
        0
    );

    $pdf->Cell(
        35,
        10,
        $data['kategori_materi'],
        1,
        0
    );

    $pdf->Cell(
        25,
        10,
        $data['tingkat_kesulitan'],
        1,
        0
    );

    $pdf->Cell(
        80,
        10,
        $data['target_pembelajaran'],
        1,
        0
    );

    $pdf->Cell(
        25,
        10,
        $data['status_materi'],
        1,
        1
    );
}

/*
|--------------------------------------------------------------------------
| Output PDF
|--------------------------------------------------------------------------
*/
$pdf->Output(
    'I',
    'Laporan_Materi_Alquran.pdf'
);
?>