<?php

class PagesController
{
  public function contact()
  {
    $this->show('contact');
  }

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
