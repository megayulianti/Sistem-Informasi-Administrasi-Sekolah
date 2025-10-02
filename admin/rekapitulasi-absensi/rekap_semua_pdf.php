<?php
include '../koneksi.php';

$bulan = [
  1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April",
  5 => "Mei", 6 => "Juni", 7 => "Juli", 8 => "Agustus",
  9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember"
];

$bln = $_POST['rekap_bln'];
$thn = $_POST['rekap_thn'];
$status = $_POST['status'];

$periode = ($bln == 'all') ? "Semua Bulan $thn" : $bulan[(int)$bln] . " $thn";
$where = ($bln == 'all') ? "YEAR(a.tanggal) = '$thn'" : "MONTH(a.tanggal) = '$bln' AND YEAR(a.tanggal) = '$thn'";

$query = "
  SELECT a.status_kehadiran, COUNT(*) as jumlah
  FROM absensi a
  JOIN guru_pegawai g ON a.nip = g.nip
  WHERE $where AND g.status = '$status'
  GROUP BY a.status_kehadiran
";

$result = $koneksi->query($query);
$data = ['Hadir'=>0, 'Izin'=>0, 'Sakit'=>0, 'Alfa'=>0];
while ($row = $result->fetch_assoc()) {
  $data[$row['status_kehadiran']] = $row['jumlah'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Cetak Rekap Absensi <?= $status; ?></title>
  <style>
    body { font-family: Arial, sans-serif; padding: 40px; }
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
    table {
      width: 60%;
      margin: 30px auto;
      border-collapse: collapse;
    }
    th, td {
      padding: 8px 12px;
      border: 1px solid #000;
      text-align: center;
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
<h2 style="text-align:center; margin-top: 20px;">Rekapitulasi Kehadiran <?= $status; ?></h2>
<h4 style="text-align:center;">Periode: <?= $periode; ?></h4>

<!-- TABEL KEHADIRAN -->
<table>
  <tr>
    <th>Status Kehadiran</th>
    <th>Jumlah Hari</th>
  </tr>
  <?php foreach ($data as $keterangan => $jumlah): ?>
    <tr>
      <td><?= $keterangan; ?></td>
      <td><?= $jumlah; ?></td>
    </tr>
  <?php endforeach; ?>
</table>

<!-- TANDA TANGAN -->
<div class="ttd">
  <p>Padang, <?= date('d M Y'); ?></p>
  <p>Kepala Sekolah</p><br><br><br>
  <p><strong><u>Drs. Oyong Aziz, M.M</u></strong><br>
  NIP. 19651109 199412 1 001</p>
</div>

</body>
</html>
