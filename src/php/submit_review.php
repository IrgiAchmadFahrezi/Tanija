<?php
// Koneksi ke database
include 'db_connection.php';

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Periksa apakah pengguna telah memberikan ulasan sebelumnya untuk produk ini
$check_review_sql = "SELECT * FROM reviews WHERE id_pemesanan = ? AND nama_user = ?";
$check_review_stmt = $conn->prepare($check_review_sql);
if ($check_review_stmt) {
    // Bind parameter
    $check_review_stmt->bind_param("is", $id_pemesanan, $nama_user);

    // Set nilai parameter
    $id_pemesanan = $_POST['id_pemesanan'];
    $nama_user = $_POST['nama_user'];

    // Eksekusi statement
    $check_review_stmt->execute();

    // Ambil hasil
    $result = $check_review_stmt->get_result();

    // Periksa apakah ulasan sudah ada
    if ($result->num_rows > 0) {
        // Jika sudah ada ulasan, tampilkan pesan kesalahan
        echo "<script>alert('Anda sudah memberikan ulasan untuk produk ini.'); window.location.href = '../html/detail-pembelian.php?id_pemesanan=$id_pemesanan';</script>";
        // Hentikan eksekusi lebih lanjut atau kembalikan response yang sesuai
        exit();
    }
    // Tutup statement
    $check_review_stmt->close();
} else {
    // Handle error jika periksa ulasan gagal
    echo "Gagal menyiapkan periksa ulasan statement: " . $conn->error;
    exit();
}

// Jika pengguna belum memberikan ulasan, lanjutkan dengan penyimpanan ulasan


// Query untuk menyimpan data
$sql = "INSERT INTO reviews (id_pemesanan, nama_user, review_text, review_rating) VALUES (?, ?, ?, ?)";

// Persiapkan statement
$stmt = $conn->prepare($sql);

if ($stmt) {
    // Bind parameter
    $stmt->bind_param("issi", $id_pemesanan, $nama_user, $review_text, $review_rating);

    // Set nilai parameter
    $id_pemesanan = $_POST['id_pemesanan'];
    $nama_user = $_POST['nama_user'];
    $review_text = $_POST['review_text'];
    $review_rating = $_POST['review_rating'];

    // Validasi data
    if (empty($id_pemesanan) || empty($nama_user) || empty($review_text) || empty($review_rating)) {
        // Handle kesalahan jika ada input yang kosong
        echo "Error: Semua kolom harus diisi.";
    } else {
        // Eksekusi statement
        if ($stmt->execute()) {
            echo "<script>alert('Review berhasil disimpan.'); window.location.href = '../html/detail-pembelian.php?id_pemesanan=$id_pemesanan';</script>";

        } else {
            echo "Gagal menyimpan review: " . $stmt->error;
        }
    }

    // Tutup statement
    $stmt->close();
} else {
    echo "Gagal menyiapkan statement: " . $conn->error;
}

// Tutup koneksi
$conn->close();
?>
