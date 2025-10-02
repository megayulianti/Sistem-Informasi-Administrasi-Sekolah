-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Jul 2025 pada 15.23
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
-- Database: `tu-sekolah`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `id_absensi` int(11) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `status_kehadiran` enum('Hadir','Izin','Sakit','Alpha') NOT NULL,
  `status` enum('guru','pegawai','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `absensi`
--

INSERT INTO `absensi` (`id_absensi`, `nip`, `nama`, `tanggal`, `jam`, `status_kehadiran`, `status`) VALUES
(1, '1111', 'melati', '2025-07-10', '23:48:33', 'Hadir', 'guru');

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru_pegawai`
--

CREATE TABLE `guru_pegawai` (
  `nip` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `status` enum('guru','pegawai') NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `guru_pegawai`
--

INSERT INTO `guru_pegawai` (`nip`, `nama`, `email`, `no_hp`, `alamat`, `jabatan`, `status`, `password`) VALUES
('1111', 'melati', 'melati@gmail.com', '081234567', 'padang pariaman', 'Guru IPA', 'guru', '$2y$10$nx81Qcz4CPE0HK/aAWBfQ.eKVQ7UoZE.mjsPKz6D14tawCaAX4aYC');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_aktif`
--

CREATE TABLE `surat_aktif` (
  `id_surat_aktif` int(11) NOT NULL,
  `id_surat` int(11) DEFAULT NULL,
  `nama_guru` varchar(100) DEFAULT NULL,
  `nip` varchar(30) DEFAULT NULL,
  `pangkat_golongan` varchar(50) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `instansi` varchar(100) DEFAULT NULL,
  `npsn` varchar(20) DEFAULT NULL,
  `nama_siswa` varchar(100) DEFAULT NULL,
  `tempat_tanggal_lahir` varchar(100) DEFAULT NULL,
  `nisn` varchar(20) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `kelas` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `sekolah` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `keterangan` text NOT NULL,
  `validasi` enum('belum disetujui','disetujui','tidak disetujui','') NOT NULL,
  `nomor_surat` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `surat_aktif`
--

INSERT INTO `surat_aktif` (`id_surat_aktif`, `id_surat`, `nama_guru`, `nip`, `pangkat_golongan`, `jabatan`, `instansi`, `npsn`, `nama_siswa`, `tempat_tanggal_lahir`, `nisn`, `jenis_kelamin`, `kelas`, `alamat`, `sekolah`, `no_hp`, `keterangan`, `validasi`, `nomor_surat`) VALUES
(3, 0, 'zai', '4324', 'guru', 'kepala sekolah', 'sma 1 sungai limau', '32423', 'budiman', 'padang/12-09-2001', '3423', 'Laki-laki', 'x.4', 'padang', 'sma 1 sungai limau', '0895676756', 'fndfhidhif', 'disetujui', '12/sma/12/vc'),
(4, 0, 'ema watson, skom', '123123', 'kepala sekolah', 'kepala sekolah', 'SMAN 1 Sungai Limau', '657567', 'resti', 'padang/12-08-2006', '5645', 'Laki-laki', 'XI.9', 'pariaman', 'SMAN 1 Sungai Limau', '0878675675', 'di pindahkan sekolah kerana urusan orang tua', 'disetujui', '12/34gf/56g'),
(5, 0, 'yuli', '556576', 'kepala sekolah', 'kepala sekolah', 'sman 1 sungai limau', '676767', 'lala', 'padang/26-01-2008', '435345', 'Perempuan', 'X.1', 'padang', 'sman 1 sungai limau', '085456456', 'bahwasanya siswa ini siswa aktif di sekolah', 'disetujui', '12/ew/sma/2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_keluar`
--

CREATE TABLE `surat_keluar` (
  `id_surat` int(11) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `nomor_surat` varchar(100) NOT NULL,
  `tujuan_surat` varchar(255) DEFAULT NULL,
  `perihal` varchar(255) DEFAULT NULL,
  `jenis_surat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `surat_keluar`
--

INSERT INTO `surat_keluar` (`id_surat`, `tanggal_keluar`, `nomor_surat`, `tujuan_surat`, `perihal`, `jenis_surat`) VALUES
(3, '2025-04-02', '12/sma/12/vc', 'Surat Keterangan Aktif Siswa', 'Surat Keterangan Aktif Siswa', 'Surat Aktif'),
(12, '2025-05-14', '45/gf/54', 'Surat Keterangan ', 'Surat Keterangan', 'Surat Keterangan'),
(14, '2025-05-14', 'fdf/768/hhj', 'Surat Keterangan ', 'Surat Keterangan', 'Surat Keterangan'),
(15, '2025-05-28', '12/34gf/56g', 'Surat Keterangan Aktif Siswa', 'Surat Keterangan Aktif Siswa', 'Surat Aktif'),
(17, '2025-05-28', '43/bcv/r4', 'Surat Keterangan ', 'Surat Keterangan', 'Surat Keterangan'),
(18, '2025-05-29', '12/ew/sma/2', 'Surat Keterangan Aktif Siswa', 'Surat Keterangan Aktif Siswa', 'Surat Aktif'),
(20, '2025-05-29', '324/sf/3', 'Surat Keterangan ', 'Surat Keterangan', 'Surat Keterangan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_keterangan`
--

CREATE TABLE `surat_keterangan` (
  `id_surat_keterangan` int(11) NOT NULL,
  `id_surat` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `nama_orang_tua` varchar(100) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `validasi` enum('belum disetujui','disetujui','tidak disetujui','') NOT NULL,
  `nomor_surat` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `surat_keterangan`
--

INSERT INTO `surat_keterangan` (`id_surat_keterangan`, `id_surat`, `nama`, `tempat_lahir`, `tanggal_lahir`, `nama_orang_tua`, `keterangan`, `validasi`, `nomor_surat`) VALUES
(4, 0, 'dfgdfg', 'dsfd', '2025-05-14', 'fdf', 'fsfdsfs', 'disetujui', 'fdf/768/hhj');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `id_surat_masuk` int(11) NOT NULL,
  `tgl_masuk` date DEFAULT NULL,
  `perihal` varchar(255) DEFAULT NULL,
  `nomor_surat` varchar(100) DEFAULT NULL,
  `asal_surat` varchar(50) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `upload_file` varchar(255) DEFAULT NULL,
  `tgl_surat` date NOT NULL,
  `nip` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `surat_masuk`
--

INSERT INTO `surat_masuk` (`id_surat_masuk`, `tgl_masuk`, `perihal`, `nomor_surat`, `asal_surat`, `keterangan`, `upload_file`, `tgl_surat`, `nip`) VALUES
(6, '2025-05-13', 'ACARA PENDIDIKAN', 'SMA1/001/PG', 'DInas Pendidikan', NULL, '20250712223956_4.2.2.pdf', '2025-05-13', '121212'),
(9, '2025-07-13', 'pendidikan', '56456', 'dinas kebudaaan', NULL, '20250712224014_Soal_E.pdf', '2025-07-12', '54546');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `level` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama_lengkap`, `level`, `foto`) VALUES
(4, 'admin', 'admin', 'admin', 'admin', 'IMG_6694.JPG'),
(6, 'ks', '123', 'kepala sekolah', 'ks', '133761608204091960.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absensi`);

--
-- Indeks untuk tabel `guru_pegawai`
--
ALTER TABLE `guru_pegawai`
  ADD PRIMARY KEY (`nip`);

--
-- Indeks untuk tabel `surat_aktif`
--
ALTER TABLE `surat_aktif`
  ADD PRIMARY KEY (`id_surat_aktif`);

--
-- Indeks untuk tabel `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD PRIMARY KEY (`id_surat`);

--
-- Indeks untuk tabel `surat_keterangan`
--
ALTER TABLE `surat_keterangan`
  ADD PRIMARY KEY (`id_surat_keterangan`);

--
-- Indeks untuk tabel `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD PRIMARY KEY (`id_surat_masuk`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `surat_aktif`
--
ALTER TABLE `surat_aktif`
  MODIFY `id_surat_aktif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `surat_keluar`
--
ALTER TABLE `surat_keluar`
  MODIFY `id_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `surat_keterangan`
--
ALTER TABLE `surat_keterangan`
  MODIFY `id_surat_keterangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `surat_masuk`
--
ALTER TABLE `surat_masuk`
  MODIFY `id_surat_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
