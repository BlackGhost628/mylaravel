document.addEventListener('DOMContentLoaded', () => {
  const likeButtons = document.querySelectorAll('.like-btn');

  likeButtons.forEach(button => {
    button.addEventListener('click', () => {
      const liked = button.getAttribute('data-liked') === 'true';

      if (!liked) {
        button.textContent = '♥';
        button.setAttribute('data-liked', 'true');
        button.classList.add('liked');
      } else {
        button.textContent = '♡';
        button.setAttribute('data-liked', 'false');
        button.classList.remove('liked');
      }
    });
  });
});
