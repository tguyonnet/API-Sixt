<?php
/**
 * Created by PhpStorm.
 * User: usersio
 * Date: 12/10/18
 * Time: 09:42
 */

namespace Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use RedBeanPHP\R;

class Rental
{

    /**
     * Liste des réservations du client
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public function rentalByCustomer($request, $response, $args){
        $rental = R::findAll('rental', 'customer_id= ? ', [$args['customer_id']]);
        return $response->withJson(['data'=>$rental]);
    }

    /**
     * Liste des réservations du client depuis une date
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public function rentalByCustomerByDate($request, $response, $args){
        $rental = R::getAll(' select * from rental where customer_id= :customer_id and start_date>= :start_date', [':customer_id'=>$args['customer_id'],':start_date'=>$args['start_date']]);
        return $response->withJson(['data'=>$rental]);
    }

    /**
     * Enregistrer une réservation
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public function createRental($request, $response, $args){
        $rental = R::dispense('rental');
        $rental->vehicle_id = $args['vehicle_id'];
        $rental->start_date = $args['start_date'];
        $rental->end_date = $args['end_date'];
        $rental->kilometers = $args['kilometers'];
        $rental->start_agency_id = $args['start_agency_id'];
        $rental->end_agency_id = $args['end_agency_id'];
        $rental->customer_id = $args['customer_id'];
        R::store($rental);
        return $response->withJson(['data'=> $rental]);
    }

}