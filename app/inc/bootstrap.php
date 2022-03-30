<?php

  define("PROJECT_ROOT_PATH", __DIR__ . "/");
  define("API_BASE_URL", "https://bpdts-test-app.herokuapp.com");

  require_once PROJECT_ROOT_PATH . "../Controller/Api/BaseController.php";
  require_once PROJECT_ROOT_PATH . "/Helpers.php";
  require_once PROJECT_ROOT_PATH . "/CurlRequest.php";
