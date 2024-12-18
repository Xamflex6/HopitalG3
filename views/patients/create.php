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
        'lit_id' => $_POST['lit_id']
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
</head>
<body>
    <h1>Ajouter un Patient</h1>
    <form method="POST">
        <label>Nom :</label><br>
        <input type="text" name="name" max_length="256" required><br>

        <label>Prénom :</label><br>
        <input type="text" name="surname" max_length="256" required><br>

        <label>Date de Naissance :</label><br>
        <input type="date" name="date_naissance" required><br>

        <label>Contact :</label><br>
        <input type="text" name="contact" required><br>

        <label>Adresse :</label><br>
        <input type="text" name="adresse" required><br>

        <label>Numéro de Lit :</label><br>
        <input type="number" name="lit_id" min="1" required><br>

        <input type="submit" value="Ajouter" name="Ajouter">
    </form>
</body>
</html>
