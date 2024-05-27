document.addEventListener("DOMContentLoaded", function () {
  const descriptionButton = document.querySelector(
    '[data-bs-target="#description"]'
  );
  const reviewsButton = document.querySelector('[data-bs-target="#reviews"]');
  const descriptionCollapse = document.querySelector("#description");
  const reviewsCollapse = document.querySelector("#reviews");

  descriptionButton.addEventListener("click", function () {
    if (!descriptionCollapse.classList.contains("show")) {
      descriptionCollapse.classList.add("show");
      reviewsCollapse.classList.remove("show");
    } else {
      descriptionCollapse.classList.remove("show");
    }
  });

  reviewsButton.addEventListener("click", function () {
    if (!reviewsCollapse.classList.contains("show")) {
      reviewsCollapse.classList.add("show");
      descriptionCollapse.classList.remove("show");
    } else {
      reviewsCollapse.classList.remove("show");
    }
  });
});
