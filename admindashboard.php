<?php
if (session_start() === PHP_SESSION_NONE) {
    session_start();
}
//if (!isset($_SESSION['adminemail'])) {
 //   header("Location:OnlineGameStore-LoginForm.php");
 //   exit;
//}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitProShop - Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="dashboard.css">
</head>

<body>
    <div class="sidebar">
        <h2>FitProShop</h2>
        <ul>
            <!-- <li><a href=""><i class="fas fa-home"></i> Dashboard</a></li> -->
            <li><a href="AdminUser.php"><i class="fas fa-users"></i>Users</a></li>
            <li><a href="adminProducts.php"><i class="fas fa-box"></i> Products</a></li>
            <li><a href="adminNews.php"><i class="fas fa-chart-line"></i> News </a></li>
            <li><a href="#"><i class="fas fa-cogs"></i> Settings</a></li>
            <li><a href="#"><i class="fas fa-question-circle"></i> Support</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <h1>Welcome, Admin!</h1>
            <div class="actions">
                <i class="fas fa-bell"></i>
                <i class="fas fa-user-circle"></i>

                <a href="logout.php">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </div>

        <!-- Dashboard Cards -->
        <div class="cards">
            <div class="card">
                <h3>1100</h3>
                <p>Active Users</p>
            </div>
            <div class="card">
                <h3>320</h3>
                <p>Products</p>
            </div>
            <div class="card">
                <h3>45</h3>
                <p>Orders Today</p>
            </div>
            <div class="card">
                <h3>$12,000</h3>
                <p>Total Revenue</p>
            </div>
        </div>
    </div>

</body>

</html>
