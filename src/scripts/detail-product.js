document.addEventListener("DOMContentLoaded", function () {
  const descriptionButton = document.querySelector(
    '[data-bs-toggle="collapse"][href="#description"]'
  );
  const reviewsButton = document.querySelector(
    '[data-bs-toggle="collapse"][href="#reviews"]'
  );
  const descriptionCollapse = document.querySelector("#description");
  const reviewsCollapse = document.querySelector("#reviews");

  // Add the show class to the description by default
  descriptionCollapse.classList.add("show");

  descriptionButton.addEventListener("click", function () {
    if (!descriptionCollapse.classList.contains("show")) {
      descriptionCollapse.classList.add("show");
      reviewsCollapse.classList.remove("show");
    }
  });

  reviewsButton.addEventListener("click", function () {
    if (!reviewsCollapse.classList.contains("show")) {
      reviewsCollapse.classList.add("show");
      descriptionCollapse.classList.remove("show");
    }
  });
});

// document.addEventListener("DOMContentLoaded", function () {
//   const quantityInput = document.getElementById("quantity");
//   const formQuantityInput = document.getElementById("form_quantity");
//   const increaseButton = document.getElementById("increase");
//   const decreaseButton = document.getElementById("decrease");

//   increaseButton.addEventListener("click", function () {
//     quantityInput.value = parseInt(quantityInput.value) + 1;
//     formQuantityInput.value = quantityInput.value;
//   });

//   decreaseButton.addEventListener("click", function () {
//     if (quantityInput.value > 1) {
//       quantityInput.value = parseInt(quantityInput.value) - 1;
//       formQuantityInput.value = quantityInput.value;
//     }
//   });
// });

// Event listener untuk tombol Add to cart
document.getElementById("addToCartBtn").addEventListener("click", function () {
  var productId = "<?php echo $row['id_produk']; ?>"; // ID produk dari PHP
  var quantity = document.getElementById("quantity").value; // Jumlah produk dari input
  var fotoProduk = "<?php echo $row['foto_produk']; ?>"; // URL foto produk dari PHP

  // Kirim data ke halaman add_to_cart.php menggunakan AJAX
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "add_to_cart.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      // Respons dari add_to_cart.php
      alert(xhr.responseText);
      // Redirect ke halaman cart.php setelah berhasil menambahkan ke keranjang
      window.location.href = "cart.php";
    }
  };
  xhr.send(
    "id=" + productId + "&quantity=" + quantity + "&foto_produk=" + fotoProduk
  );
});
