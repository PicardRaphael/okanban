<?php
// Design Pattern : Singleton
class Database {

    /** @var PDO */
    private $dbh;
    private static $_instance;

    private function __construct() {

      // Je demande à PHP de "parser" = de lire mon fichier de config
      $db_config = parse_ini_file(__DIR__.'/../db_config.conf');

      try {
          $this->dbh = new PDO(
              "mysql:host={$db_config['DB_HOST']};dbname={$db_config['DB_NAME']};charset=utf8",
              $db_config['DB_USER'],
              $db_config['DB_PASSWORD'],
              array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING) // Affiche les erreurs SQL à l'écran
          );
      }
      catch(Exception $exception) {
          die('Erreur de connexion...' . $exception->getMessage());
      }
    }
    // the unique method you need to use
    public static function getPDO() {
        // If no instance => create one
        if (empty(self::$_instance)) {
            self::$_instance = new Database();
        }
        return self::$_instance->dbh;
    }
}
