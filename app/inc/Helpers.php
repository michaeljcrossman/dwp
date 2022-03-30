<?php declare(strict_types=1);

namespace Helpers;

class Helpers {

  /**
  * Filter an array of People based on the distance of their long-lat
  * from another long-lat
  *
  * @param array $people
  * @param float longitude
  * @param float latitude
  * @param int distance
  *
  * @return array
  */
  public function filterArrayByDistance(array $people, float $latitude, float $longitude, int $distance): array {
    return array_filter($people, function($person) use($latitude, $longitude, $distance) { return $this->getDistanceBetweenPoints(floatval($person["latitude"]), floatval($person["longitude"]), $latitude, $longitude) <= $distance;});
  }

  /**
  * Get long-lat coordinates distance from other lon-lat coordinates
  * based on https://martech.zone/calculate-great-circle-distance/
  *
  * @param double $lattitude
  * @param double $longitude
  *
  * @return float
  */
  public function getDistanceBetweenPoints(float $latitude1, float $longitude1, float $latitude2, float $longitude2): float {
    $theta = $longitude1 - $longitude2;
    $distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
    $distance = acos($distance);
    $distance = rad2deg($distance);
    $distance = $distance * 60 * 1.1515;
    return (round($distance));
  }
}
