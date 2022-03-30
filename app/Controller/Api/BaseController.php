<?php declare(strict_types=1);

  namespace App;

  class BaseController {

    /**
    * Create a CurlRequest object
    *
    * @param string  $url
    *
    * @return CurlRequest
    */
    protected function buildCurlRequest($url): CurlRequest {
        return new CurlRequest($url);
    }

    /**
    * Call the API to get the people data
    *
    * @param string  $url
    *
    * @return array
    */
    public function apiCall($curlRequest): array {
      $curlRequest->setOption(CURLOPT_RETURNTRANSFER, true);
      $curlRequest->setOption(CURLOPT_FAILONERROR, true);
      $curlRequest->setOption(CURLOPT_HTTPHEADER, ['Content-Type: application/json',]);

      $response = $curlRequest->execute();
      $httpcode = $curlRequest->getInfo(CURLINFO_HTTP_CODE);

      if ($curlRequest->getErrorNo()) {
          $error_msg = $curlRequest->getError();
      }

      $curlRequest->close();

      if (isset($error_msg)) {
        return [
          "error" => true,
          "body" => json_encode(array($error_msg)),
          "headers" => array('Content-Type: application/json', 'HTTP/1.1 ' . $httpcode . '')
        ];
      }

      return [
        "error" => false,
        "body" => json_decode($response, true),
        "headers" => array('Content-Type: application/json', 'HTTP/1.1 200')
      ];
    }

    /**
    * Post the API output.
    *
    * @param mixed  $data
    * @param string $httpHeader
    */
    public function sendJSON($data, $httpHeaders=array()): void {
        header_remove('Set-Cookie');

        if (is_array($httpHeaders) && count($httpHeaders)) {
            foreach ($httpHeaders as $httpHeader) {
                header($httpHeader);
            }
        }

        echo $data;
        exit;
    }
  }
