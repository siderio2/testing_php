<?php

namespace Tests\Doubles;

use App\PaymentServiceInterface;

class FakePaymentService implements PaymentServiceInterface
{
  public function processPayment(float $priceSummary): bool
  {
    return true;
  }
}