<?php
// Inclusion des fichiers nécessaires
require_once '../../models/Modele.php';  // Modèle de base pour la connexion à la base de données
require_once '../../models/Alerte.php';  // Classe Alerte pour les interactions avec la base

/**
 * Classe AlerteController
 * Cette classe gère la logique métier des alertes, notamment leur récupération, leur création et leur comptage.
 */
class AlerteController {
    private $alerte; // Instance de la classe Alerte

    /**
     * Récupère toutes les alertes de la base de données avec leur statut de résolution traduit.
     * 
     * @return array Retourne un tableau contenant les informations des alertes, avec un statut de résolution ("vert" ou "rouge").
     */
    public function getAllAlerte() {
        // Instancie la classe Alerte
        $alerte = new Alerte();

        // Récupère toutes les alertes
        $alertes = $alerte->getAlerte()->fetchAll();

        // Tableau final contenant les alertes avec le statut traduit
        $alerteFinal = [];
        foreach ($alertes as $alerte) {
            // Traduit le statut de résolution (1 = vert, 0 = rouge)
            if ($alerte['resolu'] == 1) {
                $alerte['resolu'] = 'vert';
            } else {
                $alerte['resolu'] = 'rouge';
            }
            $alerteFinal[] = $alerte; // Ajoute l'alerte au tableau final
        }

        return $alerteFinal; // Retourne le tableau final
    }

    /**
     * Compte le nombre total d'alertes dans la base de données.
     * 
     * @return int Retourne le nombre total d'alertes.
     */
    public function getNombreAlerte() {
        // Instancie la classe Alerte
        $alerte = new Alerte();

        // Récupère le nombre total d'alertes et retourne la première colonne du résultat
        return $alerte->NombreAlerte()->fetch();
    }

    /**
     * Crée une nouvelle alerte dans la base de données.
     * 
     * @param array $data Données de l'alerte à insérer dans la base.
     */
    public function createAlerte($data) {
        // Instancie la classe Alerte
        $alerte = new Alerte();

        // Si la description est null, ce qui est déjà géré par défaut dans la base
        if ($data['alerte_description'] == NULL) {
            $data['alerte_description'] = NULL; // Ligne redondante et inutile
        }

        // Appel du modèle pour insérer les données
        if ($alerte->addAlerte($data)) {
            // Redirection vers la liste des alertes après succès
            header("Location: ../alertes/index.php");
            closecursor(); // Ferme les curseurs ouverts
        } else {
            // Affiche un message d'erreur si l'insertion échoue
            echo "Erreur lors de l'ajout de l'alerte.";
        }
    }
}

?>
