<?php

namespace Tests;

use App\Product;
use App\ShoppingCart;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;

class ShoppingCartTest extends TestCase
{
  protected $cart;

  protected function setUp(): void
  {
    $this->cart = new ShoppingCart();
  }

  #[Test]
  public function emptyCartReturnsFalseOnHasProducts(): void
  {
    $this->assertFalse(condition: $this->cart->hasProducts());
  }

  #[Test]
  public function notEmptyCartReturnsTrueOnHasProducts(): void
  {
    $this->cart->addProduct(product: new Product(name: 'Ratón ergonómico', price: 80));
    $this->assertTrue(condition: $this->cart->hasProducts());
    ;
  }
}

?>