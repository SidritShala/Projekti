document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('loginForm');
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const emailError = document.getElementById('emailError');
    const passwordError = document.getElementById('passwordError');

    form.addEventListener('submit', function (e) {
        let isValid = true;

        // Clear previous error messages
        emailError.textContent = '';
        passwordError.textContent = '';

        // Validate email
        if (email.value.trim() === '') {
            emailError.textContent = 'Email is required.';
            isValid = false;
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value.trim())) {
            emailError.textContent = 'Please enter a valid email address.';
            isValid = false;
        }

        // Validate password
        if (password.value.trim() === '') {
            passwordError.textContent = 'Password is required.';
            isValid = false;
        }

        // Prevent form submission if validation fails
        if (!isValid) {
            e.preventDefault();
        }
    });
});

