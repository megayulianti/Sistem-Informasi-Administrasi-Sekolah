<?php
include('../../koneksi.php');

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM surat_aktif WHERE id_surat_aktif = '$id'");
$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Surat Keterangan Aktif</title>
  <style>
    body {
      font-family: "Times New Roman", Times, serif;
      font-size: 12pt;
      margin: 2cm;
    }

    .kop {
      position: relative;
      text-align: center;
      border-bottom: 3px double black;
      padding-bottom: 10px;
      margin-bottom: 20px;
    }

    .logo-kiri {
      position: absolute;
      top: 10px;
      left: 0;
      width: 80px;
      height: 80px;
    }

    .logo-kanan {
      position: absolute;
      top: 10px;
      right: 0;
      width: 80px;
      height: 80px;
    }

    .kop-teks {
      display: inline-block;
      padding: 0 100px;
    }

    .kop h1, .kop h2, .kop h4, .kop p {
      margin: 2px 0;
      line-height: 1.2;
    }

    .ttd {
      width: 100%;
      display: flex;
      justify-content: flex-end;
      margin-top: 40px;
    }

    .ttd div {
      text-align: center;
    }
  </style>
</head>
<body onload="window.print()">

  <div class="kop">
    <img src="gambar/logo.jpeg" alt="" class="logo-kiri">
    <img src="gambar/logo1.jpeg" alt="Logo Kanan" class="logo-kanan">

    <div class="kop-teks">
      <h4>PEMERINTAH PROVINSI SUMATERA BARAT</h4>
      <h4>DINAS PENDIDIKAN</h4>
      <h4>CABANG DINAS WILAYAH II</h4>
      <h4>SMAN 1 SUNGAI LIMAU</h4>
      <p>NPSN: <?= $data['npsn'] ?> | Alamat: <?= $data['alamat'] ?></p>
    </div>
  </div>

  <h3 style="text-align: center;"><u>SURAT KETERANGAN AKTIF</u></h3>
  <p style="text-align: center;">Nomor: ___/___/SMAN-1SL/<?= date('Y') ?></p>

  <p>Yang bertanda tangan di bawah ini:</p>
  <table style="margin-left: 20px;">
    <tr><td>Nama</td><td>:</td><td><?= $data['nama_guru'] ?></td></tr>
    <tr><td>NIP</td><td>:</td><td><?= $data['nip'] ?></td></tr>
    <tr><td>Pangkat / Golongan</td><td>:</td><td><?= $data['pangkat_golongan'] ?></td></tr>
    <tr><td>Jabatan</td><td>:</td><td><?= $data['jabatan'] ?></td></tr>
    <tr><td>Instansi</td><td>:</td><td><?= $data['instansi'] ?></td></tr>
  </table>

  <p>Menerangkan bahwa:</p>
  <table style="margin-left: 20px;">
    <tr><td>Nama</td><td>:</td><td><?= $data['nama_siswa'] ?></td></tr>
    <tr><td>Tempat/Tgl Lahir</td><td>:</td><td><?= $data['tempat_tanggal_lahir'] ?></td></tr>
    <tr><td>NISN</td><td>:</td><td><?= $data['nisn'] ?></td></tr>
    <tr><td>Jenis Kelamin</td><td>:</td><td><?= $data['jenis_kelamin'] ?></td></tr>
    <tr><td>Kelas</td><td>:</td><td><?= $data['kelas'] ?></td></tr>
    <tr><td>Alamat</td><td>:</td><td><?= $data['alamat'] ?></td></tr>
    <tr><td>Sekolah</td><td>:</td><td><?= $data['sekolah'] ?></td></tr>
  </table>

  <p><?= $data['keterangan'] ?> <?= $data['sekolah'] ?>.</p>

  <p>Demikian surat ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</p>

  <div class="ttd">
    <div>
      <p>Padang Pariaman, <?= date('d F Y') ?></p>
      <p><?= $data['jabatan'] ?></p>
      <br><br><br>
      <p><u><?= $data['nama_guru'] ?></u><br>NIP. <?= $data['nip'] ?></p>
    </div>
  </div>

</body>
</html>
