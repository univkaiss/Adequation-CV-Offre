<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Chargement</title>
    <style>
        /* Style global pour un rendu moderne */
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #74b9ff, #81ecec);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        /* Conteneur principal du loader */
        #loader {
            text-align: center;
            animation: fadeIn 1.5s ease-in-out;
        }

        /* Animation de rotation circulaire */
        .loader-animation {
            width: 80px;
            height: 80px;
            border: 8px solid rgba(255, 255, 255, 0.3);
            border-top: 8px solid #ffffff;
            border-radius: 50%;
            margin: auto;
            animation: spin 1s linear infinite;
        }

        /* Texte de chargement */
        .loading-text {
            margin-top: 20px;
            font-size: 20px;
            font-weight: bold;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }

        /* Animation de rotation */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Animation d'apparition */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body>
    <div id="loader">
        <div class="loader-animation"></div>
        <div class="loading-text">Chargement en cours...</div>
    </div>
    <?php
    // Ajoutez ici votre logique de chargement, si nécessaire
    ?>
    <script>
        function checkTache() {
            fetch('../controleur/chek_tach.php')
                .then(response => {
                    console.log('Statut de la réponse:', response.etat);
                    console.log('Contenu de la réponse:', response);
                    return response.json();
                })
                .then(response => {
                    console.log('Données reçues:', response); // Ajoutez un log pour vérifier la réponse
                    if (response.etat === 'Termine') {
                        window.location.href = '../controleur/affichageAnalyse.php'; // Rediriger vers la page des résultats
                    }
                })
                .catch(error => {
                    console.error('Erreur lors de la vérification de la tâche:', error);
                });
        }
        // Vérifier toutes les 5 secondes
        let intervalId = setInterval(checkTache, 5000);
    </script>
</body>
</html>
