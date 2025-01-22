<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/ImportLien.css">
    <title>Importation lien </title>
</head>
<body>
<header>
<div class="logo">
            <img src="../public/css/img/logo_1.png" alt="Logo"  height=""/>
            </div>
        <nav class="barre-navigation">
            <div class="langue">
                <button aria-label="changer en Anglais">EN</button>
                <button class="actif" aria-label="Langue actuelle : Français">FR</button>
            </div>
            <div class="utilisateur">
                Nom d'utilisateur
                <div class="menu-deroulant">
                    <button class="menu-bouton">
                        ▼
                    </button>
                    <ul class="liste-menu">
                        <li><a href="#">Profil</a></li>
                        <li><a href="#">Paramètres</a></li>
                        <li><a href="#">Déconnexion</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <form action="verifierLien.php" method="post">
    <div class="container">
        <div class="import-section">
            <h1>Importation de lien</h1>
            <h3>Bienvenue, veuillez importer votre lien</h3>
                <input type="text" name="jobLink" id="jobLink" placeholder="Entrez le lien de l'offre d'emploi">
                <button type="submit">Analyser</button>
                <?= $messageErreur ?>
            
        </div>
        <div class="preview-section">
            <h2>Aperçu du CV importé</h2>
            <embed id="cvPreview" src= "<?= $fichier ?>" type="application/pdf" width="100%" height="600px" />
        </div>
    </div>   
</form>
</body>
</html>