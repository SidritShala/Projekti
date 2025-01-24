<?php
session_start();

// Kontrollo nëse përdoruesi është i kyçur dhe ka rolin "admin"
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['role'] !== 'admin') {
    // Nëse nuk është i kyçur ose nuk është admin, ridrejtoje te forma e login
    header('Location: OnlineGameStore-LoginForm.php');
    exit();
}

// Funksion për daljen nga llogaria
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: OnlineGameStore-LoginForm.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #2b386e;
            color: white;
            padding: 10px 20px;
            text-align: center;
        }
        .container {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            background-color: #2b386e;
            color: white;
            width: 250px;
            padding: 20px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
        }
        .sidebar a:hover {
            background-color: #435a94;
        }
        .main-content {
            flex: 1;
            padding: 20px;
            background-color: #fff;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Welcome to the Admin Dashboard</h1>
    </div>
    <div class="container">
        <div class="sidebar">
            <h2>Menu</h2>
            <a href="?page=dashboard">Dashboard</a>
            <a href="?page=users">Manage Users</a>
            <a href="?page=settings">Settings</a>
            <a href="?page=reports">Reports</a>
            <a href="?logout=true">Logout</a>
        </div>
        <div class="main-content">
            <?php
            $page = $_GET['page'] ?? 'dashboard';

            if ($page === 'dashboard') {
                echo '<h2>Dashboard</h2><p>Welcome to the admin panel.</p>';
            } elseif ($page === 'users') {
                echo '<h2>Manage Users</h2><p>Here you can manage users.</p>';
            } elseif ($page === 'settings') {
                echo '<h2>Settings</h2><p>Here you can adjust settings.</p>';
            } elseif ($page === 'reports') {
                echo '<h2>Reports</h2><p>View system reports here.</p>';
            } else {
                echo '<h2>Page Not Found</h2><p>The page you requested does not exist.</p>';
            }
            ?>
        </div>
    </div>
</body>
</html>
