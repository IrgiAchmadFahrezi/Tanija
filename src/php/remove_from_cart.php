<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['product_id'])) {
        $product_id = $_POST['product_id'];

        if (isset($_SESSION['cart'][$product_id])) {
            unset($_SESSION['cart'][$product_id]);
        }
    }
}

// Pastikan tombol "clear_cart" telah diklik
if(isset($_POST['clear_cart'])) {
    // Hapus semua item dari keranjang
    unset($_SESSION['cart']);
    // Redirect kembali ke halaman keranjang
    header("Location: ../html/cart.php");
    exit();
}

header('Location: ../html/cart.php');
exit();
?>
