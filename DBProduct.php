<?php
// Përfshini klasën e lidhjes dhe DBProduct
include_once 'DbConnection.php';
include_once 'DBProduct.php';

$dbProduct = new DBProduct(); // Krijoni një instancë të klasës DBProduct
$products = $dbProduct->getAllProducts(); // Thirrni funksionin për të marrë të dhënat nga tabela
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div class="product-list">
        <h2>Product List</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Kontrolloni nëse janë marrë produkte
                if ($products) {
                    // Kaloni përmes produkteve dhe shfaqni të dhënat në tabelë
                    foreach ($products as $product) {
                        echo "<tr>
                                <td>{$product->getId()}</td>
                                <td>{$product->getName()}</td>
                                <td>{$product->getDescription()}</td>
                                <td><img src='{$product->getImage()}' alt='{$product->getName()}' width='50'></td>
                                <td>\${$product->getPrice()}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No products found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
