<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/styles.css">
    <script src="../js/translations.js" defer></script>
    <script defer src="./bundle.js"></script>
    <title>Mot de passe oublie</title>
</head>
<body>
    <header>
        <img src="logo-placeholder.png" alt="Logo">
        <div class="language-switch">
            <a class="lang-btn active" id="fr-btn">FR</a>
            <a class="lang-btn" id="en-btn">EN</a>
        </div>
    </header>
    <main>
        <h1 id="title-label">Bienvenue !</h1>
        
        <?php if (!empty($message)) { ?>
                <div class="erreur"><?php echo $message; ?></div>
        <?php } ?>

        <h1 id="title-label">Entrez votre adresse email pour renit le mot de passe</h1>


        <form action="oubliemdp.php" method="POST">
            <label for="email" id="email-label">E-Mail :</label>
            <input type="email" id="email" name="email" placeholder="Veuillez entrer votre adresse mail" required>

            <button type="submit" id="suivant-label">Envoyer</button>
        </form>
       
    
        <footer>
            <a href="#" id="aide-label">Aide</a> | <a href="#" id="contact-label">Nous contacter</a>
        </footer>
    </main>
</body>
</html>
