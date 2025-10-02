<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['nip'])) {
  header("Location: login.php");
  exit;
}

$nip = $_SESSION['nip'];
$nama = $_SESSION['nama'];

$query = mysqli_query($koneksi, "SELECT * FROM guru_pegawai WHERE nip = '$nip'");
$data = mysqli_fetch_assoc($query);
?>

<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Akun</h3>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title mb-0">Ubah Password</h4>
          </div>

          <div class="card-body">
            <form action="akun/proses_ubah_password.php" method="POST">
              <div class="mb-3">
                <label for="nip" class="form-label">NIP</label>
                <input type="text" class="form-control" id="nip" value="<?= $data['nip'] ?>" readonly>
              </div>
              <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" value="<?= $data['nama'] ?>" readonly>
              </div>
              <hr>
              <h5>Ubah Password</h5>
              <input type="hidden" name="nip" value="<?= $nip ?>">
              <div class="mb-3">
                <label>Password Baru</label>
                <input type="password" name="password_baru" class="form-control" required>
              </div>
              <div class="mb-3">
                <label>Konfirmasi Password Baru</label>
                <input type="password" name="konfirmasi_password" class="form-control" required>
              </div>
              <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            </form>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
