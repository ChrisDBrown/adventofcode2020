<?php
declare(strict_types=1);

$mapRows = array_filter(explode(PHP_EOL, file_get_contents(__DIR__ . '/inputs/day3.txt')));

function treeHunt(array $mapRows, int $xIncrease, int $yIncrease): int
{
  $xPos = 0;
  $mapWidth = strlen($mapRows[0]);
  $treeCount = 0;

  for ($i = 0; $i < count($mapRows); $i = $i + $yIncrease) {
    $row = $mapRows[$i];
    if ($row[$xPos] === '#') {
      $treeCount++;
    }

    $xPos += $xIncrease;

    if ($xPos >= $mapWidth) {
      $xPos = $xPos - $mapWidth;
    }
  }

  return $treeCount;
}

function partOne(array $mapRows): int {
  return treeHunt($mapRows, 3, 1);
}

function partTwo(array $mapRows): int {
  $a = treeHunt($mapRows, 1, 1);
  $b = treeHunt($mapRows, 3, 1);
  $c = treeHunt($mapRows, 5, 1);
  $d = treeHunt($mapRows, 7, 1);
  $e = treeHunt($mapRows, 1, 2);

  return ($a * $b * $c * $d * $e);
}

echo(sprintf('Part 1: %s', partOne($mapRows)) . PHP_EOL);
echo(sprintf('Part 2: %s', partTwo($mapRows)) . PHP_EOL);
