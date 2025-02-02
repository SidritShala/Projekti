<?php
require_once 'ProductRepository.php';

class ProductController {
    private $repository;

    public function __construct() {
        $this->repository = new ProductRepository();
    }

    public function getAllProducts() {
        return $this->repository->getAllProducts();
    }
}
?>