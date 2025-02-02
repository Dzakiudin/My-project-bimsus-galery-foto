<?php
// Memulai sesi dan memastikan pengguna telah login
session_start();
include 'koneksi.php';

// Cek apakah pengguna telah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Jika belum login, arahkan ke halaman login
    exit();
}

// Ambil foto_id dari URL dan user_id dari session
$foto_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Query untuk menghapus referensi album pada foto
$query_foto = "UPDATE gallery_foto SET ALBUM_ID = NULL WHERE FOTO_ID = '$foto_id' AND USER_ID = '$user_id'";

// Eksekusi query
if (mysqli_query($koneksi, $query_foto)) {
    // Jika berhasil
    echo "<script>alert('Foto berhasil dihapus dari album!'); window.location='foto_list.php';</script>";
} else {
    // Jika gagal
    echo "<script>alert('Gagal menghapus foto dari album!'); window.location='foto_list.php';</script>";
}
?>
