<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création Equipements</title>
</head>
<body>
    <form action="../../controllers/EquipementController.php" method="POST">
        <label for="type_equipement">Type d'équipement</label>
        <select name="type_equipement" id="type_equipement">
            <option value="Moniteur de fréquence cardiaque">Moniteur de fréquence cardiaque</option>
            <option value="Moniteur de respiration">Moniteur de respiration</option>
            <option value="moniteur de respiration">moniteur de respiration</option>
            <option value="moniteur de temperature">moniteur de temperature</option>
            <option value="appareil de surveillance de la saturation en oxygene">appareil de surveillance de la saturation en oxygene</option>
            <option value="moniteur multiparametrique">moniteur multiparametrique</option>
            <option value="ventilateur mecanique">ventilateur mecanique</option>
            <option value="appareil de perfusion intraveineuse">appareil de perfusion intraveineuse</option>
        </select>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>