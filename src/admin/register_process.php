<?php
// Koneksi ke database
include '../php/db_connection.php';


// Tangkap data dari formulir pendaftaran
$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];

// Hash password sebelum disimpan ke database
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Query SQL untuk memasukkan data ke dalam tabel admin
$sql = "INSERT INTO admin (nama_admin, email_admin, password_admin)
        VALUES ('$name', '$email', '$hashed_password')";

// Eksekusi query dan periksa hasilnya
if ($conn->query($sql) === TRUE) {
    echo "Pendaftaran berhasil!";
    header('Location: login_admin.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Tutup koneksi
$conn->close();
?>
