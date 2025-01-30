<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>illyrian PlayHouse - Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="dashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="sidebar">
        <h2>illyrian PlayHouse</h2>
        <ul>
            <li><a href="DBUser.php"><i class="fas fa-users"></i> Users</a></li>
            <li><a href="DBProduct.php"><i class="fas fa-box"></i> Products</a></li>
            <li><a href="DBNews.php"><i class="fas fa-chart-line"></i> News</a></li>
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
                <h3>2000</h3>
                <p>Active Users</p>
            </div>
            <div class="card">
                <h3>650</h3>
                <p>Products</p>
            </div>
            <div class="card">
                <h3>150</h3>
                <p>Orders Today</p>
            </div>
            <div class="card">
                <h3>$45,000</h3>
                <p>Total Revenue</p>
            </div>
        </div>

        <!-- Recent Updates and Orders -->
        <div class="recent-updates">
            <h2>Recent Updates</h2>
            <ul>
                <li>Babar Received his order of USB</li>
                <li>Ali Received his order of USB</li>
                <li>Ramzan Received his order of USB</li>
            </ul>
        </div>

        <div class="recent-orders">
            <h2>Recent Orders</h2>
            <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Product Number</th>
                        <th>Payments</th>
                        <th>Status</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Mini USB</td>
                        <td>4583</td>
                        <td>Due</td>
                        <td>Pending</td>
                        <td><a href="#">Details</a></td>
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>

        <!-- Sales Analytics -->
        <div class="sales-analytics">
            <h2>Sales Analytics</h2>
            <p>Online Orders</p>
            <p>Last seen 2 Hours</p>
            <p>-17%</p>
            <p>3849</p>
        </div>
    </div>
</body>

</html>