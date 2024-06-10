const accordionItems = document.querySelectorAll('.card');

accordionItems.forEach((item) => {
  item.addEventListener('click', () => {
    const button = item.querySelector('.btn-link');
    const icon = button.querySelector('span');
    if (button && icon) {
      const expanded = button.getAttribute('aria-expanded');
      if (expanded === 'true') {
        icon.textContent = '+';
      } else {
        icon.textContent = '-';
      }
    }
  });
});
