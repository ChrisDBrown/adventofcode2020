<?php
declare(strict_types=1);

$rules = explode(PHP_EOL, file_get_contents(__DIR__ . '/inputs/day2.txt'));

function partOne(array $rules): int {
  $count = 0;
  foreach ($rules as $row) {
    if ($row === '') continue;

    [$rule, $password] = explode(': ', $row);
    [$minMax, $letter] = explode(' ', $rule);
    [$min, $max] = explode('-', $minMax);
    $min = intval($min);
    $max = intval($max);

    $times = substr_count($password, $letter);
    if ($times >= $min && $times <= $max) {
      $count++;
    }
  }

  return $count;
}

function partTwo(array $rules): int {
  $count = 0;
  foreach ($rules as $row) {
    if ($row === '') continue;

    [$rule, $password] = explode(': ', $row);
    [$numbers, $letter] = explode(' ', $rule);
    [$a, $b] = explode('-', $numbers);
    $a = intval($a);
    $b = intval($b);

    if ($password[$a -1] === $letter && $password[$b - 1] !== $letter) {
      $count++;
    }

    if ($password[$a -1] !== $letter && $password[$b - 1] === $letter) {
      $count++;
    }
  }

  return $count;
}

echo(sprintf('Part 1: %s', partOne($rules)) . PHP_EOL);
echo(sprintf('Part 2: %s', partTwo($rules)) . PHP_EOL);
