<?php
session_start();

$response = ['logged_in' => false];

if (isset($_SESSION['email'])) {
    $response['logged_in'] = true;
    $response['nama_user'] = $_SESSION['nama_user'];
}

echo json_encode($response);
?>


<?php

// Periksa apakah session 'cart' telah diset
if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    // Session 'cart' telah diset, lakukan sesuatu
    // Misalnya, tampilkan jumlah item dalam keranjang
    $totalItems = count($_SESSION['cart']);
    echo "Jumlah item dalam keranjang: " . $totalItems;
    echo '<table class="table">';
        echo '<thead>';
        echo '<tr>';
        echo '<th scope="col">ID Produk</th>';
        echo '<th scope="col">Nama Produk</th>';
        echo '<th scope="col">Harga</th>';
        echo '<th scope="col">Jumlah</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        foreach ($_SESSION['cart'] as $item) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($item['id']) . '</td>';
            echo '<td>' . htmlspecialchars($item['nama']) . '</td>';
            echo '<td>' . htmlspecialchars($item['harga']) . '</td>';
            echo '<td>' . htmlspecialchars($item['jumlah']) . '</td>';
            echo '</tr>';
        }
} else {
    // Jika session 'cart' belum diset atau kosong
    echo "Keranjang belanja kosong";
}
?>

<?php


// Periksa apakah sesi 'cart' ada dan tidak kosong
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    // Loop melalui setiap produk dalam keranjang belanja
    foreach ($_SESSION['cart'] as $product_id => $product) {
        echo "Product ID: " . $product['id'] . "<br>";
        echo "Product Name: " . $product['nama'] . "<br>";
        echo "Product Price: " . $product['harga'] . "<br>";
        echo "Product Quantity: " . $product['jumlah'] . "<br>";
        // Tambahkan informasi foto produk jika tersedia
        if (isset($product['foto_produk'])) {
            echo "Product Image: " . $product['foto_produk'] . "<br>";
        }
        echo "<hr>";
    }
} else {
    echo "Keranjang belanja kosong.";
}
?>
