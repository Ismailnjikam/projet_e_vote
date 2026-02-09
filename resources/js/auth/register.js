// Password strength indicator
const passwordInput = document.getElementById('password');
const strengthBar = document.getElementById('passwordStrength');

passwordInput.addEventListener('input', function() {
    const strength = this.value.length;
    if (strength < 6) {
        strengthBar.style.backgroundColor = '#ef4444';
        strengthBar.style.width = '33%';
    } else if (strength < 10) {
        strengthBar.style.backgroundColor = '#f59e0b';
        strengthBar.style.width = '66%';
    } else {
        strengthBar.style.backgroundColor = '#10b981';
        strengthBar.style.width = '100%';
    }
});
