<?php

// Inclusion de la classe Modele pour interagir avec la base de données
require_once __DIR__ . '/../models/Modele.php';

/**
 * Classe Equipement
 * Cette classe gère les équipements intensifs, notamment leur ajout, leur récupération et leur pagination.
 */
class Equipement {
    // Propriétés de la classe
    private $db;                 // Connexion à la base de données
    private $equipement_id;      // Identifiant unique de l'équipement
    private $type_equipement;    // Type d'équipement (par ex. moniteur, ventilateur)
    private $disponible;         // Statut de disponibilité (1 = disponible, 0 = indisponible)
    private $date_modification;  // Dernière date de modification

    /**
     * Constructeur
     * Initialise la connexion à la base de données.
     * 
     * @param PDO $db Instance PDO de la base de données.
     */
    public function __construct($db) {
        $this->db = $db;
    }

    /**
     * Méthode pour créer un nouvel équipement.
     * Insère une nouvelle entrée dans la table `equipement_intensif`.
     * 
     * @param array $data Données de l'équipement à insérer.
     * @return bool Retourne `true` si l'insertion réussit, sinon `false`.
     */
    public function create($data) {
        // Requête SQL pour insérer un nouvel équipement
        $sql = "INSERT INTO equipement_intensif (type_equipement, disponible, date_modification) 
                VALUES (:type_equipement, :disponible, :date_modification)";
        $stmt = $this->db->prepare($sql);

        // Liaison des paramètres à la requête
        $stmt->bindParam(':type_equipement', $data['type_equipement'], PDO::PARAM_STR); // Type d'équipement
        $stmt->bindParam(':disponible', $data['disponible'], PDO::PARAM_INT);          // Disponibilité (1 ou 0)
        $stmt->bindParam(':date_modification', $data['date_modification'], PDO::PARAM_STR); // Date de modification

        // Exécution de la requête et retour du résultat
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Méthode pour récupérer une liste paginée des équipements.
     * 
     * @param int $offset Position de départ pour la récupération des données.
     * @param int $limit Nombre maximal d'équipements à récupérer.
     * @return array Retourne un tableau associatif contenant les équipements récupérés.
     */
    public function paginate($offset, $limit) {
        $offset = (int) $offset; // Conversion en entier
        $limit = (int) $limit;   // Conversion en entier

        // Requête SQL avec LIMIT pour paginer les résultats
        $sql = "SELECT * FROM equipement_intensif LIMIT $offset, $limit";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        // Retourne les résultats sous forme de tableau associatif
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Méthode pour obtenir le nombre total d'équipements.
     * 
     * @return int Retourne le nombre total d'équipements dans la base de données.
     */
    public function getCount() {
        // Requête SQL pour compter tous les équipements
        $sql = "SELECT COUNT(*) as total FROM equipement_intensif";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        // Récupère le résultat et retourne le total
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int) $result['total'];
    }
}

?>
