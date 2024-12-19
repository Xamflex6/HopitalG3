<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un équipement</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <h1>Ajouter un nouvel équipement</h1>
    <a href="../../index.php" class="back-link">Retour à l'accueil</a>
    <form action="" method="POST">
        <div>
            <label for="type_equipement">Type d'équipement :</label>
            <select id="type_equipement" name="type_equipement" required>
                <option value="moniteur_de_frequence_cardiaque">Moniteur de fréquence cardiaque</option>
                <option value="moniteur_de_respiration">Moniteur de respiration</option>
                <option value="moniteur_de_temperature">Moniteur de température</option>
                <option value="appareil_de_surveillance_de_la_saturation_en_oxygene">Appareil de surveillance de la saturation en oxygène</option>
                <option value="moniteur_multiparametrique">Moniteur multiparamétrique</option>
                <option value="ventilateur_mecanique">Ventilateur mécanique</option>
                <option value="appareils_de_perfusions_intraveineuse">Appareils de perfusions intraveineuse</option>
            </select>
        </div>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>
