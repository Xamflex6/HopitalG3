<?php
// Inclusion des fichiers nécessaires pour gérer les équipements
require_once __DIR__ . '/../models/Modele.php';    // Modèle de base pour la connexion à la base de données
require_once __DIR__ . '/../models/Equipement.php'; // Classe Equipement pour les interactions avec la base

/**
 * Classe EquipementController
 * Cette classe gère la logique métier des équipements, notamment leur création, récupération, pagination et comptage.
 */
class EquipementController {
    private $equipement; // Instance de la classe Equipement

    /**
     * Constructeur
     * Initialise une connexion à la base de données et instancie la classe Equipement.
     */
    public function __construct() {
        $modele = new Modele(); // Instancie le modèle pour se connecter à la base
        $this->equipement = new Equipement($modele->getBdd()); // Instancie la classe Equipement avec la connexion
    }

    /**
     * Crée un nouvel équipement en utilisant les données fournies.
     * 
     * @param array $data Données de l'équipement à insérer dans la base.
     */
    public function createEquipement($data) {
        // Prépare les données de l'équipement
        $equipementData = [
            'type_equipement' => $data['type_equipement'],
            'disponible' => 1, // Par défaut, l'équipement est disponible
            'date_modification' => date('Y-m-d H:i:s') // Ajoute une date de modification
        ];

        // Appelle la méthode create() de la classe Equipement
        if ($this->equipement->create($equipementData)) {
            // Redirection vers la liste des équipements après succès
            header("Location: /exercices/ProjetInterLocal/views/equipements/index.php");
            exit(); // Termine l'exécution après la redirection
        } else {
            // Affiche un message d'erreur si l'insertion échoue
            echo "Erreur lors de l'ajout de l'équipement.";
        }
    }

    /**
     * Récupère tous les équipements de la base de données.
     * 
     * @return array Retourne un tableau contenant tous les équipements.
     */
    public function getAllEquipements() {
        // Appelle la méthode getAll() de la classe Equipement
        $equipements = $this->equipement->getAll();
        return $equipements; // Retourne les résultats
    }

    /**
     * Récupère une liste paginée des équipements.
     * 
     * @param int $page Numéro de la page à récupérer.
     * @param int $limit Nombre maximal d'équipements par page (par défaut : 30).
     * @return array Retourne un tableau contenant les équipements de la page demandée.
     */
    public function paginateEquipements($page, $limit = 30) {
        // Calcule l'offset pour la pagination
        $offset = $limit * ($page - 1);

        // Appelle la méthode paginate() de la classe Equipement
        $equipements = $this->equipement->paginate($offset, $limit);
        return $equipements; // Retourne les équipements paginés
    }

    /**
     * Compte le nombre total d'équipements dans la base de données.
     * 
     * @return int Retourne le nombre total d'équipements.
     */
    public function countEquipements() {
        // Appelle la méthode getCount() de la classe Equipement
        $equipement = $this->equipement->getCount();
        return $equipement; // Retourne le total
    }
    
    /**
     * Calcule le nombre maximal de pages en fonction du nombre total d'équipements et de la limite par page.
     * 
     * @param int $limit Nombre maximal d'équipements par page (par défaut : 30).
     * @return int Retourne le nombre total de pages.
     */
    public function getMaxPages($limit = 30) {
        // Récupère le nombre total d'équipements
        $count = (int) $this->countEquipements();

        // Calcule et retourne le nombre total de pages
        $pages = ceil($count / $limit);
        return $pages;
    }
}

// Traitement des requêtes POST pour créer un équipement
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new EquipementController();
    $controller->createEquipement($_POST);
}
?>
