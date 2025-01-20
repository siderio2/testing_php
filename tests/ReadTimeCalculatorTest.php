<?php

namespace Tests;

use App\ReadTimeCalculator;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class ReadTimeCalculatorTest extends TestCase {

  public static function provideTextAndExpectedMinutes(): array
  {
    return [
      'Testing minutes 1' => ['hola', 200, 1],
      'Testing minutes 2' => [str_repeat(string: 'hola ', times: 220), 200, 2],
      'Testing minutes 3' => [str_repeat(string: 'hola ', times: 1420), 200, 8],
      'Testing minutes 4' => [str_repeat(string: 'hola ', times: 220), 100, 3],
      'Testing minutes 5' => [str_repeat(string: 'hola ', times: 1420), 100, 15],
    ];
  }

  public static function provideTextAndExpectedHours(): array
  {
    return [
      'Testing hours 1' => ['hola', 200, '0:01'],
      'Testing hours 2' => [str_repeat(string: 'hola ', times: 12001), 200, '1:01'],
      'Testing hours 3' => [str_repeat(string: 'hola ', times: 24220), 200, '2:02'],
      'Testing hours 4' => [str_repeat(string: 'hola ', times: 12001), 100, '2:01'],
      'Testing hours 5' => [str_repeat(string: 'hola ', times: 24220), 100, '4:03'],
    ];
  }

  #[DataProvider('provideTextAndExpectedMinutes')]
  public function testReadTimeInMinutes(string $text, int $wordsPerMinute, int $expectedMinutes): void
  {
    $readTimeCalculator = new ReadTimeCalculator(text: $text, wordsPerMinute: $wordsPerMinute);
    $minutes = $readTimeCalculator->getReadTimeInMinutes();
    $this->assertEquals(expected: $expectedMinutes, actual: $minutes);
  }

  #[DataProvider('provideTextAndExpectedHours')]
  public function testReadTimeInHours(string $text, int $wordsPerMinute, string $expectedHours): void
  {
    $readTimeCalculator = new ReadTimeCalculator(text: $text, wordsPerMinute: $wordsPerMinute);
    $hours = $readTimeCalculator->getReadTimeInHours();
    $this->assertEquals(expected: $expectedHours, actual: $hours);
  }

}
