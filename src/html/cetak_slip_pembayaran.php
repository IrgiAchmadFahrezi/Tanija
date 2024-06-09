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
      <!-- Font Awesome CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
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
        button {
            width: 130px;
            height: 60px;
            border-radius: 30px;
            border: none;
            /* margin-left: 10%; */
            color: #F1F1F1;
            font-weight: bold;
            cursor: pointer;
        }
        .cetak{
            background-color: #00880d;
        }
        .kembali{
            background-color: #f6b943;
        }
        button:hover {
            filter: brightness(80%); /* Mengurangi kecerahan saat di-hover */
        }
        @media print {
            #no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Nota Pembayaran Tanija</h1>
        <p>No. Pembelian: <?php echo $id_pemesanan; ?></p>
        <p>No. Telepon: <?php echo $nomor_telepon; ?></p>
        <p>Tanggal Pembelian: <?php echo $pemesanan['tanggal_pemesanan']; ?></p>
        <table>
            <tr>
                <th style="width: 5%;">No.</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Harga per Produk</th>
                <th>Total Harga</th>
            </tr>
            <?php 
            $total_pembayaran = 0;
            if (!empty($detail_barang)) {
                foreach ($detail_barang as $index => $barang) : 
                    $total_harga = $barang['harga'] * $barang['jumlah'];
                    $total_pembayaran += $total_harga;
            ?>
            <tr>
                <td style="text-align: center;"><?php echo $index + 1; ?></td>
                <td><?php echo $barang['nama_barang']; ?></td>
                <td style="text-align: center;"><?php echo $barang['jumlah']; ?></td>
                <td>Rp. <?php echo number_format($barang['harga'], 0, ',', '.'); ?></td>
                <td>Rp. <?php echo number_format($total_harga, 0, ',', '.'); ?></td>
            </tr>
            <?php 
                endforeach; 
            } else {
                echo "<tr><td colspan='5'>Tidak ada barang dalam pemesanan ini.</td></tr>";
            }
            ?>
            <tr>
                <td colspan="4" style="text-align: right; border:none !important; font-weight: bold;">Total:</td>
                <td style="background-color: #F1F1F1;">Rp. <?php echo number_format($total_pembayaran, 0, ',', '.'); ?></td>
            </tr>
            <tr>
                <td colspan="4" style="text-align: right; border:none !important; font-weight: bold;">Ongkir:</td>
                <td style="background-color: #F1F1F1;">Rp. <?php echo number_format($pemesanan['ongkir'], 0, ',', '.'); ?></td>
            </tr>
            <tr>
                <td colspan="4" style="text-align: right; border:none !important; font-weight: bold;">Total Pembayaran:</td>
                <td style="background-color: #F1F1F1;">Rp. <?php echo number_format($total_pembayaran + $pemesanan['ongkir'], 0, ',', '.'); ?></td>
            </tr>
        </table>
    </div>
    <div id="no-print" style="text-align: center; margin-top: 20px;">
        <button class="cetak" onclick="window.print();"><i class="fas fa-print"></i></button>
        <button class="kembali" onclick="window.history.back();"><i class="fas fa-arrow-left"></i></button>
    </div>

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
