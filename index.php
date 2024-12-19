<?php
// Inclusion du modèle pour interagir avec la base de données
?>

<?php
  require_once 'models/Modele.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>H3DMP Hospital</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header class="navbar">
    <div class="logo">
      <a href="index.php">
        <img src="assets/logo.png" alt="H3DMP Logo">
      </a>
    </div>
    <div class="nav-buttons">
      <a href="views/auth/login.php" class="button">
        <img src="assets/login.png" alt="Login Icon">Login</a>
    </div>
  </header>
  <main>
    <div class="main-buttons">
      <a href="views/alertes" class="button">Alertes</a>
      <a href="views/equipements" class="button">Equipements</a>
      <a href="views/lits" class="button">Lits</a>
      <a href="views/patients" class="button">Patients</a>
    </div>
  </main>
</body>
</html>
