<?php
session_start();
include '../koneksi.php';

// Validasi ID user ada dan berupa angka
if (isset($_GET['id_user']) && is_numeric($_GET['id_user'])) {
    $id_user = intval($_GET['id_user']); // Hindari SQL injection

    // Eksekusi query hapus
    $query = mysqli_query($koneksi, "DELETE FROM user WHERE id_user = $id_user");

    if ($query) {
        echo "<script>
            alert('Data user berhasil dihapus!');
            window.location.href = '../?page=user/index';
        </script>";
    } else {
        $error = addslashes(mysqli_error($koneksi));
        echo "<script>
            alert('Gagal menghapus data user: $error');
            window.history.back();
        </script>";
    }
} else {
    echo "<script>
        alert('ID user tidak valid!');
        window.history.back();
    </script>";
}
?>
