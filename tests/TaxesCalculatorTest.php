<?php

namespace Tests;

use App\TaxesCalculator;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\DataProvider;

class TaxesCalculatorTest extends TestCase {
  protected $taxesCalculator;
  public static function valuesAndTaxesProvider(): array
  {
    return [
      'Tax 21% of 100' => [100, 21, 21],
      'Tax of zero' => [0, 10, 0],
      'Tax rounded' => [1.42, 10, 0.14],
    ];
  }

  public static function valuesPlusTaxesProvider(): array
  {
    return [
      'Tax 21% of 100' => [100, 21, 121],
      'Tax of zero' => [0, 10, 0],
      'Tax rounded' => [1.42, 10, 1.56],
    ];
  }

  protected function setUp(): void
  {
    $this->taxesCalculator = new TaxesCalculator();
  }

  protected function tearDown(): void
  {
    $this->taxesCalculator = null;
  }
  #[Test]
  #[DataProvider(methodName: 'valuesAndTaxesProvider')]
  public function calculatesCorrectIvaForGivenValue(float $value, int $tax, float $expected): void
  {
    $result = $this->taxesCalculator->getTax(value: $value, tax: $tax);
    $this->assertEquals(expected: $expected, actual: $result);
  }

  #[Test]
  #[DataProvider(methodName: 'valuesPlusTaxesProvider')]
  public function calculatesCorrectIvaPlusTaxesForGivenValue(float $value, int $tax, float $expected): void
  {
    $result = $this->taxesCalculator->getValuePlusTax(value: $value, tax: $tax);
    $this->assertEquals(expected: $expected, actual: $result);
  }

}

?>