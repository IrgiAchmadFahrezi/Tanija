<?php
include '../php/db_connection.php'; // Menggunakan file db_connection.php untuk koneksi ke database

if(isset($_POST['ubah'])){ // Cek apakah form telah disubmit
    // Tangkap data yang dikirimkan dari form
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $gambar = $_FILES['gambar']['name'];
    $tanggal = date('Y-m-d'); // Tanggal saat ini
    $penulis = $_POST['penulis'];

    // Proses upload gambar baru jika ada
    if(!empty($_FILES['gambar']['tmp_name'])){
        move_uploaded_file($_FILES['gambar']['tmp_name'], "../uploads-artikel/".$gambar); // Simpan gambar ke folder uploads-artikel
        // Query untuk mengubah data artikel, termasuk gambar baru jika diunggah
        $sql = "UPDATE artikel SET judul='$judul', isi='$isi', gambar='$gambar', tanggal='$tanggal', penulis='$penulis' WHERE id_artikel='$_GET[id]'";
    } else {
        // Jika tidak ada gambar baru diunggah, hanya update data tanpa mengubah gambar
        $sql = "UPDATE artikel SET judul='$judul', isi='$isi', tanggal='$tanggal', penulis='$penulis' WHERE id_artikel='$_GET[id]'";
    }

    if ($conn->query($sql) === TRUE) {
        // Redirect ke halaman lain atau tampilkan pesan keberhasilan
        echo "<script>location='index.php?halaman=artikel';</script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Ambil data artikel yang akan diubah
$ambil = $conn->query("SELECT * FROM artikel WHERE id_artikel='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Artikel</title>
    
</head>
<body>
    <h2>Edit Artikel</h2>
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Judul Artikel</label>
            <input type="text" class="form-control" name="judul" value="<?php echo $pecah['judul']; ?>">
        </div>
        <div class="form-group">
            <label>Gambar</label>
            <input type="file" name="gambar" class="form-control">
            <img src="../uploads-artikel/<?php echo $pecah['gambar']; ?>" width="100" height="100" alt="Gambar Artikel">
        </div>
        <div class="form-group">
            <label>Isi Artikel</label>
            <textarea name="isi" class="form-control" rows="10"><?php echo $pecah['isi']; ?></textarea>
        </div>
        <div class="form-group">
            <label>Penulis</label>
            <input type="text" class="form-control" name="penulis" value="<?php echo $pecah['penulis']; ?>">
        </div>
        <button type="submit" class="btn btn-primary" name="ubah">Edit</button>
    </form>
</body>
</html>
