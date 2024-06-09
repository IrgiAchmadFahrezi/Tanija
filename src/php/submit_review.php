<?php
session_start();
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_produk = $_POST['id_produk'];
    $id_pemesanan = $_POST['id_pemesanan'];
    $nama_user = $_POST['nama_user'];
    $review_text = $_POST['review_text'];
    $review_rating = $_POST['review_rating'];

    // Cek apakah review sudah ada
    $query = "SELECT COUNT(*) AS review_count FROM reviews WHERE id_pemesanan = ? AND id_produk = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $id_pemesanan, $id_produk);
    $stmt->execute();
    $result = $stmt->get_result();
    $review = $result->fetch_assoc();

    if ($review['review_count'] > 0) {
        echo "Review sudah dikirimkan untuk produk ini dalam pembelian ini.";
    } else {
        // Query untuk menyimpan review ke dalam tabel 'reviews'
        $query = "INSERT INTO reviews (id_produk, id_pemesanan, nama_user, review_text, review_rating) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iissi", $id_produk, $id_pemesanan, $nama_user, $review_text, $review_rating);

        if ($stmt->execute()) {
            echo "Review berhasil dikirim.";
        } else {
            echo "Gagal mengirim review: " . $conn->error;
        }
    }

    $stmt->close();
    $conn->close();
}
?>
