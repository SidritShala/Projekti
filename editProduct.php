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
$product = null; 

// Check if editing a product
if (isset($_GET['id'])) { 
    $product = (new ProductRepository())->getProductById($_GET['id']); 
    if (!$product) { 
        die("Product not found."); 
    } 
} 

// Handle update request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) { 
    $id = $_POST['id']; 
    $name = $_POST['name']; 
    $price = $_POST['price']; 
    $newImage = $_FILES['image']; 
    $productController->editProduct($id, $name, $price, $newImage); 
    $product = (new ProductRepository())->getProductById($id); 
    header('Location: adminProducts.php'); 
    exit; 
} 

$errMessage = $productController->getErrorMessage(); 
$succeedMessage = $productController->getSucceedMessage(); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/dashboard.css">
</head>

<body>
    <div class="sidebar">
        <h2>FitProShop</h2>
        <ul>
            <li><a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="AdminUser.php"><i class="fas fa-users"></i> Users</a></li>
            <li><a href="adminProducts.php"><i class="fas fa-box"></i> Products</a></li>
            <li><a href="adminNews.php"><i class="fas fa-chart-line"></i> News</a></li>
            <li><a href="#"><i class="fas fa-cogs"></i> Settings</a></li>
            <li><a href="#"><i class="fas fa-question-circle"></i> Support</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Edit Product</h1>
            <div class="actions">
                <i class="fas fa-bell"></i>
                <i class="fas fa-user-circle"></i>

                <a href="logout.php">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </div>


        <?php if (!empty($errMessage)): ?>
            <div class="error-message">
                <?php echo $errMessage; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($successMessage)): ?>
            <div class="success-message">
                <?php echo $successMessage; ?>
            </div>
        <?php endif; ?>

        <?php if ($product): ?>
            <div class="add-product-container">
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['id']); ?>">

                    <label for="name">Product Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>"
                        required>

                

                    <label for="price">Price:</label>
                    <input type="number" id="price" step="0.01" name="price"
                        value="<?php echo htmlspecialchars($product['price']); ?>" required>

                    <label>Current Image:</label>
                    <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="Current Image"
                        style="width: 100px; height: 100px;">

                    <label for="image">Replace Image :</label>
                    <input type="file" id="image" name="image" accept="image/*">

                    <input class="submit" type="submit" name="update" value="Update Product">
                </form>
            </div>
        <?php else: ?>
            <p>Product not found.</p>
        <?php endif; ?>
</body>

</html>