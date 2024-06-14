<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <!-- SweetAlert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
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

        // Tampilkan SweetAlert untuk login berhasil
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Login Berhasil!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = '/tanija/index.php';
                });
              </script>";
        exit(); // Pastikan tidak ada output sebelum header
        } else {
            // Jika password tidak cocok, tampilkan SweetAlert untuk password salah
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Login Gagal!',
                        text: 'Email atau password salah!',
                        confirmButtonText: 'OK'
                    }).then(function() {
                        window.location.href = '../html/login.html';
                    });
                </script>";
        }
    } else {
        // Jika email tidak ditemukan dalam database, tampilkan SweetAlert untuk email tidak ditemukan
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Login Gagal!',
                    text: 'Email tidak ditemukan!',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location.href = '../html/login.html';
                });
            </script>";
    }
?>

</body>
</html>
