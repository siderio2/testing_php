<?php

namespace Tests;

use App\Product;
use App\ShoppingCart;
use InvalidArgumentException;
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

  #[Test]
  public function cartHasAnEmptyArrayOfProducts(): void
  {
    $this->assertIsArray(actual: $this->cart->getProducts());
    $this->assertEmpty(actual: $this->cart->getProducts());
  }

  #[Test]
  public function cartHasCorrectNumberOfProducts(): void
  {
    $this->cart->addProduct(product: new Product(name: 'Ratón ergonómico', price: 80));
    $this->cart->addProduct(product: new Product(name: 'Teclado inalámbrico', price: 105));
    $this->assertCount(expectedCount: 2, haystack: $this->cart->getProducts());
  }

  #[Test]
  public function cartHasAnAddedProduct(): void
  {
    $this->cart->addProduct(product: new Product(name: 'Ratón ergonómico', price: 80));
    $this->cart->addProduct(product: new Product(name: 'Teclado inalámbrico', price: 105));
    $screen = new Product(name: 'Pantalla 4k', price: 250);
    $this->cart->addProduct(product: $screen);
    $this->assertCount(expectedCount: 3, haystack: $this->cart->getProducts());
    $this->assertContains(needle: $screen, haystack: $this->cart->getProducts());
  }

  #[Test]
  public function cartHasNotARemovedProduct(): void
  {
    $this->cart->addProduct(product: new Product(name: 'Ratón ergonómico', price: 80));
    $this->cart->addProduct(product: new Product(name: 'Teclado inalámbrico', price: 105));
    $screen = new Product(name: 'Pantalla 4k', price: 250);
    $this->cart->addProduct(product: $screen);
    $this->assertCount(expectedCount: 3, haystack: $this->cart->getProducts());
    $this->cart->removeProduct(product: $screen);
    $this->assertCount(expectedCount: 2, haystack: $this->cart->getProducts());
    $this->assertNotContains(needle: $screen, haystack: $this->cart->getProducts());
  }

  #[Test]
  public function removeProductThatIsNotInCartThrowsException(): void
  {
    $this->cart->addProduct(product: new Product(name: 'Ratón ergonómico', price: 80));
    $this->cart->addProduct(product: new Product(name: 'Teclado inalámbrico', price: 105));
    $screen = new Product(name: 'Pantalla 4k', price: 250);
    $this->expectException(exception: InvalidArgumentException::class);
    $this->expectExceptionMessage(message: "El producto no se encuentra en el carrito");
    $this->cart->removeProduct(product: $screen);
  }

  #[Test]
  public function cartHasOnlyProducts(): void
  {
    $this->cart->addProduct(product: new Product(name: 'Ratón ergonómico', price: 80));
    $this->cart->addProduct(product: new Product(name: 'Teclado inalámbrico', price: 105));
    $screen = new Product(name: 'Pantalla 4k', price: 250);
    $this->cart->addProduct(product: $screen);
    $this->assertContainsOnlyInstancesOf(className: Product::class, haystack: $this->cart->getProducts());
  }


}

?>