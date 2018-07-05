<?php

class ListController
{

  public function all()
  {
    //ListModel::findAll() car static (voir ListModel.php)

    $array_vars_view = [];
    $array_vars_view['array_listModel'] = ListModel::findAll();
    $array_vars_view['array_CardModel'] = CardModel::findAll();

    $this->show('list',$array_vars_view);

  }

  public function create()
  {
    $array_response = [
      'code' => '0',
      'errorMsg' => ''
    ];

    if(empty($_POST))
    {
      $array_response['code'] = '1';
      $array_response['errorMsg'] = 'POST vide';
    }
    else if($array_response['code'] == '0' && strlen($_POST['listName'])<3)
    {
      $array_response['code'] = '2';
      $array_response['errorMsg'] = 'Le nom de la liste doit être supérieur à 3 caractères !';      
    }
    else if($array_response['code'] == '0' && strlen($_POST['listName'])>10)
    {
      $array_response['code'] = '3';
      $array_response['errorMsg'] = 'Le nom de la liste doit être inférieur à 11 caractères !';      
    }

    if($array_response['code'] == '0'){
      $listModel = new ListModel();
      $listModel->setName($_POST['listName']);
      $listModel->add();
    }

    header('Content-Type: application/json');
    echo json_encode($array_response);
  }

  public function show($page, $array_vars=array())
  {
    include(__DIR__.'/../views/header.php');
    include(__DIR__.'/../views/'.$page.'.php');
    include(__DIR__.'/../views/footer.php');
  }
}