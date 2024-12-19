<?php
require_once __DIR__ . '/../models/Modele.php';
require_once __DIR__ . '/../models/Equipement.php'; 


class EquipementController {
    private $equipement;
    
    public function __construct() {
        $modele = new Modele();
        $this->equipement = new Equipement($modele->getBdd());
    }

    public function createEquipement($data) {
        if ($this->equipement->create($data)) {
            header("Location: ../equipements/index.php");
            closecursor();
        } else {
            echo "Erreur lors de l'ajout de l'équipement.";
        }
    }

    public function getAllEquipements() {
        $equipements = $this->equipement->getAll();
        return $equipements;
    }

    public function paginateEquipements($page, $limit = 30) {
        $offset = $limit * ($page-1);
        $equipements = $this->equipement->paginate($offset, $limit);
        return $equipements;
    }

    public function countEquipements() {
        $equipement = $this->equipement->getCount();
        return $equipement;
    }
    
    public function getMaxPages($limit = 30) {
        $count = (int) $this->countEquipements();
        $pages = ceil($count / $limit);
        return $pages;
    }

}

?>