<?php
session_start();
require_once('tachesDAO.php');
require_once('analyseDAO.php');
require_once('taches.class.php');
require_once('analyse.class.php');
$idCv = 10; //$_SESSION['cv'];
$idOffre = 9 ;//$_SESSION['offre'];
$tachesDAO = new TachesDAO();
$analyseDAO = new AnalyseDAO();

// Boucle infinie pour vérifier les tâches toutes les 5 secondes
while (true) {
    $idtache = $tachesDAO->getPendingIdByCvAndOffre($idCv, $idOffre); // Récupérer la tâche avec l'id CV et l'id offre
    $unetache = $tachesDAO->getPendingById($idtache); // Récupérer les tâches avec l'id CV et l'id offre
        if ($unetache->getEtat() === 'Terminé') {
            $uneAnalyse = $analyseDAO->getAnalysisByIdCvAndIdOffre($idCv, $idOffre);
            if ($uneAnalyse !== null) {
                $suggestions = $uneAnalyse->getSuggession();
                $statistiques = $uneAnalyse->getStatistique();
                $lettreDeMotivation = $uneAnalyse->getLettreDeMotivation();
            } else {
                $suggestions = null;
                $statistiques = null;
                $lettreDeMotivation = null;
            }
        }
    }

    // Attendre 5 secondes avant de vérifier à nouveau
    sleep(5);
?>