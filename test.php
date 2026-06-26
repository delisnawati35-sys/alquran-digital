<?php
include 'config/koneksi.php';

echo "Koneksi Database Berhasil";
?>

<?php

echo "DB_HOST = ";
var_dump(getenv('DB_HOST'));

echo "<br>DB_USER = ";
var_dump(getenv('DB_USERNAME'));