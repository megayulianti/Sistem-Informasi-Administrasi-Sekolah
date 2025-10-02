<?php

session_start();
$_SESSION['update_success'] = 'Data berhasil ter update!';

// Sisipkan file koneksi
include "../koneksi.php";

// Ambil data dari form
$id_berita = $_POST['id_berita'];
$judul_berita = $_POST['judul_berita'];
$isi_berita = $_POST['isi_berita'];
$tanggal_publikasi = $_POST['tanggal_publikasi'];

$gambar_berita = $_FILES['gambar_berita']['name'];

if (!empty($gambar_berita)) {
    // Pindahkan file gambar yang diupload ke folder uploads
    move_uploaded_file($_FILES['gambar_berita']['tmp_name'], "gambar_berita/$gambar_berita");
    
    // Query untuk mengupdate data dengan gambar baru
    $sql = "UPDATE berita SET 
                judul_berita='$judul_berita', 
                isi_berita='$isi_berita', 
                gambar_berita='$gambar_berita', 
                tanggal_publikasi='$tanggal_publikasi' 
            WHERE id_berita='$id_berita'";
} else {
    // Query untuk mengupdate data tanpa mengganti gambar
    $sql = "UPDATE berita SET 
                judul_berita='$judul_berita', 
                isi_berita='$isi_berita', 
                tanggal_publikasi='$tanggal_publikasi' 
            WHERE id_berita='$id_berita'";
}

// Eksekusi query
$ubah = mysqli_query($koneksi, $sql);

// Jika query berhasil
if ($ubah) {
    echo "<script>
            alert('Data Berhasil Diupdate');
            window.location.href='../?page=berita/index';
          </script>";
} else {
    // Jika query gagal
    echo "<script>
            alert('Data Gagal Diupdate');
            window.location.href='../?page=berita/ubah&id_berita=$id_berita';
          </script>";
}
?>
