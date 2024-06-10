<?php
session_start();
include '../php/db_connection.php';
include '../php/number.php';

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['email'])) {
    header("Location: ../html/login.html");
    exit();
}

// Ambil id pemesanan dari parameter URL
if (!isset($_GET['id_pemesanan'])) {
    header("Location: riwayat_pemesanan.php");
    exit();
}
$id_pemesanan = $_GET['id_pemesanan'];

// Query untuk mendapatkan detail pemesanan dan detail barang berdasarkan id_pemesanan
$query = "SELECT rp.*, db.id_produk, db.nama_barang, db.jumlah, db.harga 
          FROM riwayat_pemesanan rp
          INNER JOIN detail_barang db ON rp.id = db.id_pemesanan
          WHERE rp.id = ? AND rp.nama_user = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param("is", $id_pemesanan, $_SESSION['nama_user']);
$stmt->execute();
$result = $stmt->get_result();

// Debugging: Cek apakah query berhasil
if (!$result) {
    die("Query error: " . $conn->error);
}

if ($result->num_rows > 0) {
    $pemesanan = $result->fetch_assoc();
    $detail_barang = [];

    // Reset pointer ke hasil pertama
    $result->data_seek(0);
    
    while ($row = $result->fetch_assoc()) {
        $detail_barang[] = [
            'id_produk' => $row['id_produk'], // Tambahkan ini untuk ID Produk
            'nama_barang' => $row['nama_barang'],
            'jumlah' => $row['jumlah'],
            'harga' => $row['harga']
        ];
    }
} else {
    echo "Pemesanan tidak ditemukan.";
    exit();
}
$stmt->close();

// Query untuk memeriksa apakah review sudah ada
$reviewed_products = [];
foreach ($detail_barang as $barang) {
    $query = "SELECT COUNT(*) AS review_count FROM reviews WHERE id_pemesanan = ? AND id_produk = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $id_pemesanan, $barang['id_produk']);
    $stmt->execute();
    $result = $stmt->get_result();
    $review = $result->fetch_assoc();
    if ($review['review_count'] > 0) {
        $reviewed_products[$barang['id_produk']] = true;
    } else {
        $reviewed_products[$barang['id_produk']] = false;
    }
    $stmt->close();
}


// Query untuk memeriksa apakah review sudah ada
$reviewed_products = [];
foreach ($detail_barang as $barang) {
    $query = "SELECT COUNT(*) AS review_count FROM reviews WHERE id_pemesanan = ? AND id_produk = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $id_pemesanan, $barang['id_produk']);
    $stmt->execute();
    $result = $stmt->get_result();
    $review = $result->fetch_assoc();
    if ($review['review_count'] > 0) {
        $reviewed_products[$barang['id_produk']] = true;
    } else {
        $reviewed_products[$barang['id_produk']] = false;
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Pemesanan - Tanija</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/bootstrap.css" rel="stylesheet">

    <!-- Style CSS -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/detail-pembelian.css">
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
                        <a class="nav-link" href="#">Artikel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Tentang Kami</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <h1 class="mb-4">Detail Pemesanan</h1>

        <div class="row">
            <div class="col-md-4">
                <h2>Pembelian</h2>
                <p><strong>No Pembelian:</strong> <?= $pemesanan['id'] ?></p>
                <p>Tanggal: <?= $pemesanan['tanggal_pemesanan'] ?></p>
                <p>Total: Rp. <?= number_format($pemesanan['total_pembayaran'], 2, ',', '.') ?></p>
                <p>Status: <?= $pemesanan['status_pembayaran'] ?></p>
            </div>

            <div class="col-md-7">
                <h2>Pengiriman</h2>
                <p><strong>Nama Penerima:</strong> <?= $pemesanan['nama_penerima'] ?></p>
                <p>Alamat Pengiriman: <?= $pemesanan['alamat'] ?></p>
                <p>Nomor Handphone: <?= $pemesanan['nomor_handphone'] ?></p>
                <p>Ongkir: Rp. <?= number_format($pemesanan['ongkir'], 2, ',', '.') ?></p>
            </div>
        </div>

        <h2 class="mt-4">Detail Barang:</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Produk</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Harga Satuan</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($detail_barang as $index => $barang) : ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $barang['id_produk'] ?></td>
                        <td><?= $barang['nama_barang'] ?></td>
                        <td><?= $barang['jumlah'] ?></td>
                        <td>Rp. <?= number_format($barang['harga'], 2, ',', '.') ?></td>
                        <td>Rp. <?= number_format($barang['jumlah'] * $barang['harga'], 2, ',', '.') ?></td>
                        <td>
                            <?php if (!$reviewed_products[$barang['id_produk']]) : ?>
                                <form action="../html/form_review.php" method="get" style="display: inline;">
                                    <input type="hidden" name="id_produk" value="<?= $barang['id_produk'] ?>">
                                    <input type="hidden" name="id_pemesanan" value="<?= $id_pemesanan ?>">
                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i> Kirim Review</button>
                                </form>
                            <?php else : ?>
                                <button class="btn btn-secondary btn-sm" disabled><i class="fas fa-check"></i> Review Dikirim</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
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
</body>
</html>
