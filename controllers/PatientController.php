<?php
require_once __DIR__ . '/../models/Modele.php';
require_once __DIR__ . '/../models/Patient.php'; // Ensure this file exists and has no errors

class PatientController {
    private $patient;

    public function __construct() {
        $modele = new Modele();
        $this->patient = new Patient($modele->getBdd());
    }

    public function createPatient($data) {
        
        // Appel du modèle pour insérer les données
        if ($this->patient->create($data)) {
            header("Location: ../patients/index.php");
            closecursor();
        } else {
            echo "Erreur lors de l'ajout du patient.";
        }
    }

    public function getAllPatients() {
        // Appel du modèle pour récupérer les données
        $patients = $this->patient->getAll();
        return $patients;
    }
}




