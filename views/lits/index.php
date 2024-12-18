<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Lits</title>
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
    <div class="containerLit">
        <h1>Gestion des Lits Disponibles</h1>
        <button id="addBedBtn">Ajouter un Lit</button>
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Type de Lit</th>
                <th>Status</th>
                <th>Date de modification</th>
            </tr>
            </thead>
            <tr id="bedList">
            </tr>
        </table>
    </div>

    <div id="bedModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 id="modalTitle">Ajouter un Lit</h2>
            <form id="bedForm">
                <input type="hidden" id="bedId">
                <div>
                    <label for="bedName">Type de Lit:</label>
                    <input type="text" id="bedName" required>
                </div>
                <div>
                    <label for="bedStatus">Statut:</label>
                    <select id="bedStatus" required>
                        <option value="Disponible">Disponible</option>
                        <option value="Occupé">Occupé</option>
                    </select>
                </div>
                <button type="submit">Enregistrer</button>
            </form>
        </div>
    </div>
</body>
</html>