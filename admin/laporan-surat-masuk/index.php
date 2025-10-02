<?php
session_start();
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Surat Masuk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    th, td {
      vertical-align: middle !important;
    }
    .table td {
      padding: 0.5rem;
    }
  </style>
</head>
<body>
<div class="container mt-5">
  <div class="d-flex justify-content-between mb-4 align-items-center">
    <h3 class="fw-bold">Data Surat Masuk</h3>
  </div>

  <div class="card">
    <div class="card-header">
      <h4 class="card-title mb-3">Filter dan Cetak Laporan</h4>

      <!-- Form Filter Bulan & Tahun -->
      <form action="" method="post" class="mb-3">
        <div class="row g-2">
          <div class="col-md-4">
            <label>Bulan</label>
            <select class="form-control" name="bln">
              <option value="all" selected>ALL</option>
              <?php
              $bulan = [
                1 => "January", 2 => "February", 3 => "March", 4 => "April",
                5 => "May", 6 => "June", 7 => "July", 8 => "August",
                9 => "September", 10 => "October", 11 => "November", 12 => "December"
              ];
              foreach ($bulan as $key => $value) {
                echo "<option value=\"$key\">$value</option>";
              }
              ?>
            </select>
          </div>
          <div class="col-md-3">
            <label>Tahun</label>
            <select name="thn" class="form-control">
              <?php
              $now = date('Y');
              for ($a = 2020; $a <= $now; $a++) {
                echo "<option value='$a'>$a</option>";
              }
              ?>
            </select>
          </div>
          <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-primary" name="tampilkan">Tampilkan Data</button>
          </div>
        </div>
      </form>

      <!-- Form Cetak PDF -->
      <form action="laporan-surat-masuk/laporan_surat_masuk.php" method="post" target="_blank">
        <div class="row g-2">
          <div class="col-md-4">
            <select class="form-control" name="bln">
              <option value="all" selected>ALL</option>
              <?php
              foreach ($bulan as $key => $value) {
                echo "<option value=\"$key\">$value</option>";
              }
              ?>
            </select>
          </div>
          <div class="col-md-3">
            <select name="thn" class="form-control">
              <?php
              for ($a = 2020; $a <= $now; $a++) {
                echo "<option value='$a'>$a</option>";
              }
              ?>
            </select>
          </div>
          <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-danger">Cetak PDF</button>
          </div>
        </div>
      </form>
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <table id="dataTable" class="table table-bordered table-hover align-middle text-center">
          <thead class="table-light">
            <tr>
              <th>No</th>
              <th>Tanggal Masuk</th>
              <th>Nomor Surat</th>
              <th>Tanggal Surat</th>
              <th>Perihal</th>
              <th>Asal Surat</th>
              <th>NIP</th> <!-- Kolom NIP -->
            </tr>
          </thead>
          <tbody>
            <?php 
            $no = 1;
            if (isset($_POST['tampilkan'])) {
              $bln = $_POST['bln'];
              $thn = $_POST['thn'];

              if ($bln == 'all') {
                $sql = $koneksi->query("SELECT * FROM surat_masuk WHERE YEAR(tgl_surat) = '$thn'");
              } else {
                $sql = $koneksi->query("SELECT * FROM surat_masuk WHERE MONTH(tgl_surat) = '$bln' AND YEAR(tgl_surat) = '$thn'");
              }
            } else {
              $sql = $koneksi->query("SELECT * FROM surat_masuk");
            }

            while ($data = $sql->fetch_assoc()) {
            ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= $data['tgl_masuk'] ?></td>
              <td><?= $data['nomor_surat'] ?></td>
              <td><?= $data['tgl_surat'] ?></td>
              <td><?= $data['perihal'] ?></td>
              <td><?= $data['asal_surat'] ?></td>
              <td><?= $data['nip'] ?></td> <!-- Tampilkan NIP -->
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready(function () {
    $('#dataTable').DataTable({
      "lengthMenu": [[10, 25, 50], [10, 25, 50]],
      "language": {
        "search": "Cari Data:",
        "lengthMenu": "Tampilkan _MENU_ data per halaman",
        "zeroRecords": "Data tidak ditemukan",
        "info": "Menampilkan _START_ - _END_ dari _TOTAL_ data",
        "infoEmpty": "Tidak ada data tersedia",
        "infoFiltered": "(disaring dari total _MAX_ data)"
      }
    });
  });
</script>
</body>
</html>
