<?php
require_once '../../models/Modele.php';
require_once '../../models/Alerte.php';

class AlerteController {
    private $alerte;
    
    public function getAllAlerte(){
        $alerte = new alerte();
        $alertes = $alerte->getAlerte()->fetchAll();
        $alerteFinal = [];
        foreach ($alertes as $alerte) {
            if ($alerte['resolu']==1) {
                $alerte['resolu']='vert';
            }
            else {
                $alerte['resolu']='rouge';
            }
            $alerteFinal[]= ($alerte);
        }
        return $alerteFinal;
    }

    public function getNombreAlerte() {
        $alerte = new Alerte();
        return $alerte->nombreAlerte()->fetch();
    }

    public function createAlerte($data) {
        $alerte = new Alerte();
        if ($data['alerte_description']== NULL){
            $data['alerte_description'] = NULL; // cette ligne n'a aucun sens
        }
        
        // Appel du modèle pour insérer les données
        if ($alerte->addAlerte($data)) {
            header("Location: ../alertes/index.php");
            closecursor();
        } else {
            echo "Erreur lors de l'ajout de l'alerte.";
        }
    }
}

?>