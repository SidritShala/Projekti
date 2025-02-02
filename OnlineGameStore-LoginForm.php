<?php

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

// if (isset($_SESSION['useremail'])) {
//   header('Location:home.php');
//   exit;
// }

// if (isset($_SESSION['adminemail'])) {
//   header('Location:dashboard.php');
//   exit;
// }

require_once 'LoginController.php';

$loginController = new LoginController();
$loginController->handleLogin();
$errorMsg = $loginController->getErrorMessage();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="OnlineGameStore-LoginForm.css">
 
</head>
<body>
    <div class="login-page" id="loginPage">
        <form id="loginForm" method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
            <h3>Login to Your Account</h3>
            <input type="email" id="email" placeholder="Enter your email" class="box" name="email" required>
            <span id="emailError" class="error"><?= $loginController->getErrorMessage(); ?></span>
            <input type="password" id="password" placeholder="Enter your password" class="box" name="password" required>
            <span id="passwordError" class="error"></span>
            <div class="remember">
                <input type="checkbox" name="" id="remember-me">
                <label for="remember-me">Remember me</label>
            </div>
          <input type="submit" value="Login Now" class="btn" name="Login">
            <p>Don't have an account? <a href="register.php" id="signup-link">Create now</a></p>
        </form>
    </div>
    <script src="js/login.js"></script>
    
</body>
</html>