<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Mengimpor file koneksi database
include 'db_connection.php';

echo "Koneksi berhasil!";
$conn->close();
?>