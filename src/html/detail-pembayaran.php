<?php
session_start();
include '../php/db_connection.php';
include '../php/number.php';

// Check if the cart is empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
  echo "Keranjang belanja Anda kosong.";
  exit();
}

// Fetch products from the cart
$cart_items = $_SESSION['cart'];
$total_amount = 0;

foreach ($cart_items as $item) {
  $total_amount += $item['harga'] * $item['jumlah'];
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="dicoding:email" content="irgifahrezi78@gmail.com">
  <title>Keranjang - Tanija</title>
  <link rel="shortcut icon" href="../assets/icons/logo-tanija.png">

  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/css/bootstrap.css" rel="stylesheet">

  <!-- Style CSS -->
  <link href="../assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/detail-pembayaran.css">

  <!-- Font Awesome CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  
  <!-- Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">

  <!-- midtrans -->
  <script type="text/javascript"
  src="https://app.sandbox.midtrans.com/snap/snap.js"
  data-client-key="SB-Mid-client-WJFgv3j4ga-uCoJX"></script>
</head>
<body>
  <!-- Elemen Loading -->
  <div class="loader"></div>
  <!-- Navbar Bootstrap -->
  <nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="/tanija/index.php">
        <img src="../assets/icons/logo-tanija.png" alt="Logo Tanija">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <form class="form-inline my-2 my-lg-0" method="get" action="../php/search.php">
        <input class="form-control mr-sm-2" type="search" name="query" placeholder="Cari Produk..." aria-label="Cari Produk...">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Cari</button>
      </form>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link"> <i class="far fa-user"></i> <span id="nama_user">Profil</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./favorite.php"><i class="far fa-heart"></i><span class="badge"><?php echo $favoriteCount; ?></span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./cart.php"><i class="fas fa-shopping-cart"></i> Keranjang <span class="badge"><?php echo $cartCount; ?></span></a>
        </li>
        <li class="nav-item">
        <?php
            if (isset($_SESSION['email'])) {
                echo '<form action="../php/logout.php" method="post">
                        <button class="btn btn-login" type="submit" name="logout">Logout</button>
                    </form>';
            } else {
                echo '<button class="btn btn-login" type="button" onclick="window.location.href=\'../html/login.html\';">Login</button>';
            }
        ?>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Navbar Kedua -->
  <nav class="navbar navbar-expand" id="navbar-kedua">
    <div class="container">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSecond" aria-controls="navbarSecond" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSecond">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item">
            <a class="nav-link" href="/tanija/index.php">Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../html/product.php">Produk</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./riwayat_pemesanan.php">Riwayat</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./article.php">Artikel</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./about.php">Tentang Kami</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Main -->
  <main>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12">
                <h2>Detail Pembelian</h2>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Produk</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Periksa apakah keranjang tidak kosong
                            if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                                $total = 0;
                                $no = 1;
                                foreach($_SESSION['cart'] as $product_id => $product) {
                                    $subtotal = $product['harga'] * $product['jumlah'];
                                    $total += $subtotal;
                                    echo "<tr>
                                            <td>{$no}</td>
                                            <td>
                                                <div class='d-flex align-items-center'>
                                                    <img src='../uploads/{$product['foto_produk']}' class='img-fluid me-3' alt='Gambar Produk' style='max-width: 100px;'>
                                                    <div>
                                                        <p class='mb-0'>{$product['nama']}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Rp. ".number_format($product['harga'], 0, ',', '.')."</td>
                                            <td>{$product['jumlah']}</td>
                                            <td>Rp. ".number_format($subtotal, 0, ',', '.')."</td>
                                        </tr>";
                                    $no++;
                                }
                                echo "<tr>
                                        <td colspan='4' class='text-right font-weight-bold'>Total Belanja :</td>
                                        <td id='totalBelanja'>Rp. ".number_format($total, 2, ',', '.')."</td>
                                    </tr>";
                                    
                            } else {
                                // Jika keranjang kosong, tampilkan pesan
                                echo "<tr><td colspan='5' class='text-center'>Keranjang kosong</td></tr>";
                            }
                            ?>
                            <tr>
                                <td colspan="4" class="text-right font-weight-bold">Total Pembayaran :</td>
                                <td id="totalPembayaran">Rp. 0</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Form Checkout -->
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="namaPenerima">Nama Penerima:</label>
                            <input type="text" class="form-control" id="namaPenerima" name="namaPenerima" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="nomorHanphone">Nomor Handphone:</label>
                            <input type="number" class="form-control" id="nomorHanphone" name="nomorHanphone" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="ongkir">Ongkir:</label>
                            <select class="form-control" id="ongkir" name="ongkir" required>
                                <option value="0">Pilih Ongkos kirim</option>
                                <?php 
                                // Langkah 2: Buat query untuk mengambil data ongkir
                                $query_ongkir = "SELECT * FROM ongkir";
                                $result_ongkir = $conn->query($query_ongkir);

                                // Tampilkan hasil query sebagai opsi ongkir
                                while ($perongkir = $result_ongkir->fetch_assoc()) {   
                                    ?>
                                    <option value="<?php echo $perongkir["tarif"] ?>">
                                        <?php echo $perongkir['nama_kota'] ?> -
                                        Rp. <?php echo number_format($perongkir['tarif']) ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat:</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="5" required style="width: 100% !important;"></textarea>
                        </div>
                        <button id="pay-button" class="btn btn-success w-100" disabled>Check Out</button>
                    </form>
                </div>
            </div>
        </div>
    </main>


  <!-- footer -->
  <footer class="footer">
      <div class="container">
        <div class="content">
          <div class="content-top d-flex justify-content-between flex-column flex-lg-row">
            <div class="content-top-left subtext col-12 col-lg-4">
              <div class="subtext-text d-flex flex-column gap-3">
                <a href="/tanija/index.php" class="logo d-inline-flex">
                  <img src="../assets/icons/logo-tanija.png" alt="" class="img img-logo" />
                </a>
                <p class="subtext-text-desc">Tanija hadir menyediakan pengalaman belanja online yang responsif dan ramah pengguna untuk para konsumen yang tertarik dengan produk-produk pertanian berkualitas.</p>
              </div>
            </div>
            <div class="content-top-right subtext col-12 col-lg-7 d-flex justify-content-between flex-column flex-lg-row">
              <div class="subtext-menu">
                <h5 class="subtext-menu-subtitle">Cari Produk</h5>
                <div class="wrap">
                  <a href="../html/product.php?kategori%5B%5D=Pupuk" class="nav-link">Pupuk</a>
                  <a href="../html/product.php?kategori%5B%5D=Alat+Pertanian" class="nav-link">Alat Pertanian</a>
                  <a href="../html/product.php?kategori%5B%5D=Bibit+Tanaman" class="nav-link">Bibit Pertanian</a>
                  <a href="../html/product.php?kategori%5B%5D=Pestisida" class="nav-link">Pestisida</a>
                </div>
              </div>
              <div class="subtext-menu">
                <h5 class="subtext-menu-subtitle">Tentang</h5>
                <div class="wrap">
                  <a href="../html/about.php" class="nav-link">Tentang Kami</a>
                  <a href="../html/about.php" class="nav-link">FAQ</a>
                  <a href="../html/about.php" class="nav-link">Tim Kami</a>
                </div>
              </div>
              <div class="subtext-menu">
                <h5 class="subtext-menu-subtitle">Kontak Kami</h5>
                <div class="ic-wrap">
                  <a href="mailto:tanija207@gmail.com" class="nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 16 16" fill="none">
                      <path d="M0 4C0 3.46957 0.210714 2.96086 0.585786 2.58579C0.960859 2.21071 1.46957 2 2 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V12C16 12.5304 15.7893 13.0391 15.4142 13.4142C15.0391 13.7893 14.5304 14 14 14H2C1.46957 14 0.960859 13.7893 0.585786 13.4142C0.210714 13.0391 0 12.5304 0 12V4ZM2 3C1.73478 3 1.48043 3.10536 1.29289 3.29289C1.10536 3.48043 1 3.73478 1 4V4.217L8 8.417L15 4.217V4C15 3.73478 14.8946 3.48043 14.7071 3.29289C14.5196 3.10536 14.2652 3 14 3H2ZM15 5.383L10.292 8.208L15 11.105V5.383ZM14.966 12.259L9.326 8.788L8 9.583L6.674 8.788L1.034 12.258C1.09083 12.4708 1.21632 12.6589 1.39099 12.7931C1.56566 12.9272 1.77975 13 2 13H14C14.2201 13 14.4341 12.9274 14.6088 12.7934C14.7834 12.6595 14.909 12.4716 14.966 12.259ZM1 11.105L5.708 8.208L1 5.383V11.105Z" fill="#F6B943"/>
                    </svg>
                  </a>
                  <a href="https://www.instagram.com/tanija.official" class="nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 16 16" fill="none">
                      <path d="M8 0C5.829 0 5.556 0.01 4.703 0.048C3.85 0.088 3.269 0.222 2.76 0.42C2.22609 0.620819 1.74249 0.935826 1.343 1.343C0.936076 1.7427 0.621107 2.22624 0.42 2.76C0.222 3.268 0.087 3.85 0.048 4.7C0.01 5.555 0 5.827 0 8.001C0 10.173 0.01 10.445 0.048 11.298C0.088 12.15 0.222 12.731 0.42 13.24C0.625 13.766 0.898 14.212 1.343 14.657C1.787 15.102 2.233 15.376 2.759 15.58C3.269 15.778 3.849 15.913 4.701 15.952C5.555 15.99 5.827 16 8 16C10.173 16 10.444 15.99 11.298 15.952C12.149 15.912 12.732 15.778 13.241 15.58C13.7746 15.3791 14.2578 15.0641 14.657 14.657C15.102 14.212 15.375 13.766 15.58 13.24C15.777 12.731 15.912 12.15 15.952 11.298C15.99 10.445 16 10.173 16 8C16 5.827 15.99 5.555 15.952 4.701C15.912 3.85 15.777 3.268 15.58 2.76C15.3789 2.22623 15.0639 1.74268 14.657 1.343C14.2576 0.935676 13.774 0.620645 13.24 0.42C12.73 0.222 12.148 0.087 11.297 0.048C10.443 0.01 10.172 0 7.998 0H8.001H8ZM7.283 1.442H8.001C10.137 1.442 10.39 1.449 11.233 1.488C12.013 1.523 12.437 1.654 12.719 1.763C13.092 1.908 13.359 2.082 13.639 2.362C13.919 2.642 14.092 2.908 14.237 3.282C14.347 3.563 14.477 3.987 14.512 4.767C14.551 5.61 14.559 5.863 14.559 7.998C14.559 10.133 14.551 10.387 14.512 11.23C14.477 12.01 14.346 12.433 14.237 12.715C14.1087 13.0624 13.904 13.3764 13.638 13.634C13.358 13.914 13.092 14.087 12.718 14.232C12.438 14.342 12.014 14.472 11.233 14.508C10.39 14.546 10.137 14.555 8.001 14.555C5.865 14.555 5.611 14.546 4.768 14.508C3.988 14.472 3.565 14.342 3.283 14.232C2.9355 14.1039 2.62113 13.8996 2.363 13.634C2.09675 13.376 1.89172 13.0617 1.763 12.714C1.654 12.433 1.523 12.009 1.488 11.229C1.45 10.386 1.442 10.133 1.442 7.996C1.442 5.86 1.45 5.608 1.488 4.765C1.524 3.985 1.654 3.561 1.764 3.279C1.909 2.906 2.083 2.639 2.363 2.359C2.643 2.079 2.909 1.906 3.283 1.761C3.565 1.651 3.988 1.521 4.768 1.485C5.506 1.451 5.792 1.441 7.283 1.44V1.442ZM12.271 2.77C12.1449 2.77 12.0201 2.79483 11.9036 2.84308C11.7872 2.89132 11.6813 2.96203 11.5922 3.05118C11.503 3.14032 11.4323 3.24615 11.3841 3.36262C11.3358 3.4791 11.311 3.60393 11.311 3.73C11.311 3.85607 11.3358 3.9809 11.3841 4.09738C11.4323 4.21385 11.503 4.31968 11.5922 4.40882C11.6813 4.49797 11.7872 4.56868 11.9036 4.61692C12.0201 4.66517 12.1449 4.69 12.271 4.69C12.5256 4.69 12.7698 4.58886 12.9498 4.40882C13.1299 4.22879 13.231 3.98461 13.231 3.73C13.231 3.47539 13.1299 3.23121 12.9498 3.05118C12.7698 2.87114 12.5256 2.77 12.271 2.77ZM8.001 3.892C7.45607 3.8835 6.91489 3.98349 6.40898 4.18614C5.90306 4.3888 5.44251 4.69007 5.05415 5.07242C4.66579 5.45478 4.35736 5.91057 4.14684 6.41326C3.93632 6.91595 3.8279 7.4555 3.8279 8.0005C3.8279 8.5455 3.93632 9.08505 4.14684 9.58774C4.35736 10.0904 4.66579 10.5462 5.05415 10.9286C5.44251 11.3109 5.90306 11.6122 6.40898 11.8149C6.91489 12.0175 7.45607 12.1175 8.001 12.109C9.07954 12.0922 10.1082 11.6519 10.865 10.8833C11.6217 10.1146 12.0459 9.07917 12.0459 8.0005C12.0459 6.92183 11.6217 5.88641 10.865 5.11775C10.1082 4.34909 9.07954 3.90883 8.001 3.892ZM8.001 5.333C8.70833 5.333 9.38669 5.61399 9.88685 6.11415C10.387 6.61431 10.668 7.29267 10.668 8C10.668 8.70733 10.387 9.38569 9.88685 9.88585C9.38669 10.386 8.70833 10.667 8.001 10.667C7.29367 10.667 6.61531 10.386 6.11515 9.88585C5.61499 9.38569 5.334 8.70733 5.334 8C5.334 7.29267 5.61499 6.61431 6.11515 6.11415C6.61531 5.61399 7.29367 5.333 8.001 5.333Z" fill="#F6B943"/>
                  </svg>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="content-bottom text-center">
            <span class="copyright">Copyright 2024 Tanija</span>
          </div>
        </div>
      </div>
    </footer>
  <script>
  document.addEventListener("DOMContentLoaded", function() {
    function checkForm() {
        var namaPenerima = document.getElementById('namaPenerima').value;
        var nomorHanphone = document.getElementById('nomorHanphone').value;
        var ongkir = document.getElementById('ongkir').value;
        var alamat = document.getElementById('alamat').value;

        if (namaPenerima !== '' && nomorHanphone !== '' && ongkir !== '0' && alamat !== '') {
            document.getElementById('pay-button').disabled = false;
        } else {
            document.getElementById('pay-button').disabled = true;
        }
    }

    function calculateTotalPayment() {
        var totalBelanja = <?php echo $total; ?>;
        var ongkir = parseInt(document.getElementById('ongkir').value) || 0;
        var totalPembayaran = totalBelanja + ongkir;
        document.getElementById('totalPembayaran').innerText = 'Rp. ' + totalPembayaran.toLocaleString('id-ID', { minimumFractionDigits: 2 });
        return totalPembayaran;
    }

    document.getElementById('ongkir').addEventListener('change', calculateTotalPayment);
    calculateTotalPayment();

    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function(e) {
        e.preventDefault();
        if (payButton.disabled) return;

        var namaPenerima = document.getElementById('namaPenerima').value;
        var nomorHanphone = document.getElementById('nomorHanphone').value;
        var ongkirValue = document.getElementById('ongkir').value;
        var alamat = document.getElementById('alamat').value;
        var totalPembayaran = calculateTotalPayment();

        $.ajax({
            url: '../php/get_token.php',
            method: 'POST',
            data: {
                namaPenerima: namaPenerima,
                nomorHanphone: nomorHanphone,
                ongkir: ongkirValue,
                alamat: alamat,
                totalPembayaran: totalPembayaran
            },
            success: function(response) {
                var data = JSON.parse(response);
                if (data.token) {
                    snap.pay(data.token, {
                        onSuccess: function(result) {
                            console.log(result);
                            // Panggil fungsi untuk mengurangi stok setelah pembayaran berhasil
                            reduceStock(data.product_id, data.quantity);
                            
                            alert('Pembayaran sukses!');
                            // window.location.href = 'riwayat_pemesanan.php';
                            saveOrder('success', result, namaPenerima, nomorHanphone, ongkirValue, alamat, totalPembayaran);
                            
                        },
                        onPending: function(result) {
                            console.log(result);
                            alert('Pembayaran dibatalkan!');
                        },
                        onError: function(result) {
                            console.log(result);
                            alert('Pembayaran gagal!');
                            saveOrder('error', result, namaPenerima, nomorHanphone, ongkirValue, alamat, totalPembayaran);
                        },
                        onClose: function() {
                            alert('Anda menutup popup tanpa menyelesaikan pembayaran');
                        }
                    });
                } else {
                    alert('Gagal mendapatkan token transaksi');
                }
            }
        });
    });
    function reduceStock(product_id, quantity) {
    $.ajax({
        type: 'POST',
        url: '../php/reduce_stock.php',
        data: { id_produk: product_id, jumlah: quantity },
        success: function(response) {
            console.log(response);
            // Redirect ke halaman lain atau lakukan tindakan lain jika diperlukan
            window.location.href = '../html/riwayat_pemesanan.php';
        },
        error: function(xhr, status, error) {
            console.error(error);
            // Tindakan apa yang perlu diambil jika ada kesalahan
        }
    });
}


    function saveOrder(status, result, namaPenerima, nomorHanphone, ongkir, alamat, totalPembayaran) {
        $.ajax({
            url: '../php/save_order.php',
            method: 'POST',
            data: {
                namaPenerima: namaPenerima,
                nomorHandphone: nomorHanphone,
                ongkir: ongkir,
                alamat: alamat,
                totalPembayaran: totalPembayaran,
                statusPembayaran: status,
            },
            success: function(response) {
                var data = JSON.parse(response);
                if (data.success) {
                    alert('Pesanan berhasil disimpan');
                    window.location.href = 'riwayat_pemesanan.php'; // Arahkan ke halaman sukses
                    clearCart(); // Panggil fungsi untuk mengosongkan keranjang
                } else {
                    alert('Gagal menyimpan pesanan: ' + data.error);
                }
            }
        });
    }

    function clearCart() {
    $.ajax({
        url: '../php/clear_cart.php',
        method: 'POST',
        success: function(response) {
            alert('Keranjang berhasil dikosongkan');
            // Refresh halaman atau lakukan tindakan lain yang sesuai
        }
    });
}


    // Periksa form saat ada perubahan
    var inputs = document.querySelectorAll('input, select, textarea');
    inputs.forEach(function(input) {
      input.addEventListener('input', checkForm);
    });
  });
