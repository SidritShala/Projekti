<?php
include_once 'ProductRepository.php';
include_once 'DBProduct.php';

class ProductController
{
    private $products = [];
    private $errorMessage;
    private $succeedMessage;

    public function __construct()
    {
        $this->products = [];
        $this->errorMessage = "";
        $this->succeedMessage = "";
    }

    public function getAllProds()
    {
        $repo = new ProductRepository();
        $this->products = $repo->getProducts();
        return $this->products; // Ensure this method returns the products array
    }

    public function addProduct($name, $price, $image)
    {
        $repo = new ProductRepository();

        if (empty($name) || empty($price)) {
            $this->errorMessage = "All fields are required.";
            return;
        }

        if (!is_numeric($price) || $price <= 0) {
            $this->errorMessage = "Price must be a positive number.";
            return;
        }

        if ($image && $image['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'image/';
            $fileName = basename($image['name']);
            $uploadPath = $uploadDir . $fileName;

            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            if (move_uploaded_file($image['tmp_name'], $uploadPath)) {
                $repo->addProductToDatabase(htmlspecialchars($name), htmlspecialchars($price), htmlspecialchars($uploadPath));
                $this->succeedMessage = "Product added successfully.";
            } else {
                $this->errorMessage = "Failed to upload the image.";
            }
        } else {
            $this->errorMessage = "Invalid image file.";
        }
    }

    public function deleteProduct($id)
    {
        $repo = new ProductRepository();

        if (empty($id) || !is_numeric($id)) {
            $this->errorMessage = "Invalid product ID.";
            return;
        }

        $deleted = $repo->deleteProductById($id);

        if ($deleted) {
            $this->succeedMessage = "Product deleted successfully.";
        } else {
            $this->errorMessage = "Failed to delete the product.";
        }
    }

    public function editProduct($id, $name, $price, $newImage = null)
    {
        $repo = new ProductRepository();

        if (empty($name) || empty($price)) {
            $this->errorMessage = "All fields are required.";
            return;
        }

        if (!is_numeric($price) || $price <= 0) {
            $this->errorMessage = "Price must be a positive number.";
            return;
        }

        $existingProduct = $repo->getProductById($id);
        if (!$existingProduct) {
            $this->errorMessage = "Product not found.";
            return;
        }

        $imagePath = $existingProduct['image'];

        if ($newImage && $newImage['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'image/';
            $fileName = basename($newImage['name']);
            $uploadPath = $uploadDir . $fileName;

            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            if (move_uploaded_file($newImage['tmp_name'], $uploadPath)) {
                $imagePath = $uploadPath;
            } else {
                $this->errorMessage = "Failed to upload the new image.";
                return;
            }
        }

        $updated = $repo->updateProduct($id, htmlspecialchars($name), htmlspecialchars($price), htmlspecialchars($imagePath));

        if ($updated) {
            $this->succeedMessage = "Product updated successfully.";
        } else {
            $this->errorMessage = "Failed to update the product.";
        }
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    public function getSucceedMessage()
    {
        return $this->succeedMessage;
    }
}
?>
