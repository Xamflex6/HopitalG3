<?php
require_once 'Modele.php';

class Equipement {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($data) {
        $sql = "INSERT INTO equipement (type_equipement, disponible, date_modification, departement_id) 
                VALUES (:type_equipement, :disponible, :date_modification, :departement_id)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':type_equipement', $data['type_equipement'], PDO::PARAM_STR);
        $stmt->bindParam(':disponible', $data['disponible'], PDO::PARAM_BOOL);
        $stmt->bindParam(':date_modification', $data['date_modification']);
        return $stmt->execute();
    }   
}
    public function getAllEquipements() {
        $sql = "SELECT * FROM equipement_intensif";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


?>
