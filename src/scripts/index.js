const accordionItems = document.querySelectorAll(".card");

accordionItems.forEach((item) => {
  item.addEventListener("click", () => {
    const button = item.querySelector(".btn-link");
    const icon = button.querySelector("span");
    if (button && icon) {
      const expanded = button.getAttribute("aria-expanded");
      if (expanded === "true") {
        icon.textContent = "+";
      } else {
        icon.textContent = "-";
      }
    }
  });
});

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

// Animasi teks menggunakan library anime
anime({
  targets: "#animatedText",
  opacity: [0, 1], // Transisi dari keburaman ke jelas
  easing: "easeInOutQuad", // Efek animasi
  duration: 1500, // Durasi animasi dalam milidetik
  loop: true, // Mengulang animasi secara terus-menerus
  direction: "alternate", // Mengubah arah animasi setelah satu putaran
});
