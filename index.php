<?php
session_start();
include 'src/php/db_connection.php';
include 'src/php/number.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tanija</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="src/assets/css/bootstrap.css" rel="stylesheet">
  <!-- Style CSS -->
  <link href="src/assets/css/style.css" rel="stylesheet">
  <!-- Font Awesome CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
</head>
<body>
  <!-- Navbar Bootstrap -->
  <nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="#">
        <img src="src/assets/icons/logo-tanija.png" alt="Logo Tanija">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <form class="form-inline my-2 my-lg-0 position-relative" id="searchForm" method="post" action="">
      <input class="form-control mr-sm-2" type="search" name="query" id="searchInput" placeholder="Cari Produk..." aria-label="Cari Produk...">
      <div class="search-results d-none" id="searchResults"></div>
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Cari</button>
    </form>

      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="#"> <i class="far fa-user"></i> <span id="nama_user"> Profile</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./src/html/favorite.php"><i class="far fa-heart"></i><span class="badge"><?php echo $favoriteCount; ?></span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./src/html/cart.php"><i class="fas fa-shopping-cart"></i> Keranjang <span class="badge"><?php echo $cartCount; ?></span></a>
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
            <a class="nav-link" href="./index.php">Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="src/html/product.php">Produk</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="src/html/riwayat_pemesanan.php">Riwayat</a>
          </li>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="src/html/article.php">Artikel</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="src/html/about.php">Tentang Kami</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <main>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <i class="fas fa-chevron-left"></i> <!-- Ganti dengan ikon panah kiri Font Awesome -->
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <i class="fas fa-chevron-right"></i> <!-- Ganti dengan ikon panah kanan Font Awesome -->
      </a>
      
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="row no-gutters">
            <div class="col-md-6 d-flex align-items-center">
              <div class="carousel-caption">
                <h5>Pupuk<br>Organik</h5>
                <a href="#" class="btn btn-primary">Shop now</a>
                <a href="#" class="btn btn-outline-primary">View more</a>
              </div>
            </div>
            <div class="col-md-6">
              <img class="d-block w-10" src="src/assets/images/promo1.png" alt="First slide">
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="row no-gutters">
            <div class="col-md-6 d-flex align-items-center">
              <div class="carousel-caption">
                <h5>Pupuk<br>Organik</h5>
                <a href="#" class="btn btn-primary">Shop now</a>
                <a href="#" class="btn btn-outline-primary">View more</a>
              </div>
            </div>
            <div class="col-md-6">
              <img class="d-block w-10" src="src/assets/images/promo2.png" alt="Second slide">
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="row no-gutters">
            <div class="col-md-6 d-flex align-items-center">
              <div class="carousel-caption">
                <h5>Pupuk<br>Organik</h5>
                <a href="#" class="btn btn-primary">Shop now</a>
                <a href="#" class="btn btn-outline-primary">View more</a>
              </div>
            </div>
            <div class="col-md-6">
              <img class="d-block w-10" src="src/assets/images/promo3.png" alt="Third slide">
            </div>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>

    <div class="container mt-5">
    <h2>Popular products</h2>
    <div class="row">
        <?php
        // Query untuk mengambil data produk dari tabel produk
        $sql = "SELECT p.*, COUNT(r.id) AS jumlah_review 
        FROM produk p
        LEFT JOIN reviews r ON p.id_produk = r.id_produk
        GROUP BY p.id_produk
        HAVING jumlah_review > 5";
        $result = $conn->query($sql);

        // Cek apakah hasil query tidak kosong
        if ($result->num_rows > 0) {
            // Loop melalui hasil query dan tampilkan produk
            while($row = $result->fetch_assoc()) {
                echo '<div class="col-md-3 mb-4">';
                echo '<div class="card">';
                // Ambil nama file gambar dari database
                $nama_file = $row['foto_produk'];
                // Buat path lengkap menuju file gambar di folder uploads
                $path_gambar = "./src/uploads/" . $nama_file;
                // Periksa apakah file gambar ada
                if (file_exists($path_gambar)) {
                    // Jika ada, tampilkan gambar
                    echo '<img src="'.$path_gambar.'" class="card-img-top" alt="'.$row['nama_produk'].'">';
                } else {
                    // Jika tidak, tampilkan gambar default
                    echo '<img src="default_image.jpg" class="card-img-top" alt="Default Image">';
                }
                echo '<div class="card-body">';
                echo '<p class="card-text"><a href="src/html/detail-product.php?id='.$row['id_produk'].'">'.$row['nama_produk'].'</a></p>';
                echo '<p class="price">Rp'.$row['harga_produk'].'</p>';
                echo '<div class="rating">★★★★★</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "Tidak ada produk.";
        }
        // Tutup koneksi
        $conn->close();
        ?>
    </div>
</div>

    </div>

    <!-- Review -->
    <div class="container mt-5">
      <h2 class="text-center">Review From Customer</h2>
      <div class="row">
          <div class="col-md-4 mb-4">
              <div class="card customer-review">
                  <div class="card-body text-center">
                      <img src="avatar1.jpg" class="rounded-circle mb-3" alt="Customer 1">
                      <h5 class="card-title">Savannah Nguyen</h5>
                      <p class="card-text review-text">Lorem ipsum dolor sit amet consectetur. Nec sit enim tellus faucibus bibendum ullamcorper. Phasellus tristique aenean at lorem sed scelerisque.</p>
                  </div>
              </div>
          </div>
          <div class="col-md-4 mb-4">
              <div class="card customer-review">
                  <div class="card-body text-center">
                      <img src="avatar2.jpg" class="rounded-circle mb-3" alt="Customer 2">
                      <h5 class="card-title">Esther Howard</h5>
                      <p class="card-text review-text">Lorem ipsum dolor sit amet consectetur. Nec sit enim tellus faucibus bibendum ullamcorper. Phasellus tristique aenean at lorem sed scelerisque.</p>
                  </div>
              </div>
          </div>
          <div class="col-md-4 mb-4">
              <div class="card customer-review">
                  <div class="card-body text-center">
                      <img src="avatar3.jpg" class="rounded-circle mb-3" alt="Customer 3">
                      <h5 class="card-title">Esther Howard</h5>
                      <p class="card-text review-text">Lorem ipsum dolor sit amet consectetur. Nec sit enim tellus faucibus bibendum ullamcorper. Phasellus tristique aenean at lorem sed scelerisque.</p>
                  </div>
              </div>
          </div>
          <div class="col-md-4 mb-4">
              <div class="card customer-review">
                  <div class="card-body text-center">
                      <img src="avatar1.jpg" class="rounded-circle mb-3" alt="Customer 4">
                      <h5 class="card-title">Savannah Nguyen</h5>
                      <p class="card-text review-text">Lorem ipsum dolor sit amet consectetur. Nec sit enim tellus faucibus bibendum ullamcorper. Phasellus tristique aenean at lorem sed scelerisque.</p>
                  </div>
              </div>
          </div>
          <div class="col-md-4 mb-4">
              <div class="card customer-review">
                  <div class="card-body text-center">
                      <img src="avatar2.jpg" class="rounded-circle mb-3" alt="Customer 5">
                      <h5 class="card-title">Esther Howard</h5>
                      <p class="card-text review-text">Lorem ipsum dolor sit amet consectetur. Nec sit enim tellus faucibus bibendum ullamcorper. Phasellus tristique aenean at lorem sed scelerisque.</p>
                  </div>
              </div>
          </div>
          <div class="col-md-4 mb-4">
              <div class="card customer-review">
                  <div class="card-body text-center">
                      <img src="avatar3.jpg" class="rounded-circle mb-3" alt="Customer 6">
                      <h5 class="card-title">Esther Howard</h5>
                      <p class="card-text review-text">Lorem ipsum dolor sit amet consectetur. Nec sit enim tellus faucibus bibendum ullamcorper. Phasellus tristique aenean at lorem sed scelerisque.</p>
                  </div>
              </div>
          </div>
      </div>
  </div>

    <!-- Why us ? -->
    <div class="container mt-5 text-center">
      <h2>Kenapa Harus Memilih Kami ?</h2>
      <div class="card feature-card mt-4">
          <div class="card-body">
              <div class="row">
                  <div class="col-md-4">
                      <i class="bi bi-truck fs-1"></i>
                      <h5 class="card-title">Free delivery</h5>
                      <p class="card-text">on order above $50.00</p>
                  </div>
                  <div class="col-md-4">
                      <i class="bi bi-award fs-1"></i>
                      <h5 class="card-title">Best quality</h5>
                      <p class="card-text">best quality in low price</p>
                  </div>
                  <div class="col-md-4">
                      <i class="bi bi-shield-check fs-1"></i>
                      <h5 class="card-title">1 year warranty</h5>
                      <p class="card-text">Available warranty</p>
                  </div>
              </div>
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
                <a href="#" class="logo d-inline-flex">
                  <img src="assets/icons/logo-tanija.png" alt="" class="img img-logo" />
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
                <div class="ic-wrap">
                  <a href="mailto:@gmail.com" class="nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 16 16" fill="none">
                      <path d="M0 4C0 3.46957 0.210714 2.96086 0.585786 2.58579C0.960859 2.21071 1.46957 2 2 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V12C16 12.5304 15.7893 13.0391 15.4142 13.4142C15.0391 13.7893 14.5304 14 14 14H2C1.46957 14 0.960859 13.7893 0.585786 13.4142C0.210714 13.0391 0 12.5304 0 12V4ZM2 3C1.73478 3 1.48043 3.10536 1.29289 3.29289C1.10536 3.48043 1 3.73478 1 4V4.217L8 8.417L15 4.217V4C15 3.73478 14.8946 3.48043 14.7071 3.29289C14.5196 3.10536 14.2652 3 14 3H2ZM15 5.383L10.292 8.208L15 11.105V5.383ZM14.966 12.259L9.326 8.788L8 9.583L6.674 8.788L1.034 12.258C1.09083 12.4708 1.21632 12.6589 1.39099 12.7931C1.56566 12.9272 1.77975 13 2 13H14C14.2201 13 14.4341 12.9274 14.6088 12.7934C14.7834 12.6595 14.909 12.4716 14.966 12.259ZM1 11.105L5.708 8.208L1 5.383V11.105Z" fill="#F6B943"/>
                    </svg>
                  </a>
                  <a href="https://www.instagram.com/Tanija" class="nav-link">
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
  

  <!-- Bootstrap JS, Popper.js, dan jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="src/scripts/index.js"></script>
  <script src="src/scripts/update-counts.js"></script>
</body>
</html>
