<?php
require_once '../../models/Modele.php';
require_once '../../models/Lit.php';

class LitController {
    private $lit;
    
    public function getAllLit(){
        $lit = new Lit();
        $lits = $lit->getLit()->fetchAll();
        $litFinal = [];
        foreach ($lits as $lit) {
            if ($lit['disponible']==1) {
                $lit['disponible']='Disponible';
            }
            else {
                $lit['disponible']='Non Disponible';
            }
            $litFinal[]= ($lit);
        }
        return $litFinal;
    }

    public function createLit($data) {
        $lit = new Lit();
        if ($data['chambre'] == NULL){
            $data['chambre'] = NULL; // cette ligne n'a aucun sens
        }
        
        // Appel du modèle pour insérer les données
        if ($lit->addLit($data)) {
            header("Location: ../lits/index.php");
            closecursor();
        } else {
            echo "Erreur lors de l'ajout du lit.";
        }
    }

    public function nombreLitDisponible() {
        $lit = new Lit();
        return [$lit->getNombreLitDisponible()->fetch()[0], $lit->getNombreLit()->fetch()[0]];
    }

}

?>