<?php

require_once 'Modele.php';

class Patient {
    private $db;
    private $patient_id;
    private $name;
    private $surname;
    private $date_naissance;
    private $contact;
    private $adresse;
    private $date_creation;
    private $date_modification;
    private $lit_id;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($data) {
        // TODO : USE SETTERS
        $sql = "INSERT INTO patient_intensif (nom, prenom, date_naissance, contact, adresse, date_creation, date_modification) VALUES (:nom, :prenom, :date_naissance, :contact, :adresse, :date_creation, :date_modification)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nom', $data['nom'], PDO::PARAM_STR);
        $stmt->bindParam(':prenom', $data['prenom'], PDO::PARAM_STR);
        $stmt->bindParam(':date_naissance', $data['date_naissance']);
        $stmt->bindParam(':contact', $data['contact'], PDO::PARAM_STR);
        $stmt->bindParam(':adresse', $data['adresse'], PDO::PARAM_STR);
        $stmt->bindParam(':date_creation', $data['date_creation']);
        $stmt->bindParam(':date_modification', $data['date_modification']);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Getters
    public function getName() {
        return $this->nom;
    }

    public function getSurname() {
        return $this->prenom;
    }

    public function getDateNaissance() {
        return $this->date_naissance;
    }

    public function getContact() {
        return $this->contact;
    }

    public function getAdresse() {
        return $this->adresse;
    }

    public function getDateCreation() {
        return $this->date_creation;
    }

    public function getDateModification() {
        return $this->date_modification;
    }

    public function getLitId() {
        return $this->lit_id;
    }

    public function getAll(){
        $sql = "SELECT * FROM patient_intensif";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Setters
    public function setName($nom) {
        $this->name = $nom;
    }

    public function setSurname($prenom) {
        $this->surname = $prenom;
    }

    public function setDateNaissance($date_naissance) {
        $this->date_naissance = $date_naissance;
    }

    public function setContact($contact) {
        $this->contact = $contact;
    }

    public function setAdresse($adresse) {
        $this->adresse = $adresse;
    }

    public function setDateCreation($date_creation) {
        $this->date_creation = $date_creation;
    }

    public function setDateModification($date_modification) {
        $this->date_modification = $date_modification;
    }

    public function setLitId($lit_id) {
        $this->lit_id = $lit_id;
    }
}