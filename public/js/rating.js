
(function () {
  function updateVisual(ratingEl, value) {
    const buttons = Array.from(ratingEl.querySelectorAll('.star-btn'));
    buttons.forEach(btn => {
      const v = Number(btn.getAttribute('data-value'));
      if (v <= value) {
        btn.classList.add('filled');
        btn.setAttribute('aria-checked', 'true');
      } else {
        btn.classList.remove('filled');
        btn.setAttribute('aria-checked', 'false');
      }
    });
    ratingEl.dataset.rating = String(value);
  }

  function clearPreview(ratingEl) {
    ratingEl.querySelectorAll('.star-btn.preview').forEach(b => b.classList.remove('preview'));
  }

  document.querySelectorAll('.rating').forEach(ratingEl => {
    const buttons = Array.from(ratingEl.querySelectorAll('.star-btn'));

    // keyboard support: Left/Right arrows
    ratingEl.addEventListener('keydown', (ev) => {
      const current = Number(ratingEl.dataset.rating || 0);
      if (ev.key === 'ArrowLeft' || ev.key === 'ArrowDown') {
        ev.preventDefault();
        updateVisual(ratingEl, Math.max(0, current - 1));
      } else if (ev.key === 'ArrowRight' || ev.key === 'ArrowUp') {
        ev.preventDefault();
        updateVisual(ratingEl, Math.min(5, current + 1));
      } else if (ev.key === 'Home') {
        ev.preventDefault();
        updateVisual(ratingEl, 0);
      } else if (ev.key === 'End') {
        ev.preventDefault();
        updateVisual(ratingEl, 5);
      }
    });

    buttons.forEach(btn => {
      const value = Number(btn.getAttribute('data-value'));

      // Click => set rating
      btn.addEventListener('click', () => {
        updateVisual(ratingEl, value);
        // برای ذخیره در سرور می‌توانید اینجا AJAX بزنید
      });

      // Hover preview
      btn.addEventListener('mouseenter', () => {
        clearPreview(ratingEl);
        buttons.forEach(b => {
          const v = Number(b.getAttribute('data-value'));
          if (v <= value) b.classList.add('preview');
          else b.classList.remove('preview');
        });
      });

      btn.addEventListener('mouseleave', () => {
        clearPreview(ratingEl);
      });

      // Space / Enter برای فعال‌سازی
      btn.addEventListener('keydown', (ev) => {
        if (ev.key === ' ' || ev.key === 'Enter') {
          ev.preventDefault();
          btn.click();
        }
      });
    });

    ratingEl.addEventListener('mouseleave', () => {
      clearPreview(ratingEl);
      updateVisual(ratingEl, Number(ratingEl.dataset.rating || 0));
    });

    // initialize
    updateVisual(ratingEl, Number(ratingEl.dataset.rating || 0));
  });
})();
