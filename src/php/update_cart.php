<?php
session_start();

if (isset($_POST['product_id']) && isset($_POST['new_quantity'])) {
    $productId = $_POST['product_id'];
    $newQuantity = $_POST['new_quantity'];

    // Perbarui jumlah produk dalam session cart
    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]['jumlah'] = $newQuantity;
    }
}
