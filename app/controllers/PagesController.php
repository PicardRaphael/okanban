<?php

class PagesController
{
  // Notre page contact
  public function contact()
  {
    $this->show('contact');
  }

  // Notre page CGU
  public function cgu()
  {
    $this->show('cgu');
  }

  public function show($page)
  {
    include(__DIR__.'/../views/header.php');
    include(__DIR__.'/../views/'.$page.'.php');
    include(__DIR__.'/../views/footer.php');
  }

  

}