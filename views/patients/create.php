<?php
include_once '../../controllers/PatientController.php';


// Création du contrôleur
$controller = new PatientController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $date = new DateTime();
    $date = $date->format('Y-m-d H:i:s');
    $data = array(
        'nom' => $_POST['name'],
        'prenom' => $_POST['surname'],
        'date_naissance' => $_POST['date_naissance'],
        'contact' => $_POST['contact'],
        'adresse' => $_POST['adresse'],
        'date_creation' => $date,
        'date_modification' => $date ,
    );
    $controller->createPatient($data);
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Patient</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body class="container">
    <h1 class="page-title">Ajouter un Patient</h1>
    <a href="../../index.php" class="back-link">Retour à l'accueil</a>
    <form method="POST" class="form-container">
        <div class="form-group">
            <label for="name">Nom :</label>
            <input type="text" id="name" name="name" max_length="256" required>
        </div>
        <div class="form-group">
            <label for="surname">Prénom :</label>
            <input type="text" id="surname" name="surname" max_length="256" required>
        </div>
        <div class="form-group">
            <label for="date_naissance">Date de Naissance :</label>
            <input type="date" id="date_naissance" name="date_naissance" required>
        </div>
        <div class="form-group">
            <label for="contact">Contact :</label>
            <input type="text" id="contact" name="contact" required>
        </div>
        <div class="form-group">
            <label for="adresse">Adresse :</label>
            <input type="text" id="adresse" name="adresse" required>
        </div>
        <div class="form-actions">
            <input type="submit" value="Ajouter" name="Ajouter" class="btn btn-primary">
        </div>
    </form>
</body>
</html>
