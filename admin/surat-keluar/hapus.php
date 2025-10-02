<?php

session_start();
$_SESSION['delete_success'] = 'Data berhasil di hapus!';
include "../koneksi.php";

$id_berita = $_GET['id_berita'];


// query insert ke database
$hapus =mysqli_query($koneksi,"DELETE FROM berita WHERE id_berita='$id_berita'");

if($hapus){
    // jika query berhasil
    echo "<script>
    alert('Data Berhasil Dihapus') 
    window.location.href='../?page=berita/index'
    </script>";
}else{
    // jika query gagal
    echo "<script>
    alert('Data Gagal Dihapus') 
    window.location.href='../?page=berita/index'
    </script>";
}

?>