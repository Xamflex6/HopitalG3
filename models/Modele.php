<?php

/**
 * Classe Modele
 * Cette classe gère la connexion à la base de données et l'exécution des requêtes SQL.
 */
class Modele {

  // Objet PDO d'accès à la base de données (singleton)
  private static $bdd;

  // Informations d'authentification pour la base de données
  private $auth_sql = [
    'host' => '127.0.0.1',          // Adresse de l'hôte MySQL
    'port' => 3307,                 // Port utilisé pour MySQL
    'user' => 'root',               // Nom d'utilisateur pour la base de données
    'password' => '',               // Mot de passe pour la base de données
    'dbname' => 'db_soins_intensifs', // Nom de la base de données
    'charset' => 'utf8',            // Jeu de caractères utilisé (UTF-8)
  ];

  /**
   * Méthode privée pour récupérer les informations d'authentification.
   * 
   * @return array Retourne les informations d'authentification pour la base de données.
   */
  private function getAuth() {
    return $this->auth_sql;
  }

  /**
   * Exécute une requête SQL avec ou sans paramètres.
   * 
   * @param string $sql Requête SQL à exécuter.
   * @param array|null $params Tableau de paramètres pour une requête préparée (optionnel).
   * @return PDOStatement Résultat de la requête exécutée.
   */
  public function executerRequete($sql, $params = null) {
    // Si aucun paramètre n'est fourni, exécuter directement la requête SQL.
    if ($params == null) {
      $resultat = $this->getBdd()->query($sql); // Requête directe
    } else {
      // Préparation et exécution d'une requête avec des paramètres
      $resultat = $this->getBdd()->prepare($sql);
      $resultat->execute($params);
    }
    return $resultat; // Retourne le résultat de la requête
  }

  /**
   * Initialise la connexion à la base de données si elle n'est pas déjà établie.
   * 
   * @param string $database Nom de la base de données à utiliser (par défaut : `db_soins_intensifs`).
   * @return PDO Retourne une instance PDO pour interagir avec la base de données.
   */
  public static function getBdd($database = 'db_soins_intensifs') {
    // Si la connexion n'existe pas encore, l'initialiser
    if (self::$bdd === null) {
      try {
        // Création d'une nouvelle instance PDO avec les informations fournies
        self::$bdd = new PDO(
          'mysql:host=localhost:3307;dbname=' . $database . ';charset=utf8',
          'root',
          ''
        );
        // Configuration de PDO pour lever des exceptions en cas d'erreur
        self::$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch (Exception $e) {
        // Si une erreur survient, afficher un message et arrêter le script
        die('Erreur : ' . $e->getMessage());
      }
    }
    return self::$bdd; // Retourne l'instance PDO
  }
}

?>
