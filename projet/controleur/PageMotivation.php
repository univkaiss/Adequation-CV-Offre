<?php
session_start();

$cheminfichier= "var/www/html/projetCV/projet/controleur/uploads/Lettre_Motivation.pdf"; //$_SESSION['cheminFichier'];

if(isset($_POST['Accueil'])){
    header("Location:../public/PageUtilisateur.html");
    exit();
}

if(isset($_POST['Déconnexion'])){
   
    header("Location:../public/login-fr.html");
    exit();
}

if(isset($_POST['Paramètres'])){
    header("Location:../public/settings-fr.html");
    exit();
}

include "../public/PageMotivation.view.php";
?>