<?php
include('../koneksi.php');

// Ambil data dari form
$nama = $_POST['nama'];
$tempat_lahir = $_POST['tempat_lahir'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$nama_orang_tua = $_POST['nama_orang_tua'];
$keterangan = $_POST['keterangan'];
$nomor_surat = $_POST['nomor_surat'];
$validasi = "Belum Disetujui";

// Generate ID surat unik
$id_surat = uniqid('SKET-');

// Data untuk surat_keluar
$jenis_surat = "Surat Keterangan";
$tanggal_keluar = date("Y-m-d");
$tujuan_surat = "Surat Keterangan ";
$perihal = "Surat Keterangan";
$nomor_surat = $nomor_surat; // Bisa diisi manual nanti jika ada penomoran

// Insert ke surat_keluar
$insert_keluar = mysqli_query($koneksi, "
  INSERT INTO surat_keluar (
    id_surat, jenis_surat, tanggal_keluar, tujuan_surat, perihal, nomor_surat
  ) VALUES (
    '$id_surat', '$jenis_surat', '$tanggal_keluar', '$tujuan_surat', '$perihal', '$nomor_surat'
  )
");

if (!$insert_keluar) {
  echo "<script>
          alert('Gagal menyimpan ke surat_keluar: " . mysqli_error($koneksi) . "');
          window.history.back();
        </script>";
  exit;
}

// Insert ke surat_keterangan
$query = mysqli_query($koneksi, "
  INSERT INTO surat_keterangan (
    id_surat, nama, tempat_lahir, tanggal_lahir, nama_orang_tua, keterangan, validasi, nomor_surat
  ) VALUES (
    '$id_surat', '$nama', '$tempat_lahir', '$tanggal_lahir', '$nama_orang_tua', '$keterangan', '$validasi', '$nomor_surat'
  )
");

if ($query) {
  echo "<script>
          alert('Data berhasil ditambahkan!');
          window.location.href = '../?page=surat-keterangan/index';
        </script>";
} else {
  echo "<script>
          alert('Gagal menyimpan ke surat_keterangan: " . mysqli_error($koneksi) . "');
          window.history.back();
        </script>";
}
?>
