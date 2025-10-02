<?php
session_start();
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Data Guru</title>
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
  

  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h4 class="card-title mb-0">Data Guru</h4>
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="fa fa-plus"></i> Tambah Data
      </button>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table id="dataTable" class="table table-bordered table-hover align-middle">
          <thead class="text-center">
            <tr>
              <th>No</th>
              <th>NIP</th>
              <th>Nama</th>
              <th>Email</th>
              <th>No HP</th>
              <th>Alamat</th>
              <th>Jabatan</th>
              <th>Status</th>
              <th class="text-nowrap">Aksi</th>
            </tr>
          </thead>

<tbody>
<?php
$no = 1;
$result = mysqli_query($koneksi, "SELECT * FROM guru_pegawai ORDER BY nama ASC");
while ($row = mysqli_fetch_assoc($result)) {
?>
  <tr>
    <td class="text-center"><?= $no++; ?></td>
    <td><?= $row['nip']; ?></td>
    <td><?= $row['nama']; ?></td>
    <td><?= $row['email']; ?></td>
    <td><?= $row['no_hp']; ?></td>
    <td><?= $row['alamat']; ?></td>
    <td><?= $row['jabatan']; ?></td>
    <td><?= ucfirst($row['status']); ?></td>
    <td class="text-center">
      <div class="d-flex justify-content-center gap-1">
        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $row['nip']; ?>">Edit</button>
        <a href="guru_pegawai/hapus.php?nip=<?= $row['nip']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
      </div>
    </td>
  </tr>

 <!-- Modal Edit -->
<div class="modal fade" id="modalEdit<?= $row['nip']; ?>" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Data Guru dan Pegawai</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form action="guru_pegawai/proses_ubah.php" method="POST">
        <div class="modal-body">
          <input type="hidden" name="nip_lama" value="<?= $row['nip']; ?>">

          <div class="mb-3">
            <label>NIP</label>
            <input type="text" name="nip" class="form-control" value="<?= $row['nip']; ?>" required>
          </div>

          <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="<?= $row['nama']; ?>" required>
          </div>

          <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?= $row['email']; ?>">
          </div>

          <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control" value="<?= $row['no_hp']; ?>">
          </div>

          <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control"><?= $row['alamat']; ?></textarea>
          </div>

          <div class="mb-3">
            <label>Jabatan</label>
            <input type="text" name="jabatan" class="form-control" value="<?= $row['jabatan']; ?>">
          </div>

          <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
              <option value="guru" <?= $row['status'] == 'guru' ? 'selected' : '' ?>>Guru</option>
              <option value="pegawai" <?= $row['status'] == 'pegawai' ? 'selected' : '' ?>>Pegawai</option>
            </select>
          </div>

          <div class="mb-3">
            <label>Password <small>(Kosongkan jika tidak ingin mengubah)</small></label>
            <input type="password" name="password" class="form-control" placeholder="********">
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php } ?>
</tbody>



        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form action="guru_pegawai/proses_tambah.php" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Data Guru dan Pegawai</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label>NIP</label>
            <input type="text" name="nip" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
          </div>
          <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control">
          </div>
          <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control"></textarea>
          </div>
          <div class="mb-3">
            <label>Jabatan</label>
            <input type="text" name="jabatan" class="form-control">
          </div>
          <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
              <option value="">-- Pilih Status --</option>
              <option value="guru">Guru</option>
              <option value="pegawai">Pegawai</option>
            </select>
          </div>
          <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </form>
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
