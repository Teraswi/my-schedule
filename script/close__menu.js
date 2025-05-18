document.addEventListener('DOMContentLoaded', function () {
  const toggle = document.getElementById('menu__toggle');
  const menuBox = document.querySelector('.menu__box');
  const menuBtn = document.querySelector('.menu__btn');

  // Закрытие при потере фокуса (без setTimeout)
  document.addEventListener('mousedown', function (e) {
    const isClickInside = menuBox.contains(e.target) || menuBtn.contains(e.target);
    if (!isClickInside && toggle.checked) {
      toggle.checked = false;
    }
  });
});
