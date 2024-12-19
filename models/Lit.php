<?php 

// Inclusion de la classe Modele pour gérer les connexions à la base de données
require_once 'Modele.php';

/**
 * Classe Lit
 * Cette classe permet de gérer les lits en réanimation intensive, notamment leur récupération, ajout, et comptage.
 * Elle hérite de la classe Modele pour utiliser les méthodes de connexion et d'exécution des requêtes.
 */
class Lit extends Modele {

    /**
     * Récupère tous les lits de la base de données, triés par disponibilité.
     * 
     * @return PDOStatement Résultat de la requête, contenant tous les lits triés.
     */
    function getLit() {
        // Requête SQL pour récupérer tous les lits, triés par disponibilité (disponibles en premier)
        $sql = 'SELECT * FROM lit_intensif ORDER BY disponible DESC';
        $resultat = $this->executerRequete($sql);
        return $resultat; // Retourne les résultats de la requête
    }

    /**
     * Ajoute un nouveau lit dans la base de données.
     * 
     * @param array $param Tableau associatif contenant les données à insérer (disponibilité, type de lit, chambre).
     * @return PDOStatement Résultat de la requête d'insertion.
     */
    function addLit($param) {
        // Requête SQL pour insérer un nouveau lit
        $sql = 'INSERT INTO lit_intensif (disponible, type_lit, chambre) VALUES (:disponible, :type_lit, :chambre)';
        $resultat = $this->executerRequete($sql, $param); // Exécution avec des paramètres liés
        return $resultat; // Retourne le résultat de la requête
    }

    /**
     * Compte le nombre total de lits dans la base de données.
     * 
     * @return int Nombre total de lits.
     */
    function getNombreLit() {
        // Requête SQL pour compter tous les lits
        $sql = 'SELECT COUNT(lit_id) FROM lit_intensif';
        $resultat = $this->executerRequete($sql);
        return $resultat; // Retourne le résultat de la requête
    }

    /**
     * Compte le nombre de lits disponibles dans la base de données.
     * 
     * @return int Nombre de lits disponibles.
     */
    function getNombreLitDisponible() {
        // Requête SQL pour compter les lits disponibles (disponible = 1)
        $sql = 'SELECT COUNT(lit_id) FROM lit_intensif WHERE disponible=1';
        $resultat = $this->executerRequete($sql);
        return $resultat; // Retourne le résultat de la requête
    }
}

?>
