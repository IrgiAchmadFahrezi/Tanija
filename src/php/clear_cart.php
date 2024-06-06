<?php
session_start();

// Hapus semua item dari keranjang belanja
unset($_SESSION['cart']);

// Redirect kembali ke halaman pembayaran
header("Location: detail-pembayaran.php");
?>
