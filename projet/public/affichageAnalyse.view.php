<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../public/css/style.css" rel="stylesheet" />
    <title>Résultat et comparatif</title>
</head>
<body>
    <header>
        <div class="logo">Logo</div>
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
    <form action="affichageAnalyse.php" method="POST">
    <main>
        <h1 data-translate="Résultat">Résultat</h1>
        <section class="stats">
            <h2 data-translate="Statistiques avant modification">Statistiques avant modification</h2>
            <?= $AjoutSectionSite ?>
            <br></br>
            <br></br>
            <?= $apresIteration ?>
            <p><?= $statistiquesHtml ?></p>
            <br></br>
            <br></br>
        </section>
        <section class="stats">
            <h2 data-translate="Suggestions / Statistiques après modification">Suggestions / Statistiques après modification</h2>
            <br></br>
            <br></br>
            <?=$contenuHtml?>
            <br></br>
            <br></br>
        </section>
        <button class="button" name="regenerer">Regenérer</button>
        <div class="divider"></div>
        <footer>
            <h2 data-translate="Générer une lettre de motivation">Générer une lettre de motivation</h2>
            <button class="button" name="motivation" data-translate="Générer une lettre de motivation">Générer une lettre de motivation</button>
        </footer>
    </main>
</form>
</body>
</html>
