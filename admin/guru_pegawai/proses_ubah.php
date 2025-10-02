<?php
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nip_lama = htmlspecialchars($_POST['nip_lama']);
    $nip      = htmlspecialchars($_POST['nip']);
    $nama     = htmlspecialchars($_POST['nama']);
    $email    = htmlspecialchars($_POST['email']);
    $no_hp    = htmlspecialchars($_POST['no_hp']);
    $alamat   = htmlspecialchars($_POST['alamat']);
    $jabatan  = htmlspecialchars($_POST['jabatan']);
    $status   = htmlspecialchars($_POST['status']);
    $password = $_POST['password']; // tidak pakai htmlspecialchars agar bisa hash

    // Update query dasar
    $query = "UPDATE guru_pegawai SET
                nip = '$nip',
                nama = '$nama',
                email = '$email',
                no_hp = '$no_hp',
                alamat = '$alamat',
                jabatan = '$jabatan',
                status = '$status'";

    // Jika password diisi, tambahkan ke query
    if (!empty($password)) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $query .= ", password = '$password_hash'";
    }

    $query .= " WHERE nip = '$nip_lama'";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data berhasil diubah'); window.location.href='../?page=guru_pegawai/index';</script>";
    } else {
        echo "<script>alert('Gagal mengubah data'); window.history.back();</script>";
    }
}
?>
