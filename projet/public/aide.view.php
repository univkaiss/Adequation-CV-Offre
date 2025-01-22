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
        switchLanguage('fr', 'aide');
    });
    </script>
    <title id="title">Aide</title>
</head>
<body>
    <header>
        <img src="logo-placeholder.png" alt="Logo">
        <div class="header-actions">
            <div class="language-switch">
                <a class="lang-btn active" id="fr-btn" onclick="switchLanguage('fr', 'aide')">FR</a>
                <a class="lang-btn" id="en-btn" onclick="switchLanguage('en', 'aide')">EN</a>
            </div>
        </div>
    </header>
    <main>
        <h1 id="aide_title-label">Aide</h1>

        <section>
            <h2 id="section_comment_utiliser-label">Comment utiliser le site ?</h2>
            <p id="comment_utiliser_description-label">
                Notre site vous accompagne dans vos démarches de candidature en vous offrant :
                <ol>
                    <li id="analyse_cv_offres-label">Analyse de CV et offres d'emploi : Téléchargez votre CV et fournissez un lien vers une offre d'emploi. Un taux d'adéquation sera calculé grâce à l'IA.</li>
                    <li id="propositions_ameliorations-label">Propositions d'améliorations : Si le taux est inférieur à 90 %, nous proposons des conseils pour améliorer votre CV.</li>
                    <li id="generation_lettre-label">Génération automatique de lettre de motivation : Une fois votre CV optimisé, créez une lettre de motivation adaptée à l'offre.</li>
                </ol>
            </p>
        </section>

        <section>
            <h2 id="section_etapes_inscription-label">Étapes pour s'inscrire et se connecter</h2>
            <p>
                <ol>
                    <li><strong id="inscription_title-label">S'inscrire :</strong>
                        <ul>
                            <li id="inscription_etape1-label">Remplissez les champs demandés (nom, prénom, email, mot de passe).</li>
                            <div class="alert" id="attention-label">
                                 <strong>Attention :</strong> Votre adresse email ne peut pas être modifiée. 
                                 Seuls votre nom et prénom peuvent être mis à jour par la suite sur votre page profil.
                            </div>
                            <li id="inscription_etape2-label">Validez votre mot de passe en le confirmant.</li>
                            <li id="inscription_etape3-label">Cliquez sur "S'inscrire".</li>
                        </ul>
                    </li>
                    <li><strong id="connexion_title-label">Se connecter :</strong>
                        <ul>
                            <li id="connexion_etape1-label">Accédez à la page de connexion.</li>
                            <li id="connexion_etape2-label">Saisissez votre email et mot de passe.</li>
                            <li id="connexion_etape3-label">Cliquez sur "Continuer".</li>
                        </ul>
                    </li>
                </ol>
            </p>
        </section>

        <section>
            <h2 id="section_analyse_cv-label">Comment analyser votre CV ?</h2>
            <p id="analyse_cv_description-label">
                <ol>
                    <li id="analyse_cv_etape1-label">Connectez-vous à votre compte.</li>
                    <li id="analyse_cv_etape2-label">Accédez à la section "Analyse".</li>
                    <li id="analyse_cv_etape3-label">Importez votre CV et ajoutez un lien vers une offre d'emploi.</li>
                    <li id="analyse_cv_etape4-label">Cliquez sur "Analyser".</li>
                    <li id="analyse_cv_etape5-label">Consultez les résultats pour voir le taux d'adéquation et les suggestions d'amélioration.</li>
                </ol>
            </p>
        </section>

        <section>
            <h2 id="section_lettre_motivation-label">Comment créer une lettre de motivation ?</h2>
            <p id="lettre_motivation_description-label">
                Une fois votre CV optimisé :
                <ol>
                    <li id="lettre_motivation_etape1-label">Accédez à la section "Générer une lettre de motivation".</li>
                    <li id="lettre_motivation_etape2-label">Entrez les informations nécessaires (exigences de l'offre, compétences clés, etc.).</li>
                    <li id="lettre_motivation_etape3-label">Cliquez sur "Générer".</li>
                </ol>
            </p>
        </section>
    </main>
</body>
</html>