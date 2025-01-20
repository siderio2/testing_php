<?php

namespace App;

class ReadTimeCalculator {
  private string $text;
  private int $wordsPerMinute;

  public function __construct(string $text, int $wordsPerMinute = 200)
  {
    $this->text = $text;
    $this->wordsPerMinute = $wordsPerMinute;
  }
  public function getReadTimeInMinutes(): int
  {
    $wordCount = str_word_count(string: $this->text);
    return (int) ceil(num: $wordCount / $this->wordsPerMinute);
  }

  public function getReadTimeInHours(): string
  {
    $minutes = $this->getReadTimeInMinutes();
    $hours = intdiv(num1: $minutes, num2: 60);
    $remainingMinutes = $minutes % 60;
    return sprintf('%d:%02d', $hours, $remainingMinutes);
  }
}
