<?php
/**
 * Ce fichier représente la vue pour la gestion des équipements.
 * 
 * Il inclut les fichiers nécessaires pour le modèle et le contrôleur des équipements,
 * initialise la connexion à la base de données et affiche une table des équipements
 * avec pagination.
 * 
 * @package ProjetInterLocal
 * @subpackage Views
 * @category Equipements
 * @version 1.0
 */

// Inclusion des fichiers de modèle et de contrôleur
require_once '../../models/Modele.php';
require_once '../../controllers/EquipementController.php';

// Initialisation de la connexion à la base de données
$db = Modele::getBdd(); 

// Récupération de la page actuelle pour la pagination
$currentPage = isset($_GET['page']) && $_GET['page'] >= 1 ? $_GET['page'] : 1;

// Création d'une instance du contrôleur des équipements
$equipementController = new EquipementController();

// Récupération des équipements paginés
$equipements = $equipementController->paginateEquipements($currentPage);

// Récupération du nombre maximum de pages pour la pagination
$pages = $equipementController->getMaxPages();
?>
<?php
    require_once '../../models/Modele.php';
    require_once '../../controllers/EquipementController.php';

    $db = Modele::getBdd(); 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Lits</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<header class="navbar">
    <div class="logo">
      <a href="../../index.php">
        <img src="../../assets/logo.png" alt="H3DMP Logo">
      </a>
    </div>
  </header>
<body>
    <div class="containerLit">
        <h1>Gestion des Equipements</h1>
        <button id="addBedBtn">Attribuer de l'équipement</button>
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Type d'équipement</th>
                <th>Status</th>
                <th>Date de modification</th>
            </tr>
            </thead>
            <tr id="bedList">
            <?php
                $currentPage = isset($_GET['page']) && $_GET['page'] >= 1 ? $_GET['page'] : 1;

                $equipementController = new EquipementController();

                $equipements = $equipementController->paginateEquipements($currentPage);

                $pages = $equipementController->getMaxPages();
                

                foreach ($equipements as $equipement) {
                    echo "<tr id='bedList'>";
                    echo "<td>" . $equipement['equipement_id'] . "</td>";
                    echo "<td>" . $equipement['type_equipement'] . "</td>";
                    echo "<td>" . $equipement['disponible'] . "</td>";
                    echo "<td>" . $equipement['date_modification'] . "</td>";
                    echo "</tr>";
                }
            ?>   
            </tr>
        </table>
        <div class="pagination">
            <?php
                echo "Pages : ";
                for ($i = 1; $i <= $pages; $i++) {
                    echo "<a href='?page=$i'>$i</a> ";
                }
            ?>

    </div>
    <div id="bedModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 id="modalTitle">Attribuer de l'équipement</h2>
            <form id="bedForm">
                <input type="hidden" id="bedId">
                <div>
                    <label for="bedName">Type de Lit:</label>
                    <input type="text" id="bedName" required>
                </div>
                <div>
                    <label for="bedStatus">Statut:</label>
                    <select id="bedStatus" required>
                        <option value="Disponible">Disponible</option>
                        <option value="Occupé">Occupé</option>
                    </select>
                </div>
                <button type="submit">Enregistrer</button>
            </form>
        </div>
    </div>
</body>
</html>
<script>
    document.getElementById('addBedBtn').addEventListener('click', function() {
        window.location.href = 'create.php';
    });
</script>