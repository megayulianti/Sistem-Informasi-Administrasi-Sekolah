<?php
include('../koneksi.php');

$id = $_POST['id_surat_keterangan'];
$validasi = $_POST['validasi'];

// Update status validasi
$query = mysqli_query($koneksi, "UPDATE surat_keterangan SET validasi = '$validasi' WHERE id_surat_keterangan = '$id'");

if ($query) {
    echo "<script>
        alert('Data berhasil diperbarui!');
        window.location.href = '../?page=surat-keterangan/index';
    </script>";
} else {
    echo "<script>
        alert('Gagal memperbarui data!');
        window.location.href = '../?page=surat-keterangan/index';
    </script>";
}
?>
