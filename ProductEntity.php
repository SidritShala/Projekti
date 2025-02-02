<?php
class ProductEntity {
    public $id;
    public $name;
    public $image;
    public $description;
    public $price;

    public function __construct($id, $name, $image, $description, $price) {
        $this->id = $id;
        $this->name = $name;
        $this->image = $image;
        $this->description = $description;
        $this->price = $price;
    }
}
?>