<?php
include '../koneksi.php';

$nip = $_POST['nip'];
$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];
$status = $_POST['status'];

$bulan_nama = [
  1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April",
  5 => "Mei", 6 => "Juni", 7 => "Juli", 8 => "Agustus",
  9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember"
];

$pegawai = $koneksi->query("SELECT nama FROM guru_pegawai WHERE nip='$nip' AND status='$status'")->fetch_assoc();
$nama_pegawai = $pegawai['nama'] ?? '-';

$data_rekap = [];
$rekap = $koneksi->query("SELECT status_kehadiran, COUNT(*) as jumlah 
  FROM absensi 
  WHERE nip='$nip' AND MONTH(tanggal)='$bulan' AND YEAR(tanggal)='$tahun' 
  GROUP BY status_kehadiran");

while ($row = $rekap->fetch_assoc()) {
  $data_rekap[$row['status_kehadiran']] = $row['jumlah'];
}

$semua_status = ['Hadir', 'Izin', 'Sakit', 'Alfa'];
foreach ($semua_status as $s) {
  if (!isset($data_rekap[$s])) {
    $data_rekap[$s] = 0;
  }
}

$detail = $koneksi->query("SELECT tanggal, status_kehadiran 
  FROM absensi 
  WHERE nip='$nip' AND MONTH(tanggal)='$bulan' AND YEAR(tanggal)='$tahun' 
  ORDER BY tanggal ASC");

$hariIndo = [
  'Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa',
  'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu'
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Cetak Rekap Absensi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { padding: 40px; font-family: Arial, sans-serif; }
    .kop {
      text-align: center;
      position: relative;
      margin-bottom: 30px;
      border-bottom: 3px solid #000;
      padding-bottom: 10px;
    }
    .logo-kiri {
      position: absolute;
      top: 0;
      left: 0;
      width: 80px;
      height: 80px;
    }
    .logo-kanan {
      position: absolute;
      top: 0;
      right: 0;
      width: 80px;
      height: 80px;
    }
    .kop h4, .kop p {
      margin: 0;
      line-height: 1.2;
    }
    .ttd {
      width: 300px;
      text-align: center;
      float: right;
      margin-top: 50px;
    }
    @media print {
      button { display: none; }
    }
  </style>
</head>
<body onload="window.print()">

  <!-- KOP SURAT -->
  <div class="kop">
    <img src="gambar/logo.jpeg" alt="Logo Kiri" class="logo-kiri">
    <img src="gambar/logo1.jpeg" alt="Logo Kanan" class="logo-kanan">
    <h4>PEMERINTAH PROVINSI SUMATERA BARAT</h4>
    <h4>DINAS PENDIDIKAN</h4>
    <h4>CABANG DINAS WILAYAH II</h4>
    <h4><strong>SMAN 1 SUNGAI LIMAU</strong></h4>
    <p>Jl. Raya Pariaman - Tiku KM 18, KOTO TINGGI KURANJI HILIR, Kec. Sungai Limau, Kab. Padang Pariaman.</p>
    <p>Telp: (0751) 695094</p>
  </div>

  <!-- JUDUL -->
  <h5 class="text-center mt-4">Rekap Absensi Bulanan</h5>
  <h6 class="text-center mb-3"><?= $nama_pegawai ?> (<?= $status ?>) - <?= $bulan_nama[(int)$bulan] . " " . $tahun ?></h6>

  <!-- REKAP RINGKAS -->
  <table class="table table-bordered w-50 mb-4">
    <thead class="table-light">
      <tr>
        <th>Status Kehadiran</th>
        <th>Jumlah Hari</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($semua_status as $s): ?>
      <tr>
        <td><?= $s ?></td>
        <td><?= $data_rekap[$s] ?> Hari</td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <!-- DETAIL TANGGAL -->
  <h6>Detail Kehadiran Per Tanggal</h6>
  <table class="table table-bordered">
    <thead class="table-light">
      <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Hari</th>
        <th>Status Kehadiran</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1; while ($d = $detail->fetch_assoc()): ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= $d['tanggal'] ?></td>
        <td><?= $hariIndo[date('l', strtotime($d['tanggal']))] ?></td>
        <td><?= $d['status_kehadiran'] ?></td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <!-- TTD -->
  <div class="ttd">
    <p>Padang, <?= date('d M Y'); ?></p>
    <p>Kepala Sekolah</p>
    <br><br><br>
    <p><strong><u>Drs. Oyong Aziz, M.M</u></strong><br>
      NIP. 19651109 199412 1 001</p>
  </div>


</body>
</html>
