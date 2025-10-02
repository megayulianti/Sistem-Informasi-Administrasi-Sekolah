<?php
session_start();
include('../koneksi.php');
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Data Surat Aktif</title>

  <!-- Bootstrap CSS (optional, jika pakai Bootstrap) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" />

  <!-- FontAwesome (optional untuk ikon) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>
<div class="container my-4">
  <div class="page-inner">
    <div class="page-header mb-4">
      <h3 class="fw-bold">Data Surat Aktif</h3>
      <ul class="breadcrumbs mb-3 list-unstyled d-flex gap-2">
        <li class="nav-home"><a href="#"><i class="fa fa-home"></i></a></li>
        <li class="separator"><i class="fa fa-arrow-right"></i></li>
        <li class="nav-item">Data Surat Aktif</li>
      </ul>
    </div>

    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title mb-0">Data Surat Aktif</h4>
      </div>

      <div class="card-body">
        <div class="table-responsive">
          <table id="add-row" class="display table table-bordered table-striped table-hover" style="width:100%">
            <thead>
              <tr class="text-center">
                <th>No</th>
                <th>Nama Guru</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Jenis Kelamin</th>
                <th>Instansi</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $query = mysqli_query($koneksi, "SELECT * FROM surat_aktif ORDER BY id_surat_aktif DESC");
              while ($data = mysqli_fetch_array($query)) {
              ?>
              <tr class="text-center">
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($data['nama_guru']) ?></td>
                <td><?= htmlspecialchars($data['nama_siswa']) ?></td>
                <td><?= htmlspecialchars($data['kelas']) ?></td>
                <td><?= htmlspecialchars($data['jenis_kelamin']) ?></td>
                <td><?= htmlspecialchars($data['instansi']) ?></td>
                <td>
                  <?php
                  $status = strtolower(trim($data['validasi'] ?? ''));
                  switch ($status) {
                    case 'belum disetujui':
                      echo '<span class="badge bg-warning text-dark">Belum Disetujui</span>';
                      break;
                    case 'disetujui':
                      echo '<span class="badge bg-success">Disetujui</span>';
                      break;
                    case 'tidak disetujui':
                      echo '<span class="badge bg-danger">Tidak Disetujui</span>';
                      break;
                    default:
                      echo '<span class="badge bg-secondary">Status Tidak Diketahui</span>';
                  }
                  ?>
                </td>
                <td>
                  <div class="d-flex justify-content-center">
                    <button type="button" class="btn btn-warning btn-sm me-2" data-bs-toggle="modal" data-bs-target="#modal-edit<?= $data['id_surat_aktif'] ?>">
                      <i class="fa fa-edit"></i>
                    </button>
                  </div>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- Modal Edit -->
<?php
$query_modal = mysqli_query($koneksi, "SELECT * FROM surat_aktif ORDER BY id_surat_aktif DESC");
while ($d = mysqli_fetch_array($query_modal)) {
?>
<div class="modal fade" id="modal-edit<?= $d['id_surat_aktif'] ?>" tabindex="-1" aria-labelledby="modalEditLabel<?= $d['id_surat_aktif'] ?>" aria-hidden="true">
  <div class="modal-dialog">
    <form action="surat-aktif/proses_edit.php" method="POST">
      <input type="hidden" name="id_surat_aktif" value="<?= $d['id_surat_aktif'] ?>">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalEditLabel<?= $d['id_surat_aktif'] ?>">Edit Validasi & Lihat Surat</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3 text-center">
            <a href="surat-aktif/cetak.php?id=<?= $d['id_surat_aktif'] ?>" target="_blank" class="btn btn-info">
              <i class="fa fa-file-pdf"></i> Lihat Surat PDF
            </a>
          </div>
          <div class="mb-3">
            <label for="validasi">Status Validasi</label>
            <select name="validasi" class="form-control" required>
              <option value="">-- Pilih Status --</option>
              <option value="Disetujui" <?= $d['validasi'] == 'Disetujui' ? 'selected' : '' ?>>Disetujui</option>
              <option value="Tidak Disetujui" <?= $d['validasi'] == 'Tidak Disetujui' ? 'selected' : '' ?>>Tidak Disetujui</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
      </div>
    </form>
  </div>
</div>
<?php } ?>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

<script>
  $(document).ready(function() {
    $('#add-row').DataTable({
      language: {
        search: "Cari Data:"
      },
      dom: '<"top"f>rt<"bottom"lip><"clear">'
    });
  });
</script>



<!-- Optional: SweetAlert2 for nicer alerts -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
