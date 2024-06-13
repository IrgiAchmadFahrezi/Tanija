<?php
session_start();
include '../php/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_produk = $_POST['id'];
    $jumlah = $_POST['quantity'];
    $foto_produk = $_POST['foto_produk'];

    // Jika tindakan adalah buy_now, kurangi stok
    if (isset($_POST['action']) && $_POST['action'] == 'buy_now') {
        // Periksa stok produk dari database
        $sql = "SELECT stock FROM produk WHERE id_produk = '$id_produk'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $stok_tersedia = $row['stock'];

            // Periksa apakah stok cukup untuk pembelian
            if ($jumlah <= $stok_tersedia) {
                // Kurangi jumlah stok yang dibeli dari jumlah stok yang tersedia
                $stok_baru = $stok_tersedia - $jumlah;

                // Perbarui jumlah stok produk di database
                $update_sql = "UPDATE produk SET stock = '$stok_baru' WHERE id_produk = '$id_produk'";
                $update_result = $conn->query($update_sql);

                if ($update_result) {
                    echo "Stok berhasil diperbarui dan pesanan disimpan.";
                } else {
                    echo "Gagal memperbarui stok produk di database.";
                }
            } else {
                echo "Jumlah yang dibeli melebihi stok yang tersedia.";
            }
        } else {
            echo "Produk tidak ditemukan dalam database.";
        }
    } else {
        // Jika tindakan bukan buy_now, tambahkan ke keranjang
        $item = array(
            'id' => $id_produk,
            'foto_produk' => $foto_produk,
            'jumlah' => $jumlah
        );

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        array_push($_SESSION['cart'], $item);

        echo "Produk berhasil ditambahkan ke keranjang.";
    }
} else {
    echo "Metode permintaan tidak valid.";
}
?>
