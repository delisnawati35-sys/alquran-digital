<?php

$host = "localhost";
$user = "root";
$pass = "";
$db   = "alquran_digital";

$koneksi = mysqli_connect($host,$user,$pass,$db);

if(!$koneksi){
    die(mysqli_connect_error());
}