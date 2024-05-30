<?php
session_start();

// Pastikan tombol "Add to Cart" ditekan
if(isset($_POST['addToCartBtn'])) {
    // Tangkap detail produk
    $id_produk = $_GET['id_produk'];
    $nama_produk = $row['nama_produk'];
    $harga_produk = $row['harga_produk'];
    $jumlah = $_POST['quantity'];

    // Buat array untuk menyimpan detail produk
    $produk = array(
        'id' => $id_produk,
        'nama' => $nama_produk,
        'harga' => $harga_produk,
        'jumlah' => $jumlah
    );

    // Periksa apakah keranjang belanja telah dibuat sebelumnya dalam sesi
    if(!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Tambahkan detail produk ke dalam keranjang belanja
    $_SESSION['cart'][$id_produk] = $produk;

    // Tampilkan jumlah total item dalam keranjang belanja
    $total_items = count($_SESSION['cart']);
    echo "<script>alert('Produk berhasil ditambahkan ke keranjang belanja. Total item dalam keranjang: $total_items');</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - Tanija</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/bootstrap.css" rel="stylesheet">

    <!-- Style CSS -->
    <link href="../assets/css/style.css" rel="stylesheet">

    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    <?php
    include '../php/db_connection.php';

    $id_produk = $_GET['id'];
    $sql = "SELECT * FROM produk WHERE id_produk = '$id_produk'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Produk tidak ditemukan.";
        exit();
    }
    $conn->close();
    ?>

    <!-- Navbar Bootstrap -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#">
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
                  <a class="nav-link" href="#"> <i class="far fa-user"></i> <span id="nama_user"> Profile</span></a>
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
                    echo '<form action="./src/php/logout.php" method="post">
                            <button class="btn btn-login" type="submit" name="logout">Logout</button>
                          </form>';
                } else {
                    echo '<button class="btn btn-login" type="button" onclick="window.location.href=\'src/html/login.html\';">Login</button>';
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
                        <a class="nav-link" href="./product.php">Produk</a>
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
        <div class="container my-5">
        <div class="row">
          <div class="col-md-6">
              <img src="../uploads/<?php echo $row['foto_produk']; ?>" class="img-fluid" alt="<?php echo $row['nama_produk']; ?>">
          </div>
          <div class="col-md-6">
              <h1><?php echo $row['nama_produk']; ?></h1>
              <p class="price">$<?php echo $row['harga_produk']; ?></p>

              <div class="quantity mb-3">
                  <button class="btn btn-outline-secondary" type="button" id="decrease">-</button>
                  <input type="text" id="quantity" value="1" class="form-control w-auto d-inline text-center">
                  <button class="btn btn-outline-secondary" type="button" id="increase">+</button>
              </div>
              <button class="btn btn-warning" id="addToCartBtn">Add to Cart</button>

              <button class="btn btn-success">Buy it now</button>
              <p class="mt-3">
                  <strong>Stok:</strong> <?php echo $row['id_produk']; ?><br>
                  <strong>Kategori:</strong> <?php echo $row['kategori']; ?><br>
                  <strong>Share:</strong>
              </p>
              <div>
                  <button class="btn-outline-primary" data-bs-toggle="collapse" href="#description" role="button" aria-expanded="false" aria-controls="description">
                      Description
                  </button>
                  <button class="btn-outline-primary" data-bs-toggle="collapse" href="#reviews" role="button" aria-expanded="false" aria-controls="reviews">
                      Reviews
                  </button>
                  <div class="collapse mt-3" id="description">
                      <div class="card card-body">
                          <?php echo $row['deskripsi_produk']; ?>
                      </div>
                  </div>
                  <div class="collapse mt-3" id="reviews">
                      <div class="card card-body">No reviews yet</div>
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
    <script src="../scripts/detail-product.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
