<?php

include_once 'DBConnection.php';
include_once 'ProductEntity.php';

class DBProduct
{
    private $connection;

    function __construct()
    {
        $conn = new DBConnection;
        $this->connection = $conn;
    }

    function insertProduct($product)
    {
        $conn = $this->connection->startConn();

        $id = $product->getId();
        $name = $product->getName(); // Added line to get the name
        $image = $product->getImage();
        $price = $product->getPrice();

        $sql = "INSERT INTO products(id, name, image, price) VALUES ('$id','$name','$image','$price')";
        if (mysqli_query($conn, $sql)) {
            echo 'Product inserted successfully!';
        } else {
            echo 'This is an ERROR: ' . mysqli_error($conn);
        }
    }

    function getProducts()
    {
        $conn = $this->connection->startConn();

        $sql = "SELECT * FROM products";

        $products = [];

        if ($result = $conn->query($sql)) {
            while ($row = $result->fetch_assoc()) {
                $products[] = new ProductEntity(
                    $row['id'],
                    $row['name'], // Corrected order of parameters
                    $row['price'],
                    $row['image']
                );
            }
        } else {
            return null;
        }
        return $products;
    }

    function getProductByNameAndId($name, $product_id)
    {
        $conn = $this->connection->startConn();

        $sql = "SELECT * FROM products WHERE name = '$name' OR id = '$product_id'";

        if ($statement = $conn->query($sql)) {
            $result = $statement->fetch_assoc(); // Use fetch_assoc() to match the getProductById method
            return $result ? new ProductEntity($result['id'], $result['name'], $result['price'], $result['image']) : null;
        } else {
            return null;
        }
    }

    function getProductById($product_id)
    {
        $conn = $this->connection->startConn();

        $sql = "SELECT * FROM products WHERE id = '$product_id'";

        if ($statement = $conn->query($sql)) {
            $result = $statement->fetch_assoc(); // Use fetch_assoc() to get associative array
            return $result ? new ProductEntity($result['id'], $result['name'], $result['price'], $result['image']) : null;
        } else {
            return null;
        }
    }
}
?>
