<?php
require_once 'DbProduct.php';
require_once 'ProductEntity.php';

class ProductRepository {
    private $db;

    public function __construct() {
        $this->db = (new DbProduct())->getConnection();
    }

    // Merr të gjithë produktet
    public function getAllProducts() {
        $query = "SELECT * FROM products";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        
        $products = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $products[] = new ProductEntity(
                (int) $row['ID'], 
                htmlspecialchars($row['Name']), 
                htmlspecialchars($row['Image']), 
                htmlspecialchars($row['Description']), 
                (float) $row['Price']
            );
        }
        return $products;
    }

    // Merr produktin nga ID
    public function getProductById($id) {
        $query = "SELECT * FROM products WHERE ID = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new ProductEntity(
                (int) $row['ID'], 
                htmlspecialchars($row['Name']), 
                htmlspecialchars($row['Image']), 
                htmlspecialchars($row['Description']), 
                (float) $row['Price']
            );
        }
        return null; // Nëse nuk gjendet produkti
    }

    // Përditëso produktin
    public function updateProduct($id, $name, $price, $imagePath, $description) {
        $query = "UPDATE products SET Name = :name, Price = :price, Image = :image, Description = :description WHERE ID = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_STR);
        $stmt->bindParam(':image', $imagePath, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        $stmt->execute(); // Ekzekutoj pyetjen

        // Verifikoni se produkti është përditësuar
        if ($stmt->rowCount() > 0) {
            return true;  // Produkti është përditësuar
        }
        return false; // Nuk ka ndodhur asnjë ndryshim
    }

    // Shto një produkt të ri
    public function addProduct($name, $price, $imagePath, $description) {
        $query = "INSERT INTO products (Name, Price, Image, Description) VALUES (:name, :price, :image, :description)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_STR);
        $stmt->bindParam(':image', $imagePath, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);

        // Ekzekutoj pyetjen dhe kthej true/false në varësi të suksesit
        if ($stmt->execute()) {
            return true;  // Produkti është shtuar
        }
        return false;  // Dështoi të shtohet produkti
    }

    // Fshi produktin nga ID
    public function deleteProductById($id) {
        $query = "DELETE FROM products WHERE ID = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            return true;  // Produkti është fshirë
        }
        return false; // Dështoi të fshihet produkti
    }
}
?>
