<?php
class ListController
{
  public function all()
  {
    $array_vars_view = [];
    $array_vars_view['array_listModel'] = ListModel::findAll();
    $array_vars_view['array_cardModel'] = CardModel::findAll();
    $this->show('list', $array_vars_view);
  }
  public function create()
  {
    $array_response = [
      'code' => '0',
      'errorMsg' => ''
    ];
    // Je vérifie que l'on m'a bien envoyé quelque chose.
    if (empty($_POST)) {
      $array_response['code'] = '1';
      $array_response['errorMsg'] = 'POST vide';
    }
    if ($array_response['code'] == '0' && strlen($_POST['listName']) < 3) {
      $array_response['code'] = '2';
      $array_response['errorMsg'] = 'Le nom de la liste doit faire au moins 3 caractères';
    }
    if ($array_response['code'] == '0' && strlen($_POST['listName']) > 10) {
      $array_response['code'] = '3';
      $array_response['errorMsg'] = 'Le nom de la liste doit faire moins de 11 caractères';
    }
    if ($array_response['code'] == '0') {
      $listModel = new ListModel();
      $listModel->setName($_POST['listName']);
      $listModel->add();
    }
    header('Content-Type: application/json');
    echo json_encode($array_response);
  }
  public function update()
  {
    $array_response = [
      'code' => '0',
      'errorMsg' => ''
    ];
    // Je vérifie que l'on m'a bien envoyé quelque chose.
    if (empty($_POST)) {
      $array_response['code'] = '1';
      $array_response['errorMsg'] = 'POST vide';
    }
    if ($array_response['code'] == '0' && strlen($_POST['listNewName']) < 3) {
      $array_response['code'] = '2';
      $array_response['errorMsg'] = 'Le nom de la liste doit faire au moins 3 caractères';
    }
    if ($array_response['code'] == '0' && strlen($_POST['listNewName']) > 10) {
      $array_response['code'] = '3';
      $array_response['errorMsg'] = 'Le nom de la liste doit faire moins de 11 caractères';
    }
    if ($array_response['code'] == '0') {
      // Je récupere mon objet listModel provenant de la BDD
      // cet objet est instancié avec les valeurs contenues en BDD
      $listModel = ListModel::find($_POST['listId']);
      if (!is_object($listModel) || $listModel->getName() == '') {
        $array_response['code'] = '4';
        $array_response['errorMsg'] = 'Impossible de trouver la liste';
      }
      if ($array_response['code'] == '0') {
        $listModel->setName($_POST['listNewName']);
        $edited = $listModel->edit();
        // Si pour une raison X ou Y l'enregistrement en BDD n'a pas fonctionné
        if ($edited === false) {
          $array_response['code'] = '5';
          $array_response['errorMsg'] = "Erreur lors de l'enregistrement en BDD";
        // Si tout fonctionne bien je renvoi également les informations
        // concernant mon objet listModel
        } else {
          $array_response['listId'] = $listModel->getId();
          $array_response['listName'] = $listModel->getName();
        }
      }
    }
    header('Content-Type: application/json');
    $array_response_json = json_encode($array_response);
    echo $array_response_json;
  }
  public function delete()
  {
    $array_response = [
      'code' => '0',
      'errorMsg' => ''
    ];
    // Je vérifie que l'on m'a bien envoyé quelque chose.
    if (empty($_POST) && !empty($_POST['listId'])) {
      $array_response['code'] = '1';
      $array_response['errorMsg'] = 'POST vide';
    }
    if ($array_response['code'] == '0') {
      $listModel = ListModel::find($_POST['listId']);
      if (!is_object($listModel) || $listModel->getName() == '') {
        $array_response['code'] = '4';
        $array_response['errorMsg'] = 'Impossible de trouver la liste';
      }
      $deleted = $listModel->delete();
      // Si pour une raison X ou Y la suppression en BDD n'a pas fonctionnée
      if ($deleted === false) {
        $array_response['code'] = '6';
        $array_response['errorMsg'] = "Erreur lors de la suppression en BDD";
      }
    }
      header('Content-Type: application/json');
      echo json_encode($array_response);
  }
  public function show($page, $array_vars = array())
  {
    include(__DIR__.'/../views/header.php');
    include(__DIR__.'/../views/'.$page.'.php');
    include(__DIR__.'/../views/footer.php');
  }
}