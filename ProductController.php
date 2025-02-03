<?php
include_once 'ProductRepository.php';
include_once 'DBProduct.php';

class ProductController
{
    private $products;
    private $errorMessage;
    private $succeedMessage;

    public function __construct()
    {
        $this->products = [];
        $this->errorMessage = "";
        $this->succeedMessage = "";
    }

    public function getAllProducts()
    {
        $productRepository = new ProductRepository();
        return $productRepository->getAllProducts();
    }

    public function addProduct($name, $price, $description, $image)
    {
        $repo = new ProductRepository();

        if (empty($name) || empty($price) || empty($description)) {
            $this->errorMessage = "All fields are required.";
            return;
        }

        if (!is_numeric($price) || $price <= 0) {
            $this->errorMessage = "Price must be a positive number.";
            return;
        }

        $imagePath = $this->uploadImage($image);
        if ($imagePath === false) {
            $this->errorMessage = "Invalid image file.";
            return;
        }

        $repo->addProductToDatabase(htmlspecialchars($name), htmlspecialchars($price), htmlspecialchars($description), htmlspecialchars($imagePath));
        $this->succeedMessage = "Product added successfully.";
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

    public function editProduct($id, $name, $price, $description, $newImage = null)
    {
        $repo = new ProductRepository();

        if (empty($name) || empty($price) || empty($description)) {
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

        $imagePath = $existingProduct->getImage();
        
        if ($newImage && $newImage['error'] === UPLOAD_ERR_OK) {
            $newImagePath = $this->uploadImage($newImage, $imagePath);
            if ($newImagePath === false) {
                $this->errorMessage = "Failed to upload the new image.";
                return;
            }
            $imagePath = $newImagePath;
        }

        $updated = $repo->updateProduct($id, htmlspecialchars($name), htmlspecialchars($price), htmlspecialchars($description), htmlspecialchars($imagePath));

        if ($updated) {
            $this->succeedMessage = "Product updated successfully.";
        } else {
            $this->errorMessage = "Failed to update the product.";
        }
    }

    private function uploadImage($image, $existingImagePath = null)
    {
        if ($image && $image['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'image/';
            $fileName = basename($image['name']);
            $uploadPath = $uploadDir . $fileName;

            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            if ($existingImagePath && file_exists($existingImagePath)) {
                unlink($existingImagePath);
            }

            if (move_uploaded_file($image['tmp_name'], $uploadPath)) {
                return $uploadPath;
            }
        }
        return false;
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
