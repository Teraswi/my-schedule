const themeSwitcher = document.querySelectorAll('.icon');

themeSwitcher.forEach(switcher => {
  switcher.addEventListener('click', function () {
    applyTheme(this.dataset.theme);
    localStorage.setItem('theme', this.dataset.theme);
  });
});

function applyTheme(themeName) {
  let themeUrl = `style/${themeName}Theme.css`;
  document.querySelector('[title="theme"]').setAttribute('href', themeUrl);
}

let activeTheme = localStorage.getItem('theme');

if (activeTheme === null) {
  applyTheme('light')
} else {
  applyTheme(activeTheme);
}