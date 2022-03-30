<?php declare(strict_types=1);

namespace App;

class PeopleController extends BaseController {

  /**
  * Call the bpdts api to retrieve an array of People
  * @param string $url
  *
  * @return array
  */
  public function getPeople(string $url) {
    $curlRequest = $this->buildCurlRequest($url);
    $response = $this->apiCall($curlRequest);

    if($response["error"]) {
      $this->sendJSON($response["body"], $response["headers"]);
    } else {
      return $response["body"];
    }
  }
}
