<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/profil.css">
    <script src="../js/translations.js" defer></script>
    <script>
    document.addEventListener("DOMContentLoaded", () => {
        console.log("JavaScript chargé !");
        switchLanguage('fr', 'profil');
    });
   </script>
    <title>Page profil</title>
</head>
<body>
    <header>
        <img src="logo-placeholder.png" alt="Logo">
        <div class="header-actions">
            <div class="language-switch">
            <a class="lang-btn active" id="fr-btn" onclick="switchLanguage('fr', 'profil')">FR</a>
            <a class="lang-btn" id="en-btn" onclick="switchLanguage('en', 'profil')">EN</a>
            </div>
            <?php if ($utilisateur) : ?>
                <form action="PageProfil.php" method="POST" class="logout-form">
                    <input type="hidden" name="action" value="logout">
                    <button type="submit">Se déconnecter</button>
                </form>
            <?php endif; ?>
        </div>
    </header>

    <main>
        <h1 id="title-label">Page profil</h1>
        
        <?php if (!empty($message)) { ?>
                <div class="erreur"><?php echo $message; ?></div>
        <?php } ?>

        <?php if ($utilisateur) : ?>
            <form action="PageProfil.php" method="POST">
                <label for="nom" id="nom-label">Nom :</label>
                <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($utilisateur->getNom()); ?>" required>
                <br>

                <label for="prenom" id="prenom-label">Prénom :</label>
                <input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($utilisateur->getPrenom()); ?>" required>
                <br>

                <label for="email" id="email-label">Email :</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($utilisateur->getEmail()); ?>" disabled>
                <br>

                <label for="date_inscription" id="date-label">Date d'inscription :</label>
                <input type="text" id="date_inscription" name="date_inscription" value="<?= htmlspecialchars($utilisateur->getDateInscription()); ?>" disabled>
                <br>

                <button type="submit" id="save-label">Enregistrer les modifications</button>
            </form>
            <form action="PageProfil.php" method="POST" class="delete-form">
                    <input type="hidden" name="action" value="delete">
                    <button type="submit">Supprimer le compte</button>
            </form>
        </p>
        <?php else : ?>
            <p id="user-label">Utilisateur non trouvé.</p>
        <?php endif; ?>
       
    
        <footer>
            <a href="../public/aide.view.php" id="aide-label"  target="_blank">Aide</a> 
        </footer>
    </main>
</body>
</html>