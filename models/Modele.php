<?php

class Modele {

  // Objet PDO d'accès à la BD
  private $bdd;
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
  private function getBdd() {
    if ($this->bdd == null) {
      $auth = $this->getAuth();
      // Création de la connexion
      $this->bdd = new PDO('mysql:host=' . $auth['host'] . ":" . $auth['port'] .';dbname=' . $auth['dbname'] . ';charset=' . $auth['charset'] . ';user=' . $auth['user'] . ';password=' . $auth['password']);
    }
    return $this->bdd;
  }

}


?>