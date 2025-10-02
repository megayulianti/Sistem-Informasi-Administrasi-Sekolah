<?php
include('../koneksi.php');

$id = $_POST['id_surat_aktif'];
$validasi = $_POST['validasi'];

// Update status validasi
$query = mysqli_query($koneksi, "UPDATE surat_aktif SET validasi = '$validasi' WHERE id_surat_aktif = '$id'");

if ($query) {
    echo "<script>
        alert('Data berhasil diperbarui!');
        window.location.href = '../?page=surat-aktif/index';
    </script>";
} else {
    echo "<script>
        alert('Gagal memperbarui data!');
        window.location.href = '../?page=surat-aktif/index';
    </script>";
}
?>
