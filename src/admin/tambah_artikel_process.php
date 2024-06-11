<?php
include '../php/db_connection.php';

// Tangkap data dari form
$judul = $_POST['judul'];
$tanggal = $_POST['tanggal'];
$sumber = $_POST['sumber'];
$penulis = $_POST['penulis'];
$isi = $_POST['isi'];

// Tangkap gambar artikel
$gambar = $_FILES['gambar']['name'];
$tmp_name = $_FILES['gambar']['tmp_name'];
$folder = "../uploads-artikel/";

// Pindahkan gambar ke folder uploads
move_uploaded_file($tmp_name, $folder.$gambar);

// Masukkan data ke dalam database
$sql = "INSERT INTO artikel (judul, tanggal, gambar, sumber, penulis, isi) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $judul, $tanggal, $gambar, $sumber, $penulis, $isi);
if ($stmt->execute()) {
    echo "<script>alert('Artikel berhasil ditambahkan.');</script>";
    echo "<script>location='index.php?halaman=artikel';</script>";
} else {
    echo "<script>alert('Gagal menambahkan artikel. Silakan coba lagi.');</script>";
    echo "<script>window.history.back();</script>"; // Kembali ke halaman sebelumnya jika gagal
}
$stmt->close();
$conn->close();
?>
