<?php
session_start();
$koneksi = mysqli_connect("localhost", "root", "", "tu-sekolah");

// Proses login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nip = mysqli_real_escape_string($koneksi, $_POST['nip']);
    $password = $_POST['password'];

    // Cek apakah NIP ada di database
    $query = mysqli_query($koneksi, "SELECT * FROM guru_pegawai WHERE nip = '$nip'");
    if (mysqli_num_rows($query) > 0) {
        // Ambil data pengguna
        $data = mysqli_fetch_array($query);

        // Cek password yang dimasukkan
        if (password_verify($password, $data['password'])) {
            // Jika password benar, set session
            $_SESSION['nip'] = $data['nip'];
            $_SESSION['nama'] = $data['nama'];

            // Tampilkan notifikasi login berhasil
            echo "<script>
                alert('Login berhasil! Selamat datang, " . $data['nama'] . "!');
                window.location.href = '../index.php'; // Arahkan ke halaman utama
            </script>";
            exit();
        } else {
            // Jika password salah
            echo "<script>
                alert('Password salah!');
                window.location.href = 'index.php';
            </script>";
        }
    } else {
        // Jika NIP tidak ditemukan
        echo "<script>
            alert('NIP tidak ditemukan!');
            window.location.href = 'index.php';
        </script>";
    }
} else {
    // Jika tidak ada data POST
    header("Location: index.php");
    exit();
}
?>
