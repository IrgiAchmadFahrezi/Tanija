<?php
session_start();
include '../php/db_connection.php';
include '../php/number.php';

// Tangkap ID produk dari URL
$id_produk = $_GET['id'];
$sql = "SELECT * FROM produk WHERE id_produk = '$id_produk'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Produk tidak ditemukan.";
    exit();
}

// Hitung jumlah ulasan
$reviews_sql = "SELECT COUNT(*) as total_reviews FROM reviews WHERE id_produk = ?";
$reviews_stmt = $conn->prepare($reviews_sql);
$reviews_stmt->bind_param("i", $id_produk);
$reviews_stmt->execute();
$reviews_result = $reviews_stmt->get_result();
$reviews_count = 0;
if ($reviews_result->num_rows > 0) {
    $reviews_row = $reviews_result->fetch_assoc();
    $reviews_count = $reviews_row['total_reviews'];
}
$reviews_stmt->close();

if(isset($_POST['addToFavoriteBtn'])) {
    // Tangkap detail produk
    $id_produk = $_GET['id'];
    $nama_produk = $row['nama_produk'];
    $harga_produk = $row['harga_produk'];
    $foto_produk = $row['foto_produk']; // Tambahkan ini

    // Buat array untuk menyimpan detail produk
    $produk = array(
        'id' => $id_produk,
        'nama' => $nama_produk,
        'harga' => $harga_produk,
        'foto_produk' => $foto_produk // Tambahkan ini
    );

    // Periksa apakah favorit telah dibuat sebelumnya dalam sesi
    if(!isset($_SESSION['favorites'])) {
        $_SESSION['favorites'] = array();
    }

    // Tambahkan detail produk ke dalam favorit
    $_SESSION['favorites'][$id_produk] = $produk;

    // Redirect ke halaman favorit
    //header("Location: favorite.php");
    //exit();
}

// Handle Buy It Now
if (isset($_POST['buy_it_now'])) {
    $id_produk = $_POST['id_produk'];
    $nama_produk = $_POST['nama_produk'];
    $harga_produk = $_POST['harga_produk'];
    $jumlah = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
    $foto_produk = $_POST['foto_produk'];
    $stock = $_POST['stock'];
    
    // Periksa stok produk dari database
    $sql = "SELECT stock FROM produk WHERE id_produk = '$id_produk'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stok_tersedia = $row['stock'];

        // Periksa apakah stok cukup untuk pembelian
        if ($jumlah <= $stok_tersedia) {
            // Kurangi jumlah stok yang dibeli dari jumlah stok yang tersedia
            $stok_baru = $stok_tersedia - $jumlah;

            // Perbarui jumlah stok produk di database
            $update_sql = "UPDATE produk SET stock = '$stok_baru' WHERE id_produk = '$id_produk'";
            $update_result = $conn->query($update_sql);

            if ($update_result) {
                // Stok berhasil diperbarui, lanjutkan dengan proses pembayaran atau tindakan lainnya
                // Check if product is already in the cart
                $found = false;
                foreach ($_SESSION['cart'] as &$item) {
                    if ($item['id'] == $id_produk) {
                        $item['jumlah'] += $jumlah;
                        $found = true;
                        break;
                    }
                }
                if (!$found) {
                    $_SESSION['cart'][] = array(
                        'id' => $id_produk,
                        'nama' => $nama_produk,
                        'harga' => $harga_produk,
                        'jumlah' => $jumlah,
                        'foto_produk' => $foto_produk
                    );
                }

                // Redirect to payment page
                header("Location: detail-pembayaran.php");
                exit();
            } else {
                // Gagal memperbarui stok di database
                echo "Gagal memperbarui stok produk di database.";
            }
        } else {
            // Jumlah yang dibeli melebihi stok yang tersedia
            echo "Jumlah yang dibeli melebihi stok yang tersedia.";
        }
    } else {
        // Produk tidak ditemukan dalam database
        echo "Produk tidak ditemukan.";
    }
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

    <!-- Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">

</head>
<body>
<?php
    include '../php/db_connection.php';
    // Pastikan tombol "Add to Cart" ditekan
