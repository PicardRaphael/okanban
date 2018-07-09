<?php
//abstract personne na le droit de faire new MainController
abstract class MainController
{
  public function show($page, $array_vars = array())
  {
    global $router;
    
    include(__DIR__.'/../views/header.php');
    include(__DIR__.'/../views/'.$page.'.php');
    include(__DIR__.'/../views/footer.php');
  }

  public function displayJson($array_response)
  {
    header('Content-Type: application/json');
    $array_response_json = json_encode($array_response);
    echo $array_response_json;  
  }
}
