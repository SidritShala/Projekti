<?php
include_once('UserController.php');


if (session_start() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['adminemail'])) {
    header("Location:login.php");
    exit;
}
$UserController = new UserController();

$users = $UserController->getAllUsers();

$errMessage = $UserController->getErrorMessage();
$successMessage = $UserController->getSuccessMessage();
?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="dashboard.css">
    <title>Admin Users</title>
</head>

<body>
    <div class="sidebar">
        <h2>Furnitia</h2>
        <ul>
            <li><a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="adminProducts.php"><i class="fas fa-box"></i> Products</a></li>
            <li><a href="adminNews.php"><i class="fa-solid fa-blog"></i> Blog</a></li>
            <li><a href="#"><i class="fas fa-cogs"></i> Settings</a></li>
            <li><a href="#"><i class="fas fa-question-circle"></i> Support</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <h1>Users</h1>
            <div class="actions">
                <i class="fas fa-bell"></i>
                <i class="fas fa-user-circle"></i>

                <a href="logout.php">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </div>

        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td>
                        <?php echo htmlspecialchars($user->getUsername()) ?>
                    </td>
                    <td>
                        <?php echo htmlspecialchars($user->getEmail()) ?>
                    </td>
                    <td>
                        <?php echo htmlspecialchars($user->getRole()) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>
