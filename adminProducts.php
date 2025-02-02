<?php
require_once 'ProductController.php';

$controller = new ProductController();
$products = $controller->getAllProducts();

// Handle form submission for adding a product
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name']; // Get the uploaded image file name
    $imageTmp = $_FILES['image']['tmp_name']; // Get the temporary file location

    // Upload the image to the images directory
    $imagePath = 'images/' . basename($image);
    move_uploaded_file($imageTmp, $imagePath);

    // Create a new instance of ProductController and add the product
    $controller->addProduct($name, $price, $imagePath);

    // Redirect back to the admin products page after adding the product
    header('Location: adminProducts.php');
    exit;
}
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
        <h2>Illyrian PlayHouse</h2>
        <ul>
            <li><a href="admindashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="AdminUser.php"><i class="fas fa-users"></i> Users</a></li>
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

        <!-- Add Product Form -->
        <div class="add-product-container">
            <form method="POST" enctype="multipart/form-data">
                <input type="text" name="name" placeholder="Product Name" required>
                <input type="number" name="price" step="0.01" placeholder="Price" required>
                <input class="file" type="file" name="image" accept="image/*">
                <input class="submit" type="submit" name="add" value="Add Product">
            </form>
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
                <td>
                    <img src="<?php echo $product->image; ?>" alt="<?php echo $product->name; ?>" style="width: 100px; height: auto;">
                </td>
                <td><?php echo $product->description; ?></td>
                <td><?php echo $product->price; ?> &euro;</td>
                <td class="action-buttons">
                    <a href="adminProducts.php?delete=<?php echo $product->id; ?>" class="delete" onclick="return confirm('Are you sure you want to delete this product?')"><i class="fas fa-trash"></i> Delete</a>
                    <a href="editProduct.php?id=<?php echo $product->id; ?>" class="edit"><i class="fas fa-edit"></i> Edit</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
