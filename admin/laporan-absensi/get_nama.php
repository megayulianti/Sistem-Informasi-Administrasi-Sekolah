<?php
include '../koneksi.php'; // sesuaikan path jika file ini di dalam folder 'laporan-absensi'

if (isset($_POST['status'])) {
    $status = $_POST['status'];
    $query = $koneksi->prepare("SELECT nip, nama FROM guru_pegawai WHERE status = ? ORDER BY nama ASC");
    $query->bind_param("s", $status);
    $query->execute();
    $result = $query->get_result();

    echo '<option value="">-- Pilih Nama --</option>';
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['nip'] . '">' . $row['nama'] . '</option>';
    }
}
?>
