
<?php

include_once 'DbConnection.php';
include_once 'AllProductEntity.php';

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
        $description = $product->getDescription();
        $image = $product->getImage();
        $category_id = $product->getCategory_id();
        $price = $product->getPrice();

        $sql = "INSERT INTO products(id,description,image,category_id,price) VALUES
        ('$id','$description','$image','$category_id','$price')";
        if (mysqli_query($conn, $sql)) {

        } else {
            echo 'This is an ERROR' . mysqli_error($conn);
        }
    }
    // CHANGE
    function getAllProducts()
    {
        $conn = $this->connection->startConn();

        $sql = "SELECT * FROM products";

        $products = [];


        if ($result = $conn->query($sql)) {
            while ($row = $result->fetch_assoc()) {
                $products[] = new ProductEntity(
                    $row['id'],
                    $row['name'],
                    $row['description'],
                    $row['image'],
                    $row['category_id'],
                    $row['price']
                );
            }
        } else {
            return null;
        }
        return $products;
    }
    //   
    function getProductByCategoryAndName($category_id, $name)
    {
        $conn = $this->connection->startConn();

        $sql = "SELECT * FROM products WHERE category_id = '$category_id' and name = '$name'";

        if ($statement = $conn->query($sql)) {
            $result = $statement->fetch_row();
            return $result;
        } else {
            return null;
        }
    }

    function getProductByCategoryAndId($category_id, $product_id)
    {
        $conn = $this->connection->startConn();

        $sql = "SELECT * FROM products WHERE category_id = '$category_id' or id ='$product_id'";

        if ($statement = $conn->query($sql)) {
            $result = $statement->fetch_row();
            return $result;
        } else {
            return null;
        }
    }
    function getProductById($product_id)
    {

        $conn = $this->connection->startConn();

        $sql = "SELECT * FROM products WHERE id = '$product_id'";

        if ($statement = $conn->query($sql)) {
            $result = $statement->fetch_row();
            return $result;
        } else {
            return null;
        }
    }
}

?>   