<?php

namespace App;

use InvalidArgumentException;
use Tests\Doubles\FakePaymentService;

class ShoppingCart
{

  private $products = [];
  private $paymentService;
  private $paid = false;

  public function __construct(PaymentServiceInterface $paymentService)
  {
    $this->paymentService = $paymentService;
  }

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

  public function getPriceSummary(): float
  {
    $total = 0;
    foreach ($this->products as $product) {
      $total += $product->getPrice();
    }
    return $total;
  }

  public function checkout(): void
  {
    if ($this->paymentService->processPayment(priceSummary: $this->getPriceSummary())) {
      $this->paid = true;
    }
  }

  public function isPaid(): bool
  {
    return $this->paid;
  }
}
?>