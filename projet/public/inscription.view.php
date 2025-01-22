<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/elyts.css">
    <script src="../js/translations.js" defer></script>
    <script>
    document.addEventListener("DOMContentLoaded", () => {
        console.log("JavaScript chargé !");
        switchLanguage('fr', 'register');
    });
   </script>
   <title>Inscription</title>
</head>

<body>
    <header>
    <div class="logo">
            <img src="../public/css/img/logo_1.png" alt="Logo"  height=""/>
            </div>
        <div class="language-switch">
            <a class="lang-btn active" id="fr-btn" onclick="switchLanguage('fr', 'register')">FR</a>
            <a class="lang-btn" id="en-btn" onclick="switchLanguage('en', 'register')">EN</a>
        </div>
    </header>
    <main>
        <h1 id="title-label">Inscription</h1>

        <?php if (!empty($message)) { ?>
                <div class="erreur"><?php echo $message; ?></div>
            <?php } ?>
            
        <form action="inscription.php" method="POST" class ="signup">
             <div>
                <label for="nom" id="nom-label">Nom :</label>
                <input type="nom" id="nom" name="nom"  required>
            </div>
            <div>
                <label for="prenom" id="prenom-label">Prenom :</label>
                <input type="prenom" id="prenom" name="prenom"  required>
            </div>
            <div>
                <label for="email" id="email-label">E-Mail :</label>
                <input type="email" id="email" name="email"  required>
            </div>
            <div>
                <label for="password" id="password-label">Mot de Passe :</label>
                <input type="password" id="password" name="password"  required>
            </div>
            <div>
                <label for="confirm-password" id="confirm_password-label">Confirmez votre mot de passe :</label>
                <input type="password" id="confirm-password" name="confirm-password" required>
            </div>
            <br><br>
            <p id="error-message" style="color: red; display: none;"></p>
            <button type="submit" id="register_btn-label">S'inscrire</button>
        </form>
        <p id="already_account-label">
            Vous avez déjà un compte ? 
        </p>
        <a href="login.php" id="login_link-label">Connectez-vous</a>
        <footer>
            <a href="../public/aide.view.php" id="aide-label"  target="_blank">Aide</a> 
        </footer>
    </main>
</body>
</html>