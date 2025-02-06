<?php

namespace App;

class RealPaymentService implements PaymentServiceInterface
{
  public function processPayment(float $priceSummary): bool
  {
    echo "Conectando con la pasarela de pagos... pagando $priceSummary euros";
    return true;
  }
}