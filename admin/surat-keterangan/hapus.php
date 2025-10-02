<?php
include('../../koneksi.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus data dari database
    $query = mysqli_query($koneksi, "DELETE FROM surat_keterangan WHERE id_surat_keterangan = '$id'");

    if ($query) {
        echo "<script>
                alert('Data berhasil dihapus.');
                window.location.href = '../?page=surat-keterangan/index';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Gagal menghapus data.');
                window.location.href = '../?page=surat-keterangan/index';
              </script>";
        exit();
    }
} else {
    echo "<script>
            alert('ID tidak ditemukan.');
            window.location.href = '../?page=surat-keterangan/index';
          </script>";
    exit();
}
?>
