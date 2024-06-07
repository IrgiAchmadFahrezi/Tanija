<?php
include 'db_connection.php';
session_start();

// Ambil data dari AJAX
$id_produk = $_POST['id'];
$nama_produk = $_POST['name'];
$harga_produk = $_POST['price'];
$quantity = $_POST['quantity'];

// Tambahkan data ke dalam session
$_SESSION['cart'][] = array(
    'id_produk' => $id_produk,
    'nama_produk' => $nama_produk,
    'harga_produk' => $harga_produk,
    'quantity' => $quantity
);

// Kirim respons ke JavaScript (jika diperlukan)
echo "Product added to cart successfully";
?>
