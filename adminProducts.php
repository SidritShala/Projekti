<?php
require_once 'ProductController.php';

$controller = new ProductController();
$products = $controller->getAllProducts();

// Handle form submission for adding a product
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description']; // Get the product description
    $image = $_FILES['image']; // Get the uploaded image file

    // Verifikimi i të dhënave për sigurinë
    if (empty($name) || empty($price) || empty($description) || empty($image['name'])) {
        echo "All fields are required.";
    } elseif (!is_numeric($price) || $price <= 0) {
        echo "Price must be a positive number.";
    } else {
        // Define the path to store the image
        $imagePath = 'images/' . basename($image['name']);

        // Kontrollo nëse imazhi ngarkohet me sukses
        if (move_uploaded_file($image['tmp_name'], $imagePath)) {
            // Shto produktin duke përdorur controllerin
            $controller->addProduct($name, $price, $description, $imagePath);
            
            // Përsëri merr listën e produkteve
            $products = $controller->getAllProducts();
            
            // Ridrejto pas shtimit të produktit
            header('Location: adminProducts.php');
            exit;
        } else {
            echo "Error uploading image.";
        }
    }
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
                <label for="name">Product Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="description">Description:</label>
                <textarea id="description" name="description" required></textarea>

                <label for="price">Price:</label>
                <input type="number" id="price" step="0.01" name="price" required>

                <label for="image">Image:</label>
                <input type="file" id="image" name="image" accept="image/*" required>

                <input class="submit" type="submit" name="add_product" value="Add Product">
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
                <th>Actions</th>
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
