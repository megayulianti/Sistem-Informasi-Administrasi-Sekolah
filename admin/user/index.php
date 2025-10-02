<?php
session_start();
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Data User</title>
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
    <h3 class="fw-bold">Data User</h3>
  </div>

  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h4 class="card-title mb-0">Data User</h4>
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
              <th>Username</th>
              <th>Nama Lengkap</th>
              <th>Foto</th>
              <th>Level</th>
              <th class="text-nowrap">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            $result = mysqli_query($koneksi, "SELECT * FROM user ORDER BY id_user ASC");
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
              <tr>
                <td class="text-center"><?= $no++; ?></td>
                <td><?= $row['username']; ?></td>
                <td><?= $row['nama_lengkap']; ?></td>
                <td>
                  <img src="user/gambar/<?= $row['foto'] ?>" style="width: 80px; height: 80px; object-fit: cover;" alt="<?= $row['username'] ?>">
                </td>
                <td><?= $row['level']; ?></td>
               <td class="text-center">
                  <div class="d-flex justify-content-center gap-1">
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $row['id_user']; ?>">Edit</button>
                    <a href="user/hapus.php?id_user=<?= $row['id_user']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
                  </div>
                </td>

              </tr>

              <!-- Modal Edit -->
              <div class="modal fade" id="modalEdit<?= $row['id_user']; ?>" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Edit Data User</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="user/proses_ubah.php" method="POST" enctype="multipart/form-data">
                      <div class="modal-body">
                        <input type="hidden" name="id_user" value="<?= $row['id_user']; ?>">
                        <div class="mb-3">
                          <label>Username</label>
                          <input type="text" name="username" class="form-control" value="<?= $row['username']; ?>" required>
                        </div>
                        <div class="mb-3">
                          <label>Nama Lengkap</label>
                          <input type="text" name="nama_lengkap" class="form-control" value="<?= $row['nama_lengkap']; ?>" required>
                        </div>
                        <div class="mb-3">
                          <label>Ganti Foto</label><br>
                          <input type="file" name="foto" class="form-control">
                        </div>
                        <div class="mb-3">
                          <label>Level</label>
                          <select name="level" class="form-control" required>
                            <option value="admin" <?= $row['level'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                            <option value="ks" <?= $row['level'] == 'ks' ? 'selected' : '' ?>>Kepala Sekolah</option>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label>Password (Kosongkan jika tidak ingin diubah)</label>
                          <input type="password" name="password" class="form-control">
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
    <form action="user/proses_tambah.php" method="POST" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Data User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Nama Lengkap</label>
            <input type="text" name="nama_lengkap" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Foto</label>
            <input type="file" name="foto" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Level</label>
            <select name="level" class="form-control" required>
              <option value="">-- Pilih Level --</option>
              <option value="admin">Admin</option>
              <option value="ks">kepala sekolah</option>
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
