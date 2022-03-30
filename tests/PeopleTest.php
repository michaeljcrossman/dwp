<?php

class PeopleTest extends \PHPUnit\Framework\TestCase {

  public function testFiledApiCall() {

    $http = $this->getMockBuilder('HttpRequest')
                  ->setMethods(array('getErrorNo', 'getError', 'setOption', 'execute', 'getInfo', 'close'))
                  ->getMock();

    $http->expects($this->any())
             ->method('getErrorNo')
             ->will($this->returnValue(22));

    $http->expects($this->any())
             ->method('getError')
             ->will($this->returnValue("The requested URL returned error: 404 NOT FOUND"));

    $http->expects($this->any())
             ->method('getInfo')
             ->will($this->returnValue(404));

    $baseController = new App\BaseController;

    $expectedResponse = [
      "error" => true,
      "body" => json_encode(["The requested URL returned error: 404 NOT FOUND"]),
      "headers" => array('Content-Type: application/json', 'HTTP/1.1 404')
    ];

    $response = $baseController->apiCall($http);
    $this->assertEquals($expectedResponse, $response);
  }

  public function testApiCall() {

    $responseData = json_encode('[
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
      ]
    ]');

    $http = $this->getMockBuilder('HttpRequest')
                  ->setMethods(array('getErrorNo', 'getError', 'setOption', 'execute', 'getInfo', 'close'))
                  ->getMock();

    $http->expects($this->any())
             ->method('getInfo')
             ->will($this->returnValue(200));

    $http->expects($this->any())
            ->method('execute')
            ->will($this->returnValue($responseData));

    $baseController = new App\BaseController;

    $expectedResponse = [
      "error" => false,
      "body" => json_decode($responseData),
      "headers" => array('Content-Type: application/json', 'HTTP/1.1 200')
    ];

    $response = $baseController->apiCall($http);
    $this->assertEquals($expectedResponse, $response);
  }
}
