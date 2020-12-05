<?php
declare(strict_types=1);

$passportStrings = explode(PHP_EOL.PHP_EOL, file_get_contents(__DIR__ . '/inputs/day4.txt'));

$passports = [];
foreach ($passportStrings as $passportString) {
  $passportString = str_replace(PHP_EOL, ' ', $passportString);
  $parts = array_filter(explode(' ', $passportString));
  $passport = [];
  foreach ($parts as $part) {
    [$key, $value] = explode(':', $part);
    $passport[$key] = $value;
  }

  $passports[] = $passport;
}

function partOne(array $passports): int {
  $requiredKeys = ['byr', 'iyr', 'eyr', 'hgt', 'hcl', 'ecl', 'pid'];

  $count = 0;
  foreach ($passports as $passport) {
    $valid = true;
    foreach ($requiredKeys as $requiredKey) {
      if (!array_key_exists($requiredKey, $passport)) $valid = false;
    }

    if ($valid) $count++;
  }

  return $count;
}

function validateByr(string $value): bool {
  $value = intval($value);
  return $value >= 1920 && $value <= 2002;
}

function validateIyr(string $value): bool {
  $value = intval($value);
  return $value >= 2010 && $value <= 2020;
}

function validateEyr(string $value): bool {
  $value = intval($value);
  return $value >= 2020 && $value <= 2030;
}

function validateHgt(string $value): bool {
  $unit = substr($value, -2, 2);

  if ($unit === 'cm') {
    $value = intval(substr($value, 0, strlen($value) - 2));
    return $value >= 150 && $value <= 193;
  }

  if ($unit === 'in') {
    $value = intval(substr($value, 0, strlen($value) - 2));
    return $value >= 59 && $value <= 76;
  }

  return false;
}

function validateHcl(string $value): bool {
  $pattern = '/^#([a-fA-F0-9]{6})$/';
  return (bool) preg_match($pattern, $value);
}

function validateEcl(string $value): bool {
  return in_array($value, ['amb', 'blu', 'brn', 'gry', 'grn', 'hzl', 'oth']);
}

function validatePid(string $value): bool {
  var_dump($value);
  $pattern = '/^([0-9]{9})$/';
  return (bool) preg_match($pattern, $value);
}

function validatePassport(array $passport): bool {
  $requiredKeys = ['byr', 'iyr', 'eyr', 'hgt', 'hcl', 'ecl', 'pid'];

  foreach ($requiredKeys as $requiredKey) {
    if (!array_key_exists($requiredKey, $passport)) return false;
  }

  if (!validateByr($passport['byr'])) return false;
  if (!validateIyr($passport['iyr'])) return false;
  if (!validateEyr($passport['eyr'])) return false;
  if (!validateHgt($passport['hgt'])) return false;
  if (!validateHcl($passport['hcl'])) return false;
  if (!validateEcl($passport['ecl'])) return false;
  if (!validatePid($passport['pid'])) return false;

  return true;
}

function partTwo(array $passports): int {
  $count = 0;

  foreach ($passports as $passport) {
    if (!validatePassport($passport)) continue;

    $count++;
  }

  return $count;
}

echo(sprintf('Part 1: %s', partOne($passports)) . PHP_EOL);
echo(sprintf('Part 2: %s', partTwo($passports)) . PHP_EOL);
