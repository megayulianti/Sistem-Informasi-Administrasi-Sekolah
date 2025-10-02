<?php
include('../koneksi.php');
session_start();
?>

<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Data Surat Keterangan</h3>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="card">

          <!-- Header dengan judul dan tombol -->
          <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
            <h4 class="card-title">Data Surat Keterangan</h4>
            <button type="button" class="btn btn-primary btn-round" data-bs-toggle="modal" data-bs-target="#modal-tambah">
              Tambah Data
            </button>
          </div>

          <!-- Input pencarian, berada di bawah header tapi sejajar kanan -->
          <div class="card-body">
            <div class="d-flex justify-content-end mb-3">
              <input type="text" id="searchInput" class="form-control w-auto" placeholder="Cari data...">
            </div>

            <div class="table-responsive">
              <table id="dataTable" class="display table table-bordered table-striped table-hover">
                <thead>
                  <tr class="text-center">
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  $query = mysqli_query($koneksi, "SELECT * FROM surat_keterangan ORDER BY id_surat_keterangan DESC");
                  while ($data = mysqli_fetch_array($query)) {
                  ?>
                    <tr class="text-center">
                      <td><?= $no++ ?></td>
                      <td><?= htmlspecialchars($data['nama']) ?></td>
                      <td><?= htmlspecialchars($data['tempat_lahir']) ?></td>
                      <td><?= htmlspecialchars($data['tanggal_lahir']) ?></td>
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
                          <button type="button" class="btn btn-warning btn-sm me-2" data-bs-toggle="modal" data-bs-target="#modal-edit<?= $data['id_surat_keterangan'] ?>">
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
  </div>
</div>

<!-- Modal Edit -->
<?php
$query_modal = mysqli_query($koneksi, "SELECT * FROM surat_keterangan ORDER BY id_surat_keterangan DESC");
while ($d = mysqli_fetch_array($query_modal)) {
?>
  <div class="modal fade" id="modal-edit<?= $d['id_surat_keterangan'] ?>" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form action="surat-keterangan/proses_edit.php" method="POST">
        <input type="hidden" name="id_surat_keterangan" value="<?= $d['id_surat_keterangan'] ?>">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Validasi & Lihat Surat</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3 text-center">
              <a href="surat-keterangan/cetak.php?id=<?= $d['id_surat_keterangan'] ?>" target="_blank" class="btn btn-info">
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

<!-- Script pencarian otomatis -->
<script>
  document.getElementById('searchInput').addEventListener('keyup', function() {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll('#dataTable tbody tr');

    rows.forEach(row => {
      const text = row.textContent.toLowerCase();
      if (text.indexOf(filter) > -1) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  });
</script>
