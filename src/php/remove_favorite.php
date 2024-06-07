<?php
session_start();
if (isset($_POST['id_produk'])) {
    $id_produk = $_POST['id_produk'];
    if (isset($_SESSION['favorites'][$id_produk])) {
        unset($_SESSION['favorites'][$id_produk]);
    }
}
// Redirect ke halaman favorite.php
header("Location: ../html/favorite.php");
exit();
?>
