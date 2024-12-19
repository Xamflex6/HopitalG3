<?php
// Inclusion des fichiers nécessaires
require_once '../../models/Modele.php'; // Modèle de base pour la connexion à la base de données
require_once '../../models/Lit.php';   // Classe Lit pour les interactions avec la base

/**
 * Classe LitController
 * Cette classe gère la logique métier des lits, notamment leur récupération, leur création et le comptage.
 */
class LitController {
    private $lit; // Instance de la classe Lit

    /**
     * Récupère tous les lits de la base de données avec leur statut de disponibilité.
     * 
     * @return array Retourne un tableau contenant les informations sur les lits, avec le statut "Disponible" ou "Non Disponible".
     */
    public function getAllLit() {
        // Instancie la classe Lit
        $lit = new Lit();

        // Récupère tous les lits
        $lits = $lit->getLit()->fetchAll();

        // Tableau final contenant les lits avec leur statut traduit
        $litFinal = [];
        foreach ($lits as $lit) {
            // Traduit le statut de disponibilité (1 = Disponible, 0 = Non Disponible)
            if ($lit['disponible'] == 1) {
                $lit['disponible'] = 'Disponible';
            } else {
                $lit['disponible'] = 'Non Disponible';
            }
            $litFinal[] = $lit; // Ajoute le lit avec le statut traduit au tableau final
        }

        return $litFinal; // Retourne le tableau final
    }

    /**
     * Crée un nouveau lit dans la base de données.
     * 
     * @param array $data Données du lit à insérer dans la base.
     */
    public function createLit($data) {
        // Instancie la classe Lit
        $lit = new Lit();

        // Si la chambre est null, cela est déjà pris en charge par la base, cette ligne est redondante
        if ($data['chambre'] == NULL) {
            $data['chambre'] = NULL; // Ligne redondante et inutile
        }

        // Appel du modèle pour insérer les données
        if ($lit->addLit($data)) {
            // Redirection vers la liste des lits après succès
            header("Location: ../lits/index.php");
            closecursor(); // Ferme les curseurs ouverts
        } else {
            // Affiche un message d'erreur si l'insertion échoue
            echo "Erreur lors de l'ajout du lit.";
        }
    }

    /**
     * Compte le nombre de lits disponibles et le nombre total de lits.
     * 
     * @return array Retourne un tableau contenant deux valeurs : [nombre de lits disponibles, nombre total de lits].
     */
    public function nombreLitDisponible() {
        // Instancie la classe Lit
        $lit = new Lit();

        // Récupère le nombre de lits disponibles et le nombre total de lits
        $nombreDisponible = $lit->getNombreLitDisponible()->fetch()[0];
        $nombreTotal = $lit->getNombreLit()->fetch()[0];

        return [$nombreDisponible, $nombreTotal]; // Retourne un tableau avec les deux valeurs
    }
}

?>
