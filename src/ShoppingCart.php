<?php

namespace App;

use InvalidArgumentException;

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

  public function removeProduct(Product $product): void
  {
    $index = array_search(needle: $product, haystack: $this->products, strict: true);
    if ($index === false) {
      throw new InvalidArgumentException(message: "El producto no se encuentra en el carrito");
    }
    unset($this->products[$index]);
  }

  public function getProducts(): array
  {
    return $this->products;
  }
}
?>