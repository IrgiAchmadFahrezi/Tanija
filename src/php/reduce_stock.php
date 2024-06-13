<?php
session_start();
include 'db_connection.php'; // Sesuaikan dengan file koneksi Anda

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_produk = $_POST['id_produk'];
    $jumlah = $_POST['jumlah'];

    // Query untuk mengurangi stok
    $sql = "UPDATE produk SET stock = stock - $jumlah WHERE id_produk = $id_produk";

    if ($conn->query($sql) === TRUE) {
        echo "Stok berhasil diperbarui.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
