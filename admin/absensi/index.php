<?php
session_start();
include '../koneksi.php';
if (!isset($_SESSION['username'])) {
  header("Location: ../login.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Data Absensi Guru</title>
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
    body {
      background-color: #f8f9fa;
    }
    .card {
      margin-top: 40px;
    }
  </style>
</head>
<body>
<div class="container mt-5">
  <div class="d-flex justify-content-between mb-4 align-items-center">
    <h3 class="fw-bold">Data Absensi</h3>
    <span class="text-muted">Login sebagai: <strong><?= $_SESSION['username']; ?></strong></span>
  </div>

  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h4 class="card-title mb-0">Data Absensi</h4>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table id="dataTable" class="table table-bordered table-hover align-middle">
          <thead class="text-center">
            <tr>
              <th>No</th>
              <th>NIP</th>
              <th>Nama</th>
              <th>Status</th> <!-- Tambahan kolom Status Guru/Pegawai -->
              <th>Tanggal</th>
              <th>Jam</th>
              <th>Status Kehadiran</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            $data = mysqli_query($koneksi, "
              SELECT 
                a.id_absensi,
                a.nip,
                g.nama,
                g.status AS status_guru_pegawai,
                a.tanggal,
                a.jam,
                a.status_kehadiran
              FROM absensi a
              LEFT JOIN guru_pegawai g ON a.nip = g.nip
              ORDER BY a.tanggal DESC, a.jam DESC
            ");
            while ($d = mysqli_fetch_array($data)) {
            ?>
              <tr>
                <td class="text-center"><?= $no++; ?></td>
                <td><?= $d['nip']; ?></td>
                <td><?= $d['nama']; ?></td>
                <td class="text-center"><?= $d['status_guru_pegawai']; ?></td>
                <td><?= date('d-m-Y', strtotime($d['tanggal'])); ?></td>
                <td><?= date('H:i', strtotime($d['jam'])); ?></td>
                <td><?= $d['status_kehadiran']; ?></td>
                <td class="text-center">
                  <a href="absensi/hapus.php?id=<?= $d['id_absensi']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
                </td>
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
