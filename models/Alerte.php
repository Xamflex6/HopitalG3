<?php 

// Inclusion de la classe Modele pour gérer les interactions avec la base de données
require_once 'Modele.php';

/**
 * Classe Alerte
 * Cette classe permet de gérer les alertes, notamment leur récupération, leur ajout et le comptage.
 * Elle hérite de la classe Modele pour réutiliser les méthodes de connexion et d'exécution des requêtes.
 */
class Alerte extends Modele {

    /**
     * Récupère toutes les alertes de la base de données, triées par date de création (les plus récentes en premier).
     * 
     * @return PDOStatement Résultat de la requête contenant toutes les alertes triées.
     */
    function getAlerte() {
        // Requête SQL pour récupérer toutes les alertes triées par date de création
        $sql = 'SELECT * FROM alerte_intensif ORDER BY date_creation DESC';
        $resultat = $this->executerRequete($sql);
        return $resultat; // Retourne les résultats de la requête
    }
    
    /**
     * Compte le nombre total d'alertes dans la base de données.
     * 
     * @return PDOStatement Résultat de la requête contenant le nombre total d'alertes.
     */
    function NombreAlerte() {
        // Requête SQL pour compter toutes les alertes
        $sql = 'SELECT COUNT(alerte_id) FROM alerte_intensif';
        $resultat = $this->executerRequete($sql);
        return $resultat; // Retourne le résultat de la requête
    }

    /**
     * Ajoute une nouvelle alerte dans la base de données.
     * 
     * @param array $param Tableau associatif contenant les données de l'alerte (type, description, statut).
     * @return PDOStatement Résultat de la requête d'insertion.
     */
    function addAlerte($param) {
        // Requête SQL pour insérer une nouvelle alerte
        $sql = 'INSERT INTO alerte_intensif (alerte_type, alerte_description, resolu) 
                VALUES (:alerte_type, :alerte_description, :resolu)';
        $resultat = $this->executerRequete($sql, $param); // Exécution avec des paramètres liés
        return $resultat; // Retourne le résultat de la requête
    }
}

?>
