<?php
require_once dirname(__FILE__) . '/midtrans-php-master/Midtrans.php'; // Pastikan Anda telah menginstal library Midtrans PHP

// Setel kunci server Anda
\Midtrans\Config::$serverKey = 'SB-Mid-server-8VZnT2lPZk4zLWN9mCVBM2mP';
\Midtrans\Config::$isProduction = false; // Setel menjadi true untuk produksi
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;

session_start();
include 'db_connection.php'; // Tambahkan ini untuk koneksi ke database

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

if (count($cart) === 0) {
    echo json_encode(['error' => 'Keranjang kosong']);
    exit;
}

// Data dari AJAX
$namaPenerima = $_POST['namaPenerima'];
$nomorHanphone = $_POST['nomorHanphone'];
$ongkir = (int)$_POST['ongkir'];
$alamat = $_POST['alamat'];

// Hitung total harga produk
$totalHargaProduk = 0;
foreach ($cart as $product_id => $product) {
    $totalHargaProduk += $product['harga'] * $product['jumlah'];
}

// Total pembayaran
$totalPembayaran = $totalHargaProduk + $ongkir;

$transaction_details = [
    'order_id' => uniqid(),
    'gross_amount' => $totalPembayaran, // Total pembayaran
];

$item_details = [];
foreach ($cart as $product_id => $product) {
    $item_details[] = [
        'id' => $product_id,
        'price' => $product['harga'],
        'quantity' => $product['jumlah'],
        'name' => $product['nama'],
    ];
}

// Tambahkan ongkir sebagai item detail
$item_details[] = [
    'id' => 'ongkir',
    'price' => $ongkir,
    'quantity' => 1,
    'name' => 'Biaya Pengiriman',
];

$customer_details = [
    'first_name' => $namaPenerima,
    'email' => $_SESSION['email'] ?? 'guest@example.com',
    'phone' => $nomorHanphone,
    'address' => $alamat,
    'shipping_address' => [
        'first_name' => $namaPenerima,
        'phone' => $nomorHanphone,
        'address' => $alamat,
    ],
    'billing_address' => [
        'first_name' => $namaPenerima,
        'phone' => $nomorHanphone,
        'address' => $alamat,
    ],
];

$params = [
    'transaction_details' => $transaction_details,
    'item_details' => $item_details,
    'customer_details' => $customer_details,
];

try {
    $snapToken = \Midtrans\Snap::getSnapToken($params);
    echo json_encode(['token' => $snapToken]);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}

?>
