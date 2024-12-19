<?php 
require_once '../../controllers\AlerteController.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alertes</title>
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
    <div class="container">
        <h1>Alertes</h1>
        <div class="box">
            <a href="create.php" class="btn btn-primary">Ajouter une alerte</a>
        </div>
        <div class="alert-list">
            <?php 
                $alertesController = new AlerteController();

                $alertes = $alertesController->getAllAlerte(); 

                if ($alertesController->getNombreAlerte() == 0) {
                    echo "<p>Pas d'alertes pour le moment.</p>";
                }
                else {
                    foreach ($alertes as $alerte) {
                        echo "<div class=\"alert\">" ;
                        echo "<h2 class =" .$alerte['resolu'] . ">" . "Alerte " . $alerte['alerte_id'] . " : " . $alerte['alerte_type'] . "</h2>";
                        echo "<p>" . $alerte['alerte_description'] . "</p>";
                        echo "<span class=\"timestamp\">" . $alerte['date_creation'] . "</span>";
                        echo "</div>";
                    }
                }
                
            
            ?>
            </div>
        </div>
    </div>
</body>
</html>
