<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Utilisateur</title>
    <link rel="stylesheet" href="../public/css/PageUtilisateur.css">
</head>

<body>
    <form action="pageUtilisateur.php" method="POST">
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
                    <?= $nom ?>
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
            <div class="contenu">
                <div class="contenu-principal">
                    <section class="resume-actions">
                    <img src="../public/css/img/cv-4074274_640.png" width="300" height="350">
                    <br><br><br><br><br><br>
                    <img src="../public/css/img/image-removebg-preview.png" width="450" height="200">
                    </section>
                    <section class="cartes">
                        
                        <div class="bienvenue">
                            <h1>Bienvenue <?= $nom ?></h1>
                            <p class="accroche">
                                Transformez chaque candidature en opportunité : créez un CV percutant et une lettre de
                                motivation sur-mesure adaptés à l'offre d'emploi de vos rêves !
                            </p>
                        </div>
                        <div class="carte">
                            <h3>Historique des CV</h3>
                            <p>Vos CV précédents : consultez, modifiez et réutilisez facilement vos créations !<br></p>
                            <a><button type="submit" class="lien" name="Continue">Continuer →</button></a>
                        </div>
                        <div class="carte">
                            <h3>Analyse de CV</h3>
                            <p>Analysez votre CV : obtenez des conseils personnalisés pour l’optimiser et décrocher
                                le poste idéal !</p>
                            <a><button type="submit" class="lien" name="Continuer">Continuer →</button></a>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </form>
</body>

</html>