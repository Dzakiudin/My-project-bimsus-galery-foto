-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Feb 2025 pada 02.42
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `galery`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `gallerylike_foto`
--

CREATE TABLE `gallerylike_foto` (
  `LIKE_ID` int(11) NOT NULL,
  `FOTO_ID` int(11) DEFAULT NULL,
  `USER_ID` int(11) DEFAULT NULL,
  `TANGGAL_LIKE` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `gallerylike_foto`
--

INSERT INTO `gallerylike_foto` (`LIKE_ID`, `FOTO_ID`, `USER_ID`, `TANGGAL_LIKE`) VALUES
(17, 12, 6, '2024-12-05'),
(18, 12, 5, '2024-12-05'),
(21, 14, 5, '2024-12-05'),
(31, 13, 6, '2024-12-08'),
(51, 13, 7, '2024-12-08'),
(52, 15, 7, '2024-12-08'),
(55, 15, 6, '2024-12-09'),
(56, 15, 5, '2024-12-09'),
(59, 15, 10, '2024-12-09'),
(60, 16, 5, '2024-12-10'),
(61, 17, 11, '2024-12-10'),
(62, 17, 5, '2024-12-10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gallery_album`
--

CREATE TABLE `gallery_album` (
  `ALBUM_ID` int(11) NOT NULL,
  `USER_ID` int(11) DEFAULT NULL,
  `NAMAALBUM` varchar(255) DEFAULT NULL,
  `DESKRIPIS` varchar(255) DEFAULT NULL,
  `TANGGALDIBUAT` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `gallery_album`
--

INSERT INTO `gallery_album` (`ALBUM_ID`, `USER_ID`, `NAMAALBUM`, `DESKRIPIS`, `TANGGALDIBUAT`) VALUES
(10, 6, 'album fajril', 'punya fajril', '2024-12-05'),
(12, 7, 'my album', 'punya ku', '2024-12-08'),
(13, 11, 'test', 'my album', '2024-12-10'),
(14, 5, 'satu', 'test', '2024-12-10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gallery_foto`
--

CREATE TABLE `gallery_foto` (
  `FOTO_ID` int(11) NOT NULL,
  `USER_ID` int(11) DEFAULT NULL,
  `ALBUM_ID` int(11) DEFAULT NULL,
  `JUDULFOTO` varchar(255) DEFAULT NULL,
  `DESKRIPSIFOTO` varchar(255) DEFAULT NULL,
  `TANGGALUNGGAH` date DEFAULT NULL,
  `LOKASIFILE` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `gallery_foto`
--

INSERT INTO `gallery_foto` (`FOTO_ID`, `USER_ID`, `ALBUM_ID`, `JUDULFOTO`, `DESKRIPSIFOTO`, `TANGGALUNGGAH`, `LOKASIFILE`) VALUES
(12, 5, NULL, 'zaki', 'my bro', '2024-12-05', '6962432c-5d7e-4f28-bc99-ed8cf834e2d4.jpg'),
(13, 6, 10, 'fajril', 'my boy', '2024-12-05', 'ball-7650831_1280.webp'),
(14, 5, NULL, 'pap KONTOL', 'mau nyempongin ga?', '2024-12-05', 'id-11110103-6ke14-lkzqcnzchp0v3a.16000051693253453.mp4'),
(15, 7, 12, 'ardy', '123.....', '2024-12-08', '6962432c-5d7e-4f28-bc99-ed8cf834e2d4.jpg'),
(16, 5, NULL, 'yo watsap', 'halo gess', '2024-12-09', 'HERO K (83).jpg'),
(17, 11, 13, 'abdurrahman satu', 'halo gessss', '2024-12-10', '6962432c-5d7e-4f28-bc99-ed8cf834e2d4.jpg'),
(18, 5, 14, '12', '21', '2024-12-10', 'ball-7650831_1280.webp');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gallery_komentar_foto`
--

CREATE TABLE `gallery_komentar_foto` (
  `KOMENTARID` int(11) NOT NULL,
  `FOTO_ID` int(11) DEFAULT NULL,
  `USER_ID` int(11) DEFAULT NULL,
  `ISIKOMENTAR` text DEFAULT NULL,
  `TANGGALKOMENTAR` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `gallery_komentar_foto`
--

INSERT INTO `gallery_komentar_foto` (`KOMENTARID`, `FOTO_ID`, `USER_ID`, `ISIKOMENTAR`, `TANGGALKOMENTAR`) VALUES
(21, 12, 6, 'mantap boys', '2024-12-05'),
(22, 12, 5, 'yeah thanks boy', '2024-12-05'),
(23, 13, 6, 'yosh\r\n', '2024-12-05'),
(24, 13, 5, 'GG boy', '2024-12-05'),
(25, 12, 6, 'hahaha', '2024-12-05'),
(26, 13, 5, 'yess sirr', '2024-12-05'),
(27, 13, 7, 'gimana?\r\n', '2024-12-05'),
(28, 15, 7, 'haloo', '2024-12-08'),
(29, 13, 7, 'test', '2024-12-08'),
(30, 15, 7, 'test', '2024-12-08'),
(31, 15, 7, 'test', '2024-12-08'),
(32, 15, 7, 'yes sirr\r\n', '2024-12-08'),
(33, 15, 7, 'test', '2024-12-08'),
(34, 15, 8, 'gg lu', '2024-12-09'),
(35, 15, 6, 'test', '2024-12-09'),
(36, 15, 5, 'test', '2024-12-09'),
(37, 13, 5, 'test', '2024-12-09'),
(38, 16, 5, 'test', '2024-12-09'),
(39, 16, 5, 'mantap cuy', '2024-12-09'),
(40, 15, 10, 'kontol bapak kau ecah', '2024-12-09'),
(41, 16, 7, 'GG  BANGGG', '2024-12-10'),
(42, 17, 11, 'haloo gess', '2024-12-10'),
(43, 17, 5, 'test', '2024-12-10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gallery_user`
--

CREATE TABLE `gallery_user` (
  `USER_ID` int(11) NOT NULL,
  `USERNAME` varchar(255) DEFAULT NULL,
  `PASSWORD` varchar(255) DEFAULT NULL,
  `EMAIL` varchar(255) DEFAULT NULL,
  `NAMALENGKAP` varchar(255) DEFAULT NULL,
  `ALAMAT` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `gallery_user`
--

INSERT INTO `gallery_user` (`USER_ID`, `USERNAME`, `PASSWORD`, `EMAIL`, `NAMALENGKAP`, `ALAMAT`) VALUES
(5, 'zaki', '$2y$10$/oZyXJygcD6r4qX0tWKk4OTkNKjZtDy1zcQrPX6b141nEwhrq5itG', '123@gmail.com', NULL, NULL),
(6, 'fajril', '$2y$10$76CffJFAvNtqCLdSBnI5OuOeAukTXTKXQZ0FA10VqNNDNdA9bhIeK', '123@gmail.com', NULL, NULL),
(7, 'ardy', '$2y$10$jsGZWgAizNYI/sJFCy9st.f45sCMPgWfIwCIQnYtstS3qYu46U0Gy', 'ardy@gmail.com', NULL, NULL),
(8, 'test', '$2y$10$NKIqzPe.m/JV/EJMiOBBU.zqSAsLyuaH2NMYVzggpwcGVPEwbmVau', 'test@gmail.com', NULL, NULL),
(9, 'Fajril', '$2y$10$nckpis0dT92Oiw2jrO1ShejxbvG20mnhvibYaeXD1XqNAGsh9DgWG', 'haha@gmail.com', NULL, NULL),
(10, 'admin', '$2y$10$h8vSEh1bSxi/303hNKlCoe0x7ZqKQpdnwny6IGQ1c1iXmyFhX6g9m', '123@gmail.com', NULL, NULL),
(11, 'abdol', '$2y$10$QyFKmFa6qlXHoxO365SX1uddTSEm0MUTtSgNlDgc9dTL5yqdiKESe', 'test@gmail.com', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `gallerylike_foto`
--
ALTER TABLE `gallerylike_foto`
  ADD PRIMARY KEY (`LIKE_ID`),
  ADD KEY `FK_RELATIONSHIP_6` (`USER_ID`),
  ADD KEY `FK_RELATIONSHIP_7` (`FOTO_ID`);

--
-- Indeks untuk tabel `gallery_album`
--
ALTER TABLE `gallery_album`
  ADD PRIMARY KEY (`ALBUM_ID`),
  ADD KEY `FK_RELATIONSHIP_1` (`USER_ID`);

--
-- Indeks untuk tabel `gallery_foto`
--
ALTER TABLE `gallery_foto`
  ADD PRIMARY KEY (`FOTO_ID`),
  ADD KEY `FK_RELATIONSHIP_2` (`ALBUM_ID`),
  ADD KEY `FK_RELATIONSHIP_3` (`USER_ID`);

--
-- Indeks untuk tabel `gallery_komentar_foto`
--
ALTER TABLE `gallery_komentar_foto`
  ADD PRIMARY KEY (`KOMENTARID`),
  ADD KEY `FK_RELATIONSHIP_4` (`FOTO_ID`),
  ADD KEY `FK_RELATIONSHIP_5` (`USER_ID`);

--
-- Indeks untuk tabel `gallery_user`
--
ALTER TABLE `gallery_user`
  ADD PRIMARY KEY (`USER_ID`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `gallerylike_foto`
--
ALTER TABLE `gallerylike_foto`
  MODIFY `LIKE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT untuk tabel `gallery_album`
--
ALTER TABLE `gallery_album`
  MODIFY `ALBUM_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `gallery_foto`
--
ALTER TABLE `gallery_foto`
  MODIFY `FOTO_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `gallery_komentar_foto`
--
ALTER TABLE `gallery_komentar_foto`
  MODIFY `KOMENTARID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT untuk tabel `gallery_user`
--
ALTER TABLE `gallery_user`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `gallerylike_foto`
--
ALTER TABLE `gallerylike_foto`
  ADD CONSTRAINT `FK_RELATIONSHIP_6` FOREIGN KEY (`USER_ID`) REFERENCES `gallery_user` (`USER_ID`),
  ADD CONSTRAINT `FK_RELATIONSHIP_7` FOREIGN KEY (`FOTO_ID`) REFERENCES `gallery_foto` (`FOTO_ID`);

--
-- Ketidakleluasaan untuk tabel `gallery_album`
--
ALTER TABLE `gallery_album`
  ADD CONSTRAINT `FK_RELATIONSHIP_1` FOREIGN KEY (`USER_ID`) REFERENCES `gallery_user` (`USER_ID`);

--
-- Ketidakleluasaan untuk tabel `gallery_foto`
--
ALTER TABLE `gallery_foto`
  ADD CONSTRAINT `FK_RELATIONSHIP_2` FOREIGN KEY (`ALBUM_ID`) REFERENCES `gallery_album` (`ALBUM_ID`),
  ADD CONSTRAINT `FK_RELATIONSHIP_3` FOREIGN KEY (`USER_ID`) REFERENCES `gallery_user` (`USER_ID`);

--
-- Ketidakleluasaan untuk tabel `gallery_komentar_foto`
--
ALTER TABLE `gallery_komentar_foto`
  ADD CONSTRAINT `FK_RELATIONSHIP_4` FOREIGN KEY (`FOTO_ID`) REFERENCES `gallery_foto` (`FOTO_ID`),
  ADD CONSTRAINT `FK_RELATIONSHIP_5` FOREIGN KEY (`USER_ID`) REFERENCES `gallery_user` (`USER_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
