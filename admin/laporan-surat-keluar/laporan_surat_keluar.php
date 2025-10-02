<?php
session_start();
include '../koneksi.php';

// Ambil data dari form (dari POST)
$bln = isset($_POST['bln']) ? $_POST['bln'] : 'all';
$thn = isset($_POST['thn']) ? $_POST['thn'] : date('Y'); // Default tahun saat ini

// Query data absensi berdasarkan bulan dan tahun
$query = "SELECT * FROM surat_keluar WHERE YEAR(tanggal_keluar) = '$thn'";
if ($bln !== 'all') {
    $query .= " AND MONTH(tanggal_keluar) = '$bln'";
}

// Eksekusi query
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Laporan Data Surat Keluar</title>
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

    .kop h2 {
      font-size: 20px;
      margin: 0;
    }

    .kop p {
      margin: 5px 0;
      font-size: 13px;
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
     .kop h1, .kop h2, .kop h4, .kop p {
      margin: 2px 0;
      line-height: 1.2;
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
  <p>Jl. Raya Pariaman - Tiku KM 18, KOTO TINGGI KURANJI HILIR, Kec. Sungai Limau, Kab. Padang Pariaman. </p>
  <p>Telp: (0751) 695094</p>
</div>

<h3 style="text-align:center;">LAPORAN DATA SURAT KELUAR</h3>



<table class="table">
  <thead>
   <tr>
              <th>No</th>
              <th>Tanggal Keluar</th>
              <th>Nomor Surat</th>
              <th>Tujuan Surat</th>
              <th>Perihal</th>
              <th>jenis Surat</th>
     </tr>
  </thead>
  <tbody>
    <?php
    $no = 1;
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
          <td>$no</td>
          <td>{$row['tanggal_keluar']}</td>
          <td>{$row['nomor_surat']}</td>
          <td>{$row['tujuan_surat']}</td>
          <td>{$row['perihal']}</td>
          <td>{$row['jenis_surat']}</td>
        </tr>";
        $no++;
      }
    } else {
      echo "<tr><td colspan='6'>Tidak ada data ditemukan.</td></tr>";
    }
    ?>
  </tbody>
</table>

<div class="ttd">
  <p>Padang, <?= date('d M Y'); ?></p>
  <p>Kepala Sekolah</p> <br> <br> <br>
  <p><strong><u>Drs. Oyong Aziz, M.M</u></strong><br>NIP. 19651109 199412 1 001</p>
</div>

<script>
  window.onload = function() {
    window.print();
  };
</script>

</body>
</html>
