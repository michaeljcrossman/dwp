<?php

require __DIR__ . "/app/inc/bootstrap.php";
require "app/Controller/Api/PeopleController.php";

$peopleController = new App\PeopleController();
$helpers = new Helpers\Helpers();
$londonLatitude = 51.5072;
$londonLongitude = 0.1276;
$distanceFromLondon = 50;

//Get all the people
$allPeopleURL = API_BASE_URL . '/users';
$allPeopleJson = $peopleController->getPeople($allPeopleURL);

//Filter out users > 50 miles from London
$peopleNearLondon = $helpers->filterArrayByDistance($allPeopleJson, $londonLatitude, $londonLongitude, $distanceFromLondon);

//Get the people in London
$city = "London";
$peopleInLondonURL = API_BASE_URL . '/city/' . $city . '/users';
$peopleInLondon = $peopleController->getPeople($peopleInLondonURL);

//Merge arrays
$allPeople = array_merge($peopleNearLondon, $peopleInLondon);

//Output results as JSON
$peopleController->sendJSON(json_encode($allPeople), array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
