<?php
class ProductEntity {
    public  int $id;
    public  string $name;
    public  string $image;
    public string $description;
    public float $price;

    public function __construct(int $id, string $name, string $image, string $description, float $price) {
        $this->id = $id;
        $this->name = $name;
        $this->image = $image;
        $this->description = $description;
        $this->price = $price;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getImage(): string {
        return $this->image;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getPrice(): float {
        return $this->price;
    }

    // Setters
    public function setName(string $name): void {
        $this->name = $name;
    }

    public function setImage(string $image): void {
        $this->image = $image;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function setPrice(float $price): void {
        $this->price = $price;
    }
}
?>
