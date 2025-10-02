<?php
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nip     = htmlspecialchars($_POST['nip']);
    $nama    = htmlspecialchars($_POST['nama']);
    $email   = htmlspecialchars($_POST['email']);
    $no_hp   = htmlspecialchars($_POST['no_hp']);
    $alamat  = htmlspecialchars($_POST['alamat']);
    $jabatan = htmlspecialchars($_POST['jabatan']);
    $status  = htmlspecialchars($_POST['status']);
    $password = $_POST['password']; // jangan di-htmlspecialchars untuk hash

    // Enkripsi password
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO guru_pegawai 
              (nip, nama, email, no_hp, alamat, jabatan, status, password)
              VALUES 
              ('$nip', '$nama', '$email', '$no_hp', '$alamat', '$jabatan', '$status', '$password_hash')";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data berhasil ditambahkan'); window.location.href='../?page=guru_pegawai/index';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan data'); window.history.back();</script>";
    }
}
?>
