<?php
session_start();

// Proses pembayaran (sesuaikan dengan proses pembayaran yang Anda gunakan)

// Setelah proses pembayaran selesai, kosongkan keranjang
unset($_SESSION['cart']);

// Redirect pengguna ke halaman riwayat pemesanan atau halaman lain yang relevan
header("Location: riwayat_pemesanan.php");
exit();
?>
