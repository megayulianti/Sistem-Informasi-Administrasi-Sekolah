<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['nip'])) {
  header("Location: ../login.php");
  exit;
}

$nip_login = $_SESSION['nip'];
$nama_login = $_SESSION['nama']; // pastikan nama disimpan saat login
?>

<!-- Tambahkan CSS DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Data Absensi</h3>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">Data Absensi</h4>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-tambah">+ Ambil Absensi</button>
          </div>

          <div class="card-body">
            <div class="table-responsive">
              <table id="tabelAbsensi" class="table table-bordered table-hover">
                <thead class="text-center">
                  <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no = 1;
                    $query = mysqli_query($koneksi, "SELECT * FROM absensi WHERE nip = '$nip_login' ORDER BY id_absensi DESC");
                    while ($data = mysqli_fetch_array($query)) {
                  ?>
                    <tr class="text-center">
                      <td><?= $no++ ?></td>
                      <td><?= date('d-m-Y', strtotime($data['tanggal'])) ?></td>
                      <td><?= date('H:i', strtotime($data['jam'])) ?></td>
                      <td><?= $data['status_kehadiran'] ?></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modal-tambah">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="absensi/proses_tambah.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Absensi</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="nip" value="<?= $nip_login ?>">
          <input type="hidden" name="tanggal" value="<?= date('Y-m-d') ?>">
          <input type="hidden" name="jam" value="<?= date('H:i:s') ?>">
          <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="<?= $nama_login ?>" readonly>
          </div>
          <div class="mb-3">
            <label>Status</label>
            <select name="status_kehadiran" class="form-control" required>
              <option value="">-- Pilih --</option>
              <option value="Hadir">Hadir</option>
              <option value="Izin">Izin</option>
              <option value="Sakit">Sakit</option>
              <option value="Alpha">Alpha</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button class="btn btn-primary" type="submit">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Tambahkan JS jQuery dan DataTables -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- Inisialisasi DataTables -->
<script>
  $(document).ready(function() {
    $('#tabelAbsensi').DataTable({
      language: {
        search: "",
        searchPlaceholder: "Cari data..."
      },
      dom: '<"row mb-2"<"col-md-6"l><"col-md-6 text-end"f>>tip'
    });
  });
</script>
