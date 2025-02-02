<?php
// Memulai sesi untuk memastikan pengguna telah login
session_start();

// Menghubungkan ke database
include 'koneksi.php';

// Memastikan pengguna telah login sebelum mengedit album
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Jika belum login, arahkan ke halaman login
    exit();
}

// Mendapatkan ID album dari URL
$album_id = $_GET['id'];

// Mengambil data album berdasarkan ID untuk ditampilkan di form
$query = "SELECT * FROM gallery_album WHERE ALBUM_ID = '$album_id'";
$result = mysqli_query($koneksi, $query);
$album = mysqli_fetch_assoc($result); // Mengambil data album dalam bentuk array

// Memproses data form jika metode pengiriman adalah POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form
    $nama_album = mysqli_real_escape_string($koneksi, $_POST['nama_album']); // Mengamankan input nama album
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']); // Mengamankan input deskripsi

    // Query untuk memperbarui data album
    $update_query = "UPDATE gallery_album SET NAMAALBUM = '$nama_album', DESKRIPIS = '$deskripsi' WHERE ALBUM_ID = '$album_id'";
    if (mysqli_query($koneksi, $update_query)) {
        // Jika berhasil diperbarui, beri notifikasi dan arahkan ke halaman daftar album
        echo "<script>alert('Album berhasil diperbarui!'); window.location='album_list.php';</script>";
    } else {
        // Jika gagal, beri notifikasi kesalahan
        echo "<script>alert('Gagal memperbarui album!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Album - Galeri Foto</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Edit Album</h2>

        <!-- Form untuk mengedit data album -->
        <form method="POST">
            <!-- Input nama album -->
            <div class="mb-3">
                <label for="nama_album" class="form-label">Nama Album</label>
                <input type="text" class="form-control" id="nama_album" name="nama_album"
                    value="<?= $album['NAMAALBUM'] ?>" required> <!-- Menampilkan nama album saat ini -->
            </div>

            <!-- Input deskripsi album -->
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"
                    required><?= $album['DESKRIPIS'] ?></textarea>
                <!-- Menampilkan deskripsi saat ini -->
            </div>

            <!-- Tombol untuk submit atau batal -->
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="album_list.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>