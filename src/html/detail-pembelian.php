<?php
session_start();
include '../php/db_connection.php';
include '../php/number.php';

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['email'])) {
    header("Location: ../html/login.html");
    exit();
}

// Pastikan pengguna telah login dan nama pengguna tersedia dalam sesi
if(isset($_SESSION['nama_user'])) {
    $namaUser = $_SESSION['nama_user'];
} else {
    // Handle jika nama pengguna tidak tersedia dalam sesi
    $namaUser = ""; // Atau atur ke nilai default jika diperlukan
}

// Ambil id pemesanan dari parameter URL
if (!isset($_GET['id_pemesanan'])) {
    header("Location: riwayat_pemesanan.php");
    exit();
}
$id_pemesanan = $_GET['id_pemesanan'];

// Query untuk mendapatkan detail pemesanan dan detail barang berdasarkan id_pemesanan
$query = "SELECT rp.*, db.id as detail_id, db.nama_barang, db.jumlah, db.harga 
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
            'detail_id' => $row['detail_id'],
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
            <form class="form-inline my-2 my-lg-0" method="get" action="../php/search.php">
                <input class="form-control mr-sm-2" type="search" name="query" placeholder="Cari Produk..." aria-label="Cari Produk...">
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
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
                <th>Review</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($detail_barang as $index => $barang) : ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= $barang['nama_barang'] ?></td>
                    <td><?= $barang['jumlah'] ?></td>
                    <td>Rp. <?= number_format($barang['harga'], 2, ',', '.') ?></td>
                    <td>Rp. <?= number_format($barang['jumlah'] * $barang['harga'], 2, ',', '.') ?></td>
                    <td><button class="btn btn-primary" data-toggle="modal" data-target="#reviewModal" data-detail-id="<?= $barang['detail_id'] ?>">Review</button></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Review Modal -->
    <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reviewModalLabel">Tulis Review</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="reviewForm" action="../php/submit_review.php" method="POST">
                        <input type="hidden" name="detail_id" id="detailIdInput">
                        <div class="form-group">
                            <label for="reviewText">Review</label>
                            <textarea class="form-control" id="reviewText" name="review_text" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="reviewRating">Rating</label>
                            <select class="form-control" id="reviewRating" name="review_rating" required>
                                <option value="">Pilih Rating</option>
                                <option value="1">1 - Sangat Buruk</option>
                                <option value="2">2 - Buruk</option>
                                <option value="3">3 - Cukup</option>
                                <option value="4">4 - Bagus</option>
                                <option value="5">5 - Sangat Bagus</option>
                            </select>
                        </div>
                        <!-- Menambahkan input field untuk nama pengguna dari sesi -->
                        <div class="form-group">
                            <label for="namaUser">Nama Pengguna</label>
                            <input type="text" class="form-control" id="namaUser" name="nama_user" value="<?php echo $namaUser; ?>" required readonly>
                        </div>
                        <!-- End of tambahan -->
                        <input type="hidden" name="id_pemesanan" value="<?= $id_pemesanan ?>">
                        <input type="hidden" name="detail_id" value="<?= $detail_id ?>">
                        <button type="submit" class="btn btn-primary">Kirim Review</button>
                    </form>
                </div>

            </div>
        </div>
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

    <!-- JavaScript -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            <?php if(isset($_SESSION['email'])) { ?>
                var namaUser = "<?php echo $_SESSION['nama_user']; ?>";
                document.getElementById("nama_user").innerText = namaUser;
            <?php } ?>
        });

        $('#reviewModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var detailId = button.data('detail-id');
            var modal = $(this);
            modal.find('#detailIdInput').val(detailId);
        });

        // Simpan referensi ke formulir
var reviewForm = document.getElementById("reviewForm");

// Tambahkan event listener untuk aksi submit
reviewForm.addEventListener("submit", function(event) {
    // Hentikan aksi submit bawaan
    event.preventDefault();

    // Kirimkan data menggunakan AJAX atau lakukan submit biasa

    // Setelah berhasil, reset formulir
    reviewForm.reset();
});

    </script>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
