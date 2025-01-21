<?php

namespace App;

use PHPUnit\Framework\Constraint\IsEmpty;

class ShoppingCart
{

  private $products = [];
  public function hasProducts(): bool
  {
    return count(value: $this->products) > 0;
  }

  public function addProduct(Product $product): void
  {
    $this->products[] = $product;
  }
}
?>