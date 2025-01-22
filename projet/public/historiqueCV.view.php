<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../public/css/style.css" rel="stylesheet" />
    <title>Historique de vos CV</title>
    
</head>

<body>
<form action="historiqueCV.php" method="POST">
<div class="contient">
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
                        <a><button type="submit" class="lien" name="Profil">Profil</button></a>
                        <a><button type="submit" class="lien" name="Paramètre">Paramètre</button></a>
                        <a><button type="submit" class="lien" name="Déconnexion">Déconnexion</button></a>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <h1> Historique de vos CV</h1>
    <table>
        <thead>
            <tr>
                <th>Vos CV</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="cv-list">
                <?php foreach ($cvs as $fic): ?>
            <tr>
                <td><?= $fic->getNomFichier() ?></td>
                <td>
                <a href="../uploads/CV%20KAISS-1.pdf" download="CV_KAISS-1.pdf">
                        <button class="bouton sauvegarder" type="button">Enregistrer / exporter</button>
                
                     <button class="bouton supprimer" type="submit" name="supprimer">Supprimer</button>
                     
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
            </tr>
        </tbody>
    </table>
    </div>
</form>
</body>
</html>
