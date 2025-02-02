<?php
session_start();
include 'koneksi.php';

$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = mysqli_real_escape_string($koneksi, $_POST['password']);

$query = "SELECT * FROM gallery_user WHERE USERNAME = '$username'";
$result = mysqli_query($koneksi, $query);
$user = mysqli_fetch_assoc($result);

if ($user && password_verify($password, $user['PASSWORD'])) {
    $_SESSION['user_id'] = $user['USER_ID'];
    $_SESSION['username'] = $user['USERNAME'];
    echo "<script>alert('Login berhasil!'); window.location='index.php';</script>";
} else {
    echo "<script>alert('Username atau password salah!'); window.location='login.php';</script>";
}
?>