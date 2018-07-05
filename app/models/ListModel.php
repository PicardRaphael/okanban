<?php

/* 
    1 model = 1 class
    1 model par table
    1 class par fichier
    1 propriété de classe par champ dans ma table
    pas de contructeur
 */

class ListModel
{

    private $id;
    private $name;

    /*     
        Attribut en private donc je met en place des getters en public
    */   
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($newName){
        $this->name = $newName;
    }

    public function add(){
        $sql ='INSERT INTO lists (name)
        VALUE ("'.$this->name.'")';

        $insertedRows = Database::getPDO()->exec($sql); 

        //return $insertedRows > 0 ? true: false;
        return $insertedRows >0;
    }

    public static function findAll(){
        $sql = 'SELECT * FROM lists';
        // Database::getPDO() est une méthode statique de la classe Database fournie dans "inc/Database.php"
        $pdoStatement = Database::getPDO()->query($sql);
        // Retourne tous les résultats sous forme d'array d'objets Product
        return $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'ListModel');
    }


}