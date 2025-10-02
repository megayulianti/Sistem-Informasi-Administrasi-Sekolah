<?php
session_start();
include '../../koneksi.php';

$nip = $_POST['nip'];
$password_baru = $_POST['password_baru'];
$konfirmasi_password = $_POST['konfirmasi_password'];

// Validasi konfirmasi password
if ($password_baru !== $konfirmasi_password) {
  echo "<script>alert('Konfirmasi password tidak cocok!');history.back();</script>";
  exit;
}

// Enkripsi password baru dengan password_hash (lebih aman daripada md5)
$password_hash = password_hash($password_baru, PASSWORD_DEFAULT);

// Update password ke database
mysqli_query($koneksi, "UPDATE guru_pegawai SET password='$password_hash' WHERE nip='$nip'");

// Notifikasi berhasil
echo "<script>alert('Password berhasil diubah!');window.location='../index.php?page=akun/index';</script>";
?>
