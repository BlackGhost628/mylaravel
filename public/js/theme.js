// تغییر تم روز/شب
const toggleBtn = document.getElementById('themeToggle');
const body = document.body;

// بارگذاری تم ذخیره شده
const savedTheme = localStorage.getItem('theme');
if (savedTheme) {
  body.className = savedTheme;
  toggleBtn.textContent = savedTheme === 'dark' ? '🌙' : '☀️';
}

// تغییر تم با کلیک
toggleBtn.addEventListener('click', () => {
  if (body.classList.contains('light')) {
    body.classList.replace('light', 'dark');
    toggleBtn.textContent = '🌙';
    localStorage.setItem('theme', 'dark');
  } else {
    body.classList.replace('dark', 'light');
    toggleBtn.textContent = '☀️';
    localStorage.setItem('theme', 'light');
  }
});
