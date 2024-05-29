<?php
session_start();

$response = ['logged_in' => false];

if (isset($_SESSION['email'])) {
    $response['logged_in'] = true;
    $response['nama_user'] = $_SESSION['nama_user'];
}

echo json_encode($response);
?>

