<?php
include 'db_connection.php';
session_start();

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $namaUser = $_SESSION['nama_user'] ?? 'Guest';
    $namaPenerima = $_POST['namaPenerima'];
    $nomorHandphone = $_POST['nomorHandphone'];
    $alamat = $_POST['alamat'];
    $ongkir = $_POST['ongkir'];
    $totalPembayaran = $_POST['totalPembayaran'];
    $statusPembayaran = $_POST['statusPembayaran'];
    
    // Proses detail barang
    $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
    $detailBarang = [];
    foreach ($cart as $product_id => $product) {
        $detailBarang[] = $product['nama'] . " (" . $product['jumlah'] . ")";
    }
    $detailBarangString = implode(", ", $detailBarang);

    // Insert into riwayat_pemesanan
    $sql = "INSERT INTO riwayat_pemesanan (nama_user, detail_barang, nama_penerima, nomor_handphone, alamat, ongkir, total_pembayaran, status_pembayaran) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssiis", $namaUser, $detailBarangString, $namaPenerima, $nomorHandphone, $alamat, $ongkir, $totalPembayaran, $statusPembayaran);

    if ($stmt->execute()) {
        $lastInsertId = $stmt->insert_id;

        // Insert into detail_barang
        foreach ($cart as $product_id => $product) {
            $idProduk = $product['id'];
            $namaBarang = $product['nama'];
            $jumlah = $product['jumlah'];
            $harga = $product['harga'];
            $sqlDetail = "INSERT INTO detail_barang (id_pemesanan, id_produk, nama_barang, jumlah, harga) VALUES (?, ?, ?, ?, ?)";
            $stmtDetail = $conn->prepare($sqlDetail);
            $stmtDetail->bind_param("iisid", $lastInsertId, $idProduk, $namaBarang, $jumlah, $harga);
            $stmtDetail->execute();
        }

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}
?>