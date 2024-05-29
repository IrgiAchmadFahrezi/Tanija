<?php
session_start();
include 'db_connection.php';

$email = $_POST['email'];
$password = $_POST['password'];

// Hashing the password
$password = md5($password);

$sql = "SELECT * FROM admin WHERE email_admin = '$email' AND password_admin = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $_SESSION['admin'] = $email;
    header('Location: add_product.php');
} else {
    echo "Login gagal. Silakan coba lagi.";
}
$conn->close();
?>
