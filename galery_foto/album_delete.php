<?php
// Memulai sesi untuk memeriksa autentikasi pengguna
session_start();

// Menghubungkan ke database
include 'koneksi.php';

// Memastikan pengguna telah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Jika belum login, arahkan ke halaman login
    exit();
}

// Mendapatkan ID album dari URL dan ID user dari sesi
$album_id = $_GET['id']; // ID album yang akan dihapus
$user_id = $_SESSION['user_id']; // ID user yang sedang login

// **Langkah 1: Menghapus referensi album pada foto**
// Foto yang terhubung dengan album ini akan diupdate sehingga tidak lagi memiliki referensi album
$query_foto = "UPDATE gallery_foto SET ALBUM_ID = NULL WHERE ALBUM_ID = '$album_id' AND USER_ID = '$user_id'";
mysqli_query($koneksi, $query_foto); // Jalankan query update

// **Langkah 2: Menghapus album dari database**
$query_album = "DELETE FROM gallery_album WHERE ALBUM_ID = '$album_id' AND USER_ID = '$user_id'";
if (mysqli_query($koneksi, $query_album)) {
    // Jika penghapusan berhasil, beri notifikasi dan arahkan ke daftar album
    echo "<script>alert('Album berhasil dihapus!'); window.location='album_list.php';</script>";
} else {
    // Jika penghapusan gagal, beri notifikasi gagal
    echo "<script>alert('Gagal menghapus album!'); window.location='album_list.php';</script>";
}
?>
