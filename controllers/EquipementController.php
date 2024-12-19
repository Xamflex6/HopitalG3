<?php
require_once __DIR__ . '/../models/Modele.php';
require_once __DIR__ . '/../models/Equipement.php';

class EquipementController {
    private $equipement;

    public function __construct() {
        $modele = new Modele();
        $this->equipement = new Equipement($modele->getBdd());
    }

    public function getEquipements() {
        return $this->equipement->getAllEquipements();
    }
}
?>
