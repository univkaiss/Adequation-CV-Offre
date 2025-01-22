<?php



if(isset($_POST['Accueil'])){
    header("Location:../public/PageUtilisateur.html");
    exit();
}

if(isset($_POST['Déconnexion'])){
   
    header("Location:../public/login-fr.html");
    exit();
    
}



// Si aucun bouton n'est cliqué, rester sur la même page
header("Location:../public/settings-fr.html");
exit();

?>