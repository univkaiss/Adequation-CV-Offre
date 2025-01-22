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
        switchLanguage('fr', 'login');
    });
   </script>
    <title>Connexion</title>
</head>
<body>
    <header>
    <div class="logo">
            <img src="../public/css/img/logo_1.png" alt="Logo"  height=""/>
            </div>
        <div class="language-switch">
        <a class="lang-btn active" id="fr-btn" onclick="switchLanguage('fr', 'login')">FR</a>
        <a class="lang-btn" id="en-btn" onclick="switchLanguage('en', 'login')">EN</a>
        </div>
    </header>
    <main>
        <h1 id="title-label">Bienvenue !</h1>

        <?php if (!empty($message)) { ?>
            <div class="erreur"><?php echo $message; ?></div>
        <?php } ?>

        <form action="login.php" method="POST">
            <div>
                <label for="email" id="email-label">E-Mail :</label>
                <input type="email" id="email" name="email" >
            </div>
            <div>
                <label for="password" id="password-label">Mot de Passe :</label>
                <input type="password" id="password" name="password">
            </div>
            <!--<a href="oubliemdp.php" id="forgot_password-label">Vous avez oublié votre mot de passe ?</a>-->
            <br><br>
            <button type="submit" id="suivant-label">Continuer</button>
        </form>
        <br><br>
        <p id="nocompte-label">
            Vous n'avez pas de compte ? 
        </p>
        <br>
        <a href="inscription.php" id="inscrire-label">Inscrivez-vous</a>
        <footer>
            <a href="../public/aide.view.php" id="aide-label"  target="_blank">Aide</a> 
        </footer>
    </main>
</body>
</html>