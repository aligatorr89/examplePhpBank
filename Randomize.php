<?php

class Randomize {

  private static $names = array(
    "Rok",
    "Luka",
    "Nejc",
    "Benjamin",
    "Irena"
  );

  public static function dateFromTo($startDate, $endDate) {

    $min = strtotime($startDate);
    $max = strtotime($endDate);

    $val = mt_rand($min, $max);

    return date("Y-m-d", $val);
  }

  public static function name() {

    $random_name = self::$names[mt_rand(0, sizeof(self::$names) - 1)];

    return $random_name;
  }

  public static function intFromTo($min = 0, $max = 0) {

    $random_number = self::names[mt_rand($min, $max)];

    return $random_number;
  }

  public static function floatFromTo($min = 0, $max = 0, $dec = 2) {

    $random_number = mt_rand($min, $max * 100) / 100;

    return round($random_number, $dec);
  }
}
