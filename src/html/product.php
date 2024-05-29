<?php
include '../php/db_connection.php';
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Produk - Tanija</title>

<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/css/bootstrap.css" rel="stylesheet">
<!-- Style CSS -->
<link href="assets/css/style.css" rel="stylesheet">

  <!-- Font Awesome CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>

  <!-- Navbar Bootstrap -->
  <nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="#">
        <img src="/assets/icons/logo-tanija.png" alt="Logo Tanija">
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
          <a class="nav-link" href="#"> <i class="far fa-user"></i> Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><i class="far fa-heart"></i></i><span class="badge">5</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><i class="fas fa-shopping-cart"></i> Keranjang <span class="badge">10</span></a>
        </li>
        <li class="nav-item">
          <button class="btn btn-login" type="button" onclick="window.location.href='halaman_login.html';">Login</button>
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
            <a class="nav-link" href="/index.html">Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/src/html/product.html">Produk</a>
          </li>
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
  <main>
    <div class="container mt-5">
      <div class="row">
          <div class="col-md-3">
              <h5>Categories</h5>
              <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="checkAll">
                  <label class="form-check-label" for="checkAll">
                      Semua Kategori
                  </label>
              </div>
              <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="checkPupuk">
                  <label class="form-check-label" for="checkPupuk">
                      Pupuk
                  </label>
              </div>
              <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="checkAlatPertanian">
                  <label class="form-check-label" for="checkAlatPertanian">
                      Alat Pertanian
                  </label>
              </div>
              <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="checkBibitTanaman">
                  <label class="form-check-label" for="checkBibitTanaman">
                      Bibit Tanaman
                  </label>
              </div>
              <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="checkPestisida">
                  <label class="form-check-label" for="checkPestisida">
                      Pestisida
                  </label>
              </div>
              <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="checkLainnya">
                  <label class="form-check-label" for="checkLainnya">
                      Lainnya
                  </label>
              </div>
          </div>

          <div class="col-md-9">
              <div class="row">
                <?php
                // Query untuk mengambil data produk dari tabel produk
                $sql = "SELECT * FROM produk";
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
                        $path_gambar = "/tanija/uploads/" . $nama_file;
                        // Periksa apakah file gambar ada
                        if (file_exists($path_gambar)) {
                            // Jika ada, tampilkan gambar
                            echo '<img src="'.$path_gambar.'" class="card-img-top" alt="'.$row['nama_produk'].'">';
                        } else {
                            // Jika tidak, tampilkan gambar default
                            echo '<img src="default_image.jpg" class="card-img-top" alt="Default Image">';
                        }
                        echo '<div class="card-body">';
                        echo '<p class="card-text"><a href="#">'.$row['nama_produk'].'</a></p>';
                        echo '<p class="price">$'.$row['harga_produk'].'</p>';
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
  </div>
  </main>

  <footer>

  </footer>

  <!-- Bootstrap JS, Popper.js, dan jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
