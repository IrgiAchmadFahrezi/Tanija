<?php
session_start();
include '../php/db_connection.php';

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['email'])) {
    header("Location: ../html/login.html");
    exit();
}

// Query untuk mendapatkan riwayat pemesanan pengguna yang sedang login
$query = "SELECT * FROM riwayat_pemesanan WHERE nama_user = '{$_SESSION['nama_user']}'";
$result = $conn->query($query);

// Cek apakah ada riwayat pemesanan
if ($result->num_rows > 0) {
    $riwayat_pemesanan = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $riwayat_pemesanan = [];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Riwayat Pemesanan - Tanija</title>
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
    <h1>Riwayat Pemesanan</h1>
    <table class="table mt-3">
      <thead>
        <tr>
          <th>No</th>
          <th>Tanggal Pemesanan</th>
          <th>Detail Barang</th>
          <th>Total Pembayaran</th>
          <th>Status Pembayaran</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($riwayat_pemesanan)) : ?>
          <?php foreach ($riwayat_pemesanan as $index => $pemesanan) : ?>
            <tr>
              <td><?= $index + 1 ?></td>
              <td><?= $pemesanan['tanggal_pemesanan'] ?></td>
              <td><?= $pemesanan['detail_barang'] ?></td>
              <td>Rp. <?= number_format($pemesanan['total_pembayaran'], 2, ',', '.') ?></td>
              <td><?= $pemesanan['status_pembayaran'] ?></td>
              <td>
                <button class="btn btn-info nota-btn" data-id="<?= $pemesanan['id'] ?>">Detail</button>
                <button class="btn btn-secondary cetak-btn" data-id="<?= $pemesanan['id'] ?>">Cetak Nota</button>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else : ?>
          <tr>
            <td colspan="6">Belum ada riwayat pemesanan.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
  <script>
    document.addEventListener("click", function(e) {
        if (e.target.classList.contains("nota-btn")) {
            var idPemesanan = e.target.dataset.id;
            showNota(idPemesanan);
        }
        if (e.target.classList.contains("cetak-btn")) {
            var idPemesanan = e.target.dataset.id;
            cetakSlipPembayaran(idPemesanan);
        }
    });

    function showNota(idPemesanan) {
        // Redirect ke halaman nota dengan menyertakan idPemesanan sebagai parameter URL
        window.location.href = "detail-pembelian.php?id_pemesanan=" + idPemesanan;
    }

    function cetakSlipPembayaran(idPemesanan) {
        // Redirect ke halaman cetak slip pembayaran dengan menyertakan idPemesanan sebagai parameter URL
        window.location.href = "cetak_slip_pembayaran.php?id_pemesanan=" + idPemesanan;
    }

    document.addEventListener("DOMContentLoaded", function() {
        // Cek apakah sesi email ada
        <?php if(isset($_SESSION['email'])) { ?>
            // Jika sesi email ada, ambil nama pengguna dari sesi
            var namaUser = "<?php echo $_SESSION['nama_user']; ?>";
            // Ubah teks "Profile" menjadi nama pengguna
            document.getElementById("nama_user").innerText = namaUser;
        <?php } ?>
    });
  </script>
</body>
</html>
