<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tambah Artikel - Tanija</title>
</head>
<body>
        <h2>Tambah Artikel</h2>
        <form action="tambah_artikel_process.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul" required>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
            </div>
            <div class="form-group">
                <label for="gambar">Gambar Artikel</label>
                <input type="file" class="form-control-file" id="gambar" name="gambar" required>
            </div>
            <div class="form-group">
                <label for="sumber">Sumber</label>
                <input type="text" class="form-control" id="sumber" name="sumber" required>
            </div>
            <div class="form-group">
                <label for="penulis">Penulis</label>
                <input type="text" class="form-control" id="penulis" name="penulis" required>
            </div>
            <div class="form-group">
                <label for="isi">Isi Artikel</label>
                <textarea class="form-control" id="isi" name="isi" rows="6" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Artikel</button>
        </form>

</body>
</html>
