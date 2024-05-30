<?php
session_start();

$response = ['logged_in' => false];

if (isset($_SESSION['email'])) {
    $response['logged_in'] = true;
    $response['nama_user'] = $_SESSION['nama_user'];
}

echo json_encode($response);
?>


<?php

// Periksa apakah session 'cart' telah diset
if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    // Session 'cart' telah diset, lakukan sesuatu
    // Misalnya, tampilkan jumlah item dalam keranjang
    $totalItems = count($_SESSION['cart']);
    echo "Jumlah item dalam keranjang: " . $totalItems;
} else {
    // Jika session 'cart' belum diset atau kosong
    echo "Keranjang belanja kosong";
}
?>
