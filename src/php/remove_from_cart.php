<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_SESSION['cart'])) {
        // Hapus semua item dari keranjang
        unset($_SESSION['cart']);
    }
}

// Redirect kembali ke halaman keranjang
header("Location: ../html/cart.php");
exit();
?>
