<?php
include '../koneksi.php';

// Ambil status dari POST
$status = $_POST['status'];

// Ambil data berdasarkan status
if ($status == 'all') {
  $query = "SELECT * FROM guru_pegawai ORDER BY nama ASC";
} else {
  $query = "SELECT * FROM guru_pegawai WHERE status = '$status' ORDER BY nama ASC";
}
$data = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Laporan Guru dan Pegawai</title>
    <style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      font-size: 14px;
      margin: 40px;
    }

    .kop {
      text-align: center;
      position: relative;
      border-bottom: 3px solid black;
      padding-bottom: 10px;
      margin-bottom: 20px;
    }

    .kop h1, .kop h2, .kop h4, .kop p {
      margin: 2px 0;
      line-height: 1.2;
    }

    .logo-kiri, .logo-kanan {
      position: absolute;
      top: 0;
      width: 80px;
      height: 80px;
    }

    .logo-kiri {
      left: 0;
    }

    .logo-kanan {
      right: 0;
    }

    h3 {
      text-align: center;
      margin-top: 0;
    }

    .table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    .table th, .table td {
      border: 1px solid black;
      padding: 8px;
      text-align: center;
    }

    .table th {
      background-color: #f2f2f2;
    }

    .ttd {
      margin-top: 60px;
      width: 100%;
      text-align: right;
    }

    .ttd p {
      margin: 4px 0;
    }

    @media print {
      .no-print {
        display: none;
      }
    }
  </style>
</head>
<body>

<div class="kop">
  <img src="gambar/logo.jpeg" alt="Logo Kiri" class="logo-kiri">
  <img src="gambar/logo1.jpeg" alt="Logo Kanan" class="logo-kanan">
  <h4>PEMERINTAH PROVINSI SUMATERA BARAT</h4>
  <h4>DINAS PENDIDIKAN</h4>
  <h4>CABANG DINAS WILAYAH II</h4>
  <h4>SMAN 1 SUNGAI LIMAU</h4> <br>
  <p>Jl. Raya Pariaman - Tiku KM 18, KOTO TINGGI KURANJI HILIR, Kec. Sungai Limau, Kab. Padang Pariaman.</p>
  <p>Telp: (0751) 695094</p>
</div>

<div style="text-align: center; font-weight: bold; font-size: 18px;">
  <p style="margin: 0;">
    Laporan Data <?= $status == 'all' ? 'Guru dan Pegawai' : ucfirst($status) ?>
  </p>
</div>



<table class="table">
  <thead>
    <tr>
      <th>No</th>
      <th>NIP</th>
      <th>Nama</th>
      <th>Jabatan</th>
      <th>Status</th>
      <th>Email</th>
      <th>No HP</th>
      <th>Alamat</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 1;
    while ($row = mysqli_fetch_assoc($data)) {
      echo "<tr>
              <td>$no</td>
              <td>{$row['nip']}</td>
              <td>{$row['nama']}</td>
              <td>{$row['jabatan']}</td>
              <td>{$row['status']}</td>
              <td>{$row['email']}</td>
              <td>{$row['no_hp']}</td>
              <td>{$row['alamat']}</td>
            </tr>";
      $no++;
    }
    ?>
  </tbody>
</table>

<div class="ttd">
  <p>Padang, <?= date('d M Y') ?></p>
  <p>Kepala Sekolah</p><br><br>
  <p><strong><u>Drs. Oyong Aziz, M.M</u></strong><br>NIP. 19651109 199412 1 001</p>
</div>

<script>window.print();</script>
</body>
</html>
