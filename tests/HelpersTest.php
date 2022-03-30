<?php

class HelpersTest extends \PHPUnit\Framework\TestCase {

  public function testFilterArrayByDistance() {
    $people = [
      [
        "id" => 135,
        "first_name" => "Mechelle",
        "last_name" => "Boam",
        "email" => "mboam3q@thetimes.co.uk",
        "ip_address" => "113.71.242.187",
        "latitude" => 51.5072,
        "longitude" => 0.1276
      ],
      [
        "id" => 396,
        "first_name" => "Terry",
        "last_name" => "Stowgill",
        "email" => "tstowgillaz@webeden.co.uk",
        "ip_address" => "143.190.50.240",
        "latitude" => 55.0108,
        "longitude" => 1.4491
      ],
      [
        "id" => 520,
        "first_name" => "Andrew",
        "last_name" => "Seabrocke",
        "email" => "aseabrockeef@indiegogo.com",
        "ip_address" => "28.146.197.176",
        "latitude" => 27.69417,
        "longitude" => 109.73583
      ],
      [
        "id" => 658,
        "first_name" => "Stephen",
        "last_name" => "Mapstone",
        "email" => "smapstonei9@bandcamp.com",
        "ip_address" => "187.79.141.124",
        "latitude" => -8.1844859,
        "longitude" => 113.6680747
      ],
      [
        "id" => 688,
        "first_name" => "Tiffi",
        "last_name" => "Colbertson",
        "email" => "tcolbertsonj3@vimeo.com",
        "ip_address" => "141.49.93.0",
        "latitude" => 37.13,
        "longitude" => -84.08
      ],
      [
        "id" => 794,
        "first_name" => "Katee",
        "last_name" => "Gopsall",
        "email" => "kgopsallm1@cam.ac.uk",
        "ip_address" => "203.138.133.164",
        "latitude" => 5.7204203,
        "longitude" => 10.901604
      ]
    ];
    $latitude = 51.5072;
    $longitude = 0.1276;
    $distance = 50;
    $distance2 = 250;
    $helpers = new Helpers\Helpers;

    $filteredPeople = $helpers->filterArrayByDistance($people, $latitude, $longitude, $distance);
    $this->assertEquals(1, count($filteredPeople));

    $filteredPeople2 = $helpers->filterArrayByDistance($people, $latitude, $longitude, $distance2);
    $this->assertEquals(2, count($filteredPeople2));
  }

  public function testGetDistanceBetweenPoints() {
    $helpers = new Helpers\Helpers;
    $latitude1 = 55.0108;
    $longitude1 = 1.4491;
    $latitude2 = 51.5072;
    $longitude2 = 0.1276;

    $distance = $helpers->getDistanceBetweenPoints($latitude1, $longitude1, $latitude2, $longitude2);
    $this->assertEquals(248, $distance);
  }
}
