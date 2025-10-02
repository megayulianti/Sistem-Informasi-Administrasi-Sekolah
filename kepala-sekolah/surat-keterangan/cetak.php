<?php
include('../../koneksi.php');

// Ambil ID dari URL
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM surat_keterangan WHERE id_surat_keterangan = '$id'");
$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Surat Keterangan</title>
  <style>
    body {
      font-family: 'Times New Roman', Times, serif;
      margin: 40px;
      background: #fff;
      color: #000;
    }

    .container {
      max-width: 800px;
      margin: auto;
      padding: 30px;
      border: 1px solid #000;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      text-align: center;
    }

    .header img {
      width: 80px;
      height: auto;
    }

    .judul {
      flex: 1;
    }

    /* Styling for the government and school name section */
    .judul h2,
    .judul h3,
    .judul p {
      margin: 0;
      line-height: 1.2;
    }

    hr {
      border: 1px solid #000;
      margin-top: 10px;
      margin-bottom: 20px;
    }

    .judul-surat {
      text-align: center;
      text-decoration: underline;
      margin-bottom: 0;
    }

    .nomor-surat {
      text-align: center;
      margin-top: 0;
      margin-bottom: 20px;
    }

    .tanggal-detail {
      display: flex;
      flex-direction: column;
      margin-bottom: 10px;
    }

    .tanggal-detail div {
      display: flex;
      justify-content: space-between;
      margin-bottom: 5px;
    }

    .tanggal-detail div:last-child {
      margin-bottom: 0;
    }

    strong {
      flex: 0 0 150px;
      text-align: left;
    }

    .detail {
      flex: 1;
      padding-left: 10px;
      text-align: left;
    }

    .ttd {
      text-align: right;
      margin-top: 50px;
    }

    .nama {
      font-weight: bold;
      text-decoration: underline;
    }

    .nip {
      margin-top: -10px;
    }

  </style>
  <script>
    function printSurat() {
      window.print();
    }
  </script>
</head>
<body onload="window.print()">
  <div class="container">
    <div class="header">
      <div class="logo-kiri">
        <img src="logo-sumbar.png" alt="Logo Sumbar">
      </div>
      <div class="judul">
        <h3>PEMERINTAH PROVINSI SUMATERA BARAT</h3>
        <h3>DINAS PENDIDIKAN</h3>
        <h3>CABANG DINAS WILAYAH I</h3>
        <h2>SMA NEGERI 1 SUNGAI LIMAU</h2>
        <p>Jalan Poros Sungai Limau - Lubuk Alung Km.04 Padang Pariaman</p>
      </div>
      <div class="logo-kanan">
        <img src="logo-sekolah.png" alt="Logo Sekolah">
      </div>
    </div>

    <hr>

    <h3 class="judul-surat">Surat Keterangan</h3>
    <p class="nomor-surat">No.     /      / SMAN1 / SL / <?= date('Y') ?></p>

    <p>Saya yang bertanda tangan kepada SMAN 1 Sungai Limau Kabupaten Padang Pariaman Provinsi Sumatera Barat dengan ini menerangkan bahwa :</p>

    <div class="tanggal-detail">
      <div>
        <strong>Nama</strong>
        <span class="detail">: <?= $data['nama'] ?> </span>
      </div>
      <div>
        <strong>Tempat/Tanggal Lahir</strong>
        <span class="detail">: <?= $data['tempat_lahir'] ?>/<?= $data['tanggal_lahir'] ?></span>
      </div>
      <div>
        <strong>Nama Orang Tua</strong>
        <span class="detail">: <?= $data['nama_orang_tua'] ?></span>
      </div>
    </div>

    <p><?= $data['keterangan'] ?></p>

    <p>Demikian surat tugas ini dibuat agar dapat dipergunakan sebagaimana mestinya.</p>

    <div class="ttd">
      <p>Padang Pariaman, <?= date('d F Y') ?></p>
      <p>Kepala Sekolah</p>
      <br><br><br>
      <p class="nama">Drs. Oyong Aziz, M.M</p>
      <p class="nip">NIP. 19651109 199412 1 001</p>
    </div>

  </div>
</body>
</html>
