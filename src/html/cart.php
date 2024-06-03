<?php
session_start();
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
        <div class="col-lg-8">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Produk</th>
                <th scope="col">Harga</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Subtotal</th>
                <th scope="col">Aksi</th> <!-- Kolom aksi untuk menghapus produk -->
              </tr>
            </thead>
            <tbody>
            <?php
            // Periksa apakah keranjang tidak kosong
            if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                $total = 0;
                foreach($_SESSION['cart'] as $product_id => $product) {
                    $subtotal = $product['harga'] * $product['jumlah'];
                    $total += $subtotal;
                    echo "<tr>
                            <td>
                                <div class='d-flex align-items-center'>
                                    <img src='../uploads/{$product['foto_produk']}' class='img-fluid me-3' alt='Gambar Produk' style='max-width: 100px;'>
                                    <div>
                                        <p class='mb-0'>{$product['nama']}</p>
                                    </div>
                                </div>
                            </td>
                            <td>Rp. ".number_format($product['harga'], 0, ',', '.')."</td>
                            <td>
                                <div class='input-group'>
                                    <button class='btn btn-outline-secondary btn-sm' type='button'>-</button>
                                    <input type='text' class='form-control form-control-sm text-center' value='{$product['jumlah']}'>
                                    <button class='btn btn-outline-secondary btn-sm' type='button'>+</button>
                                </div>
                            </td>
                            <td>Rp. ".number_format($subtotal, 0, ',', '.')."</td>
                            <td>
                                <form action='../php/remove_from_cart.php' method='post'>
                                    <input type='hidden' name='product_id' value='{$product_id}'>
                                    <button class='btn btn-sm btn-outline-danger' type='submit'>Hapus</button>
                                </form>
                            </td>
                        </tr>";
                }
            } else {
                // Jika keranjang kosong, tampilkan pesan
                echo "<tr><td colspan='5' class='text-center'>Keranjang kosong</td></tr>";
            }
            ?>
        </tbody>


          </table>
          <div class="d-flex justify-content-between">
            <a href="./product.php"><button class="btn btn-warning" >Lanjut Belanja</button></a>
            <form action="../php/remove_from_cart.php" method="post">
        <button class="btn btn-danger" type="submit" name="clear_cart">Bersihkan Keranjang</button>
    </form>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Total Keranjang</h5>
              <ul class="list-group list-group-flush">
                <?php
                // Inisialisasi total dengan nilai 0
                $total = 0;

                // Periksa apakah keranjang tidak kosong
                if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                    foreach($_SESSION['cart'] as $product_id => $product) {
                        $subtotal = $product['harga'] * $product['jumlah'];
                        $total += $subtotal;
                    }
                } else {
                    // Jika keranjang kosong, atur total dan subtotal menjadi 0
                    $subtotal = 0;
                    $total = 0;
                }
                ?>

                <!-- Tampilkan subtotal dan total -->
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Subtotal
                    <span>Rp. <?php echo number_format($subtotal, 0, ',', '.'); ?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Total
                    <span>Rp. <?php echo number_format($total, 0, ',', '.'); ?></span>
                </li>
            </ul>
              <button class="btn btn-warning mt-3 w-100">Lanjut ke Pembayaran</button>
            </div>
          </div>
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
                <img src="../assets/icons/logo-tanija.png" alt="" class="img img-logo" />
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
                <a href="/src/html/about-us.html#FAQ" class="nav-link">Benih</a>
                <a href="/src/html/about-us.html#FAQ" class="nav-link">Produk Lain</a>
              </div>
            </div>
            <div class="subtext-menu">
              <h5 class="subtext-menu-subtitle">Jelajahi Tanija</h5>
              <div class="wrap">
                <a href="/src/html/about-us.html" class="nav-link">Tentang Kami</a>
                <a href="/src/html/about-us.html#FAQ" class="nav-link">FAQ</a>
                <a href="/src/html/terms.html" class="nav-link">Syarat & Ketentuan</a>
                <a href="/src/html/privacy.html" class="nav-link">Kebijakan Privasi</a>
              </div>
            </div>
            <div class="subtext-menu">
              <h5 class="subtext-menu-subtitle">Tanya Kami</h5>
              <div class="wrap">
                <a href="/src/html/contact.html" class="nav-link">Kontak</a>
                <a href="/src/html/login.html" class="nav-link">Bantuan</a>
                <a href="/src/html/signup.html" class="nav-link">Pengaduan</a>
              </div>
            </div>
          </div>
        </div>
        <div class="content-bottom d-flex justify-content-between flex-column flex-lg-row">
          <p class="subtext-menu-subtitle">Follow Us:</p>
          <div class="wrap d-flex gap-3">
            <a href="#"><img src="../assets/icons/fb.png" alt="Facebook"></a>
            <a href="#"><img src="../assets/icons/twitter.png" alt="Twitter"></a>
            <a href="#"><img src="../assets/icons/linkedin.png" alt="LinkedIn"></a>
            <a href="#"><img src="../assets/icons/ig.png" alt="Instagram"></a>
          </div>
          <p class="subtext-menu-subtitle">&copy; 2023 PT. Tanija. All Rights Reserved.</p>
        </div>
      </div>
    </div>
  </footer>
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
</body>
</html>
