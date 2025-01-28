<?php

namespace Tests;

use App\Factorial;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class FactorialTest extends TestCase
{
  protected $factorial;

  protected function setUp(): void
  {
    $this->factorial = new Factorial();
  }

  protected function tearDown(): void
  {
    $this->factorial = null;
  }

  public function testFactorialOne(): void
  {
    $this->assertEquals(expected: 1, actual: $this->factorial->calculate(input: 1));
  }

  public function testFactorialTwo(): void
  {
    $this->assertEquals(expected: 2, actual: $this->factorial->calculate(input: 2));
  }

  public function testFactorialZero(): void
  {
    $this->assertEquals(expected: 1, actual: $this->factorial->calculate(input: 0));
  }

  public function testFactorialNegativeNumberThrowsException(): void
  {
    $this->expectException(exception: InvalidArgumentException::class);
    $this->factorial->calculate(input: -5);
  }

  public function testFactorialOfTen(): void
  {
    $this->assertEquals(expected: 3628800, actual: $this->factorial->calculate(input: 10));
  }


}
