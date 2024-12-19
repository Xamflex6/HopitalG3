<?php 

require_once 'Modele.php';

class Lit extends Modele {

    function getLit(){
        $sql = 'SELECT * from lit_intensif ORDER BY disponible DESC';
        $resultat = $this->executerRequete($sql);
        return $resultat;
    }


    function addLit($param){
        
        $sql = 'INSERT INTO lit_intensif (disponible, type_lit, chambre) VALUES (:disponible, :type_lit, :chambre)';
        $resultat = $this->executerRequete($sql, $param);
        return $resultat;
    }

    function getNombreLit() {
        $sql = 'SELECT COUNT(lit_id) FROM lit_intensif';
        $resultat = $this->executerRequete($sql);
        return $resultat;
    }

    function getNombreLitDisponible() {
        $sql = 'SELECT COUNT(lit_id) FROM lit_intensif WHERE disponible=1';
        $resultat = $this->executerRequete($sql);
        return $resultat;
    }
}

?>