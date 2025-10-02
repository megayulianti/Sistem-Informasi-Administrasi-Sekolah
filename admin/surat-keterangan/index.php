<?php
include('../koneksi.php');
session_start();
?>

<!-- Link CSS DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Data Surat Keterangan</h3>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Data Surat Keterangan</h4>
            <button type="button" class="btn btn-primary btn-round" data-bs-toggle="modal" data-bs-target="#modal-tambah">
              Tambah Data
            </button>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="tabelSurat" class="display table table-bordered table-striped table-hover">
                <thead>
                  <tr class="text-center">
                    <th>No</th>
                    <th>Nomor Surat</th>
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
                      <td><?= $data['nomor_surat'] ?></td>
                      <td><?= $data['nama'] ?></td>
                      <td><?= $data['tempat_lahir'] ?></td>
                      <td><?= $data['tanggal_lahir'] ?></td>
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
                          <a href="surat-keterangan/cetak.php?id=<?= $data['id_surat_keterangan'] ?>" class="btn btn-info btn-sm" target="_blank">
                            <i class="fa fa-print"></i>
                          </a>
                          <a onclick="return confirm('Yakin ingin dihapus?')" href="surat-keterangan/hapus.php?id=<?= $data['id_surat_keterangan'] ?>" class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i>
                          </a>
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

<!-- Modal Tambah -->
<div class="modal fade" id="modal-tambah" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="surat-keterangan/proses_tambah.php" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Surat Keterangan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label>Nomor Surat</label>
              <input type="text" class="form-control" name="nomor_surat" required>
            </div>
            <div class="col-md-6 mb-3">
              <label>Nama</label>
              <input type="text" class="form-control" name="nama" required>
            </div>
            <div class="col-md-6 mb-3">
              <label>Tempat Lahir</label>
              <input type="text" class="form-control" name="tempat_lahir" required>
            </div>
            <div class="col-md-6 mb-3">
              <label>Tanggal Lahir</label>
              <input type="date" class="form-control" name="tanggal_lahir" required>
            </div>
            <div class="col-md-6 mb-3">
              <label>Nama Orang Tua</label>
              <input type="text" class="form-control" name="nama_orang_tua" required>
            </div>
            <div class="col-md-12 mb-3">
              <label>Keterangan</label>
              <input type="text" class="form-control" name="keterangan" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Script JS DataTables -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- Inisialisasi DataTables -->
<script>
  $(document).ready(function() {
    $('#tabelSurat').DataTable({
      "language": {
        "search": "",
        "searchPlaceholder": "Cari data..."
      },
      "dom": '<"row mb-2"<"col-md-6"l><"col-md-6 text-end"f>>tip',
    });
  });
</script>
