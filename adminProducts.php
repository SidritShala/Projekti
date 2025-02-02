<?php
require_once 'ProductController.php';

$controller = new ProductController();
$products = $controller->getAllProducts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Products</title>
    <link rel="stylesheet" href="adminProducts.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="sidebar">
        <h2>Furnitia</h2>
        <ul>
            <li><a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="AdminUser.php"><i class="fas fa-users"></i> Users</a></li>
            <li><a href="adminBlogs.php"><i class="fa-solid fa-blog"></i> Blogs</a></li>
            <li><a href="#"><i class="fas fa-cogs"></i> Settings</a></li>
            <li><a href="#"><i class="fas fa-question-circle"></i> Support</a></li>
        </ul>
    </div>

    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <h1>Products</h1>
            <div class="actions">
                <i class="fas fa-bell"></i>
                <i class="fas fa-user-circle"></i>

                <a href="logout.php">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </div>

        <!-- Product Table -->
        <h1>Product List</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>Description</th>
                <th>Price</th>
            </tr>
            <?php foreach ($products as $product): ?>
            <tr>
                <td><?php echo $product->id; ?></td>
                <td><?php echo $product->name; ?></td>
                <td><img src="<?php echo $product->image; ?>" alt="<?php echo $product->name; ?>"></td>
                <td><?php echo $product->description; ?></td>
                <td><?php echo $product->price; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
