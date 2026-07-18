document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.getElementById('themeToggle');
    const body = document.body;

    if (!toggleBtn) return;

    // بارگذاری تم ذخیره شده
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
        body.className = savedTheme;
        toggleBtn.textContent = savedTheme === 'dark' ? '☀️' : '🌙';
    } else {
        // پیش‌فرض روشن
        body.className = 'light';
        toggleBtn.textContent = '🌙';
    }

    // رویداد کلیک
    toggleBtn.addEventListener('click', function() {
        if (body.classList.contains('light')) {
            body.classList.replace('light', 'dark');
            toggleBtn.textContent = '☀️';
            localStorage.setItem('theme', 'dark');
        } else {
            body.classList.replace('dark', 'light');
            toggleBtn.textContent = '🌙';
            localStorage.setItem('theme', 'light');
        }
    });
});