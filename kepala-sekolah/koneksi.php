<?php

$koneksi = mysqli_connect("localhost", "root", "", "tu-sekolah");

// // Check connection
// if (!$koneksi) {
//     die("Connection failed: " . mysqli_connect_error());
// 
$absensi_count = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM absensi"))['count'];
$surat_aktif_count = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM surat_aktif"))['count'];
$surat_keterangan_count = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM surat_keterangan"))['count'];
$surat_masuk_count = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM surat_masuk"))['count'];
$surat_keluar_count = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM surat_keluar"))['count'];
?>