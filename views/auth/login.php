<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Connexion</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
  <header class="navbar">
    <div class="logo">
      <a href="../../index.php">
        <img src="../../assets/logo.png" alt="H3DMP Logo">
      </a>
    </div>
  </header>
<body>
    <div class="login-page">
        <div class="login-container">
            <h2 class="login-title">Connexion</h2>
            <form action="../../index.php?action=login" method="POST" class="login-form">
                <div class="form-group">
                    <label for="username">Nom d'utilisateur</label>
                    <input type="text" id="username" name="username" class="form-input" placeholder="Entrez votre nom d'utilisateur" required>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" class="form-input" placeholder="Entrez votre mot de passe" required>
                </div>
                <button type="submit" class="btn-login">Se connecter</button>
            </form>
        </div>
    </div>
</body>
</html>
