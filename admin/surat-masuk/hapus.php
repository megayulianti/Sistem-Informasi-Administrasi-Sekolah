<?php
session_start();
include "../../koneksi.php";

$id = $_GET['id'];

// Ambil nama file terlebih dahulu
$get = mysqli_query($koneksi, "SELECT upload_file FROM surat_masuk WHERE id_surat_masuk='$id'");
$data = mysqli_fetch_array($get);

if ($data) {
    $file_path = "../../uploads/" . $data['upload_file'];

    // Hapus file dari folder jika ada
    if (file_exists($file_path)) {
        unlink($file_path);
    }

    // Hapus data dari database
    $query = mysqli_query($koneksi, "DELETE FROM surat_masuk WHERE id_surat_masuk='$id'");

    if ($query) {
        echo "<script>
                alert('Data berhasil dihapus!');
                window.location.href = '../?page=surat-masuk/index';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus data!');
                window.location.href = '../?page=surat-masuk/index';
              </script>";
    }
} else {
    echo "<script>
            alert('Data tidak ditemukan!');
            window.location.href = '../?page=surat-masuk/index';
          </script>";
}
exit;
?>
