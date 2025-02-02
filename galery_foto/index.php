<?php
// Memulai sesi untuk memastikan pengguna telah login
session_start();

// Periksa apakah session 'user_id' sudah ada, jika tidak redirect ke halaman login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Menghubungkan ke database menggunakan file koneksi
include 'koneksi.php';

// Query SQL untuk mengambil data foto yang diunggah beserta informasi terkait
$query_foto = "SELECT f.FOTO_ID, f.JUDULFOTO, f.LOKASIFILE, f.TANGGALUNGGAH, a.NAMAALBUM, u.USERNAME, f.DESKRIPSIFOTO
               FROM gallery_foto f
               JOIN gallery_album a ON f.ALBUM_ID = a.ALBUM_ID
               JOIN gallery_user u ON f.USER_ID = u.USER_ID
               ORDER BY f.TANGGALUNGGAH DESC"; // Urutkan berdasarkan tanggal unggah terbaru
$foto_result = mysqli_query($koneksi, $query_foto); // Menjalankan query
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Foto</title>
    <link href="https://fonts.googleapis.com/css2?family=Comic+Sans+MS:wght@400&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Font Comic Sans MS tanpa bold */
        body {
            font-family: 'Comic Sans MS', sans-serif;
            background-color: #f8f9fa;
        }

        /* Navbar dengan warna gradasi yang cerah */
        nav {
            background-color: #ff6347 !important;
        }

        .navbar-brand, .nav-link {
            color: white !important;
        }

        .nav-link:hover {
            color: #ff4500 !important;
        }

        /* Card dengan desain cerah dan border radius */
        .card {
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            padding: 20px;
            background-color: #fff8e1;
            border-radius: 12px;
        }

        .card-img-top {
            border-radius: 12px 12px 0 0;
            max-height: 220px;
            object-fit: cover;
        }

        /* Tombol berwarna cerah dengan border-radius */
        .btn-outline-primary {
            border-radius: 20px;
            font-weight: normal;
            background-color: #ff6347;
            color: white;
            border: none;
            padding: 12px;
            transition: background-color 0.3s ease-in-out;
        }

        .btn-outline-primary:hover {
            background-color: #ff4500;
        }

        .komentar-section {
            max-height: 200px;
            overflow-y: auto;
            margin-top: 15px;
            background-color: #ffebee;
            padding: 10px;
            border-radius: 10px;
        }

        /* Styling untuk form komentar */
        .form-control {
            border-radius: 10px;
            margin-bottom: 10px;
            padding: 12px;
            background-color: #fce4ec;
        }

        /* Styling untuk card title dan text */
        .card-title {
            font-size: 18px;
            font-weight: normal;
            color: #3f51b5;
        }

        .card-text {
            font-size: 14px;
            color: #757575;
        }

        .text-muted {
            font-size: 12px;
        }

        .btn-primar{
            color: #f8f9fa;
            background-color: #ff4500;
        }

        /* Footer untuk halaman */
        footer {
            background-color: #ff6347;
            color: white;
            padding: 10px 0;
            text-align: center;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Web Galeri Foto</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- Menampilkan username jika user sudah login -->
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li class="nav-item">
                            <span class="nav-link text-light">Selamat datang, <?= $_SESSION['username']; ?>!</span>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="album_list.php">Album</a></li>
                    <li class="nav-item"><a class="nav-link" href="foto_list.php">Foto</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten utama -->
    <div class="container mt-5">
        <h2 class="text-center mb-4" style="color: #ff6347;">Galeri Foto</h2>

        <div class="row">
            <?php
            // Looping untuk menampilkan setiap foto dari hasil query
            while ($foto = mysqli_fetch_assoc($foto_result)) { ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <!-- Menampilkan gambar -->
                        <img src="uploads/<?= $foto['LOKASIFILE'] ?>" alt="<?= $foto['JUDULFOTO'] ?>" class="card-img-top">
                        <div class="card-body">
                            <!-- Menampilkan judul dan deskripsi foto -->
                            <h5 class="card-title"><?= $foto['JUDULFOTO'] ?></h5>
                            <p class="card-text"><?= $foto['DESKRIPSIFOTO'] ?></p>
                            <p class="text-muted">
                                <?= $foto['USERNAME'] ?> - <?= $foto['NAMAALBUM'] ?> | <?= $foto['TANGGALUNGGAH'] ?>
                            </p>

                            <!-- Bagian tombol Like -->
                            <?php
                            $foto_id = $foto['FOTO_ID'];
                            $query_like = "SELECT COUNT(*) AS total_like FROM gallerylike_foto WHERE FOTO_ID = '$foto_id'";
                            $like_result = mysqli_query($koneksi, $query_like);
                            $like_data = mysqli_fetch_assoc($like_result);
                            ?>
                            <button class="btn btn-outline-primary w-100" data-foto-id="<?= $foto_id ?>">
                                Like (<?= $like_data['total_like'] ?>)
                            </button>

                            <hr>

                            <!-- Bagian komentar -->
                            <div class="komentar-section">
                                <h6>Komentar:</h6>
                                <?php
                                // Menampilkan komentar terkait foto
                                $query_komentar = "SELECT k.ISIKOMENTAR, u.USERNAME, k.TANGGALKOMENTAR 
                                                   FROM gallery_komentar_foto k
                                                   JOIN gallery_user u ON k.USER_ID = u.USER_ID
                                                   WHERE k.FOTO_ID = '$foto_id' ORDER BY k.TANGGALKOMENTAR DESC";
                                $komentar_result = mysqli_query($koneksi, $query_komentar);
                                while ($komentar = mysqli_fetch_assoc($komentar_result)) {
                                    echo "<p><strong>{$komentar['USERNAME']}</strong>: {$komentar['ISIKOMENTAR']} ({$komentar['TANGGALKOMENTAR']})</p>";
                                }
                                ?>
                            </div>

                            <!-- Form untuk menambahkan komentar -->
                            <form method="POST" action="proses_komentar.php">
                                <input type="hidden" name="foto_id" value="<?= $foto_id ?>">
                                <textarea name="komentar" placeholder="Tambah komentar..." required
                                    class="form-control mb-2"></textarea>
                                <button type="submit" class="btn btn-primar w-100">Kirim</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Web Galeri Foto. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <script>
        // Menangani klik tombol Like
        document.querySelectorAll('.btn-outline-primary').forEach(button => {
            button.addEventListener('click', function () {
                const foto_id = this.getAttribute('data-foto-id');

                fetch('proses_like.php', {
                    method: 'POST',
                    body: new URLSearchParams({ 'foto_id': foto_id }),
                })
                    .then(response => response.text())
                    .then(data => {
                        alert(data); // Memberikan notifikasi
                        location.reload(); // Memuat ulang halaman untuk memperbarui jumlah Like
                    });
            });
        });
    </script>

</body>

</html>
