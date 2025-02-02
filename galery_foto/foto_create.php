<?php
// Memulai sesi dan memastikan pengguna telah login
session_start();
include 'koneksi.php';

// Cek apakah pengguna telah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Jika belum login, arahkan ke halaman login
    exit();
}

// Ambil user_id dari session
$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data input dari form
    $album_id = mysqli_real_escape_string($koneksi, $_POST['album_id']);
    $judul_foto = mysqli_real_escape_string($koneksi, $_POST['judul_foto']);
    $deskripsi_foto = mysqli_real_escape_string($koneksi, $_POST['deskripsi_foto']);
    $tanggal_unggah = date('Y-m-d');

    // Mengambil informasi file upload
    $lokasi_file = $_FILES['file']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($lokasi_file);

    // Proses upload file
    if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
        // Query untuk memasukkan foto ke database
        $query = "INSERT INTO gallery_foto (USER_ID, ALBUM_ID, JUDULFOTO, DESKRIPSIFOTO, TANGGALUNGGAH, LOKASIFILE) 
                  VALUES ('$user_id', '$album_id', '$judul_foto', '$deskripsi_foto', '$tanggal_unggah', '$lokasi_file')";

        // Eksekusi query dan cek hasilnya
        if (mysqli_query($koneksi, $query)) {
            echo "<script>alert('Foto berhasil ditambahkan!'); window.location='foto_list.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan foto!'); window.location='foto_create.php';</script>";
        }
    } else {
        echo "<script>alert('Gagal mengunggah file!');</script>";
    }
}

// Ambil album yang tersedia untuk user saat ini
$albums = mysqli_query($koneksi, "SELECT * FROM gallery_album WHERE USER_ID = '$user_id'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Foto - Galeri Foto</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Tambah Foto</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="judul_foto" class="form-label">Judul Foto</label>
                <input type="text" class="form-control" id="judul_foto" name="judul_foto" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi_foto" class="form-label">Deskripsi Foto</label>
                <textarea class="form-control" id="deskripsi_foto" name="deskripsi_foto" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="album_id" class="form-label">Album</label>
                <select class="form-select" id="album_id" name="album_id" required>
                    <option value="">Pilih Album</option>
                    <?php
                    // Pastikan ada album yang tersedia untuk user
                    if (mysqli_num_rows($albums) > 0) {
                        while ($album = mysqli_fetch_assoc($albums)) {
                            echo "<option value='{$album['ALBUM_ID']}'>{$album['NAMAALBUM']}</option>";
                        }
                    } else {
                        echo "<option value=''>Belum ada album</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="file" class="form-label">Pilih File Foto</label>
                <input type="file" class="form-control" id="file" name="file" required>
            </div>
            <button type="submit" class="btn btn-primar">Simpan</button>
            <a href="foto_list.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>

    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>
