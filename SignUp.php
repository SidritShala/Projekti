<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// if (isset($_SESSION['useremail'])) {
//     header('Location: home.php');
//     exit;
// }

require_once 'RegisterController.php';

$RegisterController = new RegisterController();
$RegisterController->handleRegister();
$usernameError = $RegisterController->getUsernameError();
$emailError = $RegisterController->getEmailError();
$passwordError = $RegisterController->getPasswordError();
$succedMsg = $RegisterController->getSuccedMessage();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Illyrian PlayHouse</title>
    <link rel="stylesheet" href="SignUp.css">
</head>
<body>

     <!-- Register Form -->
     <div class="form-container" id="registerPage">
        <form id="registerForm" method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
            <h3>Create Your Account</h3>
            <input type="text" id="username" placeholder="Enter your username" class="box" name="username" required>
            <span id="usernameError" class="error"><?= $usernameError ?></span>
            <input type="email" id="email" placeholder="Enter your email" class="box" name="email" required>
            <span id="emailError" class="error"><?= $emailError ?></span>
            <input type="password" id="password" placeholder="Enter your password" class="box" name="password" required>
            <span id="passwordError" class="error"><?= $passwordError ?></span>
            <input type="text" id="address" placeholder="Enter your address" class="box" name="address">
            <input type="date" id="birthDate" class="box" name="birthDate">
            <input type="submit" value="Register Now" class="btn" name="registerBtn"> 
            <p>Already have an account? <a href="OnlineGameStore-LoginForm.php" id="login-link">Login now</a></p>
            <?php if ($succedMsg): ?>
                <p class="success"><?= $succedMsg ?></p>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>
