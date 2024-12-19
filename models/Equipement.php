<?php

require_once __DIR__ . '/../models/Modele.php';

Class equipement {
    private $db;
    private $equipement_id;
    private $type_equipement;
    private $disponible;
    private $date_modification;


    public function __construct($db) {
        $this->db = $db;
    }

    public function create($data){
        $sql = "INSERT INTO equipement (type_equipement, disponible, date_modification) VALUES (:type_equipement, :disponible, :date_modification)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':type_equipement', $data['type_equipement'], PDO::PARAM_STR);
        $stmt->bindParam(':disponible', $data['disponible'], PDO::PARAM_STR);
        $stmt->bindParam(':date_modification', $data['date_modification']);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function paginate($offset, $limit){ 
        $offset = (int) $offset; 
        $limit = (int) $limit;   
        $sql = "SELECT * FROM equipement_intensif LIMIT $offset, $limit";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCount(){
        $sql = "SELECT COUNT(*) as total FROM equipement_intensif";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int) $result['total'];
    
    }
    
}


?>