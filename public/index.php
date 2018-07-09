<?php

### FrontController ###

// Inclusion des classes necessaires
include(__DIR__.'/../app/controllers/MainController.php');
include(__DIR__.'/../app/controllers/ListController.php');
include(__DIR__.'/../app/controllers/PagesController.php');
include(__DIR__.'/../app/controllers/CardController.php');
include(__DIR__.'/../app/inc/AltoRouter.php');
include(__DIR__.'/../app/inc/Database.php');
include(__DIR__.'/../app/models/CardModel.php');
include(__DIR__.'/../app/models/ListModel.php');


/*

# Routage Simple, fonctionnel avec des routes statics

// Récupération de mon URL
$currentUrl = isset($_GET['_url']) ? $_GET['_url'] : '';

// Si mon URL est vide
if (empty($currentUrl)) {

  $mainController = new MainController();
  $mainController->home();

// Si mon URL vaux '/cgu'
} else if ($currentUrl == '/cgu') {

  $mainController = new MainController();
  $mainController->cgu();

// Si mon URL vaux '/list/create'
} else if ($currentUrl == '/list/create') {

  $listController = new ListController();
  $listController->create();

// Si mon URL est de la forme : /list/[un id non déterminé]/edit
// AIE PROBLEME !
} else if ($currentUrl == '/list/'.$id.'/edit') {

// Pour tout le reste => 404
} else {

  $mainController = new MainController();
  $mainController->error404();
}
*/

# Routage avec AltoRouter

// J'instancie AltoRouter
$router = new AltoRouter();

// Je déclare à AltoRouter la partie "fixe" de mon URL
// $router->setBasePath('/oclock/journey/socle/saison06/S06-E03-okanban/public');

// Je profite de la configuration de mon fichier .htaccess qui demande à Apache
// de fournir une variable $_SERVER['BASE_URI'] contenant cette partie fixe de l'URL
$router->setBasePath($_SERVER['BASE_URI']);

// Déclaration de mes routes à AltoRouter
$router->map('GET', '/', 'PagesController#home', 'accueil');

$router->map('GET', '/list', 'ListController#all', 'list_all');
$router->map('POST', '/list/create', 'ListController#create', 'list_create');
$router->map('POST', '/list/update', 'ListController#update', 'list_update');
$router->map('POST', '/list/delete', 'ListController#delete', 'list_delete');

$router->map('POST', '/list/card/create', 'CardController#create', 'card_create');
$router->map('POST', '/list/card/update', 'CardController#update', 'card_update');
$router->map('POST', '/list/card/color', 'CardController#color', 'card_color)');
$router->map('POST', '/list/card/delete', 'CardController#delete', 'card_delete)');

$router->map('GET', '/contact', 'PagesController#contact', 'contact');
$router->map('GET', '/mentions-legales', 'PagesController#cgu', 'cgu');

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

} else {

  $pageController = new PagesController();
  $pageController->error404();
}
