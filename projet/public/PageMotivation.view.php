<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Génération de lettre de motivation</title>
    <link rel="stylesheet" href="../public/css/PageMotivation.css">
</head>
<body>
    <form action="PageMotivation.php" method="POST">
    <div class="conteneur">
    <header>
        <div class="logo">Logo</div>
        <nav class="barre-navigation">
            <div class="langue">
                <button aria-label="changer en Anglais">EN</button>
                <button class="actif" aria-label="Langue actuelle : Français">FR</button>
            </div>
            <div class="utilisateur">
                <a href="../controleur/login.php">Connexion</a>
                    
                </div>
            </div>
        </nav>
    </header>
        <main class="contenu-principal">
            <h1>Lettre de motivation générée</h1>
            <div class="zone-lettre">
                <embed id="pdfEmbed" src="./uploads/Lettre_Motivation.pdf" type="application/pdf"/>
            </div>
            <div class="zone-boutons">
                <button class="bouton generer">Régénérer</button>
                <button class="bouton sauvegarder" onclick="downloadPDF()">Enregistrer / exporter</button>
            </div>
        </main>
    </div>
    <script>
        function downloadPDF() {
            const pdfURL = document.getElementById('pdfEmbed').src;
            const link = document.createElement('a');
            link.href = pdfURL;
            link.download = 'lettre-de-motivation.pdf';
            link.click();
        }
    </script>
    </form>
</body>
</html>