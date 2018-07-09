<?php

class PagesController extends MainController
{
  public function contact()
  {
    $this->show('contact');
  }

  public function cgu()
  {
    $this->show('cgu');
  }
  
  // Notre page d'accueil
  public function home()
  {
    $this->show('accueil');
  }

  public function error404()
  {
    $this->show('404');
  }

}
