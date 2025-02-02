<?php
include 'koneksi.php';

$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$email = mysqli_real_escape_string($koneksi, $_POST['email']);
$password = mysqli_real_escape_string($koneksi, $_POST['password']);
$confirm_password = mysqli_real_escape_string($koneksi, $_POST['confirm_password']);

if ($password !== $confirm_password) {
    echo "<script>alert('Password tidak cocok!'); window.location='register.php';</script>";
    exit();
}

$hashed_password = password_hash($password, PASSWORD_BCRYPT);
$query = "INSERT INTO gallery_user (USERNAME, PASSWORD, EMAIL) VALUES ('$username', '$hashed_password', '$email')";

if (mysqli_query($koneksi, $query)) {
    echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location='login.php';</script>";
} else {
    echo "<script>alert('Registrasi gagal!'); window.location='register.php';</script>";
}
?>