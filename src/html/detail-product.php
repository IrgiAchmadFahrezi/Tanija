<?php
session_start();
include '../php/db_connection.php';
include '../php/number.php';

// Mendapatkan detail produk dari database
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
    <link href="../css/detail-product.css" rel="stylesheet">

    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

    // Pastikan tombol "Add to Cart" ditekan
if (isset($_POST['addToCartBtn'])) {
    // Periksa apakah pengguna sudah login
    if (!isset($_SESSION['email'])) {
        echo "<script>
            Swal.fire({
                icon: 'warning',
                title: 'Anda harus login terlebih dahulu untuk menambahkan produk ke keranjang.',
                showConfirmButton: true,
                confirmButtonText: 'OK',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href='../html/login.html';
                }
            });
        </script>";
        exit();
    }

    // Tangkap detail produk dari POST data
    $id_produk = $_POST['id_produk'];

    // Periksa apakah produk sudah ada di keranjang belanja
    if (isset($_SESSION['cart'][$id_produk])) {
        echo "<script>
            Swal.fire({
                icon: 'info',
                title: 'Produk sudah ada di keranjang belanja.',
                showConfirmButton: true,
                confirmButtonText: 'OK',
            });
        </script>";
    } else {
        $nama_produk = $_POST['nama_produk'];
        $harga_produk = $_POST['harga_produk'];
        $jumlah = $_POST['quantity'];
        $nama_file_foto = $_POST['foto_produk']; // Mendapatkan nama file foto produk dari form

        // Buat array untuk menyimpan detail produk
        $produk = array(
            'id' => $id_produk,
            'nama' => $nama_produk,
            'harga' => $harga_produk,
            'jumlah' => $jumlah,
            'foto_produk' => $nama_file_foto // Simpan nama file foto produk ke dalam sesi
        );

        // Periksa apakah keranjang belanja telah dibuat sebelumnya dalam sesi
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        // Tambahkan detail produk ke dalam keranjang belanja
        $_SESSION['cart'][$id_produk] = $produk;

        // Tampilkan jumlah total item dalam keranjang belanja
        $total_items = count($_SESSION['cart']);
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Produk berhasil ditambahkan ke keranjang belanja.',
                text: 'Total item dalam keranjang: $total_items',
                showConfirmButton: true,
                confirmButtonText: 'OK',
            });
        </script>";
    }
}

