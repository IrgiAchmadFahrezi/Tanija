<?php
include 'db_connection.php';
session_start();
include 'db_connection.php';

// Ambil data dari AJAX
$id_produk = $_POST['id'];
$quantity = $_POST['quantity'];

// Query untuk mendapatkan detail produk
$sql = "SELECT * FROM produk WHERE id_produk = $id_produk";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nama_produk = $row['nama_produk'];
    $harga_produk = $row['harga_produk'];
    $foto_produk = $row['foto_produk']; // Tambahkan foto produk ke variabel

    // Tambahkan data ke dalam session
    $_SESSION['cart'][] = array(
        'id_produk' => $id_produk,
        'nama_produk' => $nama_produk,
        'harga_produk' => $harga_produk,
        'quantity' => $quantity,
        'foto_produk' => $foto_produk // Simpan foto produk di sesi
    );
} else {
    echo "Produk tidak ditemukan";
}

// Tutup koneksi database
$conn->close();

// Kirim respons ke JavaScript (jika diperlukan)
echo "Produk berhasil ditambahkan ke keranjang";
?>
<?php
session_start();
include 'db_connection.php';

// Ambil data dari AJAX
$id_produk = $_POST['id'];
$quantity = $_POST['quantity'];

// Query untuk mendapatkan detail produk
$sql = "SELECT * FROM produk WHERE id_produk = $id_produk";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nama_produk = $row['nama_produk'];
    $harga_produk = $row['harga_produk'];
    $foto_produk = $row['foto_produk']; // Tambahkan foto produk ke variabel

    // Tambahkan data ke dalam session
    $_SESSION['cart'][] = array(
        'id_produk' => $id_produk,
        'nama_produk' => $nama_produk,
        'harga_produk' => $harga_produk,
        'quantity' => $quantity,
        'foto_produk' => $foto_produk // Simpan foto produk di sesi
    );
} else {
    echo "Produk tidak ditemukan";
}

// Tutup koneksi database
$conn->close();

// Kirim respons ke JavaScript (jika diperlukan)
echo "Produk berhasil ditambahkan ke keranjang";
?>
