<?php

session_start();
$_SESSION['save_success'] = 'Data berhasil disimpan!';

// sisipkan file koneksi
include "../koneksi.php";

// Ambil data dari form
$judul_berita = $_POST['judul_berita'];
$isi_berita = $_POST['isi_berita'];
$tanggal_publikasi = $_POST['tanggal_publikasi'];
$gambar_berita = $_FILES['gambar_berita']['name'];

// Upload file gambar
move_uploaded_file($_FILES['gambar_berita']['tmp_name'], "gambar_berita/$gambar_berita");

// query insert ke database
$tambah = mysqli_query($koneksi, "INSERT INTO berita (judul_berita, isi_berita, gambar_berita, tanggal_publikasi) 
VALUES ('$judul_berita', '$isi_berita', '$gambar_berita', '$tanggal_publikasi')");

if ($tambah) {
    // jika query berhasil
    echo "<script>
    window.location.href='../?page=berita/index'
    </script>";
} else {
    // jika query gagal
    echo "<script>
    window.location.href='../?page=berita/tambah'
    </script>";
}

?>
