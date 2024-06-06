<?php
session_start();
include '../php/db_connection.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Keranjang - Tanija</title>

  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/css/bootstrap.css" rel="stylesheet">

  <!-- Style CSS -->
  <link href="../assets/css/style.css" rel="stylesheet">

  <!-- Font Awesome CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  
  <!-- midtrans -->
  <script type="text/javascript"
  src="https://app.sandbox.midtrans.com/snap/snap.js"
  data-client-key="SB-Mid-client-WJFgv3j4ga-uCoJX"></script>
</head>
<body>

  <!-- Navbar Bootstrap -->
  <nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="/tanija/index.php">
        <img src="../assets/icons/logo-tanija.png" alt="Logo Tanija">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Cari Produk..." aria-label="Cari Produk...">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Cari</button>
      </form>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="#"> <i class="far fa-user"></i> <span id="nama_user">Profil</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/src/html/favorite.html"><i class="far fa-heart"></i><span class="badge">5</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./cart.php"><i class="fas fa-shopping-cart"></i> Keranjang <span class="badge">10</span></a>
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
            <a class="nav-link" href="#">Artikel</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Tentang Kami</a>
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

  <!-- Footer -->
  <footer class="footer">
        <div class="container">
            <div class="content">
                <div class="content-top d-flex justify-content-between flex-column flex-lg-row">
                    <div class="content-top-left subtext col-12 col-lg-4">
                        <div class="subtext-text d-flex flex-column gap-3">
                            <a href="#" class="logo d-inline-flex">
                                <img src="../assets/icons/logo-tanija.png" alt="" class="img img-logo">
                            </a>
                            <p class="subtext-text-desc">Tanija hadir menyediakan pengalaman belanja online yang responsif dan ramah pengguna untuk para konsumen yang tertarik dengan produk-produk pertanian berkualitas.</p>
                        </div>
                    </div>
                    <div class="content-top-right subtext col-12 col-lg-7 d-flex justify-content-between flex-column flex-lg-row">
                        <div class="subtext-menu">
                            <h5 class="subtext-menu-subtitle">Cari Produk</h5>
                            <div class="wrap">
                                <a href="/src/html/about-us.html" class="nav-link">Pupuk</a>
                                <a href="/src/html/about-us.html#FAQ" class="nav-link">Alat Pertanian</a>
                                <a href="/src/html/about-us.html#teams" class="nav-link">Bibit Pertanian</a>
                                <a href="/src/html/about-us.html#teams" class="nav-link">Pestisida</a>
                            </div>
                        </div>
                        <div class="subtext-menu">
                            <h5 class="subtext-menu-subtitle">Tentang</h5>
                            <div class="wrap">
                                <a href="/src/html/survey.html" class="nav-link">Tentang Kami</a>
                                <a href="/src/html/gallery.html" class="nav-link">FAQ</a>
                                <a href="/src/html/gallery.html" class="nav-link">Tim Kami</a>
                            </div>
                        </div>
                        <div class="subtext-menu">
                            <h5 class="subtext-menu-subtitle">Kontak Kami</h5>
                            <div class="wrap">
                                <a href="/src/html/blog.html" class="nav-link">Kontak</a>
                                <a href="/src/html/blog.html" class="nav-link">Testimonial</a>
                                <a href="/src/html/blog.html" class="nav-link">Terms of Service</a>
                                <a href="/src/html/blog.html" class="nav-link">Privacy Policy</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="line"></div>
                <div class="content-bottom d-flex flex-column justify-content-center justify-content-md-between flex-md-row align-items-md-center">
                    <div class="copyright">
                        <p class="subtext">© 2023. All Rights Reserved.</p>
                    </div>
                    <div class="icon d-flex gap-3 align-items-center">
                        <a href="#"><i class="bi bi-twitter"></i></a>
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-whatsapp"></i></a>
                    </div>
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
                            alert('Pembayaran sukses!');
                            window.location.href = 'riwayat_pemesanan.php';
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
  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
</html>
