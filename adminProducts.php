<?php
include_once 'ProductController.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['adminemail'])) {
    header('Location: login.php');
    exit;
}

$productController = new ProductController();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_FILES['image'];

    $productController->addProduct($name, $price, $image);
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['delete'])) {
    $productId = $_GET['delete'];

    $productController->deleteProduct($productId);
    header('Location: adminProducts.php');
    exit;
}

$products = $productController->getAllProds();
$errMessage = $productController->getErrorMessage();
$succeedMessage = $productController->getSucceedMessage();

if (!$products) {
    $products = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Products</title>
    <link rel="stylesheet" href="css/adminProducts.css">
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
        
        <div class="add-product-container">
            <form method="POST" enctype="multipart/form-data">
                <input type="text" name="name" placeholder="Product Name" required>
                <input type="number" name="price" step="0.01" placeholder="Price" required>
                <input class="file" type="file" name="image" accept="image/*">
                <input class="submit" type="submit" name="add" value="Add Product">
            </form>
        </div>

        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product['id']); ?></td>
                        <td><img src="<?php echo htmlspecialchars($product['image']); ?>" alt="Product Image"></td>
                        <td><?php echo htmlspecialchars($product['name']); ?></td>
                        <td><?php echo htmlspecialchars($product['price']); ?> &euro;</td>
                        <td class="action-buttons">
                            <a href="adminProducts.php?delete=<?php echo $product['id']; ?>" class="delete" onclick="return confirm('Are you sure you want to delete this product?')"><i class="fas fa-trash"></i> Delete</a>
                            <a href="editProduct.php?id=<?php echo $product['id']; ?>" class="edit"><i class="fas fa-edit"></i> Edit</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
