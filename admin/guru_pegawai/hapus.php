<?php
include '../koneksi.php';

if (isset($_GET['nip'])) {
    $nip = $_GET['nip'];

    $query = "DELETE FROM guru_pegawai WHERE nip = '$nip'";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data berhasil dihapus'); window.location.href='../?page=guru/index';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('NIP tidak ditemukan'); window.history.back();</script>";
}
?>
