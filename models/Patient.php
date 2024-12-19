<?php

// Inclusion du fichier Modele.php pour l'accès à la base de données.
require_once 'Modele.php';

/**
 * Classe Patient
 * Cette classe gère les patients et leurs interactions avec la base de données.
 */
class Patient {
    // Propriétés de la classe
    private $db;                 // Connexion à la base de données
    private $patient_id;         // Identifiant unique du patient
    private $name;               // Nom du patient
    private $surname;            // Prénom du patient
    private $date_naissance;     // Date de naissance du patient
    private $contact;            // Contact du patient
    private $adresse;            // Adresse du patient
    private $date_creation;      // Date de création de l'entrée
    private $date_modification;  // Dernière date de modification
    private $lit_id;             // Identifiant du lit associé au patient

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
     * Méthode pour créer un nouveau patient.
     * Insère une nouvelle entrée dans la table `patient_intensif`.
     * 
     * @param array $data Données du patient à insérer.
     * @return bool Retourne `true` si l'insertion réussit, sinon `false`.
     */
    public function create($data) {
        // Préparation de la requête SQL
        $sql = "INSERT INTO patient_intensif (nom, prenom, date_naissance, contact, adresse, date_creation, date_modification) 
                VALUES (:nom, :prenom, :date_naissance, :contact, :adresse, :date_creation, :date_modification)";
        $stmt = $this->db->prepare($sql);

        // Liaison des paramètres
        $stmt->bindParam(':nom', $data['nom'], PDO::PARAM_STR);
        $stmt->bindParam(':prenom', $data['prenom'], PDO::PARAM_STR);
        $stmt->bindParam(':date_naissance', $data['date_naissance']); // Date de naissance
        $stmt->bindParam(':contact', $data['contact'], PDO::PARAM_STR);
        $stmt->bindParam(':adresse', $data['adresse'], PDO::PARAM_STR);
        $stmt->bindParam(':date_creation', $data['date_creation']); // Date de création
        $stmt->bindParam(':date_modification', $data['date_modification']); // Date de modification

        // Exécution de la requête et retour du résultat
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Méthode pour récupérer tous les patients de la base de données.
     * 
     * @return array Retourne un tableau associatif contenant tous les patients.
     */
    public function getAll() {
        // Préparation et exécution de la requête SQL
        $sql = "SELECT * FROM patient_intensif";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        // Retourne tous les résultats
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // =======================
    // Getters (Accesseurs)
    // =======================

    public function getName() {
        return $this->name; // Retourne le nom du patient
    }

    public function getSurname() {
        return $this->surname; // Retourne le prénom du patient
    }

    public function getDateNaissance() {
        return $this->date_naissance; // Retourne la date de naissance
    }

    public function getContact() {
        return $this->contact; // Retourne le contact
    }

    public function getAdresse() {
        return $this->adresse; // Retourne l'adresse
    }

    public function getDateCreation() {
        return $this->date_creation; // Retourne la date de création
    }

    public function getDateModification() {
        return $this->date_modification; // Retourne la dernière date de modification
    }

    public function getLitId() {
        return $this->lit_id; // Retourne l'identifiant du lit
    }

    // =======================
    // Setters (Mutateurs)
    // =======================

    public function setName($nom) {
        $this->name = $nom; // Définit le nom
    }

    public function setSurname($prenom) {
        $this->surname = $prenom; // Définit le prénom
    }

    public function setDateNaissance($date_naissance) {
        $this->date_naissance = $date_naissance; // Définit la date de naissance
    }

    public function setContact($contact) {
        $this->contact = $contact; // Définit le contact
    }

    public function setAdresse($adresse) {
        $this->adresse = $adresse; // Définit l'adresse
    }

    public function setDateCreation($date_creation) {
        $this->date_creation = $date_creation; // Définit la date de création
    }

    public function setDateModification($date_modification) {
        $this->date_modification = $date_modification; // Définit la dernière date de modification
    }

    public function setLitId($lit_id) {
        $this->lit_id = $lit_id; // Définit l'identifiant du lit
    }
}
