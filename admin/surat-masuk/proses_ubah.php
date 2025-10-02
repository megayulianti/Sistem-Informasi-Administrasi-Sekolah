<?php
session_start();
include "../../koneksi.php";

$id = $_POST['id_surat_masuk'];
$tgl_masuk = $_POST['tgl_masuk'];
$nomor_surat = $_POST['nomor_surat'];
$tgl_surat = $_POST['tgl_surat'];
$perihal = $_POST['perihal'];
$asal_surat = $_POST['asal_surat'];
$nip = $_POST['nip']; // Tambahan field nip

$upload_dir = "../../uploads/";
$allowed_extensions = ['pdf', 'doc', 'docx'];

$upload_file = $_FILES['upload_file']['name'];
$tmp_file = $_FILES['upload_file']['tmp_name'];

if ($upload_file != "") {
    $file_extension = strtolower(pathinfo($upload_file, PATHINFO_EXTENSION));

    if (!in_array($file_extension, $allowed_extensions)) {
        echo "<script>
                alert('Hanya file PDF atau Word (.doc/.docx) yang diperbolehkan!');
                window.location.href = '../?page=surat-masuk/index';
              </script>";
        exit;
    }

    // Bersihkan nama file dari karakter aneh (spasi, simbol, dll)
    $clean_name = preg_replace('/[^a-zA-Z0-9\._-]/', '_', $upload_file);
    $new_file_name = date('YmdHis') . '_' . $clean_name;
    $upload_path = $upload_dir . $new_file_name;

    if (move_uploaded_file($tmp_file, $upload_path)) {
        // Ambil file lama dari database
        $result = mysqli_query($koneksi, "SELECT upload_file FROM surat_masuk WHERE id_surat_masuk='$id'");
        $row = mysqli_fetch_assoc($result);
        $old_file = $row['upload_file'];

        // Hapus file lama jika ada dan eksis di folder
        if ($old_file && file_exists($upload_dir . $old_file)) {
            unlink($upload_dir . $old_file);
        }

        // Update data beserta file baru
        $query = mysqli_query($koneksi, "UPDATE surat_masuk SET 
            tgl_masuk='$tgl_masuk',
            nomor_surat='$nomor_surat',
            tgl_surat='$tgl_surat',
            perihal='$perihal',
            asal_surat='$asal_surat',
            nip='$nip',
            upload_file='$new_file_name'
            WHERE id_surat_masuk='$id'");
    } else {
        echo "<script>
                alert('Upload file gagal! Error code: {$_FILES['upload_file']['error']}');
                window.location.href = '../?page=surat-masuk/index';
              </script>";
        exit;
    }
} else {
    // Update data tanpa mengganti file
    $query = mysqli_query($koneksi, "UPDATE surat_masuk SET 
        tgl_masuk='$tgl_masuk',
        nomor_surat='$nomor_surat',
        tgl_surat='$tgl_surat',
        perihal='$perihal',
        asal_surat='$asal_surat',
        nip='$nip'
        WHERE id_surat_masuk='$id'");
}

// Feedback
if ($query) {
    echo "<script>
            alert('Data berhasil diperbarui!');
            window.location.href = '../?page=surat-masuk/index';
          </script>";
} else {
    echo "<script>
            alert('Gagal memperbarui data!');
            window.location.href = '../?page=surat-masuk/index';
          </script>";
}
exit;
?>
