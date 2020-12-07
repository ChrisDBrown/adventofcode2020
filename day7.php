<?php
declare(strict_types=1);
class Day7
{
  private $rules;

  public function __construct()
  {
    $this->rules = array_filter(explode(PHP_EOL, file_get_contents(__DIR__ . '/inputs/day7.txt')));
  }

  private function containsBag(string $bagType): array
  {
    $valid = [];
    foreach ($this->rules as $rule) {
      [$bag, $contents] = explode(' bags contain ', $rule);
      if (strpos($contents, $bagType) !== false) {
        $valid[] = $bag;
      }
    }

    return $valid;
  }

  public function partOne(): int
  {
    $validBags = $this->containsBag('shiny gold');

    do {
      $possibilities = [];
      foreach ($validBags as $bag) {
        $possibilities = array_merge($possibilities, $this->containsBag($bag));
      }

      $possibilities = array_unique($possibilities);

      $added = [];
      foreach ($possibilities as $posibility) {
        if (!in_array($posibility, $validBags)) {
          $added[] = $posibility;
        }
      }

      $validBags = array_merge($validBags, $added);
    } while (count($added));

    return count($validBags);
  }

  private function countSubBags(array $bagTree, string $bag, int $count = 0): int
  {
    // TODO: activate brain
    return 0;
  }

  public function partTwo(): int
  {
    $summary = [];
    foreach ($this->rules as $rule) {
      [$bag, $contents] = explode(' bags contain ', $rule);
      $childBags = explode(', ', str_replace('.', '', $contents));
      foreach ($childBags as $childBag) {
        $parts = explode(' ', $childBag);
        if ($parts[0] === 'no') continue;
        $summary[$bag][$parts[1] . ' ' . $parts[2]] = intval($parts[0]);
      }
    }

    return $this->countSubBags($summary, 'shiny gold');
  }
}

$day = new Day7();

echo(sprintf('Part 1: %s', $day->partOne()) . PHP_EOL);
echo(sprintf('Part 2: %s', $day->partTwo()) . PHP_EOL);
