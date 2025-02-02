<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$foto_id = $_POST['foto_id'];
$komentar = mysqli_real_escape_string($koneksi, $_POST['komentar']);

// Menyimpan komentar ke dalam database
$query_komentar = "INSERT INTO gallery_komentar_foto (FOTO_ID, USER_ID, ISIKOMENTAR, TANGGALKOMENTAR) 
                   VALUES ('$foto_id', '$user_id', '$komentar', NOW())";

if (mysqli_query($koneksi, $query_komentar)) {
    // Redirect ke halaman index setelah komentar berhasil
    header("Location: index.php");
    exit();  // Pastikan tidak ada eksekusi lebih lanjut setelah header
} else {
    // Menampilkan pesan error jika gagal
    echo "Gagal menambahkan komentar!";
}
?>