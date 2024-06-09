<?php
include '../php/db_connection.php'; // Menggunakan file db_connection.php untuk koneksi ke database

if(isset($_POST['ubah'])){ // Cek apakah form telah disubmit
    // Tangkap data yang dikirimkan dari form
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stock = $_POST['stock'];
    $deskripsi = $_POST['deskripsi'];

    // Proses upload gambar baru jika ada
    if(!empty($_FILES['foto']['tmp_name'])){
        $foto = $_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], "../gambar/".$foto); // Simpan gambar ke folder gambar
        // Query untuk mengubah data produk, termasuk gambar baru jika diunggah
        $sql = "UPDATE produk SET nama_produk='$nama', harga_produk='$harga', stock='$stock', deskripsi_produk='$deskripsi', foto_produk='$foto' WHERE id_produk='$_GET[id]'";
    } else {
        // Jika tidak ada gambar baru diunggah, hanya update data tanpa mengubah gambar
        $sql = "UPDATE produk SET nama_produk='$nama', harga_produk='$harga', stock='$stock', deskripsi_produk='$deskripsi' WHERE id_produk='$_GET[id]'";
    }

    if ($conn->query($sql) === TRUE) {
        // Redirect ke halaman lain atau tampilkan pesan keberhasilan
        echo "<script>location='index.php?halaman=produk';</script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Ambil data produk yang akan diubah
$ambil=$conn->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	
</head>
<body>
	<h2>Edit Produk</h2>
<?php 

$ambil=$conn->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
$pecah = $ambil->fetch_assoc();

?>
<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama Produk</label>
		<input type="text" class="form-control" name="nama" value="<?php echo $pecah ['nama_produk'];?>">
	</div>
	<div class="form-group">
		<label>Harga (Rp)</label>
		<input type="number" class="form-control" name="harga" value="<?php echo $pecah ['harga_produk'];?>">
	</div>
	<div class="form-group">
        <label>Stock</label>
        <input type="number" class="form-control" name="stock" value="<?php echo $pecah['stock']; ?>">
</div>

	<div class="form-group">
        <label>Ganti Foto</label>
        <input type="file" name="foto" class="form-control">
    </div>
	<div class="form-group">
		<label>Deskripsi</label>
		<textarea name="deskripsi" class="form-control" rows="10"><?php echo $pecah ['deskripsi_produk']; ?></textarea>
	</div>
    <a href="ubahproduk.php"><button class="btn btn-primary" name="ubah">Edit</button></a>
</form>

<?php

?>


</body>
</html>
