<?php
/*
  Petit rappel:
  1 model => 1 classe
  1 model par table
  1 classe par fichier
  1 propriété de classe par champ dans ma table
  pas de constructeur
*/
class ListModel
{
  // Déclaration de mes attributs (= propriétés) de ma classe
  // ils correspondents aux champs (=colonnes) de ma table
  private $id;
  private $name;
  // Comme mes attributs sont en "private"
  // je mets en place des méthodes public "getters"
  public function getId()
  {
    return $this->id;
  }
  public function getName()
  {
    return $this->name;
  }
  public function setName($newName)
  {
    $this->name = $newName;
  }
  public function add()
  {
    $sql = 'INSERT INTO lists (name) VALUES ("'.$this->name.'")';
    $insertedRows = Database::getPDO()->exec($sql);
    // return $insertedRows > 0 ? true : false;
    /*  Reviens à faire: */
    return ($insertedRows > 0);
  }
  public function edit()
  {
    $sql = 'UPDATE lists SET name = "'.$this->name.'" WHERE id = "'.$this->id.'"';
    $editRows = Database::getPDO()->exec($sql);
    return $editRows > 0;
  }
  public function delete()
  {
    $sql = 'DELETE FROM lists WHERE id = "'.$this->id.'";';
    $deletedRows = Database::getPDO()->exec($sql);
    return $deletedRows == 1;
  }
  public static function find($searched_id)
  {
    // Je stock mon SQL à executer dans une variable
    $sql = 'SELECT * FROM lists WHERE id="'.$searched_id.'";';
    $pdoStatement = Database::getPDO()->query($sql);
    // Je fetch le résultat car je n'ai qu'un seul résultat maximum !
    // Un fetchAll renvoie toujours un tableau. Dans notre cas de réponse unique,
    // celui-ci serait moins adapté
    return $pdoStatement->fetchObject('ListModel');
  }
  public static function findAll()
  {
    // Je stock mon SQL à executer dans une variable
    $sql = 'SELECT * FROM lists';
    // Database::getPDO() est une méthode statique de la classe Database fournie dans "inc/Database.php"
    $pdoStatement = Database::getPDO()->query($sql);
    // Retourne tous les résultats sous forme d'array d'objets ListModel
    return $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'ListModel');
  }
}