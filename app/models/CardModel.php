<?php

/* 
    1 model = 1 class
    1 model par table
    1 class par fichier
    1 propriété de classe par champ dans ma table
    pas de contructeur
 */

class CardModel
{

    private $id;
    private $title;
    private $ordering;
    private $list_id;

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getOrdering()
    {
        return $this->ordering;
    }

    public function getListId()
    {
        return $this->list_id;
    }

    public static function findAll(){
        $sql = "SELECT * FROM cards ORDER BY ordering ";
        // Database::getPDO() est une méthode statique de la classe Database fournie dans "inc/Database.php"
        $pdoStatement = Database::getPDO()->query($sql);
        // Retourne tous les résultats sous forme d'array d'objets Product
        return $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'CardModel');
    }

}