<?php
session_start();
include '../php/db_connection.php';
include '../php/number.php';

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['email'])) {
    echo "<script>alert('Anda harus login terlebih dahulu untuk melakukan pembelian.'); window.location.href='../html/login.html';</script>";
    exit();
}

// Tangkap keranjang dari sesi
$cart = $_SESSION['cart'];

// Mulai transaksi
$conn->begin_transaction();

try {
    foreach ($cart as $item) {
        $id_produk = $item['id'];
        $jumlah = $item['jumlah'];

        // Kurangi stok produk
        $stok_sql = "SELECT stock FROM produk WHERE id_produk = ?";
        $stok_stmt = $conn->prepare($stok_sql);
        $stok_stmt->bind_param("i", $id_produk);
        $stok_stmt->execute();
        $stok_result = $stok_stmt->get_result();
        $stok_stmt->close();

        if ($stok_result->num_rows > 0) {
            $stok_row = $stok_result->fetch_assoc();
            $stok_produk = $stok_row['stock'];

            if ($jumlah > $stok_produk) {
                throw new Exception('Jumlah produk yang ingin dibeli melebihi stok yang tersedia.');
            } else {
                // Kurangi stok produk
                $new_stok = $stok_produk - $jumlah;
                $update_stok_sql = "UPDATE produk SET stock = ? WHERE id_produk = ?";
                $update_stok_stmt = $conn->prepare($update_stok_sql);
                $update_stok_stmt->bind_param("ii", $new_stok, $id_produk);
                $update_stok_stmt->execute();
                $update_stok_stmt->close();
            }
        } else {
            throw new Exception('Produk tidak ditemukan.');
        }

        // Lakukan proses pembelian lainnya, seperti menyimpan data transaksi
    }

    // Commit transaksi
    $conn->commit();

    // Kosongkan keranjang setelah pembelian berhasil
    unset($_SESSION['cart']);
    echo "<script>alert('Pembelian berhasil. Terima kasih telah berbelanja di Tanija.'); window.location.href='../index.php';</script>";
} catch (Exception $e) {
    // Rollback transaksi jika terjadi kesalahan
    $conn->rollback();
    echo "<script>alert('Pembelian gagal: " . $e->getMessage() . "'); window.location.href='../html/cart.php';</script>";
}

$conn->close();
?>
