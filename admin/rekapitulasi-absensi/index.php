<?php
session_start();
include 'koneksi.php';

$bulan = [
  1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April",
  5 => "Mei", 6 => "Juni", 7 => "Juli", 8 => "Agustus",
  9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember"
];

$now = date('Y');
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Absensi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
  <style>
    th, td { vertical-align: middle !important; }
    .table td { padding: 0.5rem; }
    @media print {
      .btn, .form-control, select, option {
        display: none !important;
      }
    }
  </style>
</head>
<body>
<div class="container mt-5">
  <div class="mb-4">
    <h3 class="fw-bold text-center">Data Absensi</h3>
  </div>

  <!-- FILTER REKAP KESELURUHAN PER BULAN -->
  <div class="card mb-4">
    <div class="card-header"><strong>Rekap Bulanan Seluruh Guru/Pegawai</strong></div>
    <div class="card-body">
      <form method="post" class="row g-2">
        <div class="col-md-3">
          <label>Bulan</label>
          <select name="rekap_bln" class="form-control">
            <option value="all">ALL</option>
            <?php foreach ($bulan as $key => $val) echo "<option value='$key'>$val</option>"; ?>
          </select>
        </div>
        <div class="col-md-3">
          <label>Tahun</label>
          <select name="rekap_thn" class="form-control">
            <?php for ($a = 2020; $a <= $now; $a++) echo "<option value='$a'>$a</option>"; ?>
          </select>
        </div>
        <div class="col-md-2 d-flex align-items-end">
          <button type="submit" class="btn btn-warning w-100" name="rekap_bulanan">Tampilkan Rekap</button>
        </div>
      </form>
    </div>
  </div>

  <?php
  if (isset($_POST['rekap_bulanan'])) {
    $bln = $_POST['rekap_bln'] ?? 'all';
    $thn = $_POST['rekap_thn'] ?? date('Y');
    $where = ($bln == 'all') ? "YEAR(a.tanggal) = '$thn'" : "MONTH(a.tanggal) = '$bln' AND YEAR(a.tanggal) = '$thn'";

    $statuses = ['Guru', 'Pegawai'];
    foreach ($statuses as $sts):
      $query = "
        SELECT a.status_kehadiran, COUNT(*) as jumlah
        FROM absensi a
        JOIN guru_pegawai g ON a.nip = g.nip
        WHERE $where AND g.status = '$sts'
        GROUP BY a.status_kehadiran
      ";
      $result = $koneksi->query($query);
      $data_rekap = ['Hadir' => 0, 'Izin' => 0, 'Sakit' => 0, 'Alfa' => 0];
      while ($r = $result->fetch_assoc()) $data_rekap[$r['status_kehadiran']] = $r['jumlah'];
  ?>
    <div class="card mb-4">
      <div class="card-body">
        <h5>Rekap Kehadiran <strong><?= $sts ?></strong> - <?= $bln == 'all' ? 'Semua Bulan' : $bulan[(int)$bln]; ?> <?= $thn; ?></h5>
        <ul class="list-group mb-3 w-50">
          <?php foreach ($data_rekap as $status => $jumlah): ?>
            <li class="list-group-item d-flex justify-content-between">
              <span><?= $status; ?></span><span><?= $jumlah; ?> Hari</span>
            </li>
          <?php endforeach; ?>
        </ul>
        <form action="rekapitulasi-absensi/rekap_semua_pdf.php" method="post" target="_blank" class="d-inline">
          <input type="hidden" name="rekap_bln" value="<?= $bln; ?>">
          <input type="hidden" name="rekap_thn" value="<?= $thn; ?>">
          <input type="hidden" name="status" value="<?= $sts; ?>">
          <button type="submit" class="btn btn-danger">Cetak PDF <?= $sts; ?></button>
        </form>
      </div>
    </div>
  <?php endforeach; } ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready(function () {
    $('#dataTable').DataTable({
      lengthMenu: [[10, 25, 50], [10, 25, 50]],
      language: {
        search: "Cari:",
        lengthMenu: "Tampilkan _MENU_ data",
        zeroRecords: "Data tidak ditemukan",
        info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
        infoEmpty: "Tidak ada data",
        infoFiltered: "(disaring dari _MAX_ data)"
      }
    });
  });
</script>
</body>
</html>
