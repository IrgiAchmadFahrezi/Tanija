<?php
session_start();
require_once 'midtrans-php-master/Midtrans.php'; // Pastikan Anda telah menginstal library Midtrans PHP
include 'db_connection.php'; // Sambungan ke database

// Setel kunci server Anda
\Midtrans\Config::$serverKey = 'SB-Mid-server-8VZnT2lPZk4zLWN9mCVBM2mP';
\Midtrans\Config::$isProduction = false; // Setel menjadi true untuk produksi
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;

// Ambil order_id dari parameter URL
$order_id = $_GET['order_id'];

// Periksa apakah order_id ada dan valid
$query = "SELECT * FROM riwayat_pemesanan WHERE order_id = '$order_id' AND status_pembayaran = 'pending'";
$result = $conn->query($query);
if ($result->num_rows == 0) {
    echo "Transaksi tidak ditemukan atau sudah selesai.";
    exit();
}

$transaction = $result->fetch_assoc();

// Data untuk Midtrans
$transaction_details = [
    'order_id' => $transaction['order_id'],
    'gross_amount' => $transaction['total_pembayaran'],
];

$item_details = [
    [
        'id' => 'item1',
        'price' => $transaction['total_pembayaran'],
        'quantity' => 1,
        'name' => 'Pembayaran Pesanan ' . $transaction['order_id'],
    ]
];

$customer_details = [
    'first_name' => $_SESSION['nama_user'],
    'email' => $_SESSION['email'],
    'phone' => $transaction['nomor_hanphone'],
    'address' => $transaction['alamat'],
];

$params = [
    'transaction_details' => $transaction_details,
    'item_details' => $item_details,
    'customer_details' => $customer_details,
];

try {
    $snapToken = \Midtrans\Snap::getSnapToken($params);
} catch (Exception $e) {
    echo "Gagal mendapatkan token transaksi: " . $e->getMessage();
    exit();
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lanjutkan Pembayaran - Tanija</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="CLIENT_KEY_ANDA"></script>
</head>
<body>
  <div class="container mt-5">
    <h1>Lanjutkan Pembayaran</h1>
    <button id="pay-button" class="btn btn-success">Bayar Sekarang</button>
  </div>

  <script>
    document.getElementById('pay-button').addEventListener('click', function () {
        snap.pay('<?php echo $snapToken; ?>', {
            onSuccess: function(result) {
                console.log(result);
                alert('Pembayaran sukses!');
                window.location.href = 'riwayat_pemesanan.php';
            },
            onPending: function(result) {
                console.log(result);
                alert('Pembayaran tertunda.');
            },
            onError: function(result) {
                console.log(result);
                alert('Pembayaran gagal!');
            },
            onClose: function() {
                alert('Anda menutup popup tanpa menyelesaikan pembayaran');
            }
        });
    });
  </script>
</body>
</html>
