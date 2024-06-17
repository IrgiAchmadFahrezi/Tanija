<?php
if (!isset($_SESSION['admin'])) {
    header('Location: login_admin.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<h2>Tambah Produk</h2>

<form action="process_add_product.php" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label>Nama</label>
        <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
    </div>
    <div class="form-group">
        <label>Harga (Rp)</label>
        <input type="number" class="form-control" id="harga_produk" name="harga_produk" required>
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
    <div class="form-group">
        <label>Deskripsi</label>
        <textarea class="form-control" id="deskripsi_produk" name="deskripsi_produk" required></textarea>
    </div>
    <div class="form-group">
        <label>Stock</label>
        <input type="number" class="form-control" id="stock" name="stock" required>
    </div>
    <div class="form-group">
        <label>Foto</label>
        <input type="file" class="form-control" id="foto_produk" name="foto_produk" required>
    </div>
    <button type="submit" class="btn btn-primary">Tambah Produk</button>
</form>

<?php
if (!empty($error)) {
    echo "<div class='alert alert-danger'>$error</div>";
}
?>

</body>
</html>
