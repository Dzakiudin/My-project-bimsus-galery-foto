<?php
// Memulai sesi untuk memastikan pengguna telah login
session_start();

// Menghubungkan ke database
include 'koneksi.php';

// Jika sesi user belum ada, arahkan pengguna ke halaman login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Menangani form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id']; // Mengambil ID user dari session
    $nama_album = mysqli_real_escape_string($koneksi, $_POST['nama_album']); // Sanitasi input nama album
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']); // Sanitasi input deskripsi
    $tanggal_dibuat = date('Y-m-d'); // Mengambil tanggal saat ini

    // Query untuk menambahkan album baru ke database
    $query = "INSERT INTO gallery_album (USER_ID, NAMAALBUM, DESKRIPIS, TANGGALDIBUAT) 
              VALUES ('$user_id', '$nama_album', '$deskripsi', '$tanggal_dibuat')";

    // Menjalankan query dan memberikan notifikasi berdasarkan hasilnya
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Album berhasil ditambahkan!'); window.location='album_list.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan album!'); window.location='album_create.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Album - Galeri Foto</title>
    <!-- Menggunakan Bootstrap untuk tampilan yang lebih menarik -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>
    <!-- Container untuk form -->
    <div class="container mt-5">
        <h2 class="text-center">Tambah Album</h2>
        <!-- Form untuk menambahkan album -->
        <form method="POST" action="">
            <!-- Input untuk nama album -->
            <div class="mb-3">
                <label for="nama_album" class="form-label">Nama Album</label>
                <input type="text" class="form-control" id="nama_album" name="nama_album" required>
            </div>
            <!-- Input untuk deskripsi album -->
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
            </div>
            <!-- Tombol untuk menyimpan dan batal -->
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="album_list.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
    <!-- Bootstrap JS -->
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>