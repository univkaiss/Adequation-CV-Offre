<?php


session_start();

require_once "../modele/utilisateurDAO.php";

$utilisateurDAO = new UtilisateurDAO();
$mail=$_SESSION['email'];
$nom=$utilisateurDAO->getNomByEmail($mail);




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

if(isset($_POST['Continue'])){
    header("Location:../controleur/historiqueCV.php");
    exit();
}

if(isset($_POST['Continuer'])){
    header("Location:../controleur/upload.php");
    exit();
}

include "../public/PageUtilisateur.view.php";



?>