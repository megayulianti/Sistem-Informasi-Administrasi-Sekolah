<?php
session_start();
include "../koneksi.php";
?>

<!-- Link CSS DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Data Surat Masuk</h3>
      <ul class="breadcrumbs mb-3">
        <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
        <li class="separator"><i class="icon-arrow-right"></i></li>
        <li class="nav-item"><a href="#">Data Surat Masuk</a></li>
      </ul>
    </div>

    <!-- Row -->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Data Surat Masuk</h4>
            <div>
              <button type="button" class="btn btn-primary btn-round mb-2" data-bs-toggle="modal" data-bs-target="#modal-tambah">
                Tambah Data
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="tabelSurat" class="display table table-bordered table-striped table-hover">
                <thead class="text-center">
                  <tr>
                    <th>No</th>
                    <th>Tanggal Masuk</th>
                    <th>Nomor Surat</th>
                    <th>Tanggal Surat</th>
                    <th>Perihal</th>
                    <th>Asal Surat</th>
                    <th>NIP</th>
                    <th>File Dokumen</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody class="text-center">
                  <?php
                  $no = 1;
                  $query = mysqli_query($koneksi, "SELECT * FROM surat_masuk ORDER BY id_surat_masuk DESC");
                  while ($data = mysqli_fetch_array($query)) {
                  ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $data['tgl_masuk'] ?></td>
                      <td><?= $data['nomor_surat'] ?></td>
                      <td><?= $data['tgl_surat'] ?></td>
                      <td><?= $data['perihal'] ?></td>
                      <td><?= $data['asal_surat'] ?></td>
                      <td><?= $data['nip'] ?></td>
                      <td>
                        <a href="/tu-sekolah/uploads/<?= $data['upload_file']; ?>" target="_blank" class="btn btn-sm btn-primary" title="Lihat File">
                          <i class="fa fa-eye"></i>
                        </a>
                      </td>
                      <td>
                        <div class="d-flex justify-content-center">
                          <button class="btn btn-success btn-sm me-2" data-bs-toggle="modal" data-bs-target="#modal-ubah"
                            data-id="<?= $data['id_surat_masuk'] ?>"
                            data-tglmasuk="<?= $data['tgl_masuk'] ?>"
                            data-nomor="<?= $data['nomor_surat'] ?>"
                            data-tglsurat="<?= $data['tgl_surat'] ?>"
                            data-perihal="<?= $data['perihal'] ?>"
                            data-asal="<?= $data['asal_surat'] ?>"
                            data-nip="<?= $data['nip'] ?>">
                            <i class="fa fa-pencil-alt"></i>
                          </button>
                          <a href="surat-masuk/hapus.php?id=<?= $data['id_surat_masuk'] ?>" onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-danger btn-sm">
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

    <!-- Modal Tambah -->
    <div class="modal fade" id="modal-tambah" tabindex="-1">
      <div class="modal-dialog">
        <form class="modal-content" action="surat-masuk/proses_tambah.php" method="POST" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Surat Masuk</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <input type="date" name="tgl_masuk" class="form-control mb-2" placeholder="Tanggal Masuk" required>
            <input type="text" name="nomor_surat" class="form-control mb-2" placeholder="Nomor Surat" required>
            <input type="date" name="tgl_surat" class="form-control mb-2" placeholder="Tanggal Surat" required>
            <input type="text" name="perihal" class="form-control mb-2" placeholder="Perihal" required>
            <input type="text" name="asal_surat" class="form-control mb-2" placeholder="Asal Surat" required>
            <input type="text" name="nip" class="form-control mb-2" placeholder="NIP" required>
            <input type="file" name="upload_file" class="form-control" required>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button class="btn btn-primary" type="submit">Simpan</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Modal Ubah -->
    <div class="modal fade" id="modal-ubah" tabindex="-1">
      <div class="modal-dialog">
        <form class="modal-content" action="surat-masuk/proses_ubah.php" method="POST" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title">Ubah Surat Masuk</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="id_surat_masuk" id="ubah_id">
            <input type="date" name="tgl_masuk" id="ubah_tglmasuk" class="form-control mb-2" required>
            <input type="text" name="nomor_surat" id="ubah_nomor" class="form-control mb-2" required>
            <input type="date" name="tgl_surat" id="ubah_tglsurat" class="form-control mb-2" required>
            <input type="text" name="perihal" id="ubah_perihal" class="form-control mb-2" required>
            <input type="text" name="asal_surat" id="ubah_asal" class="form-control mb-2" required>
            <input type="text" name="nip" id="ubah_nip" class="form-control mb-2" required>
            <input type="file" name="upload_file" class="form-control">
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button class="btn btn-primary" type="submit">Update</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Script isi modal ubah -->
    <script>
      var modalUbah = document.getElementById('modal-ubah');
      modalUbah.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        document.getElementById('ubah_id').value = button.getAttribute('data-id');
        document.getElementById('ubah_tglmasuk').value = button.getAttribute('data-tglmasuk');
        document.getElementById('ubah_nomor').value = button.getAttribute('data-nomor');
        document.getElementById('ubah_tglsurat').value = button.getAttribute('data-tglsurat');
        document.getElementById('ubah_perihal').value = button.getAttribute('data-perihal');
        document.getElementById('ubah_asal').value = button.getAttribute('data-asal');
        document.getElementById('ubah_nip').value = button.getAttribute('data-nip');
      });
    </script>

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
  </div>
</div>
