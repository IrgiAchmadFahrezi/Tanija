<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login_admin.php');
    exit();
}

include '../php/db_connection.php';

// Ambil data dari form
$nama_produk = $_POST['nama_produk'];
$harga_produk = $_POST['harga_produk'];
$kategori = $_POST['kategori'];
$deskripsi_produk = $_POST['deskripsi_produk'];
$stock = $_POST['stock'];

// Ambil nama file yang diupload
$nama_file = $_FILES["foto_produk"]["name"];

// Direktori tempat penyimpanan file (pastikan folder uploads ada di dalam root direktori)
$target_dir = "../uploads/";

// Path lengkap file yang akan disimpan
$target_file = $target_dir . basename($nama_file);

// Pindahkan file yang diupload ke direktori tujuan
if (move_uploaded_file($_FILES["foto_produk"]["tmp_name"], $target_file)) {
    // Lakukan query untuk menyimpan data produk beserta path foto ke database menggunakan prepared statements
    $stmt = $conn->prepare("INSERT INTO produk (nama_produk, harga_produk, foto_produk, kategori, deskripsi_produk, stock) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $nama_produk, $harga_produk, $nama_file, $kategori, $deskripsi_produk, $stock);

    if ($stmt->execute()) {
        echo "New product added successfully";
        echo "<script>location='index.php?halaman=produk';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Sorry, there was an error uploading your file.";
}

$conn->close();
?>
