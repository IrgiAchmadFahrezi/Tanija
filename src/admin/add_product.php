<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login_admin.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Add Product</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Add Product</h2>
        <form action="process_add_product.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nama_produk" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
            </div>
            <div class="mb-3">
                <label for="harga_produk" class="form-label">Price</label>
                <input type="number" class="form-control" id="harga_produk" name="harga_produk" required>
            </div>
            <div class="mb-3">
                <label for="foto_produk" class="form-label">Product Image</label>
                <input type="file" class="form-control" id="foto_produk" name="foto_produk" required>
            </div>
            <div class="mb-3">
                <label for="kategori" class="form-label">Category</label>
                <select class="form-control" id="kategori" name="kategori" required>
                    <option value="">Select Category</option>
                    <option value="pupuk">Pupuk</option>
                    <option value="alat pertanian">Alat Pertanian</option>
                    <option value="bibit tanaman">Bibit Tanaman</option>
                    <option value="pestisida">Pestisida</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="deskripsi_produk" class="form-label">Description</label>
                <textarea class="form-control" id="deskripsi_produk" name="deskripsi_produk" required></textarea>
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" class="form-control" id="stock" name="stock" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>
    </div>
</body>
</html>
