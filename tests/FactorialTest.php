<?php

namespace Tests;

use App\Factorial;
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

  public function testFactorialOne()
  {
    $this->assertEquals(1, $this->factorial->calculate(1));
  }

  public function testFactorialTwo()
  {
    $this->assertEquals(2, $this->factorial->calculate(2));
  }

  public function testFactorialZero()
  {
    $this->assertEquals(1, $this->factorial->calculate(0));
  }

  public function testFactorialNegativeNumber()
  {
    $this->assertEquals(-1, $this->factorial->calculate(-5));
  }

  public function testFactorialOfTen()
  {
    $this->assertEquals(3628800, $this->factorial->calculate(10));
  }
}
