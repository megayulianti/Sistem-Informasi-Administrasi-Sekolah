<?php
include '../../koneksi.php'; // Sesuaikan dengan path koneksi database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_user = $_POST['id_user'];
    $username = $_POST['username'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $password = $_POST['password'];
    $level = $_POST['level'];

    // Jika ada file baru diunggah
    if ($_FILES['foto']['name'] != "") {
        $foto = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];
        $folder = "../../user/gambar/";

        move_uploaded_file($tmp, $folder . $foto);

        // Update data dengan foto baru
        $query = "UPDATE user SET username='$username', nama_lengkap='$nama_lengkap', password='$password', foto='$foto', level='$level' WHERE id_user='$id_user'";
    } else {
        // Update data tanpa mengganti foto
        $query = "UPDATE user SET username='$username', nama_lengkap='$nama_lengkap', password='$password', level='$level' WHERE id_user='$id_user'";
    }

    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>
            alert('Data berhasil diubah!');
            window.location.href = '../?page=user/index' 
        </script>";
    } else {
        echo "<script>
            alert('Gagal mengubah data!');
            window.history.back();
        </script>";
    }
}
?>
