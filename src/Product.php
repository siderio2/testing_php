<?php

namespace App;

class Product {

  private $tax = 21;
  public function __construct(private string $name, private int $price)
  {
    $this->price = (float) $price;
  }
  public function getPrice(): float
  {
    return $this->price;
  }

  public function getTaxes(): float
  {
    $taxesCalculator = new TaxesCalculator();
    return $taxesCalculator->getTax($this->price, $this->tax);
  }

  public function getPricePlusTaxes(): float
  {
    $taxesCalculator = new TaxesCalculator();
    return $taxesCalculator->getValuePlusTax($this->price, $this->tax);
  }

  public function getSummary(): string
  {
    return "{$this->name} costs {$this->price} and the taxes are {$this->getTaxes()}";
  }
}
?>