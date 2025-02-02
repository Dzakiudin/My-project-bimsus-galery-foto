<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$foto_id = $_POST['foto_id'];

// Cek apakah user sudah memberi like pada foto tersebut
$query_check_like = "SELECT * FROM gallerylike_foto WHERE USER_ID = '$user_id' AND FOTO_ID = '$foto_id'";
$check_like = mysqli_query($koneksi, $query_check_like);

if (mysqli_num_rows($check_like) == 0) {
    // Jika belum, simpan like baru
    $query_like = "INSERT INTO gallerylike_foto (USER_ID, FOTO_ID, TANGGAL_LIKE) 
                   VALUES ('$user_id', '$foto_id', NOW())";
    if (mysqli_query($koneksi, $query_like)) {
        echo "Like berhasil!";
    } else {
        echo "Gagal memberi like!";
    }
} else {
    // Jika sudah memberi like, hapus like
    $query_unlike = "DELETE FROM gallerylike_foto WHERE USER_ID = '$user_id' AND FOTO_ID = '$foto_id'";
    if (mysqli_query($koneksi, $query_unlike)) {
        echo "Like dibatalkan!";
    } else {
        echo "Gagal membatalkan like!";
    }
}
?>