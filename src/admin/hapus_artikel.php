<!DOCTYPE html>
<html>
<head>
    <title>Hapus Artikel</title>
</head>
<body>
<?php
include '../php/db_connection.php'; // Menggunakan file db_connection.php untuk koneksi ke database

// Memeriksa apakah ada parameter id di URL
if(isset($_GET['id'])) {
    $id_artikel = $_GET['id'];

    // Query untuk mengambil informasi artikel yang akan dihapus
    $ambil = $conn->query("SELECT * FROM artikel WHERE id_artikel='$id_artikel'");
    $pecah = $ambil->fetch_assoc();
    $gambar_artikel = $pecah['gambar'];

    // Hapus file gambar artikel jika ada
    if (file_exists("../uploads-artikel/$gambar_artikel")) {
        unlink("../uploads-artikel/$gambar_artikel");
    }

    // Query untuk menghapus data artikel dari database
    $hapus = $conn->query("DELETE FROM artikel WHERE id_artikel='$id_artikel'");

    if($hapus) {
        // Jika penghapusan berhasil, tampilkan pesan sukses dan redirect ke halaman index.php
        echo "<script>alert('Artikel telah berhasil dihapus.');</script>";
        echo "<script>location='index.php?halaman=artikel';</script>";
    } else {
        // Jika terjadi kesalahan saat menghapus, tampilkan pesan error
        echo "<script>alert('Gagal menghapus artikel.');</script>";
    }
} else {
    // Jika tidak ada parameter id di URL, redirect ke halaman index.php
    echo "<script>location='index.php?halaman=artikel';</script>";
}
?>
</body>
</html>
