<!DOCTYPE html>
<html>
<head>
	<title></title>

    <style>
        .btn-primary {
            background: #FFDE59;
            color: black;
        }
        .btn-danger {
            background: #F63724;
        }
        .btn-warning {
            background: #FF914D;
        }
    </style>
</head>
<body>
<h2>Produk</h2>

<a href="index.php?halaman=tambahartikel" class="btn btn-primary">Tambah Data</a>


<table class="table table-bordered">
	<thead>
		<tr>
			<th>No.</th>
			<th>Judul</th>
			<th>Foto</th>
			<th>tanggal</th>
			<th>isi</th>
            <th>penulis</th>
            <th>aksi</th>
		</tr>
	</thead>
	<tbody>
        
    <?php $nomor = 1; ?>
    <?php $ambil = $conn->query("SELECT * FROM artikel"); ?>
    <?php while ($pecah = $ambil->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $pecah['judul']; ?></td>
            <td>
                <div class="panel-body">
                    <center>
                        <img src="../uploads-artikel/<?php echo $pecah['gambar']; ?>" width="95" height="100">
                    </center>
                </div>
            </td>
            <td><?php echo $pecah['tanggal']; ?></td>
            <td><?php echo substr($pecah['isi'], 0, 200); ?></td>
            <td><?php echo $pecah['penulis']; ?></td> <!-- Menampilkan jumlah stok -->
            <td>
                <a href="index.php?halaman=hapusartikel&id=<?php echo $pecah['id_artikel']; ?>" class="btn-danger btn">Hapus</a>
                <a href="index.php?halaman=ubahartikel&id=<?php echo $pecah['id_artikel']; ?>" class="btn btn-warning">Edit</a>
            </td>
        </tr>
        <?php $nomor++; ?>
    <?php } ?>
	</tbody>
</table>

</body>
</html>
