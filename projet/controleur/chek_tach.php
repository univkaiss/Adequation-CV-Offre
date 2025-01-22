<?php
session_start();
ob_start(); // Capturer toute sortie
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

// Vérification des variables de session
$idCv = isset($_SESSION['cv']) ? $_SESSION['cv'] : null;
$idOffre = isset($_SESSION['offre']) ? $_SESSION['offre'] : null;
$idTache = isset($_SESSION['tache']) ? $_SESSION['tache'] : null;

if ($idCv === null || $idOffre === null || $idTache === null) {
    error_log("Erreur : Les variables de session ne sont pas définies.");
    ob_end_clean();
    echo json_encode(['etat' => 'Erreur', 'message' => 'Variables de session manquantes.']);
    exit;
}

require_once '../modele/tachesDAO.php';
require_once '../modele/analyseDAO.php';
require_once '../modele/taches.class.php';
require_once '../modele/analyse.class.php';

$tachesDAO = new TachesDAO();
$analyseDAO = new AnalyseDAO();

$response = ['etat' => 'En attente'];
if ($tachesDAO->checkTaskStatusByIdAndStatus($idTache, 'Termine')) {
    $uneAnalyse = $analyseDAO->getAnalysisByIdCvAndIdOffre($idCv, $idOffre);

    if ($uneAnalyse) {
        $_SESSION['suggestions'] = $uneAnalyse->getSuggession();
        $_SESSION['statistiques'] = $uneAnalyse->getStatistique();

        // Gérer la lettre de motivation
       // $lettreDeMotivation = $uneAnalyse->getLettreDeMotivation();
       // $Nomfichier = $uneAnalyse->getNomFichier();
        //if (!empty($lettreDeMotivation)) {
           /* $dossier = __DIR__ . '/uploads/';
            if (!is_dir($dossier)) mkdir($dossier, 0777, true);
            $cheminFichier = $dossier . $Nomfichier;
            $_SESSION['cheminFichier'] = $cheminFichier;
            file_put_contents($cheminFichier, $lettreDeMotivation);*/
            // $cheminFichier ="../../../../../../home/ia/projetcv/motivation_letter.pdf";

            // $cheminFichier = "../../../ia/motivation_letter.pdf";
            // $cheminFichier ="/home/ia/projetcv/motivation_letter.pdf";
            $cheminFichier ="/home/ia/projetcv/Lettre_Motivation_KAISS.pdf";


            $_SESSION['cheminFichier'] = $cheminFichier;
        //}
        $response = ['etat' => 'Termine', 'cheminFichier' => $cheminFichier ?? null];
    } else {
        error_log("Erreur : Aucune analyse trouvée.");
    }
} else {
    error_log("Tâche non terminée ou introuvable.");
}

ob_end_clean(); // Nettoyer la sortie
echo json_encode($response);
exit;
?>