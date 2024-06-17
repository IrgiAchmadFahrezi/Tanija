<?php
// Pastikan file ini adalah skrip PHP yang valid dan sesuai dengan kebutuhan aplikasi Anda

// Mulai atau lanjutkan sesi jika belum dimulai
session_start();



// Periksa apakah ada data yang dikirimkan melalui POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id'])) {
    // Ambil product_id dari POST data
    $product_id = $_POST['product_id'];

    // Simulasi penghapusan produk dari session keranjang
    // Di sini kita asumsikan session 'cart' berisi produk yang ada dalam keranjang belanja
    if (isset($_SESSION['cart']) && isset($_SESSION['cart'][$product_id])) {
        // Hapus produk dari keranjang (session)
        unset($_SESSION['cart'][$product_id]);

        // Redirect kembali ke halaman keranjang belanja atau halaman sebelumnya
        header("Location: ../html/cart.php");
        exit();
    } else {
        // Jika produk tidak ditemukan dalam keranjang, mungkin perlu menangani kasus ini
        $error = "Produk tidak ditemukan dalam keranjang belanja.";
        // Opsional: Anda dapat menangani ini dengan mengirimkan pesan kesalahan atau melakukan tindakan lain
    }
} else {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_SESSION['cart'])) {
            // Hapus semua item dari keranjang
            unset($_SESSION['cart']);
        }
    }
    
    // Redirect kembali ke halaman keranjang
    header("Location: ../html/cart.php");
    exit();
    }


?>
