<?php
### FrontController ###
// Inclusion des classes necessaires
include(__DIR__.'/../app/controllers/MainController.php');
include(__DIR__.'/../app/controllers/ListController.php');
include(__DIR__.'/../app/controllers/PagesController.php');

include(__DIR__.'/../app/inc/AltoRouter.php');
include(__DIR__.'/../app/inc/Database.php');

include(__DIR__.'/../app/models/CardModel.php');
include(__DIR__.'/../app/models/ListModel.php');

# Routage avec AltoRouter

// J'instancie AltoRouter
$router = new AltoRouter();
// Je déclare à AltoRouter la partie "fixe" de mon URL
// $router->setBasePath('/oclock/journey/socle/saison06/S06-E03-okanban/public');
// Je profite de la configuration de mon fichier .htaccess qui demande à Apache
// de fournir une variable $_SERVER['BASE_URI'] contenant cette partie fixe de l'URL
$router->setBasePath($_SERVER['BASE_URI']);

// Déclaration de mes routes à AltoRouter
$router->map('GET', '/', 'MainController#home', 'accueil');

$router->map('GET', '/mentions-legals', 'PagesController#cgu', 'cgu');
$router->map('GET', '/contact', 'PagesController#contact', 'contact');

$router->map('GET', '/list', 'ListController#all', 'list_all');
$router->map('POST', '/list/create', 'ListController#create', 'list_create');
$router->map('GET', '/list/[id]/edit', 'ListController#edit', 'list_edit');

// Je demande à AltoRouter de regarder si il y a une correspondance entre
// mon URL actuelle et mes routes déclarées.
$match = $router->match();
// Dispatcher
if ($match !== false) {
  // explode permet de découper une chaine de caractères en fonction d'un délimiteur
  // list permet de regrouper un tableau dans des variables
  // Je viens donc découper ma variable $match['target'] suivant le #
  // et j'assigne les valeurs dans mes deux variables "$controllerName" et "$methodName"
  list($controllerName, $methodName) = explode('#', $match['target']);
  /* Reviens à faire:
  $target = explode('#', $match['target']);
  $controllerName = $target[0];
  $methodName = $target[1];
  */
  // J'instancie mon controller
  $controller = new $controllerName();
  /* La variable $controllerName va être remplacée par PHP par sa valeur
    par exemple : $controller = new MainController();
  */
  // J'appel la méthode à executer de mon controller
  $controller->$methodName();
  /* La variable $methodName va être remplacée par PHP par sa valeur
    par exemple: $controller->home();
  */
} 
else 
{
  $mainController = new MainController();
  $mainController->error404();
}