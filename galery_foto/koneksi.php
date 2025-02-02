<?php
$host = "localhost"; // Sesuaikan dengan host Anda
$user = "root"; // Sesuaikan dengan user Anda
$password = ""; // Sesuaikan dengan password Anda
$database = "galery";

$koneksi = mysqli_connect($host, $user, $password, $database);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>