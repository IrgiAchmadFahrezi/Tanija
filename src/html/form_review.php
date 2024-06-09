<?php
session_start();
include '../php/db_connection.php';

// Ambil informasi produk berdasarkan id_produk dari parameter URL
if (isset($_GET['id_produk'])) {
    $id_produk = $_GET['id_produk'];

    // Query untuk mendapatkan informasi produk
    $query_produk = "SELECT * FROM produk WHERE id_produk = ?";
    $stmt_produk = $conn->prepare($query_produk);
    $stmt_produk->bind_param("i", $id_produk);
    $stmt_produk->execute();
    $result_produk = $stmt_produk->get_result();

    if ($result_produk->num_rows > 0) {
        $produk = $result_produk->fetch_assoc();
    } else {
        echo "Produk tidak ditemukan.";
        exit();
    }

    $stmt_produk->close();
} else {
    echo "Parameter id_produk tidak ditemukan.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kirim Review</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/bootstrap.css" rel="stylesheet">

    <!-- Style CSS -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/form_review.css">
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
    <main class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-5 review-sec" style="max-height: 530px;">
                <h1 style="font-weight: 600; text-align: center; color: #1b5a7d;">Kirim Review</h1>
                <form action="../php/submit_review.php" method="post" class="review">
                    <input type="hidden" name="id_produk" value="<?= $_GET['id_produk'] ?>">
                    <input type="hidden" name="id_pemesanan" value="<?= $_GET['id_pemesanan'] ?>">
                    <div class="form-group">
                        <strong>
                            <label for="nama_user">Nama User:</label>
                        </strong>
                        <input type="text" class="form-control form-rev" id="nama_user" name="nama_user" value="<?php echo isset($_SESSION['nama_user']) ? $_SESSION['nama_user'] : ''; ?>" required readonly>
                    </div>
                    <div class="form-group">
                        <strong>
                            <label  for="review_text">Review:</label>
                        </strong>
                        <textarea class="form-control form-rev" id="review_text" name="review_text" required></textarea>
                    </div>
                    <div class="form-group">
                        <strong>
                            <label for="review_rating">Rating:</label>
                        </strong>
                        <div class="rating">
                            <input type="radio" id="star5" name="review_rating" value="5"><label for="star5" title="5 stars"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star4" name="review_rating" value="4"><label for="star4" title="4 stars"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star3" name="review_rating" value="3"><label for="star3" title="3 stars"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star2" name="review_rating" value="2"><label for="star2" title="2 stars"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star1" name="review_rating" value="1"><label for="star1" title="1 star"><i class="fas fa-star"></i></label>
                        </div>
                    </div>
                    <div style="text-align: center;">
                    <button type="submit" class="kirim">Kirim Review</button>
                    <button class="kembali" onclick="window.history.back();"><i class="fas fa-arrow-left"></i></button>
                    </div>
                </form>
            </div>
            <div class="col-md-5 detail-prod" style="max-height: 530px;">
                <h1 class="tittle">Produk yang Direview</h1>
                <div class="card" style="border-radius: 5%; border: none !important; padding-bottom: 20px;">
                <img src="../uploads/<?= $produk['foto_produk'] ?>" class="card-img-top" alt="<?= $produk['nama_produk'] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $produk['nama_produk'] ?></h5>
                        <p class="card-text">Harga: Rp. <?= number_format($produk['harga_produk'], 2, ',', '.') ?></p>
                    </div>
                    <div style="text-align: center;">
                    <button class="btn btn-primary btn-prod" onclick="window.location.href='../html/detail-product.php?id=<?= $produk['id_produk'] ?>'">Lihat Produk</button>
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
</body>
</html>
