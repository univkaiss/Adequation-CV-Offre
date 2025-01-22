<?php
session_start();
require_once '../modele/cvsDAO.php';
require_once '../modele/offreDAO.php';
require_once '../modele/tachesDAO.php';
require_once '../modele/utilisateurDAO.php';
require_once '../modele/cvs.class.php';
require_once '../modele/offre.class.php';
require_once '../modele/taches.class.php';
require_once '../modele/utilisateur.class.php';

    $cv = new CVsDAO();
    $offre = new OffreDAO();
    $taches = new TachesDAO();
    $utilisateur = new UtilisateurDAO();

$fichier = "../uploads/" . $_SESSION['file'];
    $jobLink = filter_input(INPUT_POST, 'jobLink', FILTER_SANITIZE_URL);
    if (filter_var($jobLink, FILTER_VALIDATE_URL)) {
        if($_SESSION['user'] == null){
            $id_anonyme = uniqid();
            $nomFichier = $_SESSION['file'];
            $typeFichier = "pdf";
            $fichierData = file_get_contents($fichier);
            $uncv = new CVs(null,null,$id_anonyme,$nomFichier,$typeFichier,$fichierData);
            $cv->insert($uncv);
            $uneoffre = new Offre(null,$jobLink,null,null,$id_anonyme);
            $offre->insert($uneoffre);

            $idcv = $cv->getIdCvByAnonymeId($id_anonyme);
            $idoffre = $offre->getIdOffreByAnonymeId($id_anonyme);
            $untache = new Taches(null,$idcv,$idoffre,"En attente",null,null,null);
            $taches->insert($untache);
            
            $idtache =  $taches->getPendingIdByCvAndOffre($idcv, $idoffre);
            $_SESSION['tache'] = $idtache;
            $_SESSION['cv'] = $idcv;
            $_SESSION['offre'] = $idoffre;

        }else if($_SESSION['user'] != null){
            $id_utilisateur = $utilisateur->getByEmail($_SESSION['email'])->getIdUtilisateur();
            $nomFichier = $_SESSION['file'];
            $typeFichier = "pdf";
            $fichierData = file_get_contents($fichier);
            $uncv = new CVs(null,$id_utilisateur,null,$nomFichier,$typeFichier,$fichierData);
            $cv->insert($uncv);
            $uneoffre = new Offre(null,$jobLink,null,$id_utilisateur,null);
            $offre->insert($uneoffre);

            $idcv = $cv->getLastIdCvByUserId($id_utilisateur);
            $idoffre = $offre->getLastIdOffreByUserId($id_utilisateur);
            $untache = new Taches(null,$idcv,$idoffre,"En attente",null,null,null);
            $taches->insert($untache);

           $idtache =  $taches->getPendingIdByCvAndOffre($idcv, $idoffre);
            $_SESSION['tache'] = $idtache;
            $_SESSION['cv'] = $idcv;
            $_SESSION['offre'] = $idoffre;
        }
        header("location:chargement.php");
    } else {
        $erreur = "";
    }

include "../public/importLien.view.php";
?>