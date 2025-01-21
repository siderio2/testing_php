<?php

namespace Tests;

use App\Product;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;

class ProductTest extends TestCase
{

  protected $product;
  protected function setUp(): void
  {
    $this->product = new Product(name: "Ordenador Macbook Pro", price: 1299);
  }

  protected function tearDown(): void
  {
    $this->product = null;
  }

  #[Test]
  public function productHasNumericPrice(): void
  {
    $this->assertIsNumeric(actual: $this->product->getPrice());
  }

  #[Test]
  public function productHasAssignedPrice(): void
  {
    $this->assertSame(expected: 1299.00, actual: $this->product->getPrice());
  }

  #[Test]
  public function productTaxesIsFloat(): void
  {
    $this->assertIsFloat(actual: $this->product->getTaxes());
  }

  #[Test]
  public function productTaxesIsCorrect(): void
  {
    $this->assertEquals(expected: 272.79, actual: ($this->product->getTaxes()));
  }

  #[Test]
  public function productPlusTaxesIsCorrect(): void
  {
    $this->assertEquals(expected: 1571.79, actual: $this->product->getPricePlusTaxes());
  }


  #[Test]
  public function productSummaryContainsItsName(): void
  {
    $this->assertStringContainsString(needle: 'Ordenador Macbook Pro', haystack: $this->product->getSummary());
  }
}

?>