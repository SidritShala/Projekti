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
        <h2>Illyrian PlayHouse</h2>
        <ul>
            <!-- <li><a href=""><i class="fas fa-home"></i> Dashboard</a></li> -->
            <li><a href="AdminUser.php"><i class="fas fa-users"></i>Users</a></li>
            <li><a href="adminProducts.php"><i class="fas fa-box"></i> Products</a></li>
            <li><a href="#"><i class="fas fa-chart-line"></i> News </a></li>
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
            <h3>850</h3>
            <p>Active Users</p>
        </div>
        <div class="card">
            <h3>600</h3>
            <p>Products</p>
        </div>
        <div class="card">
            <h3>75</h3>
            <p>Orders Today</p>
        </div>
        <div class="card">
            <h3>$30,000</h3>
            <p>Total Revenue</p>
        </div>
    </div>

    <!-- New Dashboard Cards -->
    <div class="cards">
        <div class="card">
            <h3>25</h3>
            <p>Pending Orders</p>
        </div>
        <div class="card">
            <h3>600</h3>
            <p>New Visitors</p>
        </div>
        <div class="card">
            <h3>55</h3>
            <p>Feedback Received</p>
        </div>
        <div class="card">
            <h3>15</h3>
            <p>Support Tickets</p>
        </div>
    </div>

    <!-- Gaming Store Specific Features -->
    <div class="cards">
        <div class="card">
            <h3>Top Selling Games</h3>
            <p> FC25, GTA V, Call of Duty</p>
        </div>
        <div class="card">
            <h3>Recent Reviews</h3>
            <p>"Awesome game!" - Antony56</p>
            <p>"Loved the graphics!" - Garnacho5</p>
        </div>
        <div class="card">
            <h3>Upcoming Releases</h3>
            <p>Football Manager 25 - Release Date: 10 Feb 2025</p>
            <p>GTA VI - Release Date: 20 Mar 2025</p>
        </div>
        <div class="card">
            <h3>Stock Alerts</h3>
            <p>Minecraft: Low Stock</p>
            <p>need for speed: Out of Stock</p>
        </div>
        <div class="card">
            <h3>Gaming Events</h3>
            <p>Tournament fortnite - 15 Feb 2025</p>
        </div>
        <div class="card">
            <h3>coming  Items</h3>
            <p>NBA2k25, Marvel Rivals, Sniper elite</p>
        </div>
    </div>
<!-- Footer -->
<div class="footer">
        <p>&copy; 2025 Illyrian PlayHouse. All rights reserved.</p>
    </div>
</body>

</html>
