<?php
include_once 'ProductController.php'; 
include_once 'ProductRepository.php';

if (session_status() === PHP_SESSION_NONE) { 
    session_start(); 
} 

$productController = new ProductController(); 
$productRepository = new ProductRepository(); 
$product = null; 

// Kontrollo ID-në dhe merr produktin
if (isset($_GET['id'])) { 
    $product = $productRepository->getProductById($_GET['id']); 
    if (!$product) { 
        die("Product not found."); 
    } 
} else {
    die("Invalid Product ID.");
}

// Përditëso produktin
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) { 
    $id = $_POST['id']; 
    $name = $_POST['name']; 
    $price = $_POST['price']; 
    $description = $_POST['description']; 
    $newImage = $_FILES['image']; 
    $productController->editProduct($id, $name, $price, $description, $newImage); 

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
</head>

<body>
    <h1>Edit Product</h1>

    <?php if (!empty($errMessage)): ?>
        <p style="color: red;"><?php echo $errMessage; ?></p>
    <?php endif; ?>

    <?php if (!empty($succeedMessage)): ?>
        <p style="color: green;"><?php echo $succeedMessage; ?></p>
    <?php endif; ?>

    <?php if ($product): ?>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($product->getId()); ?>">

            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product->getName()); ?>" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required><?php echo htmlspecialchars($product->getDescription()); ?></textarea>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" value="<?php echo htmlspecialchars($product->getPrice()); ?>" required>

            <label>Current Image:</label>
            <img src="<?php echo htmlspecialchars($product->getImage()); ?>" alt="Product Image" style="width: 100px; height: 100px;">

            <label for="image">Replace Image:</label>
            <input type="file" id="image" name="image" accept="image/*">

            <input type="submit" name="update" value="Update Product">
        </form>
    <?php else: ?>
        <p>Product not found.</p>
    <?php endif; ?>
</body>

</html>
