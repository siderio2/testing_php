<?php

namespace App;

interface PaymentServiceInterface
{
  public function processPayment(float $priceSummary): bool;
}