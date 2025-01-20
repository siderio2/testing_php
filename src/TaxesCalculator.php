<?php

namespace App;

class TaxesCalculator {
  public function getTax(float $value, int $tax): float
  {
    return round(num: ($value * $tax) / 100, precision: 2);
  }

  public function getValuePlusTax(float $value, int $tax): float
  {
    return $value + $this->getTax(value: $value, tax: $tax);
  }
}
?>