<?php

// Ensure the favorites session is initialized
if (!isset($_SESSION['favorites'])) {
  $_SESSION['favorites'] = [];
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Count the number of favorite items
$favoriteCount = count($_SESSION['favorites']);
$cartCount = count($_SESSION['cart']);
?>