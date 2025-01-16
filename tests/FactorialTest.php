<?php

namespace Tests;

use App\Factorial;
use PHPUnit\Framework\TestCase;

class FactorialTest extends TestCase
{
  public function testFactorialOne()
  {
    $factorial = new Factorial();
    $this->assertEquals(1, $factorial->calculate(1));
  }

  public function testFactorialTwo()
  {
    $factorial = new Factorial();
    $this->assertEquals(2, $factorial->calculate(2));
  }

  public function testFactorialZero()
  {
    $factorial = new Factorial();
    $this->assertEquals(1, $factorial->calculate(0));
  }

  public function testFactorialNegativeNumber()
  {
    $factorial = new Factorial();
    $this->assertEquals(-1, $factorial->calculate(-5));
  }

  public function testFactorialOfTen()
  {
    $factorial = new Factorial();
    $this->assertEquals(3628800, $factorial->calculate(10));
  }
}
