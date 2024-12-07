document.addEventListener("DOMContentLoaded", () => {
    
    const usernameInput = document.querySelector('.input-box input[placeholder="Username"]');
    const emailInput = document.querySelector('.input-box input[placeholder="Email"]');
    const passwordInput = document.querySelector('.input-box input[placeholder="Password"]');
    const confirmPasswordInput = document.querySelector('.input-box input[placeholder="Confirm Password"]');
    const agreeCheckbox = document.querySelector('.agree-terms input[type="checkbox"]');
    const signUpButton = document.querySelector('.btn');

    
    signUpButton.addEventListener("click", (event) => {
        event.preventDefault(); // Prevent form submission

        const username = usernameInput.value.trim();
        const email = emailInput.value.trim();
        const password = passwordInput.value.trim();
        const confirmPassword = confirmPasswordInput.value.trim();

        if (!username) {
            alert("Please enter a username.");
            return;
        }

        if (!email || !isValidEmail(email)) {
            alert("Please enter a valid email address.");
            return;
        }

        if (!password) {
            alert("Please enter a password.");
            return;
        }

        if (password !== confirmPassword) {
            alert("Passwords do not match. Please try again.");
            return;
        }

        if (!agreeCheckbox.checked) {
            alert("You must agree to the Terms & Conditions.");
            return;
        }

        
        console.log("Registration Successful", { username, email, password });
        alert("Registration Successful! Redirecting...");
        window.location.href = "WelcomePage.html"; 
    });

    
    const isValidEmail = (email) => {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    };
});