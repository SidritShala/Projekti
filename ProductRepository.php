<?php
require_once 'DbProduct.php';
require_once 'ProductEntity.php';

class ProductRepository {
    private $db;

    public function __construct() {
        $this->db = (new DbProduct())->getConnection();
    }

    public function getAllProducts() {
        $products = [];
        $query = "SELECT * FROM products";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $products[] = new ProductEntity($row['ID'], $row['Name'], $row['Image'], $row['Description'], $row['Price']);
        }

        return $products;
    }
}
?>