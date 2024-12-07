document.addEventListener("DOMContentLoaded", () => {
 
    const usernameInput = document.querySelector('.input-box input[type="text"]');
    const passwordInput = document.querySelector('.input-box input[type="password"]');
    const loginButton = document.querySelector('.btn');
    const rememberCheckbox = document.querySelector('.remember-forgot input[type="checkbox"]');
    const forgotPasswordLink = document.querySelector('.remember-forgot a');

   
    loginButton.addEventListener("click", (event) => {
        event.preventDefault();

        const username = usernameInput.value.trim();
        const password = passwordInput.value.trim();

        if (!username) {
            alert("Please enter your username.");
            return;
        }

        if (!password) {
            alert("Please enter your password.");
            return;
        }

       
        console.log("Form Submitted", { username, password, remember: rememberCheckbox.checked });
        alert("Login successful!");
    });

   
    const togglePasswordVisibility = () => {
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    };

   
    const passwordIcon = document.querySelector('.input-box i.bxs-lock-alt');
    if (passwordIcon) {
        passwordIcon.style.cursor = "pointer";
        passwordIcon.addEventListener("click", togglePasswordVisibility);
    }


    forgotPasswordLink.addEventListener("click", () => {
        alert("Redirecting to forgot password page...");
    });
});
