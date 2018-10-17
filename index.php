<?php

chdir(__DIR__);

require './vendor/autoload.php';


use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \RedBeanPHP\R as R;





R::setup('mysql:host=localhost;dbname=api-sixt','userapi','pwapi'); //connect to data base.

$dataGenerator = Faker\Factory::create('fr_FR');


$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];

$c = new \Slim\Container($configuration);
$app = new \Slim\App($c);





//liste de toutes les agences
$app->get('/agency', \Controllers\Agency::class . ':agency');
//Informations d'une agence (code, adresse, code postal, ville)
$app->get('/agency/{agency_id}', \Controllers\Agency::class . ':agency_id');
//Liste des véhicules d'une agence
$app->get('/agency/{agency_id}/vehicle', \Controllers\Agency::class . ':vehicleByAgency');
//Liste des véhicules disponibles d'une agence
$app->get('/agency/{agency_id}/{model_id}/{start_date}/{end_date}', \Controllers\Agency::class.':vehicleOccupiedByDate');


//Liste des réservations du client
$app->get('/rental/{customer_id}', \Controllers\Rental::class.':rentalByCustomer');
//Liste des réservations du client depuis une date
$app->get('/rental/{customer_id}/{start_date}', \Controllers\Rental::class.':rentalByCustomerByDate');
//Enregistrer une réservation
$app->get('/rental/create/{vehicle_id}/{start_date}/{end_date}/{kilometers}/{start_agency_id}/{end_agency_id}/{customer_id}', \Controllers\Rental::class.':createRental');


$app->run();

