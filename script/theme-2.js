const themeSwitcher2 = document.querySelectorAll('.icon-2');

themeSwitcher2.forEach(switcher => {
  switcher.addEventListener('click', function () {
    applyTheme(this.dataset.theme);
    localStorage.setItem('theme', this.dataset.theme);
  });
});

function applyTheme(themeName) {
  let themeUrl = `style/${themeName}Theme.css`;
  document.querySelector('[title="theme"]').setAttribute('href', themeUrl);
}

let activeTheme2 = localStorage.getItem('theme');

if (activeTheme2 === null) {
  applyTheme('light')
} else {
  applyTheme(activeTheme);
}