<?php
session_start();
include '../php/db_connection.php';

$email = $_POST['email'];
$password = $_POST['password'];

// Escape email to prevent SQL injection
$email = $conn->real_escape_string($email);

// Query to check if the email exists in the admin table
$sql = "SELECT * FROM admin WHERE email_admin = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // If there is a record with the provided email
    $row = $result->fetch_assoc();
    // Verify the password
    if (password_verify($password, $row['password_admin'])) {
        // Store entire admin info in session
        $_SESSION['admin'] = [
            'email_admin' => $row['email_admin'],
            'nama_admin' => $row['nama_admin']
        ];
        header('Location: index.php');
        exit(); // It's good practice to exit after redirecting
    } else {
        echo "Login gagal. Password salah.";
    }
} else {
    echo "Login gagal. Email tidak ditemukan.";
}

// Close the database connection
$conn->close();
?>
