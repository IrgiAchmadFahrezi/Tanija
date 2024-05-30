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

// Ambil elemen-elemen yang diperlukan
var decreaseBtn = document.getElementById("decrease");
var increaseBtn = document.getElementById("increase");
var quantityInput = document.getElementById("quantity");

// Tambahkan event listener untuk tombol tambah
increaseBtn.addEventListener("click", function () {
  quantityInput.value = parseInt(quantityInput.value) + 1;
});

// Tambahkan event listener untuk tombol kurang
decreaseBtn.addEventListener("click", function () {
  var currentValue = parseInt(quantityInput.value);
  if (currentValue > 1) {
    quantityInput.value = currentValue - 1;
  }
});

// Event listener untuk tombol Add to cart
document.getElementById("addToCartBtn").addEventListener("click", function () {
  var productId = "<?php echo $row['id_produk']; ?>"; // ID produk dari PHP
  var quantity = document.getElementById("quantity").value; // Jumlah produk dari input

  // Kirim data ke halaman cart.php dengan URL query string
  window.location.href = "cart.php?id=" + productId + "&quantity=" + quantity;
});

document.addEventListener("DOMContentLoaded", function () {
  const addToCartBtn = document.getElementById("addToCartBtn");
  // Di dalam script JavaScript di detail-product.php

  addToCartBtn.addEventListener("click", function () {
    const productId = this.getAttribute("data-product-id");
    const productName = this.getAttribute("data-product-name");
    const productPrice = this.getAttribute("data-product-price");
    const quantity = document.getElementById("quantity").value;

    // Kirim data ke PHP menggunakan AJAX
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "add_to_cart.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        // Respons dari server (jika diperlukan)
        console.log(xhr.responseText);
      }
    };
    xhr.send(
      "id=" +
        productId +
        "&name=" +
        encodeURIComponent(productName) +
        "&price=" +
        productPrice +
        "&quantity=" +
        quantity
    );
  });
});
