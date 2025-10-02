<?php
session_start();
include "../../koneksi.php";

// Ambil data dari form
$tgl_masuk = $_POST['tgl_masuk'];
$nomor_surat = $_POST['nomor_surat'];
$tgl_surat = $_POST['tgl_surat'];
$perihal = $_POST['perihal'];
$asal_surat = $_POST['asal_surat'];
$nip = $_POST['nip']; // tambahkan nip

// Konfigurasi upload file
$upload_dir = "../../uploads/"; 
$original_name = basename($_FILES['upload_file']['name']);
$upload_file = date('YmdHis') . '_' . $original_name;
$tmp_file = $_FILES['upload_file']['tmp_name'];
$upload_path = $upload_dir . $upload_file;

// Validasi ekstensi file
$allowed_extensions = ['pdf', 'doc', 'docx'];
$file_extension = strtolower(pathinfo($upload_file, PATHINFO_EXTENSION));

if (!in_array($file_extension, $allowed_extensions)) {
    echo "<script>
            alert('Hanya file PDF atau Word (.doc/.docx) yang diperbolehkan!');
            window.location.href = '../?page=surat-masuk/index';
          </script>";
    exit;
}

// Proses upload file dan simpan ke database
if (move_uploaded_file($tmp_file, $upload_path)) {
    $query = mysqli_query($koneksi, "INSERT INTO surat_masuk 
        (tgl_masuk, nomor_surat, tgl_surat, perihal, asal_surat, nip, upload_file) 
        VALUES 
        ('$tgl_masuk', '$nomor_surat', '$tgl_surat', '$perihal', '$asal_surat', '$nip', '$upload_file')");

    if ($query) {
        echo "<script>
                alert('Data berhasil ditambahkan!');
                window.location.href = '../?page=surat-masuk/index';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menyimpan data ke database!');
                window.location.href = '../?page=surat-masuk/index';
              </script>";
    }
} else {
    echo "<script>
            alert('Upload file gagal. Cek folder uploads!');
            window.location.href = '../?page=surat-masuk/index';
          </script>";
}
exit;
?>
