<?php
namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
class Item {
    public string $name;
    public int $quantity;
    public float $price;


    public function __construct(string $name, int $quantity, float $price) {
        $this->name = $name;
        $this->quantity = $quantity;
        $this->price = $price;
    
      
    }
}