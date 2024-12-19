<?php
// Inclusion des fichiers nécessaires pour gérer les patients
require_once __DIR__ . '/../models/Modele.php';  // Modèle de base pour la connexion à la base de données
require_once __DIR__ . '/../models/Patient.php'; // Classe Patient pour les interactions avec la base

/**
 * Classe PatientController
 * Cette classe gère la logique métier des patients, notamment leur création et leur récupération.
 */
class PatientController {
    private $patient; // Instance de la classe Patient

    /**
     * Constructeur
     * Initialise une connexion à la base de données et instancie la classe Patient.
     */
    public function __construct() {
        // Création d'une instance de Modele pour se connecter à la base
        $modele = new Modele();
        // Instanciation de la classe Patient avec la connexion à la base
        $this->patient = new Patient($modele->getBdd());
    }

    /**
     * Crée un nouveau patient en utilisant les données fournies.
     * 
     * @param array $data Données du patient à insérer dans la base.
     */
    public function createPatient($data) {
        // Appelle la méthode create() de la classe Patient
        if ($this->patient->create($data)) {
            // Redirection vers la liste des patients après succès
            header("Location: ../patients/index.php");
            closecursor(); // Ferme tout curseur de base de données éventuellement ouvert
        } else {
            // Affiche un message d'erreur si l'insertion échoue
            echo "Erreur lors de l'ajout du patient.";
        }
    }

    /**
     * Récupère tous les patients de la base de données.
     * 
     * @return array Retourne un tableau contenant tous les patients.
     */
    public function getAllPatients() {
        // Appelle la méthode getAll() de la classe Patient
        $patients = $this->patient->getAll();
        return $patients; // Retourne les résultats
    }
}

?>
