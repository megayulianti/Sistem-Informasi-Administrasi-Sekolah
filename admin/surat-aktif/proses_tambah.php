<?php
include('../../koneksi.php');
session_start();

// Ambil data dari form
$id_surat         = $_POST['id_surat'] ?? null;
$nama_guru        = $_POST['nama_guru'];
$nip              = $_POST['nip'];
$pangkat_golongan = $_POST['pangkat_golongan'];
$jabatan          = $_POST['jabatan'];
$instansi         = $_POST['instansi'];
$npsn             = $_POST['npsn'];
$nama_siswa       = $_POST['nama_siswa'];
$tempat_tanggal_lahir = $_POST['tempat_tanggal_lahir'];
$nisn             = $_POST['nisn'];
$jenis_kelamin    = $_POST['jenis_kelamin'];
$kelas            = $_POST['kelas'];
$alamat           = $_POST['alamat'];
$sekolah          = $_POST['sekolah'];
$no_hp            = $_POST['no_hp'];
$keterangan       = $_POST['keterangan'];
$nomor_surat      = $_POST['nomor_surat'];
$validasi         = "Belum Disetujui";

// =======================
// CEK & INSERT SURAT_KELUAR
// =======================
$cek = mysqli_query($koneksi, "SELECT id_surat FROM surat_keluar WHERE id_surat = '$id_surat'");
if (mysqli_num_rows($cek) == 0) {
    $jenis_surat = 'Surat Aktif';
    $tujuan_surat = 'Surat Keterangan Aktif Siswa';
    $perihal = 'Surat Keterangan Aktif Siswa';
    $tanggal_keluar = date('Y-m-d');

    $insert_keluar = mysqli_query($koneksi, "
        INSERT INTO surat_keluar (
            id_surat, 
            jenis_surat, 
            tanggal_keluar, 
            tujuan_surat, 
            perihal, 
            nomor_surat
        ) VALUES (
            '$id_surat', 
            '$jenis_surat', 
            '$tanggal_keluar', 
            '$tujuan_surat', 
            '$perihal', 
            '$nomor_surat'
        )
    ");

    if (!$insert_keluar) {
        $error = addslashes(mysqli_error($koneksi));
        echo "<script>
            alert('Gagal menyimpan ke surat_keluar: $error');
            window.history.back();
        </script>";
        exit;
    }
}

// =======================
// INSERT SURAT_AKTIF
// =======================
$query = mysqli_query($koneksi, "
  INSERT INTO surat_aktif (
    id_surat,
    nomor_surat,
    nama_guru,
    nip,
    pangkat_golongan,
    jabatan,
    instansi,
    npsn,
    nama_siswa,
    tempat_tanggal_lahir,
    nisn,
    jenis_kelamin,
    kelas,
    alamat,
    sekolah,
    no_hp,
    keterangan,
    validasi
  ) VALUES (
    '$id_surat',
    '$nomor_surat',
    '$nama_guru',
    '$nip',
    '$pangkat_golongan',
    '$jabatan',
    '$instansi',
    '$npsn',
    '$nama_siswa',
    '$tempat_tanggal_lahir',
    '$nisn',
    '$jenis_kelamin',
    '$kelas',
    '$alamat',
    '$sekolah',
    '$no_hp',
    '$keterangan',
    '$validasi'
  )
");

if ($query) {
    echo "<script>
        alert('Data berhasil ditambahkan!');
        window.location.href = '../?page=surat-aktif/index';
    </script>";
} else {
    $error = addslashes(mysqli_error($koneksi));
    echo "<script>
        alert('Gagal menyimpan ke surat_aktif: $error');
        window.history.back();
    </script>";
}
?>
