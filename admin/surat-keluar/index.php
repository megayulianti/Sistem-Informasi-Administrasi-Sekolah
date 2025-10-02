<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Data Berita</h3>
      <ul class="breadcrumbs mb-3">
        <li class="nav-home">
          <a href="#">
            <i class="icon-home"></i>
          </a>
        </li>
        <li class="separator">
          <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
          <a href="#">Data Berita</a>
        </li>
      </ul>
    </div>

        <!-- Row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Data Berita</h4>
                        <button type="button" class="btn btn-primary btn-round" data-bs-toggle="modal" data-bs-target="#modal-tambah">
                            Tambah Data
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="add-row" class="display table table-bordered table-striped table-hover">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>judul berita</th>
                                        <th>Isi Berita</th>
                                        <th>Tanggal Berita</th>
                                        <th>Gambar Berita</th>
                                        <th style="width: 30%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $query = mysqli_query($koneksi, "SELECT * FROM berita ORDER BY id_berita DESC");
                                    while ($data = mysqli_fetch_array($query)) {
                                    ?>
                                    <tr class="text-center">
                                        <td><?php echo $no++ ?></td>
                                        <td><?= $data['judul_berita'] ?></td>
                                        <td><?= $data['isi_berita'] ?></td>
                                        <td><?= $data['tanggal_publikasi']; ?></td>
                                        <td>
                                            <?php echo "<img src='berita/gambar_berita/".$data['gambar_berita']."' style='width: 100px; height: 100px; object-fit: cover;' alt='".$data['judul_berita']."' >"; ?>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a href="#" 
                                                    class="btn btn-success btn-sm mr-2" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#modal-ubah" 
                                                    data-id="<?= $data['id_berita'] ?>" 
                                                    data-judul="<?= $data['judul_berita'] ?>" 
                                                    data-isi="<?= $data['isi_berita'] ?>"
                                                    data-tanggal="<?= $data['tanggal_publikasi'] ?>">
                                                    <i class="fa fa-pencil-alt"></i>
                                                </a>
                                                <a onclick="return confirm('Yakin ingin dihapus?')" 
                                                    href="berita/hapus.php?id_berita=<?= $data['id_berita'] ?>" 
                                                    class="btn btn-danger btn-sm">
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

<!-- Modal Tambah Data Berita -->
<div class="modal fade" id="modal-tambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTambahLabel">Tambah Berita</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="berita/proses_tambah.php" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="judul_berita" class="form-label">Judul Berita</label>
            <input type="text" id="judul_berita" name="judul_berita" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="isi_berita" class="form-label">Isi Berita</label>
            <textarea id="isi_berita" name="isi_berita" class="form-control" required></textarea>
          </div>

          <div class="mb-3">
            <label for="tanggal_publikasi" class="form-label">Tanggal Publikasi</label>
            <input type="date" id="tanggal_publikasi" name="tanggal_publikasi" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="gambar_berita" class="form-label">Gambar Berita</label>
            <input type="file" id="gambar_berita" name="gambar_berita" class="form-control-file" required>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Modal Ubah Data Berita -->
<div class="modal fade" id="modal-ubah" tabindex="-1" aria-labelledby="modalUbahLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalUbahLabel">Ubah Berita</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Form untuk mengubah data berita -->
        <form action="berita/proses_ubah.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id_berita" id="id_berita_ubah"> <!-- Corrected the name attribute -->
          <div class="mb-3">
            <label for="judul_berita_ubah" class="form-label">Judul Berita</label>
            <input type="text" id="judul_berita_ubah" name="judul_berita" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="isi_berita_ubah" class="form-label">Isi Berita</label>
            <textarea id="isi_berita_ubah" name="isi_berita" class="form-control" required></textarea>
          </div>
          <div class="mb-3">
            <label for="tanggal_publikasi_ubah" class="form-label">Tanggal Publikasi</label>
            <input type="date" id="tanggal_publikasi_ubah" name="tanggal_publikasi" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="gambar_berita_ubah" class="form-label">Gambar Berita</label>
            <input type="file" id="gambar_berita_ubah" name="gambar_berita" class="form-control">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    var modalUbah = document.getElementById('modal-ubah');
    modalUbah.addEventListener('show.bs.modal', function (event) {
      var button = event.relatedTarget; // Button that triggered the modal
      var id = button.getAttribute('data-id');
      var judulBerita = button.getAttribute('data-judul');
      var isiBerita = button.getAttribute('data-isi');
      var tanggalPublikasi = button.getAttribute('data-tanggal');
      var gambarBerita = button.getAttribute('data-gambar');

      var inputIdBerita = modalUbah.querySelector('#id_berita_ubah');
      var inputJudulBerita = modalUbah.querySelector('#judul_berita_ubah');
      var inputIsiBerita = modalUbah.querySelector('#isi_berita_ubah');
      var inputTanggalPublikasi = modalUbah.querySelector('#tanggal_publikasi_ubah');
      var inputGambarBerita = modalUbah.querySelector('#gambar_berita_ubah');

      inputIdBerita.value = id;
      inputJudulBerita.value = judulBerita;
      inputIsiBerita.value = isiBerita;
      inputTanggalPublikasi.value = tanggalPublikasi;
      // Note: for file input (gambar), we cannot set value directly for security reasons.
      // You might want to display the current image name or similar information instead.
    });
  });
</script>





<?php if (isset($_SESSION['save_success'])): ?>
  <script>
    Swal.fire({
      position: 'center',
      icon: 'success',
      title: '<?= $_SESSION['save_success'] ?>',
      showConfirmButton: false,
      timer: 1500
    });
  </script>
  <?php unset($_SESSION['save_success']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['update_success'])): ?>
  <script>
    Swal.fire({
      position: 'center',
      icon: 'success',
      title: '<?= $_SESSION['update_success'] ?>',
      showConfirmButton: false,
      timer: 1500
    });
  </script>
  <?php unset($_SESSION['update_success']); ?>
<?php endif; ?>


<?php if (isset($_SESSION['delete_success'])): ?>
  <script>
    Swal.fire({
      position: 'center',
      icon: 'success',
      title: '<?= $_SESSION['delete_success'] ?>',
      showConfirmButton: false,
      timer: 1500
    });
  </script>
  <?php unset($_SESSION['delete_success']); ?>
<?php endif; ?>