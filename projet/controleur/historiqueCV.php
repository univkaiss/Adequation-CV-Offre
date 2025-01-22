<?php

session_start();

require_once '../modele/cvsDAO.php';
require_once "../modele/utilisateurDAO.php";

$cvsDAO = new CVsDAO();
$utilisateurDAO = new UtilisateurDAO();
$email = $_SESSION['email'];
echo "jdjdjdjdjd";
$utilisateur = $utilisateurDAO->getByEmail($email)->getIdUtilisateur();

echo $utilisateur;
$cvs=$cvsDAO->getAllByUserId2($utilisateur);

if($cvs != null){
    echo "kkkkkkkkkkkkkkkkk";
}

$idcv=$cvsDAO->getLastIdCvByUserId($utilisateur);

if (isset($_POST['supprimer'])) {
    $cvsDAO->delete($idcv);
    header('Location: historiqueCV.php');
    exit();
}

if(isset($_POST['Profil'])){
   
    header("Location: PageProfil.php");
    exit();
}

if(isset($_POST['Déconnexion'])){
   
    header("Location: login.php");
    exit();
}

if(isset($_POST['Paramètre'])){
    header("Location: settings.php");
    exit();
}

include '../public/historiqueCV.view.php';



?>

