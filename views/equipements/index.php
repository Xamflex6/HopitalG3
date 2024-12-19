<?php

require_once __DIR__ . '/../../controllers/EquipementController.php';

$EquipementController = new EquipementController();
$equipements = $EquipementController->getEquipements();

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
        <button id="addBedBtn" onclick="window.location.href='create.php'">Attribuer de l'équipement</button>
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Type d'équipement</th>
                <th>Status</th>
                <th>Date de modification</th>
            </tr>
            </thead>
            <?php

            $equipement = new EquipementController();

            $equipement = $equipement->getAllEquipement(); 


            foreach ($equipements as $equipement) {
                echo "<tr>
                    <td>{$equipement['equipement_id']}</td>
                    <td>{$equipement['type_equipement']}</td>
                    <td>{$equipement['disponible']}</td>
                    <td>{$equipement['date_modification']}</td>
                </tr>";
            }
            ?>
        </table>
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