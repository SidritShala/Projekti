<?php

include_once('DBConnection.php');

class ProductRepository
{
    private $connection;
    private $table = 'products';

    function __construct()
    {
        $conn = new DBConnection;
        $this->connection = $conn->startConn();
    }

    public function getProducts()
    {
        $query = "Select * FROM " . $this->table;
        $results = $this->connection->query($query);
        $prods = [];

        while ($row = $results->fetch_assoc()) {
            $prods[] = $row;
        }
        return $prods;
    }
    public function addProductToDatabase($name, $price, $imagePath)
{
    $query = "INSERT INTO " . $this->table . " (name, price, image) VALUES (?, ?, ?)";
    $stmt = $this->connection->prepare($query);
    $stmt->bind_param("sss", $name, $price, $imagePath);
    $stmt->execute();
    $stmt->close();
}

    public function deleteProductById($id)
    {
        $query = "SELECT image FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();

        if ($product) {
            if (file_exists($product['image'])) {
                unlink($product['image']);
            }
        }
        $stmt->close();

        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $affectedRows = $stmt->affected_rows;
        $stmt->close();

        return $affectedRows > 0;
    }
    public function updateProduct($id, $name, $price, $imagePath)
    {
        $query = "UPDATE " . $this->table . " 
                  SET name = ?, price = ?, image = ? 
                  WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("sssi", $name, $price, $imagePath, $id); // Updated to 'sssi'
        $stmt->execute();
        $affectedRows = $stmt->affected_rows;
        $stmt->close();
    
        return $affectedRows > 0;
    }
    
    public function getProductById($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();
        $stmt->close();

        return $product;
    }
}

?>