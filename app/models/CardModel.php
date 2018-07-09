<?php

class CardModel
{
  private $id;
  private $title;
  private $ordering;
  private $list_id;
  private $color;

  public function getId()
  {
    return $this->id;
  }

  public function getTitle()
  {
    return $this->title;
  }
  public function setTitle($newTitle)
  {
    $this->title = $newTitle;
  }

  public function getOrdering()
  {
    return $this->ordering;
  }
  public function setOrdering($newOrdering)
  {
    $this->ordering = $newOrdering;
  }

  public function getListId()
  {
    return $this->list_id;
  }
  public function setListId($newListId)
  {
    $this->list_id = $newListId;
  }

  public function getColor(){
    return $this->color;
  }
  public function setColor($newColor){
    return $this->color= $newColor;
  }

  public static function findAll()
  {
    // Mise en place du SQL
    $sql = 'SELECT * FROM cards ORDER BY ordering ASC;';

    // Je récupere mon objet PDO et j'applique la méthode query dessus
    // j'obtient donc un objet PDOStatement
    $pdoStatement = Database::getPDO()->query($sql);

    /* Reviens à faire */
    // $pdo = Database::getPDO();
    // $pdoStatement = $pdo->query($sql);

    return $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'CardModel');
  }


  public function add()
  {
    //$sql = "INSERT INTO cards (`title`, `ordering`, `list_id`) VALUES ('.$this->title.', '.$this->ordering.', '.$this->list_id.' )";
    $sql = 'INSERT INTO cards (`title`, `ordering`, `list_id`) VALUES ("'.$this->title.'", "'.$this->ordering.'", "'.$this->list_id.'")';

    $insertedRows = Database::getPDO()->exec($sql);
    // return $insertedRows > 0 ? true : false;
    /*  Reviens à faire: */
    return ($insertedRows > 0);
  }

  public static function find($searched_id)
  {
    // Je stock mon SQL à executer dans une variable
    $sql = 'SELECT * FROM cards WHERE id="'.$searched_id.'";';

    $pdoStatement = Database::getPDO()->query($sql);

    // Je fetch le résultat car je n'ai qu'un seul résultat maximum !
    // Un fetchAll renvoie toujours un tableau. Dans notre cas de réponse unique,
    // celui-ci serait moins adapté
    return $pdoStatement->fetchObject('CardModel');
  }

  public function editColor(){
    $sql = 'UPDATE cards SET color = "'.$this->color.'" WHERE id = "'.$this->id.'"';
 
    $editRows = Database::getPDO()->exec($sql);

    return $editRows > 0; 
  }

  public function edit()
  {
    $sql = 'UPDATE cards SET title = "'.$this->title.'" WHERE id = "'.$this->id.'"';
   
  }

  public function delete()
  {
    $sql = 'DELETE FROM cards WHERE id = "'.$this->id.'"';
    $deletedRows = Database::getPDO()->exec($sql);
    return $deletedRows == 1;
  }

}