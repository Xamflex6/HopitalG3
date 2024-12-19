<?php

//todo: hériter dla classe modele

class Modele {

  // Objet PDO d'accès à la BD
  private static $bdd;
  private $auth_sql = [
    'host' => '127.0.0.1',
    'port' => 3307,
    'user' => 'root',
    'password' => '',
    'dbname' => 'db_soins_intensifs',
    'charset' => 'utf8',
  ];

  private function getAuth(){
    return $this->auth_sql;
  }

  // Exécute une requête SQL éventuellement paramétrée
  public function executerRequete($sql, $params = null) {
    if ($params == null) {
      $resultat = $this->getBdd()->query($sql);    // exécution directe
    }
    else {
      $resultat = $this->getBdd()->prepare($sql);  // requête préparée
      $resultat->execute($params);
    }
    return $resultat;
  }

  // Renvoie un objet de connexion à la BD en initialisant la connexion au besoin 
  public static function getBdd($database = 'db_soins_intensifs') {
    if (self::$bdd === null) {
        try {
          self::$bdd = new PDO('mysql:host=localhost:3307;dbname=' .$database. ';charset=utf8', 'root', '');
          self::$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    return self::$bdd;
  }
}


?>