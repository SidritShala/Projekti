<?php
session_start();

$users = [
    'admin' => ['password' => 'admin123', 'role' => 'admin'],
    'user' => ['password' => 'user123', 'role' => 'user']
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (isset($users[$username]) && $users[$username]['password'] === $password) {
        // Store session variables
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $users[$username]['role'];
        $_SESSION['logged_in'] = true; 

        // ✅ Set `adminemail` session variable for admindashboard.php compatibility
        if ($_SESSION['role'] === 'admin') {
            $_SESSION['adminemail'] = $username; // This is the fix!
            header('Location: admindashboard.php');
        } else {
            header('Location: index.php');
        }
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Illyrian PlayHouse</title>
    <link rel="stylesheet" href="OnlineGameStore-LoginForm.css">
</head>
<body>

<div class="wrapper">
    <form method="POST" action="OnlineGameStore-LoginForm.php">
        <h1>Login</h1>
        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <div class="input-box">
            <input type="text" name="username" placeholder="Username" required>
        </div>
        <div class="input-box">
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <div class="remember-forgot">
            <label><input type="checkbox"> Remember me</label>
            <a href="#">Forgot password?</a>
        </div>
        <button type="submit" class="btn">Login</button>
        <div class="register-link">
            <p>Don't have an account? <a href="SignUp.html">Register</a></p>
        </div>
    </form>
</div>

</body>
</html>