if (isset($_POST['addToCartBtn'])) {
    // Periksa apakah pengguna sudah login
    if (!isset($_SESSION['email'])) {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Anda harus login terlebih dahulu untuk menambahkan produk ke keranjang.',
                    confirmButtonColor: '#00880d',
                    confirmButtonText: 'OK'
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
    $jumlah = $_POST['quantity'];

    // Periksa stok produk
    $sql = "SELECT stock FROM produk WHERE id_produk = '$id_produk'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stok_tersedia = $row['stock'];

        if ($jumlah > $stok_tersedia) {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Jumlah yang dibeli melebihi stok yang tersedia.',
                        confirmButtonColor: '#00880d',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.history.back();
                        }
                    });
                  </script>";
            exit();
        }
    }

    // Periksa apakah produk sudah ada di keranjang belanja
    if (isset($_SESSION['cart'][$id_produk])) {
        echo "<script>
                Swal.fire({
                    icon: 'info',
                    title: 'Info',
                    text: 'Produk sudah ada di keranjang belanja.',
                    confirmButtonColor: '#00880d'
                });
              </script>";
            } else {
                $nama_produk = $_POST['nama_produk'];
                $harga_produk = $_POST['harga_produk'];
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
                            title: 'Success',
                            text: 'Produk berhasil ditambahkan ke keranjang belanja. Total item dalam keranjang: $total_items',
                            confirmButtonColor: '#00880d'

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
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Anda harus login terlebih dahulu untuk menambahkan produk ke favorit.',
                            confirmButtonColor: '#00880d', // Warna tombol hijau
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href='../html/login.html';
                            }
                        });
                    </script>";
                exit();
            }

            
            // Periksa apakah produk sudah ada dalam daftar favorit
            if (isset($_SESSION['favorites'][$id_produk])) {
                echo "<script>
                        Swal.fire({
                            icon: 'info',
                            title: 'Info',
                            text: 'Produk sudah ada di favorit.',
                            confirmButtonColor: '#00880d' // Warna tombol hijau
                        });
                    </script>";
            } else {
                // Tangkap detail produk dari POST data
            $id_produk = $_POST['id_produk'];
            $nama_produk = $_POST['nama_produk'];
            $harga_produk = $_POST['harga_produk'];
            $nama_file_foto = $_POST['foto_produk']; // Mendapatkan nama file foto produk dari form

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
                            title: 'Success',
                            text: 'Produk berhasil ditambahkan ke favorit. Total item dalam favorit: $total_favorites',
                            confirmButtonColor: '#00880d' // Warna tombol hijau
                        });
                    </script>";
            }
        }

    ?>

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
    ?>
    
    <div class="loader"></div>

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
                    <a class="nav-link"> <i class="far fa-user"></i> <span id="nama_user">Profil</span></a>
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
            <a class="nav-link" href="./article.php">Artikel</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./about.php">Tentang Kami</a>
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
                        <button type="submit" name="addToCartBtn" class="btn btn-warning"><i class="fas fa-cart-plus"></i> Add to Cart</button>
                        <button type="submit" class="btn btn-outline-secondary btn-favorite" name="addToFavoriteBtn"><i class="fas fa-heart"></i> Add to Favorite</button>
                        <button type="submit" name="buy_it_now" class="btn btn-success"><i class="fas fa-shopping-cart"></i> Buy It Now</button>
                    </form>
                </div>
                <!-- <button class="btn btn-warning" id="addToCartBtn">Add to Cart</button> -->

                
                <p class="mt-3">
                    <strong>Stok:</strong> <?php echo $row['stock']; ?><br>
                    <strong>Kategori:</strong> <?php echo $row['kategori']; ?><br>
                </p>
                <div>
                    <button class="btn-outline-primary" data-bs-toggle="collapse" href="#description" role="button" aria-expanded="false" aria-controls="description">
                        Description
                    </button>
                    <button class="btn-outline-primary" data-bs-toggle="collapse" href="#reviews" role="button" aria-expanded="false" aria-controls="reviews">
                        Reviews (<?php echo $reviews_count; ?>)
                    </button>
                    <div class="collapse mt-3" id="description">
                        <div class="card card-body"><?php echo htmlspecialchars($row['deskripsi_produk'], ENT_QUOTES, 'UTF-8'); ?>
                        </div>
                    </div>
                    <div class="collapse mt-3" id="reviews">
                        <div class="card card-body">
                            <?php
                            // Koneksi ke database
                            include '../php/db_connection.php';

                            // Query untuk mengambil ulasan produk dari database
                            $reviews_sql = "SELECT * FROM reviews WHERE id_produk = ?";
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
                                        echo '<strong>Tanggal:</strong> ' . $review_row['created_at'] . '<br>';

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

    <!-- footer -->
  <footer class="footer">
      <div class="container">
        <div class="content">
          <div class="content-top d-flex justify-content-between flex-column flex-lg-row">
            <div class="content-top-left subtext col-12 col-lg-4">
              <div class="subtext-text d-flex flex-column gap-3">
                <a href="/tanija/index.php" class="logo d-inline-flex">
                  <img src="../assets/icons/logo-tanija.png" alt="" class="img img-logo" />
                </a>
                <p class="subtext-text-desc">Tanija hadir menyediakan pengalaman belanja online yang responsif dan ramah pengguna untuk para konsumen yang tertarik dengan produk-produk pertanian berkualitas.</p>
              </div>
            </div>
            <div class="content-top-right subtext col-12 col-lg-7 d-flex justify-content-between flex-column flex-lg-row">
              <div class="subtext-menu">
                <h5 class="subtext-menu-subtitle">Cari Produk</h5>
                <div class="wrap">
                  <a href="../html/product.php?kategori%5B%5D=Pupuk" class="nav-link">Pupuk</a>
                  <a href="../html/product.php?kategori%5B%5D=Alat+Pertanian" class="nav-link">Alat Pertanian</a>
                  <a href="../html/product.php?kategori%5B%5D=Bibit+Tanaman" class="nav-link">Bibit Pertanian</a>
                  <a href="../html/product.php?kategori%5B%5D=Pestisida" class="nav-link">Pestisida</a>
                </div>
              </div>
              <div class="subtext-menu">
                <h5 class="subtext-menu-subtitle">Tentang</h5>
                <div class="wrap">
                  <a href="../html/about.php" class="nav-link">Tentang Kami</a>
                  <a href="../html/about.php" class="nav-link">FAQ</a>
                  <a href="../html/about.php" class="nav-link">Tim Kami</a>
                </div>
              </div>
              <div class="subtext-menu">
                <h5 class="subtext-menu-subtitle">Kontak Kami</h5>
                <div class="ic-wrap">
                  <a href="mailto:tanija207@gmail.com" class="nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 16 16" fill="none">
                      <path d="M0 4C0 3.46957 0.210714 2.96086 0.585786 2.58579C0.960859 2.21071 1.46957 2 2 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V12C16 12.5304 15.7893 13.0391 15.4142 13.4142C15.0391 13.7893 14.5304 14 14 14H2C1.46957 14 0.960859 13.7893 0.585786 13.4142C0.210714 13.0391 0 12.5304 0 12V4ZM2 3C1.73478 3 1.48043 3.10536 1.29289 3.29289C1.10536 3.48043 1 3.73478 1 4V4.217L8 8.417L15 4.217V4C15 3.73478 14.8946 3.48043 14.7071 3.29289C14.5196 3.10536 14.2652 3 14 3H2ZM15 5.383L10.292 8.208L15 11.105V5.383ZM14.966 12.259L9.326 8.788L8 9.583L6.674 8.788L1.034 12.258C1.09083 12.4708 1.21632 12.6589 1.39099 12.7931C1.56566 12.9272 1.77975 13 2 13H14C14.2201 13 14.4341 12.9274 14.6088 12.7934C14.7834 12.6595 14.909 12.4716 14.966 12.259ZM1 11.105L5.708 8.208L1 5.383V11.105Z" fill="#F6B943"/>
                    </svg>
                  </a>
                  <a href="https://www.instagram.com/tanija.official" class="nav-link">
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
    document.addEventListener("DOMContentLoaded", function () {
  const quantityInput = document.getElementById("quantity");
  const formQuantityInput = document.getElementById("form_quantity");
  const increaseButton = document.getElementById("increase");
  const decreaseButton = document.getElementById("decrease");

  increaseButton.addEventListener("click", function () {
    // quantityInput.value = parseInt(quantityInput.value) + 1;
    // formQuantityInput.value = quantityInput.value;

    let quantity = parseInt(quantityInput.value);
        const maxQuantity = <?php echo $row['stock']; ?>; // Ambil stok dari PHP

        if (quantity < maxQuantity) {
            quantity++;
            quantityInput.value = quantity;
            formQuantityInput.value = quantityInput.value;
        } else {
            Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Jumlah yang dibeli melebihi stok yang tersedia.',
                        confirmButtonColor: '#00880d',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            exit()
                        }
                    });
        }
  });

  decreaseButton.addEventListener("click", function () {
    if (quantityInput.value > 1) {
      quantityInput.value = parseInt(quantityInput.value) - 1;
      formQuantityInput.value = quantityInput.value;
    }
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
  <script>
    window.addEventListener("load", () => {
  const loader = document.querySelector(".loader");

  if (loader) {
    loader.classList.add("loader--hidden");

    loader.addEventListener("transitionend", () => {
      if (loader.parentNode) {
        loader.parentNode.removeChild(loader);
      }
    });
  }
});
</script>


    <script src="../scripts/detail-product.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
