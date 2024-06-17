<!DOCTYPE html>
<html>
<head>
    <title>Hapus Produk</title>
</head>
<body>
<?php
include '../php/db_connection.php'; // Menggunakan file db_connection.php untuk koneksi ke database

// Memeriksa apakah ada parameter id di URL
if(isset($_GET['id'])) {
    $id_produk = $_GET['id'];

    // Query untuk mengambil informasi produk yang akan dihapus
    $ambil = $conn->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
    $pecah = $ambil->fetch_assoc();
    $fotoproduk = $pecah['foto_produk'];

    // Hapus file gambar produk jika ada
    if (file_exists("../uploads/$fotoproduk")) {
        unlink("../uploads/$fotoproduk");
    }

    // Query untuk menghapus data produk dari database
    $hapus = $conn->query("DELETE FROM produk WHERE id_produk='$id_produk'");

    if($hapus) {
        // Jika penghapusan berhasil, tampilkan pesan sukses dan redirect ke halaman index.php
        echo "<script>alert('Produk telah berhasil dihapus.');</script>";
        echo "<script>location='index.php?halaman=produk';</script>";
    } else {
        // Jika terjadi kesalahan saat menghapus, tampilkan pesan error
        echo "<script>alert('Gagal menghapus produk.');</script>";
    }
} else {
    // Jika tidak ada parameter id di URL, redirect ke halaman index.php
    echo "<script>location='index.php?halaman=produk';</script>";
}
?>
</body>
</html>
