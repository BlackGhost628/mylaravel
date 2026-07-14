// فعال/غیرفعال کردن دکمه "تکمیل ثبت‌نام" با تیک قوانین
const termsCheckbox = document.getElementById('terms');
const registerBtn = document.getElementById('registerBtn');

termsCheckbox.addEventListener('change', () => {
  if (termsCheckbox.checked) {
    registerBtn.disabled = false;
    registerBtn.classList.remove('md-disabled');
  } else {
    registerBtn.disabled = true;
    registerBtn.classList.add('md-disabled');
  }
});
