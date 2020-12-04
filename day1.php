<?php
declare(strict_types=1);

$numbers = explode(PHP_EOL, file_get_contents(__DIR__ . '/inputs/day1.txt'));

function partOne(array $numbers): int {
  foreach ($numbers as $a) {
    $a = intval($a);
    foreach ($numbers as $b) {
      $b = intval($b);
      if ($a + $b === 2020) {
        return $a * $b;
      }
    }
  }
}

function partTwo(array $numbers): int {
  foreach ($numbers as $a) {
    $a = intval($a);
    foreach ($numbers as $b) {
      $b = intval($b);
      foreach ($numbers as $c) {
        $c = intval($c);
        if ($a + $b + $c === 2020) {
          return $a * $b * $c;
        }
      }
    }
  }
}

echo(sprintf('Part 1: %s', partOne($numbers)) . PHP_EOL);
echo(sprintf('Part 2: %s', partTwo($numbers)) . PHP_EOL);
