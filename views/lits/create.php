<?php
include_once '../../controllers/LitController.php';


// Création du contrôleur
$controller = new LitController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $data = array(
        'disponible' => $_POST['disponible'],
        'type_lit' => $_POST['type'],
          
    );
    $controller->createLit($data);
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css">
    <title>Ajouter un lit</title>
</head>
<body>
    <h1>Ajouter un lit</h1>
    <a href="../../index.php" class="back-link">Retour à l'accueil</a>
    <form method="POST">

        <label>Disponibilité</label><br>
        <input type="radio" name="disponible" value="1" required> Disponible
        <input type="radio" name="disponible" value="0" required> Non disponible
        <br>

        <label>Type du lit :</label><br>
        <select name="type" required>
            <option value="Standard">Standard</option>
            <option value="Pédiatrique">Pédiatrique</option>
            <option value="Intensif">Intensif</option>
    </select><br>

        <label>Numéro de chambre :</label><br>
        <input type="number" name="chambre" min="1"><br>

        <input type="submit" value="Ajouter" name="Ajouter">
    </form>
</body>
</html>
