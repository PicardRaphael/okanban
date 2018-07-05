<?php
class MainController
{
  // Notre page d'accueil
  public function home()
  {
    $this->show('accueil');
  }

  public function error404()
  {
    $this->show('404');
  }


  public function show($page)
  {
    include(__DIR__.'/../views/header.php');
    include(__DIR__.'/../views/'.$page.'.php');
    include(__DIR__.'/../views/footer.php');
  }



}