<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Patient</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <h1>Ajouter un Patient</h1>
    <form action="#" method="POST">
        <div>
            <label for="name">Nom:</label>
            <input type="text" name="name" max_length="256" required>
        </div>
        <div>
            <label for="age">Âge:</label>
            <input type="number" name="age" min="0" required>
        </div>
        <div>
            <label for="gender">Sexe:</label>
            <select name="gender" required>
                <option value="male">Homme</option>
                <option value="female">Femme</option>
                <option value="other">Autre</option>
            </select>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="phone">Téléphone:</label>
            <input type="tel" id="phone" name="phone" required>
        </div>
        <div>
            <label for="address">Adresse:</label>
            <input type="text" id="address" name="address" required>
        </div>
        <div>
            <label for="contact">Contact:</label>
            <input type="text" id="contact" name="contact" required>
        </div>
        <div>
            <label for="bed_number">Numéro de lit:</label>
            <input type="number" id="bed_number" name="bed_number" min="0" required>
        </div>
        <div>
            <label for="room_number">Numéro de chambre:</label>
            <input type="number" id="room_number" name="room_number" min="0" required>
        </div>
        <div>
            <button type="submit">Ajouter</button>
        </div>
    </form>
</body>
</html>