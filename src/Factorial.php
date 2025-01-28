<?php

namespace App;

use InvalidArgumentException;

class Factorial
{
  public function calculate(int $input): int
  {
    if ($input < 0) {
      throw new InvalidArgumentException(message: "Factorial is not defined for negative numbers.");
    }
    if ($input <= 1) {
      return 1;
    }
    return $input * $this->calculate(input: $input - 1);
  }
}
