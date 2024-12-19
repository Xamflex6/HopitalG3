<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="../../controllers/EquipementController.php" method="POST">
        <label for="type_equipement">Type d'équipement</label>
        <input type="text" name="type_equipement" id="type_equipement">
        <label for="disponible">Disponible</label>
        <input type="text" name="disponible" id="disponible">
        <label for="date_modification">Date de modification</label>
        <input type="text" name="date_modification" id="date_modification">
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>