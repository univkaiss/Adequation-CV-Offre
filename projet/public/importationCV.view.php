<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/ImportCV.css">
    <title>ImportationCV</title>
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
<form id="uploadForm" action="upload.php" method="post" enctype="multipart/form-data">
    <h1>Analysons votre CV</h1>
    <h3>Bienvenue, veuillez importer votre CV dans une langue et format accepté</h3>
        <label for="imprteCV">Importer un CV</label>
        <input type="file" id="imprteCV" name="file" accept=".pdf,.doc,.docx">
    <script>
        document.getElementById('imprteCV').addEventListener('change', function() {
            document.getElementById('uploadForm').submit();
        });
    </script>
     </form>
</body>
</html>