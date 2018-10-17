<?php
/**
 * Created by PhpStorm.
 * User: usersio
 * Date: 04/10/18
 * Time: 17:11
 */

namespace Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use RedBeanPHP\R;

class Agency
{
    /**
     * liste de toutes les agences
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public static function agency($request, $response, $args){
        $agency = R::findAll('agency');
        return $response->withJson(['data'=>$agency]);
    }

    /**
     * Informations d'une agence (code, adresse, code postal, ville)
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public function agency_id($request, $response, $args){
        $agency = R::findOne('agency','id= ? ', [$args['agency_id']]);
        return $response->withJson(['data'=>$agency]);
    }

    /**
     * Liste des véhicules d'une agence
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public function vehicleByAgency($request, $response, $args){
        $vehicle = R::findAll('vehicle','agency_id= ? ', [$args['agency_id']]);
        return $response->withJson(['data'=>$vehicle]);
    }

    /**
     * Liste des véhicules disponibles d'une agence
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public function vehicleOccupiedByDate($request, $response, $args){
        $vehicleAgency = R::getAll('SELECT DISTINCT manufacturer.label as Marque, model.label as Modele, category.label as Categorie, numberPlate as Plaque 
                  FROM model,manufacturer,agency,category,vehicle,rental 
                  
                  WHERE model.manufacturer_id = manufacturer.id 
                  AND model.category_id = category.id 
                  AND vehicle.agency_id = agency.id 
                  AND vehicle.model_id = model.id 
                  
                  AND agency.id = :agency_id
                  AND rental.start_date < rental.end_date 
                  AND rental.end_date > rental.start_date;',[':agency_id'=>$args['agency_id']]);
        return $response->withJson(['data' => $vehicleAgency]);
    }
}
