<?php
session_start();
include 'koneksi.php';

$bulan = [
  1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April",
  5 => "Mei", 6 => "Juni", 7 => "Juli", 8 => "Agustus",
  9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember"
];

$now = date('Y');

// Handle permintaan AJAX untuk ambil nama berdasarkan status
if (isset($_GET['get_nama']) && isset($_GET['status'])) {
  $status = $_GET['status'];
  $data = [];
  $result = $koneksi->query("SELECT nip, nama FROM guru_pegawai WHERE status='$status' ORDER BY nama ASC");
  while ($row = $result->fetch_assoc()) {
    $data[] = $row;
  }
  echo json_encode($data);
  exit;
}
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

  <!-- FILTER REKAP PER ORANG -->
  <div class="card mb-4">
    <div class="card-header">
      <strong>Rekap Per Guru/Pegawai</strong>
    </div>
    <div class="card-body">
      <form method="post" class="row g-2">
        <div class="col-md-3">
          <label>Status</label>
          <select name="status_filter" id="status_filter" class="form-control" required>
            <option value="">-- Pilih Status --</option>
            <option value="Guru">Guru</option>
            <option value="Pegawai">Pegawai</option>
          </select>
        </div>
        <div class="col-md-4">
          <label>Nama</label>
          <select name="nip_filter" id="nip_filter" class="form-control" required>
            <option value="">-- Pilih Nama --</option>
          </select>
        </div>
        <div class="col-md-2">
          <label>Bulan</label>
          <select name="bulan_filter" class="form-control">
            <?php foreach ($bulan as $key => $val) echo "<option value='$key'>$val</option>"; ?>
          </select>
        </div>
        <div class="col-md-2">
          <label>Tahun</label>
          <select name="tahun_filter" class="form-control">
            <?php for ($a = 2020; $a <= $now; $a++) echo "<option value='$a'>$a</option>"; ?>
          </select>
        </div>
        <div class="col-md-1 d-flex align-items-end">
          <button type="submit" name="rekap_filter" class="btn btn-success w-100">Rekap</button>
        </div>
      </form>
    </div>
  </div>

  <!-- REKAP PER ORANG -->
  <?php if (isset($_POST['rekap_filter'])):
    $nip = $_POST['nip_filter'];
    $bln = $_POST['bulan_filter'];
    $thn = $_POST['tahun_filter'];
    $status = $_POST['status_filter'];

    $pegawai = $koneksi->query("SELECT nama FROM guru_pegawai WHERE nip='$nip' AND status='$status'")->fetch_assoc();
    $data_rekap = ['Hadir'=>0, 'Izin'=>0, 'Sakit'=>0, 'Alfa'=>0];
    $rekap = $koneksi->query("SELECT status_kehadiran, COUNT(*) as jumlah FROM absensi WHERE nip='$nip' AND MONTH(tanggal)='$bln' AND YEAR(tanggal)='$thn' GROUP BY status_kehadiran");
    while ($row = $rekap->fetch_assoc()) $data_rekap[$row['status_kehadiran']] = $row['jumlah'];

    $detail = $koneksi->query("SELECT tanggal, status_kehadiran FROM absensi WHERE nip='$nip' AND MONTH(tanggal)='$bln' AND YEAR(tanggal)='$thn' ORDER BY tanggal ASC");
    $hariIndo = ['Sunday'=>'Minggu','Monday'=>'Senin','Tuesday'=>'Selasa','Wednesday'=>'Rabu','Thursday'=>'Kamis','Friday'=>'Jumat','Saturday'=>'Sabtu'];
  ?>
  <div class="card mb-4">
    <div class="card-body">
      <h5>Rekap Absensi: <?= $pegawai['nama']; ?> (<?= $status; ?>) - <?= $bulan[$bln]; ?> <?= $thn; ?></h5>
      <ul class="list-group mb-3 w-50">
        <?php foreach ($data_rekap as $ket => $jumlah): ?>
        <li class="list-group-item d-flex justify-content-between">
          <span><?= $ket; ?></span><span><?= $jumlah; ?> Hari</span>
        </li>
        <?php endforeach; ?>
      </ul>

      <table class="table table-bordered text-center">
        <thead class="table-light">
          <tr><th>No</th><th>Tanggal</th><th>Hari</th><th>Status Kehadiran</th></tr>
        </thead>
        <tbody>
          <?php $no = 1; while ($d = $detail->fetch_assoc()):
            $hari = $hariIndo[date('l', strtotime($d['tanggal']))]; ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $d['tanggal']; ?></td>
              <td><?= $hari; ?></td>
              <td><?= $d['status_kehadiran']; ?></td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
      <form action="laporan-absensi/rekap_print.php" method="post" target="_blank">
        <input type="hidden" name="nip" value="<?= $nip; ?>">
        <input type="hidden" name="bulan" value="<?= $bln; ?>">
        <input type="hidden" name="tahun" value="<?= $thn; ?>">
        <input type="hidden" name="status" value="<?= $status; ?>">
        <button type="submit" class="btn btn-danger">Cetak Rekap</button>
      </form>
    </div>
  </div>
  <?php endif; ?>

</div>

<!-- SCRIPTS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function () {
    $('#status_filter').on('change', function () {
      const status = $(this).val();
      $('#nip_filter').html('<option value="">Memuat...</option>');

      if (status !== '') {
        $.ajax({
          url: 'laporan-absensi/get_nama.php',
          method: 'POST',
          data: { status: status },
          success: function (data) {
            $('#nip_filter').html(data);
          },
          error: function () {
            alert('Gagal mengambil data nama.');
            $('#nip_filter').html('<option value="">-- Pilih Nama --</option>');
          }
        });
      } else {
        $('#nip_filter').html('<option value="">-- Pilih Nama --</option>');
      }
    });
  });
</script>


</body>
</html>
