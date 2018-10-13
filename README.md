# API-Sixt - Documentation

## Qu'est ce que c'est ?
----------------------------------------------

Cette API est destinée aux clients grand comptes de la société SIXT, 
avec plus de 50 réservations de véhicules par mois,
pour leurs permettre d'automatiser le processus de réservation,
vers le site de la société.




## Comment utiliser l'API ?
----------------------------------------------

Télécharger le dossier de l'[API](https://github.com/tguyonnet/api-sixt/archive/master.zip).
Ensuite, pour utiliser l'[API](https://github.com/tguyonnet/api-sixt/archive/master.zip) vous devez installer [composer](https://getcomposer.org/) (s'il l'est deja faite simplement la commande
'composer update' à la racine du projet).

L'[API](https://github.com/tguyonnet/api-sixt/archive/master.zip) dépend des frameworks suivant :
- **[Slim](https://www.slimframework.com/)** -> composer require slim/slim
- **[Redbean](https://www.redbeanphp.com/index.php)** -> composer require gabordemooij/redbean




## Les différentes fonctionnalités de l'API
----------------------------------------------

* liste de toutes les agences :
tpapi.test/agency


* Informations d'une agence (code, adresse, code postal, ville) :
tpapi.test/agency/{agency_id}


* Liste des types de véhicules d'une agence :
tpapi.test/agency/{agency_id}/vehicle


* Liste des véhicules disponibles d'une agence :
tpapi.test/agency/{agency_id}/{model_id}/{start_date}/{end_date}


* Liste des réservations du client :
tpapi.test/rental/{customer_id}


* Liste des réservations du client depuis une date:
tpapi.test/rental/{customer_id}/{start_date}


* Enregistrer une réservation :
tpapi.test/rental/create/{vehicle_id}/{start_date}/{end_date}/{kilometers}/{start_agency_id}/{end_agency_id}/{customer_id}




## Exemples de fonctionnalités
----------------------------------------------

L'adresse **http://tpapi.test/agency/6**
Revoi les détails de l'agence avec l'id 6.

> id:         "6" address:	"48, Rue Jean Mermoz" ville: "Évreux" postcode:	"27000"

