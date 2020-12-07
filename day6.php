<?php
declare(strict_types=1);

$groups = explode(PHP_EOL.PHP_EOL, file_get_contents(__DIR__ . '/inputs/day6.txt'));

function partOne(array $groups): int {
  $count = 0;

  foreach ($groups as $group) {
    $answers = implode('', explode(PHP_EOL, $group));
    $count += count(array_unique(str_split($answers)));
  }

  return $count;
}

function partTwo(array $groups): int {
  $count = 0;

  foreach ($groups as $group) {
    $members = count(array_filter(explode(PHP_EOL, $group)));
    $answers = implode('', explode(PHP_EOL, $group));
    foreach (range('a', 'z') as $letter) {
      if (substr_count($answers, $letter) === $members) $count++;
    }
  }

  return $count;
}

echo(sprintf('Part 1: %s', partOne($groups)) . PHP_EOL);
echo(sprintf('Part 2: %s', partTwo($groups)) . PHP_EOL);
