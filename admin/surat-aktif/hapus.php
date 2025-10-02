<?php
include('../koneksi.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $hapus = mysqli_query($koneksi, "DELETE FROM surat_aktif WHERE id_surat_aktif = '$id'");

    if ($hapus) {
        echo "<script>
            alert('Data berhasil dihapus.');
            window.location.href = '../?page=surat-aktif/index';
        </script>";
    } else {
        $error = addslashes(mysqli_error($koneksi));
        echo "<script>
            alert('Gagal menghapus data: $error');
            window.location.href = '../?page=surat-aktif/index';
        </script>";
    }
} else {
    echo "<script>
        alert('ID tidak ditemukan.');
        window.location.href = '../?page=surat-aktif/index';
    </script>";
}
?>
