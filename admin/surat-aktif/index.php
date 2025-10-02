<?php
include('../koneksi.php');
session_start();
?>

<!-- Tambahkan ini di bagian <head> atau sebelum penutup </head> -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Data Surat Aktif</h3>
      <ul class="breadcrumbs mb-3">
        <li class="nav-home">
          <a href="#"><i class="icon-home"></i></a>
        </li>
        <li class="separator"><i class="icon-arrow-right"></i></li>
        <li class="nav-item"><a href="#">Data Surat Aktif</a></li>
      </ul>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Data Surat Aktif</h4>
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
                    <th>Nama Guru</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Jenis Kelamin</th>
                    <th>Nomor Surat</th>
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
                    <td><?= $data['nama_guru'] ?></td>
                    <td><?= $data['nama_siswa'] ?></td>
                    <td><?= $data['kelas'] ?></td>
                    <td><?= $data['jenis_kelamin'] ?></td>
                    <td><?= $data['nomor_surat'] ?></td>
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
                        <a href="surat-aktif/cetak.php?id=<?= $data['id_surat_aktif'] ?>" class="btn btn-info btn-sm mr-2" target="_blank">
                          <i class="fa fa-print"></i>
                        </a>
                        <a onclick="return confirm('Yakin ingin dihapus?')" href="surat-aktif/hapus.php?id=<?= $data['id_surat_aktif'] ?>" class="btn btn-danger btn-sm">
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

<!-- Modal Tambah Data -->
<div class="modal fade" id="modal-tambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="surat-aktif/proses_tambah.php" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Surat Aktif</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="nomor_surat">Nomor Surat</label>
              <input type="text" class="form-control" name="nomor_surat" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="nama_guru">Nama Guru</label>
              <input type="text" class="form-control" name="nama_guru" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="nip">Nip</label>
              <input type="text" class="form-control" name="nip" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="pangkat_golongan">Pangkat Golongan</label>
              <input type="text" class="form-control" name="pangkat_golongan" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="jabatan">jabatan</label>
              <input type="text" class="form-control" name="jabatan" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="instansi">instansi</label>
              <input type="text" class="form-control" name="instansi" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="npsn">npsn</label>
              <input type="text" class="form-control" name="npsn" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="nama_siswa">Nama Siswa</label>
              <input type="text" class="form-control" name="nama_siswa" required>
            </div>
             <div class="col-md-6 mb-3">
              <label for="tempat_tanggal_lahir">Tempat/tanggal lahir</label>
              <input type="text" class="form-control" name="tempat_tanggal_lahir" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="nisn">Nisn</label>
              <input type="text" class="form-control" name="nisn" required>
            </div>
           <div class="col-md-6 mb-3">
              <label for="jenis_kelamin">Jenis Kelamin</label>
              <select class="form-control" name="jenis_kelamin" required>
                <option value="">-- Pilih Jenis Kelamin --</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
            </div>
            <div class="col-md-6 mb-3">
              <label for="kelas">Kelas</label>
              <input type="text" class="form-control" name="kelas" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="alamat">Alamat</label>
              <input type="text" class="form-control" name="alamat" required>
            </div>
             <div class="col-md-6 mb-3">
              <label for="sekolah">Sekolah</label>
              <input type="text" class="form-control" name="sekolah" required>
            </div>
             <div class="col-md-6 mb-3">
              <label for="no_hp">No Hp</label>
              <input type="text" class="form-control" name="no_hp" required>
            </div>
            <div class="col-md-12 mb-3">
              <label for="keterangan">Keterangan</label>
              <input type="text" class="form-control" name="keterangan" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
      </div>
    </form>
  </div>
</div>


