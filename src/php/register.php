<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Mengimpor file koneksi database
include 'db_connection.php';

// Memproses data dari formulir pendaftaran
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_user = $conn->real_escape_string($_POST['nama_user']);
    $email_user = $conn->real_escape_string($_POST['email_user']);
    // Menggunakan MD5 untuk menghash password
    $password_user = md5($conn->real_escape_string($_POST['password_user']));

    // Query untuk menyimpan data pengguna baru
    $sql = "INSERT INTO user (nama_user, email_user, password_user) VALUES ('$nama_user', '$email_user', '$password_user')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Pendaftaran berhasil!";
        // Anda bisa mengarahkan pengguna ke halaman lain di sini
        header("Location: /html/login.html");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Menutup koneksi
$conn->close();
?>
