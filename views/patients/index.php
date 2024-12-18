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
                    <th>Sexe</th>
                    <th>Adresse</th>
                    <th>Contact</th>
                    <th>Actif</th>
                    <th>Date de Création</th>
                    <th>Date de Modification</th>
                    <th>Numéro de Lit</th>
                    <th>Numéro de Chmabre</th>
                </tr>
            </thead>
            <?php
            $patients = [
                [
                    'nom' => 'Malaise',
                    'prenom' => 'Antoine',
                    'date_naissance' => '1910-01-01',
                    'sexe' => '2x/semaine',
                    'adresse' => '123 Rue Exemple',
                    'contact' => '0123456789',
                    'actif' => 'Oui',
                    'date_creation' => '2023-01-01',
                    'date_modification' => '2023-01-10',
                    'numero_lit' => '101',
                    'numero_chambre' => '101',
                ],
                
            ];

            foreach ($patients as $patient) {
                echo "<tr>
                    <td>{$patient['nom']}</td>
                    <td>{$patient['prenom']}</td>
                    <td>{$patient['date_naissance']}</td>
                    <td>{$patient['sexe']}</td>
                    <td>{$patient['adresse']}</td>
                    <td>{$patient['contact']}</td>
                    <td>{$patient['actif']}</td>
                    <td>{$patient['date_creation']}</td>
                    <td>{$patient['date_modification']}</td>
                    <td>{$patient['numero_lit']}</td>
                    <td>{$patient['numero_chambre']}</td>
                </tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>