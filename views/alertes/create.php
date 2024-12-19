<?php
include_once '../../controllers/AlerteController.php';


// Création du contrôleur
$controller = new AlerteController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $data = array(
        'alerte_type' => $_POST['type'],
        'alerte_description' => $_POST['description'],
        'resolu' => $_POST['resolu']
    );
    
    $controller->createAlerte($data);
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css">
    <title>Ajouter une alerte</title>
</head>
<body>
    <h1>Ajouter une alerte</h1>
    <a href="../../index.php" class="back-link">Retour à l'accueil</a>
    <form method="POST">
    <label>Type de l'alerte :</label><br>
        <select name="type" required>
            <option value="lit">Lit</option>
            <option value="equipement">Equipement</option>
    </select><br>

    <div class="form-group">
            <label for="description">Description</label>
            <input type="text" id="description" name="description" max_length="255" required>
        </div>
        <label>Résolu ou non</label><br>
        <input type="radio" name="resolu" value="1" required> Resolu
        <input type="radio" name="resolu" value="0" required> Non Resolu
        <br>

        <input type="submit" value="Ajouter" name="Ajouter">
    </form>
</body>
</html>
