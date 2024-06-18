<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="dicoding:email" content="irgifahrezi78@gmail.com">
    <title>My Page</title>
    <!-- Include Sweet Alert Library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
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
        echo "<script>
                Swal.fire({
                    icon: 'info',
                    title: 'Info',
                    text: 'Review sudah dikirimkan untuk produk ini dalam pembelian ini.',
                    confirmButtonColor: '#00880d' // Warna tombol hijau
                }).then((result) => {
                    window.location.href='../html/riwayat_pemesanan.php';
                });
              </script>";
    } else {
        // Query untuk menyimpan review ke dalam tabel 'reviews'
        $query = "INSERT INTO reviews (id_produk, id_pemesanan, nama_user, review_text, review_rating) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iissi", $id_produk, $id_pemesanan, $nama_user, $review_text, $review_rating);
    
        if ($stmt->execute()) {
            echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Review berhasil dikirim.',
                        confirmButtonColor: '#00880d' // Warna tombol hijau
                    }).then((result) => {
                        window.location.href='../html/riwayat_pemesanan.php';
                    });
                  </script>";
        } else {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Gagal mengirim review: " . $conn->error . "',
                        confirmButtonColor: '#00880d' // Warna tombol hijau
                    });
                  </script>";
        }
    }    

    $stmt->close();
    $conn->close();
}
?>

</body>
</html>

