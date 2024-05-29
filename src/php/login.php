<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Mengimpor file koneksi database
include 'db_connection.php';

// Ambil nilai dari formulir login
$email = $_POST['email'];
$password = $_POST['password'];

// Kueri untuk mendapatkan data user dari database berdasarkan email
$query = "SELECT * FROM user WHERE email_user='$email'";
$result = mysqli_query($conn, $query);

// Periksa apakah email ditemukan dalam database
if (mysqli_num_rows($result) == 1) {
    // Ambil data user dari hasil kueri
    $row = mysqli_fetch_assoc($result);
    $hashed_password_db = $row['password_user'];

    // Verifikasi password
    // Jika password di database di-hash dengan MD5
    if ($hashed_password_db == md5($password)) {
        // Jika password cocok, lanjutkan sesi atau tindakan lainnya
        session_start();
        $_SESSION['email'] = $email;
        $_SESSION['nama_user'] = $row['nama_user']; // Ambil nama pengguna dari hasil kueri

        echo "Login berhasil!";
        header("Location: /tanija/index.php");
        exit(); // Pastikan tidak ada output sebelum header
    } else {
        // Jika password tidak cocok, tampilkan pesan kesalahan
        echo "Email atau password salah!";
    }
} else {
    // Jika email tidak ditemukan dalam database, tampilkan pesan kesalahan
    echo "Email tidak ditemukan!";
}
?>
