<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    require_once("../modele/utilisateurDAO.php");

    $utilisateurDAO = new UtilisateurDAO();


    // Collecte des valeurs du formulaire d'inscription
    $valeurs['nom'] = (isset($_POST['nom']) ? trim($_POST['nom']) : null);
    $valeurs['prenom'] = (isset($_POST['prenom']) ? trim($_POST['prenom']) : null);
    $valeurs['email'] = (isset($_POST['email']) ? trim($_POST['email']) : null);
    $valeurs['password'] = (isset($_POST['password']) ? trim($_POST['password']) : null);
    $valeurs['confirm-password'] = (isset($_POST['confirm-password']) ? trim($_POST['confirm-password']) : null);


    //echo( $valeurs['nom'].$valeurs['prenom'].$valeurs['email'].$valeurs['password'].$valeurs['confirm-password']);
    if ($valeurs['email'] && $valeurs['password'] && $valeurs['confirm-password']) {


        
        if (!$utilisateurDAO->existe($valeurs['email'])) {
            if ($valeurs['password'] === $valeurs['confirm-password']) {
                try {
                    $hashed_password = password_hash($valeurs['password'], PASSWORD_DEFAULT);
                    
                    $utilisateur = new Utilisateur(
                        null, 
                        $valeurs['nom'], 
                        $valeurs['prenom'], 
                        $valeurs['email'], 
                        $hashed_password, 
                        ' '
                    );

                    $utilisateurDAO->insert($utilisateur);

                    $message = "Inscription réussie, vous pouvez maintenant vous connecter !";
                    header("location: login.php");
                } catch (Exception $e) {
                    $message = "Erreur lors de l'inscription : " . $e->getMessage();
                }
            } else {
                $message = "Les mots de passe ne correspondent pas.";
            }
                    
        } else {
            $message = "Cette adresse e-mail est déjà utilisée.";
                
        }
    } 
        // else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //         $message = "Veuillez remplir tous les champs.";
            
    

    require_once("../public/inscription.view.php");
?>