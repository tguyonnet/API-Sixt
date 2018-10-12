<?php

chdir(__DIR__);

require './vendor/autoload.php';


use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \RedBeanPHP\R as R;





R::setup('mysql:host=localhost;dbname=sixt_slam3_v0','userapi','pwapi'); //connect to data base.

$dataGenerator = Faker\Factory::create('fr_FR');


$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];

$c = new \Slim\Container($configuration);
$app = new \Slim\App($c);






$app->get('/agency', \Controllers\Agency::class . ':agency');

$app->get('/agency/{agency_id}', \Controllers\Agency::class . ':agency_id');

$app->get('/agency/{agency_id}/vehicle', \Controllers\Agency::class . ':vehicleByAgency');

$app->get('/agency/{agency_id}/{model_id}/{start_date}/{end_date}', \Controllers\Agency::class.':vehicleOccupiedByDate');



$app->get('/rental/{customer_id}', \Controllers\Rental::class.':rentalByCustomer');

$app->get('/rental/{customer_id}/{start_date}', \Controllers\Rental::class.':rentalByCustomerByDate');

$app->get('/rental/create/{vehicle_id}/{start_date}/{end_date}/{kilometers}/{start_agency_id}/{end_agency_id}/{customer_id}', \Controllers\Rental::class.':createRental');


$app->run();

