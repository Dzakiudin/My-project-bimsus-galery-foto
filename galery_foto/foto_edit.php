<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$foto_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Ambil data foto berdasarkan ID
$query = "SELECT * FROM gallery_foto WHERE FOTO_ID = '$foto_id' AND USER_ID = '$user_id'";
$result = mysqli_query($koneksi, $query);
$foto = mysqli_fetch_assoc($result);

// Ambil data album untuk dropdown
$albums = mysqli_query($koneksi, "SELECT * FROM gallery_album WHERE USER_ID = '$user_id'");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul_foto = mysqli_real_escape_string($koneksi, $_POST['judul_foto']);
    $deskripsi_foto = mysqli_real_escape_string($koneksi, $_POST['deskripsi_foto']);
    $album_id = mysqli_real_escape_string($koneksi, $_POST['album_id']);

    $update_query = "UPDATE gallery_foto SET JUDULFOTO = '$judul_foto', DESKRIPSIFOTO = '$deskripsi_foto', ALBUM_ID = '$album_id' WHERE FOTO_ID = '$foto_id'";

    if (mysqli_query($koneksi, $update_query)) {
        echo "<script>alert('Foto berhasil diperbarui!'); window.location='foto_list.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui foto!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Foto - Galeri Foto</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Edit Foto</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="judul_foto" class="form-label">Judul Foto</label>
                <input type="text" class="form-control" id="judul_foto" name="judul_foto"
                    value="<?= $foto['JUDULFOTO'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi_foto" class="form-label">Deskripsi Foto</label>
                <textarea class="form-control" id="deskripsi_foto" name="deskripsi_foto" rows="3"
                    required><?= $foto['DESKRIPSIFOTO'] ?></textarea>
            </div>
            <div class="mb-3">
                <label for="album_id" class="form-label">Album</label>
                <select class="form-select" id="album_id" name="album_id" required>
                    <option value="">Pilih Album</option>
                    <?php while ($album = mysqli_fetch_assoc($albums)) { ?>
                        <option value="<?= $album['ALBUM_ID'] ?>" <?= $album['ALBUM_ID'] == $foto['ALBUM_ID'] ? 'selected' : '' ?>><?= $album['NAMAALBUM'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="foto_list.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>