</script>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
            // Cek apakah sesi email ada
            <?php if(isset($_SESSION['email'])) { ?>
                // Jika sesi email ada, ambil nama pengguna dari sesi
                var namaUser = "<?php echo $_SESSION['nama_user']; ?>";
                // Ubah teks "Profile" menjadi nama pengguna
                document.getElementById("nama_user").innerText = namaUser;
            <?php } ?>
        });
        document.addEventListener("DOMContentLoaded", function() {
            // Cek apakah sesi email ada
            <?php if(isset($_SESSION['email'])) { ?>
                // Jika sesi email ada, tampilkan tombol logout
                document.getElementById("loginBtn").innerHTML = '<button class="btn btn-login" type="button" onclick="logout()">Logout</button>';
            <?php } ?>
        });
        
        function logout() {
            // Redirect ke halaman logout (buat file logout.php)
            window.location.href = "logout.php";
        }
  </script>
  <script>
  window.addEventListener("load", () => {
    const loader = document.querySelector(".loader");

    // Tambahkan class untuk menghilangkan loader setelah 3 detik
    setTimeout(() => {
      loader.classList.add("loader--hidden");
      loader.addEventListener("transitionend", () => {
        document.body.removeChild(loader);
      });
    }, 500); // 3000 milidetik atau 3 detik
  });
</script>
  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
</html>
