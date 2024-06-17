<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Admin - Tanija</title>
    <link rel="shortcut icon" href="../assets/icons/logo-tanija.png" />
    <!-- Bootstrap CSS -->
    <link
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
    <!-- Style CSS -->
    <link rel="stylesheet" href="../assets/css/style.css" />

    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap"
      rel="stylesheet"
    />
    <style>
      body {
        font-family: "Roboto", sans-serif;
        background-color: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
      }
    </style>
  </head>
  <body>
    <!-- Elemen Loading -->
    <div class="loader"></div>
    <div class="container-login">
      <div class="left-section">
        <img src="./assets/images/gambarlogin_admin.png" alt="gambar" />
        <h2>Saya admin Tanija</h2>
      </div>
      <div class="right-section">
        <a href="/tanija/index.php">
          <img
            src="../assets/icons/logo-tanija2.png"
            alt=""
            onclick="window.location.href='index.html'"
          />
        </a>
        <h3>Masuk Akun Admin</h3>
        <form class="login" action="auth.php" method="POST">
          <input
            type="email"
            id="email"
            name="email"
            placeholder="example@gmail.com"
            required
          />
          <input
            type="password"
            id="password"
            name="password"
            placeholder="masukkan password"
            required
          />
          <p>
            Password terdiri dari minimal 8 karakter. Terdapat huruf kapital dan
            karakter unik atau angka.
          </p>
          <button type="submit">Masuk</button>
        </form>
        <p>Belum punya akun admin? <a href="register_admin.php">Daftar</a></p>
      </div>
    </div>
  </body>
  <script>
    window.addEventListener("load", () => {
      const loader = document.querySelector(".loader");

      // Tambahkan class untuk menghilangkan loader setelah 3 detik
      setTimeout(() => {
        loader.classList.add("loader--hidden");
        loader.addEventListener("transitionend", () => {
          document.body.removeChild(loader);
        });
      }, 500); // 3000 milidetik atau 3 detik
    });
  </script>
  <!-- Bootstrap JS, Popper.js, dan jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</html>