// Tangani permintaan penambahan ke favorit
if (isset($_POST['addToFavoriteBtn'])) {
    // Periksa apakah pengguna sudah login
    if (!isset($_SESSION['email'])) {
        echo "<script>
            Swal.fire({
                icon: 'warning',
                title: 'Anda harus login terlebih dahulu untuk menambahkan produk ke favorit.',
                showConfirmButton: true,
                confirmButtonText: 'OK',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href='../html/login.html';
                }
            });
        </script>";
        exit();
    }

    // Tangkap detail produk dari POST data
    $id_produk = $_POST['id_produk'];
    $nama_produk = $_POST['nama_produk'];
    $harga_produk = $_POST['harga_produk'];
    $nama_file_foto = $_POST['foto_produk']; // Mendapatkan nama file foto produk dari form

    // Periksa apakah produk sudah ada dalam daftar favorit
    if (isset($_SESSION['favorites'][$id_produk])) {
        echo "<script>
            Swal.fire({
                icon: 'info',
                title: 'Produk sudah ada di favorit.',
                showConfirmButton: true,
                confirmButtonText: 'OK',
            });
        </script>";
    } else {
        // Buat array untuk menyimpan detail produk
        $produk = array(
            'id' => $id_produk,
            'nama' => $nama_produk,
            'harga' => $harga_produk,
            'foto_produk' => $nama_file_foto // Simpan nama file foto produk ke dalam sesi
        );

        // Periksa apakah daftar favorit telah dibuat sebelumnya dalam sesi
        if (!isset($_SESSION['favorites'])) {
            $_SESSION['favorites'] = array();
        }

        // Tambahkan detail produk ke dalam daftar favorit
        $_SESSION['favorites'][$id_produk] = $produk;

        // Tampilkan jumlah total item dalam daftar favorit
        $total_favorites = count($_SESSION['favorites']);
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Produk berhasil ditambahkan ke favorit.',
                text: 'Total item dalam favorit: $total_favorites',
                showConfirmButton: true,
                confirmButtonText: 'OK',
            });
        </script>";
    }
}

    $conn->close();
    ?>

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
                    <a class="nav-link" href="#"> <i class="far fa-user"></i> <span id="nama_user">Profile</span></a>
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
                        <a class="nav-link" href="./product.php">Produk</a>
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
        <div class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <img src="../uploads/<?php echo $row['foto_produk']; ?>" class="img-fluid product-image" alt="<?php echo $row['nama_produk']; ?>">
            </div>
            <div class="col-md-6">
                <h1><?php echo $row['nama_produk']; ?></h1>
                <p class="price">Rp<?php echo $row['harga_produk']; ?></p>

                <div class="quantity mb-3">
                    <button class="btn btn-outline-secondary" type="button" id="decrease">-</button>
                    <input type="text" id="quantity" value="1" class="form-control w-auto d-inline text-center">
                    <button class="btn btn-outline-secondary" type="button" id="increase">+</button>
                </div>

                <div class="btn-container">
                <form method="post" action="">
                        <input type="hidden" name="id_produk" value="<?php echo $row['id_produk']; ?>">
                        <input type="hidden" name="nama_produk" value="<?php echo $row['nama_produk']; ?>">
                        <input type="hidden" name="harga_produk" value="<?php echo $row['harga_produk']; ?>">
                        <input type="hidden" name="quantity" id="form_quantity" value="1">
                        <input type="hidden" name="foto_produk" value="<?php echo $row['foto_produk']; ?>"> <!-- Tambahkan input hidden untuk menyimpan nama file foto produk -->
                        <button type="submit" name="addToCartBtn" class="btn btn-warning">Add to Cart</button>
                        <button type="submit" class="btn btn-outline-secondary btn-favorite" name="addToFavoriteBtn">Add to Favorite</button>
                        <button class="btn btn-success">Buy it now</button>
                    </form>
                </div>
                <!-- <button class="btn btn-warning" id="addToCartBtn">Add to Cart</button> -->

                
                <p class="mt-3">
                    <strong>Stok:</strong> <?php echo $row['stock']; ?><br>
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
    <div class="card card-body">
        <?php
        // Koneksi ke database
        include '../php/db_connection.php';

        // Query untuk mengambil ulasan produk dari database
        $reviews_sql = "SELECT * FROM reviews WHERE id_pemesanan = ?";
        $reviews_stmt = $conn->prepare($reviews_sql);
        if ($reviews_stmt) {
            // Bind parameter
            $reviews_stmt->bind_param("i", $id_produk);

            // Set nilai parameter
            $id_produk = $_GET['id'];

            // Eksekusi statement
            $reviews_stmt->execute();

            // Ambil hasil
            $reviews_result = $reviews_stmt->get_result();

            // Tampilkan ulasan jika ada
            if ($reviews_result->num_rows > 0) {
                while ($review_row = $reviews_result->fetch_assoc()) {
                    // Tampilkan nama pengguna
                    echo '<div class="review-item">';
                    echo '<strong>Nama:</strong> ' . $review_row['nama_user'] . '<br>';

                    // Tampilkan rating dalam bentuk bintang
                    echo '<strong>Rating:</strong> ';
                    $rating = intval($review_row['review_rating']);
                    for ($i = 0; $i < $rating; $i++) {
                        echo '<span class="star">&#9733;</span>'; // Menampilkan bintang solid
                    }
                    echo '<br>';

                    // Tampilkan teks ulasan
                    echo '<strong>Ulasan:</strong> ' . $review_row['review_text'] . '<br>';
                    echo '</div>';
                }
            } else {
                echo "Belum ada ulasan untuk produk ini.";
            }

            // Tutup statement
            $reviews_stmt->close();
        } else {
            // Handle error jika query ulasan gagal
            echo "Gagal menyiapkan periksa ulasan statement: " . $conn->error;
        }

        // Tutup koneksi
        $conn->close();
        ?>
    </div>
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
