<?php

namespace Tests;

use App\Product;
use App\ShoppingCart;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Tests\Doubles\FakePaymentService;
use PHPUnit\Framework\Attributes\Test;

class ShoppingCartTest extends TestCase
{

  protected $emptyCart;
  protected $cart;

  protected function setUp(): void
  {
    $paymentService = new FakePaymentService;
    $this->emptyCart = new ShoppingCart(paymentService: $paymentService);
    $this->cart = new ShoppingCart(paymentService: $paymentService);
    $this->cart->addProduct(product: new Product(name: 'Ratón ergonómico', price: 80));
    $this->cart->addProduct(product: new Product(name: 'Teclado inalámbrico', price: 105));
  }

  #[Test]
  public function emptyCartReturnsFalseOnHasProducts(): void
  {
    $this->assertFalse(condition: $this->emptyCart->hasProducts());
  }

  #[Test]
  public function notEmptyCartReturnsTrueOnHasProducts(): void
  {
    $this->emptyCart->addProduct(product: new Product(name: 'Ratón ergonómico', price: 80));
    $this->assertTrue(condition: $this->emptyCart->hasProducts());
  }

  #[Test]
  public function cartHasAnEmptyArrayOfProducts(): void
  {
    $this->assertIsArray(actual: $this->emptyCart->getProducts());
    $this->assertEmpty(actual: $this->emptyCart->getProducts());
  }

  #[Test]
  public function cartHasCorrectNumberOfProducts(): void
  {
    $this->assertCount(expectedCount: 2, haystack: $this->cart->getProducts());
  }

  #[Test]
  public function cartHasAnAddedProduct(): void
  {
    $screen = new Product(name: 'Pantalla 4k', price: 250);
    $this->cart->addProduct(product: $screen);
    $this->assertCount(expectedCount: 3, haystack: $this->cart->getProducts());
    $this->assertContains(needle: $screen, haystack: $this->cart->getProducts());
  }

  #[Test]
  public function cartHasNotARemovedProduct(): void
  {
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
    $screen = new Product(name: 'Pantalla 4k', price: 250);
    $this->expectException(exception: InvalidArgumentException::class);
    $this->expectExceptionMessage(message: "El producto no se encuentra en el carrito");
    $this->cart->removeProduct(product: $screen);
  }

  #[Test]
  public function cartHasOnlyProducts(): void
  {
    $screen = new Product(name: 'Pantalla 4k', price: 250);
    $this->cart->addProduct(product: $screen);
    $this->assertContainsOnlyInstancesOf(className: Product::class, haystack: $this->cart->getProducts());
  }

  #[Test]
  public function checkoutMarkCartAsPaid(): void
  {
    $this->cart->checkout();
    $this->assertTrue(condition: $this->cart->isPaid());
  }

}

?>