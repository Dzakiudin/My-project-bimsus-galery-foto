<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}

$user_id = $_SESSION['user_id'];
$query = "SELECT f.FOTO_ID, f.JUDULFOTO, f.DESKRIPSIFOTO, f.TANGGALUNGGAH, f.LOKASIFILE, a.NAMAALBUM, f.USER_ID
          FROM gallery_foto f 
          JOIN gallery_album a ON f.ALBUM_ID = a.ALBUM_ID";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Foto List - Galeri Foto</title>
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
      background: linear-gradient(to right, #ff7e5f, #feb47b);
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

    /* Styling untuk tabel */
    .table th, .table td {
      text-align: center;
    }

    .table-primary th {
      background-color: #ff6347;
      color: white;
    }

    .btn-primar {
      background-color: #ff6347;
      color: #f8f9fa;
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
          <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="album_list.php">Album</a></li>
          <li class="nav-item"><a class="nav-link active" href="foto_list.php">Foto</a></li>
          <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Kontainer untuk daftar foto -->
  <div class="container mt-5">
    <h2 class="text-center mb-4" style="color: #ff6347;">Daftar Foto</h2>
    <!-- Tombol untuk menambah foto baru -->
    <a href="foto_create.php" class="btn btn-primar mb-3">Tambah Foto</a>
    <!-- Tabel daftar foto -->
    <table class="table table-bordered">
      <thead class="table-primary">
        <tr>
          <th>No</th>
          <th>Judul Foto</th>
          <th>Deskripsi</th>
          <th>Album</th>
          <th>Tanggal Unggah</th>
          <th>Foto</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>
                        <td>{$no}</td>
                        <td>{$row['JUDULFOTO']}</td>
                        <td>{$row['DESKRIPSIFOTO']}</td>
                        <td>{$row['NAMAALBUM']}</td>
                        <td>{$row['TANGGALUNGGAH']}</td>
                        <td><img src='uploads/{$row['LOKASIFILE']}' alt='{$row['JUDULFOTO']}' width='100'></td>
                        <td>";
          // Batasi edit dan delete hanya untuk pemilik
          if ($user_id == $row['USER_ID']) {
            echo "<a href='foto_edit.php?id={$row['FOTO_ID']}' class='btn btn-warning btn-sm'>Edit</a>
                          <a href='foto_delete.php?id={$row['FOTO_ID']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus?\")'>Delete</a>";
          }
          echo "</td>
                      </tr>";
          $no++;
        }
        ?>
      </tbody>
    </table>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
