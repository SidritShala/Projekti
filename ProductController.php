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

    // Merr të gjithë produktet
    public function getAllProducts()
    {
        $productRepository = new ProductRepository();
        return $productRepository->getAllProducts();
    }

    // Shto një produkt
    public function addProduct($name, $price, $description, $image)
    {
        $repo = new ProductRepository();

        // Verifikoni që të gjitha fushat janë të plota
        if (empty($name) || empty($price) || empty($description)) {
            $this->errorMessage = "All fields are required.";
            return;
        }

        // Verifikoni që çmimi është numër pozitiv
        if (!is_numeric($price) || $price <= 0) {
            $this->errorMessage = "Price must be a positive number.";
            return;
        }

        // Verifikoni që $image është një array dhe përmban çelësat e nevojshëm
        if (is_array($image) && isset($image['error']) && isset($image['tmp_name'])) {
            $imagePath = $this->uploadImage($image);
        } else {
            $this->errorMessage = "Invalid image file.";
            return;
        }

        if ($imagePath === false) {
            $this->errorMessage = "Invalid image file.";
            return;
        }

        // Shtoni produktin në bazën e të dhënave
        if ($repo->addProduct(htmlspecialchars($name), htmlspecialchars($price), htmlspecialchars($description), htmlspecialchars($imagePath))) {
            $this->succeedMessage = "Product added successfully.";
        } else {
            $this->errorMessage = "Failed to add product.";
        }
    }

    // Fshi një produkt
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

    // Edito një produkt
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

        // Merr rrugën ekzistuese të imazhit
        $imagePath = $existingProduct->getImage();
        
        if ($newImage && $newImage['error'] === UPLOAD_ERR_OK) {
            $newImagePath = $this->uploadImage($newImage, $imagePath);
            if ($newImagePath === false) {
                $this->errorMessage = "Failed to upload the new image.";
                return;
            }
            $imagePath = $newImagePath;
        }

        // Përditëso produktin
        if ($repo->updateProduct($id, htmlspecialchars($name), htmlspecialchars($price), htmlspecialchars($imagePath), htmlspecialchars($description))) {
            $this->succeedMessage = "Product updated successfully.";
        } else {
            $this->errorMessage = "Failed to update the product.";
        }
    }

    // Ngarko imazhin
    private function uploadImage($image, $existingImagePath = null)
    {
        if (is_array($image) && isset($image['error']) && $image['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'images/';  // Përdorimi i direktorisë së duhur
            $fileName = basename($image['name']);
            $uploadPath = $uploadDir . $fileName;

            // Sigurohuni që ekziston dosja për ngarkimet
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            if ($existingImagePath && file_exists($existingImagePath)) {
                unlink($existingImagePath);  // Fshijmë imazhin ekzistues nëse është e nevojshme
            }

            if (move_uploaded_file($image['tmp_name'], $uploadPath)) {
                return $uploadPath; // Kthe rrugën e imazhit
            } else {
                $this->errorMessage = "Failed to move the uploaded file.";
            }
        }
        return false;
    }

    // Merr produktet
    public function getProducts()
    {
        return $this->products;
    }

    // Merr mesazhin e gabimit
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    // Merr mesazhin e suksesit
    public function getSucceedMessage()
    {
        return $this->succeedMessage;
    }
}
?>
