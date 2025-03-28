// script.js
document.addEventListener("DOMContentLoaded", () => {
    // Particle Generation for Background Animation
    const particlesContainer = document.querySelector('.particles');
    const numParticles = 20;

    for (let i = 0; i < numParticles; i++) {
        const particle = document.createElement('div');
        particle.classList.add('particle');
        particle.style.left = `${Math.random() * 100}%`;
        particle.style.top = `${Math.random() * 100}%`;
        particle.style.animationDelay = `${Math.random() * 10}s`;
        particlesContainer.appendChild(particle);
    }

    // Form Validation for Register Form
    const registerForm = document.getElementById("registerForm");
    if (registerForm) {
        registerForm.addEventListener("submit", function (e) {
            let hasError = false;
            const errorContainer = document.createElement('div');
            errorContainer.className = 'error-message';
            errorContainer.style.display = 'none';

            // Clear previous error messages
            const existingError = registerForm.querySelector('.error-message');
            if (existingError) existingError.remove();

            // Password Validation
            const password = this.password.value;
            if (password.length < 6) {
                errorContainer.textContent = "Password must be at least 6 characters!";
                hasError = true;
            }

            // Email Validation
            const email = this.email.value;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                errorContainer.textContent = "Please enter a valid email address!";
                hasError = true;
            }

            // Username Validation
            const username = this.username.value;
            if (username.length < 3) {
                errorContainer.textContent = "Username must be at least 3 characters!";
                hasError = true;
            }

            if (hasError) {
                e.preventDefault();
                registerForm.insertBefore(errorContainer, registerForm.querySelector('button'));
                errorContainer.style.display = 'block';
            }
        });
    }

    // Form Validation for Login Form
    const loginForm = document.getElementById("loginForm");
    if (loginForm) {
        loginForm.addEventListener("submit", function (e) {
            let hasError = false;
            const errorContainer = document.createElement('div');
            errorContainer.className = 'error-message';
            errorContainer.style.display = 'none';

            // Clear previous error messages
            const existingError = loginForm.querySelector('.error-message');
            if (existingError) existingError.remove();

            // Username Validation
            const username = this.username.value;
            if (username.length < 3) {
                errorContainer.textContent = "Username must be at least 3 characters!";
                hasError = true;
            }

            // Password Validation
            const password = this.password.value;
            if (password.length < 6) {
                errorContainer.textContent = "Password must be at least 6 characters!";
                hasError = true;
            }

            if (hasError) {
                e.preventDefault();
                loginForm.insertBefore(errorContainer, loginForm.querySelector('button'));
                errorContainer.style.display = 'block';
            }
        });
    }

    // Password Visibility Toggle for Both Forms
    const passwordInputs = document.querySelectorAll('input[type="password"]');
    passwordInputs.forEach(input => {
        const toggleIcon = input.parentElement.querySelector('.toggle-password');
        if (toggleIcon) {
            toggleIcon.addEventListener('click', () => {
                if (input.type === 'password') {
                    input.type = 'text';
                    toggleIcon.textContent = '👁️‍🗨️';
                } else {
                    input.type = 'password';
                    toggleIcon.textContent = '👁️';
                }
            });
        }
    });
});