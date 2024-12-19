<?php 


require_once 'Modele.php';

class Alerte extends Modele {

    function getAlerte(){
        $sql = 'SELECT * from alerte_intensif ORDER BY date_creation DESC';
        $resultat = $this->executerRequete($sql);
        return $resultat;
    }
    
    function NombreAlerte() {
        $sql = 'SELECT COUNT(alerte_id) FROM alerte_intensif';
        $resultat = $this->executerRequete($sql);
        return $resultat;
    }

    function addAlerte($param){
        
        $sql = 'INSERT INTO alerte_intensif (alerte_type, alerte_description, resolu) VALUES (:alerte_type, :alerte_description, :resolu)';
        $resultat = $this->executerRequete($sql, $param);
        return $resultat;
    }
}

?> 