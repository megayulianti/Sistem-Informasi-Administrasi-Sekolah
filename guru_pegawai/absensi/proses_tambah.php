<?php
session_start();
include '../../koneksi.php';

$nip = $_POST['nip'];
$nama = $_POST['nama'];
$status = $_POST['status_kehadiran'];

date_default_timezone_set('Asia/Jakarta');
$tanggal = date('Y-m-d');
$jam = date('H:i:s');

// Cek apakah sudah absen hari ini
$cek = mysqli_query($koneksi, "SELECT * FROM absensi WHERE nip='$nip' AND tanggal='$tanggal'");
if (mysqli_num_rows($cek) > 0) {
    echo "<script>alert('Anda sudah absen hari ini!');window.location='../index.php?page=absensi/index';</script>";
    exit;
}

// Simpan ke database
$simpan = mysqli_query($koneksi, "INSERT INTO absensi (nip, nama, tanggal, jam, status_kehadiran) VALUES 
('$nip', '$nama', '$tanggal', '$jam', '$status')");

if ($simpan) {
    echo "<script>alert('Absensi berhasil disimpan.');window.location='../index.php?page=absensi/index';</script>";
} else {
    echo "<script>alert('Gagal menyimpan data.');window.history.back();</script>";
}
?>
