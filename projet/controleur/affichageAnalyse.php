<?php
session_start();
require_once '../modele/historique.class.php';
require_once '../modele/taches.class.php';
require_once '../modele/historiqueDAO.php';
require_once '../modele/tachesDAO.php';

$historique = new HistoriqueDAO();
$taches = new TachesDAO();

// Charger les données nécessaires
$suggestions = $_SESSION['suggestions'] ?? null;
$statistiques = $_SESSION['statistiques'] ?? null;

// Fonction de conversion Markdown -> HTML
function markdownToHtml($markdown) {
    $markdown = preg_replace('/^(#{6})\s(.+)/m', '<h6>$2</h6>', $markdown);
    $markdown = preg_replace('/^(#{5})\s(.+)/m', '<h5>$2</h5>', $markdown);
    $markdown = preg_replace('/^(#{4})\s(.+)/m', '<h4>$2</h4>', $markdown);
    $markdown = preg_replace('/^(#{3})\s(.+)/m', '<h3>$2</h3>', $markdown);
    $markdown = preg_replace('/^(#{2})\s(.+)/m', '<h2>$2</h2>', $markdown);
    $markdown = preg_replace('/^(#{1})\s(.+)/m', '<h1>$2</h1>', $markdown);
    $markdown = preg_replace('/^[-*]\s(.+)/m', '<li>$1</li>', $markdown);
    $markdown = preg_replace_callback('/(<li>.+<\/li>)+/s', function ($matches) {
        return '<ul>' . $matches[0] . '</ul>';
    }, $markdown);
    $markdown = preg_replace('/\*\*(.+?)\*\*/', '<strong>$1</strong>', $markdown);
    $markdown = preg_replace('/__(.+?)__/', '<strong>$1</strong>', $markdown);
    $markdown = preg_replace('/\*(.+?)\*/', '<em>$1</em>', $markdown);
    $markdown = preg_replace('/_(.+?)_/', '<em>$1</em>', $markdown);
    $markdown = preg_replace('/`(.+?)`/', '<code>$1</code>', $markdown);
    $markdown = preg_replace('/```(.+?)```/s', '<pre><code>$1</code></pre>', $markdown);
    $markdown = nl2br($markdown);
    return $markdown;
}


    $contenuHtml = markdownToHtml($suggestions);
    $statistiquesHtml = markdownToHtml($statistiques);
   
    if(isset($_POST['motivation'])){
        header("Location:../controleur/PageMotivation.php");
        exit();
    }
    if(isset($_POST['regenerer'])){
        $nbiteration = $historique->countByCvId($_SESSION['cv'])+1;
        $unHstorique = new Historique(null,$_SESSION['cv'],$nbiteration,$statistiques,null);
        $historique->insert($unHstorique);
        $idtache = $_SESSION['tache'];
        $taches->updateStatus($idtache, "En attente");
        header("Location:../controleur/chargement.php");
        exit();
    }
    $nb = $historique->countByCvId($_SESSION['cv']);
    if($nb > 0){
        $unHstoriqueVdeux = $historique->getLatestStatisticsByCvId($_SESSION['cv']);
        $lll = $unHstoriqueVdeux->getIdHistorique();
        $statistiquesVdeux = $unHstoriqueVdeux->getStatistique();
        if($statistiquesVdeux == null){
            $statistiquesVdeux = "Aucune statistique n'est disponible pour cette itération";
        }
        $apresIteration = "<h2>Apres l'iteration $nb</h2>";
        $statistiquesHtmlVdeux = markdownToHtml($statistiquesVdeux);
        $AjoutSectionSite = "<h2> iteration 1</h2>
            <br></br>
            <br></br>
            $statistiquesHtmlVdeux
            <br></br>
            <br></br>";
    }
    else{
        $AjoutSectionSite = "";
    }


require_once '../public/affichageAnalyse.view.php';
?>