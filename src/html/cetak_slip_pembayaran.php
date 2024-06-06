<?php
// Pastikan bahwa id_pemesanan tersedia dalam URL
if (isset($_GET['id_pemesanan'])) {
    // Lakukan sanitasi input untuk menghindari serangan injeksi SQL
    $id_pemesanan = htmlspecialchars($_GET['id_pemesanan']);

    // Lakukan koneksi ke database dan query untuk mendapatkan data pemesanan
    include '../php/db_connection.php';
    $query = "SELECT * FROM riwayat_pemesanan WHERE id = '$id_pemesanan'";
    $result = $conn->query($query);

    // Periksa apakah pemesanan dengan id yang diberikan ada
    if ($result->num_rows > 0) {
        $pemesanan = $result->fetch_assoc();

        // Ambil nomor telepon dari riwayat_pemesanan
        $nomor_telepon = $pemesanan['nomor_handphone'];

        // Ambil detail barang dari tabel detail_barang
        $query_detail_barang = "SELECT * FROM detail_barang WHERE id_pemesanan = '$id_pemesanan'";
        $result_detail_barang = $conn->query($query_detail_barang);

        // Mengumpulkan detail barang ke dalam array
        $detail_barang = array();
        while ($row = $result_detail_barang->fetch_assoc()) {
            $detail_barang[] = $row;
        }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Pembayaran</title>
    <style>
        /* Gaya CSS untuk nota pembayaran */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            border: 1px solid #000;
            padding: 20px;
        }
        .container h1 {
            text-align: center;
            width: 30%;
            margin-left: 35%;
            margin-top: 0;
        }
        .container table {
            width: 100%;
            border-collapse: collapse;
        }
        .container th, .container td {
            border: 1px solid #000;
            padding: 8px;
        }
        .container th {
            background-color: #F1F1F1;
        }
        button{
            background-color: #00880d;
            width: 100px;
            height: 40px;
            border-radius: 30px;
            border: none;
            margin-left: 10%;
            color: #F1F1F1;
            font-weight: bold;
            cursor: pointer;
        }
        button:hover{
            background-color: #087613;
        }
        @media print{
			#no-print{
				display: none;
			}
		}
    </style>
</head>
<body>
    <div class="container">
        <h1>Nota Pembayaran Tanija</h1>
        <p>No. Pembelian: <?php echo $id_pemesanan; ?></p></p>
        <p>No. Telepon: <?php echo $nomor_telepon; ?></p>
        <p>Tanggal Pembelian: <?php echo $pemesanan['tanggal_pemesanan']; ?></p>
        <table>
            <tr>
                <th style="width: 5%;">No.</th>
                <th>Produk</th>
                <th>Harga</th>
            </tr>
            <?php 
            $total_pembayaran = 0;
            if (!empty($detail_barang)) {
                foreach ($detail_barang as $index => $barang) : 
                    $total_pembayaran += $barang['harga'];
            ?>
            <tr>
                <td style="text-align: center;"><?php echo $index + 1; ?></td>
                <td><?php echo $barang['nama_barang']; ?></td>
                <td>Rp. <?php echo number_format($barang['harga'], 0, ',', '.'); ?></td>
            </tr>
            <?php 
                endforeach; 
            } else {
                echo "<tr><td colspan='3'>Tidak ada barang dalam pemesanan ini.</td></tr>";
            }
            ?>
            <tr>
                <td colspan="2" style="text-align: right; border:none !important; font-weight: bold;">Total:</td>
                <td style="background-color: #F1F1F1;">Rp. <?php echo number_format($total_pembayaran, 0, ',', '.'); ?></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: right; border:none !important; font-weight: bold;">Ongkir:</td>
                <td style="background-color: #F1F1F1;">Rp. <?php echo number_format($pemesanan['ongkir'], 0, ',', '.'); ?></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: right; border:none !important; font-weight: bold;">Total Pembayaran:</td>
                <td style="background-color: #F1F1F1;">Rp. <?php echo number_format($total_pembayaran + $pemesanan['ongkir'], 0, ',', '.'); ?></td>
            </tr>
        </table>
    </div>
    <button id="no-print" onclick="window.print();">Cetak Nota</button>
    <!-- <script>
        window.onload = function() {
            window.print();
        }
    </script> -->
</body>
</html>

<?php
    } else {
        echo "<h2>Pemesanan tidak ditemukan.</h2>";
    }
} else {
    echo "<h2>Parameter id_pemesanan tidak tersedia.</h2>";
}
?>
