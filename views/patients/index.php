
<?php require '../../controllers/PatientController.php' ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Patients</title>
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
    <div class="container mt-5">
        <h1 class="mb-4">Liste des Patients</h1>
        <div class="box">
            <a href="create.php" class="btn btn-primary">Ajouter un Patient</a>
        </div>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Date de Naissance</th>
                    <th>Adresse</th>
                    <th>Contact</th>
                    <th>Date de Création</th>
                    <th>Date de Modification</th>
                </tr>
            </thead>
            <?php

            $Patients = new PatientController();

            $patients = $Patients->getAllPatients(); 


            foreach ($patients as $patient) {
                echo "<tr>
                    <td>{$patient['nom']}</td>
                    <td>{$patient['prenom']}</td>
                    <td>{$patient['date_naissance']}</td>
                    <td>{$patient['adresse']}</td>
                    <td>{$patient['contact']}</td>
                    <td>{$patient['date_creation']}</td>
                    <td>{$patient['date_modification']}</td>
                </tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>