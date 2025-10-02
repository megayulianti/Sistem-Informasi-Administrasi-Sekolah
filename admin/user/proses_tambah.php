<?php
session_start();
include '../koneksi.php';

$username = $_POST['username'];
$nama_lengkap = $_POST['nama_lengkap'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$level = $_POST['level'];

// Validasi level hanya boleh 'admin' atau 'kepala sekolah'
if ($level !== 'admin' && $level !== 'kepala sekolah') {
    echo "<script>
        alert('Level tidak valid!');
        window.location.href = '../?page=user/index';
    </script>";
    exit();
}

// Upload foto
$foto = $_FILES['foto']['name'];
$tmp = $_FILES['foto']['tmp_name'];
$path = "gambar/" . $foto;

if (move_uploaded_file($tmp, $path)) {
    $query = mysqli_query($koneksi, "INSERT INTO user (username, nama_lengkap, password, foto, level) VALUES ('$username', '$nama_lengkap', '$password', '$foto', '$level')");

    if ($query) {
        echo "<script>
            alert('Data user berhasil disimpan!');
            window.location.href = '../?page=user/index';
        </script>";
    } else {
        $error = addslashes(mysqli_error($koneksi));
        echo "<script>
            alert('Gagal menyimpan data user: $error');
            window.history.back();
        </script>";
    }
} else {
    echo "<script>
        alert('Gagal mengupload foto!');
        window.history.back();
    </script>";
}
?>
