<?php
declare(strict_types=1);

$passes = array_filter(explode(PHP_EOL, file_get_contents(__DIR__ . '/inputs/day5.txt')));

function getRow(string $pass): int {
  $rows = range(0, 127);

  for ($i = 0; $i < 7; $i++) {
    [$front, $back] = array_chunk($rows, (int) ceil(count($rows) / 2));

    if ($pass[$i] === 'F') $rows = $front;
    if ($pass[$i] === 'B') $rows = $back;
  }

  return $rows[0];
}

function getCol(string $pass): int {
  $cols = range(0, 7);

  for ($i = 7; $i < 10; $i++) {
    [$left, $right] = array_chunk($cols, (int) ceil(count($cols) / 2));

    if ($pass[$i] === 'L') $cols = $left;
    if ($pass[$i] === 'R') $cols = $right;
  }

  return $cols[0];
}

function getPassIds(array $passes): array {
  $ids = [];
  foreach ($passes as $pass) {
    $row = getRow($pass);
    $col = getCol($pass);
    $ids[] = ($row * 8) + $col;
  }

  return $ids;
}

function partOne(array $passes): int {
  return max(getPassIds($passes));
}

function partTwo(array $passes): int {
  $ids = getPassIds($passes);
  sort($ids);
  $missing = array_diff(range(min($ids), max($ids)), $ids);

  return reset($missing);
}

echo(sprintf('Part 1: %s', partOne($passes)) . PHP_EOL);
echo(sprintf('Part 2: %s', partTwo($passes)) . PHP_EOL);
