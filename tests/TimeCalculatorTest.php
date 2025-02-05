<?php

namespace Tests;

use App\TimeCalculator;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\DataProvider;

class TimeCalculatorTest extends TestCase
{

  protected $timeCalculator;

  protected function setUp(): void
  {
    $this->timeCalculator = new TimeCalculator();
  }

  protected function tearDown(): void
  {
    $this->timeCalculator = null;
  }

  public static function minutesToHoursAndMinutesProvider(): array
  {
    return [
      'zero time' => [0, 0, 0],
      '60 minutes to one hour' => [60, 1, 0],
      '30 minutes to 30 minutes' => [30, 0, 30],
      '365 minutes to 6 hours and 5 minutes' => [365, 6, 5],
    ];
  }
  #[Test]
  public function convertMinutesToHoursAndMinutesReturnsAnArray(): void
  {
    $result = $this->timeCalculator->convertMinutesToHoursAndMinutes(minutes: 100);
    $this->assertIsArray(actual: $result);
  }

  #[Test]
  #[DataProvider(methodName: 'minutesToHoursAndMinutesProvider')]
  public function convert60MinutesInOneHour($minutes, $expectedHours, $expectedMinutes): void
  {
    [$returnedHours, $returnedMinutes] = $this->timeCalculator->convertMinutesToHoursAndMinutes(minutes: $minutes);
    $this->assertEquals(expected: $expectedHours, actual: $returnedHours);
    $this->assertEquals(expected: $expectedMinutes, actual: $returnedMinutes);
  }
}
