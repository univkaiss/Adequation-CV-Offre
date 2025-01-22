<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    require_once("../modele/utilisateurDAO.php");

    $utilisateurDAO = new UtilisateurDAO();

    $valeurs['email'] = (isset($_POST['email']) ? trim($_POST['email']) : null);
    $valeurs['password'] = (isset($_POST['password']) ? trim($_POST['password']) : null);


    //echo ($valeurs['email']. "   " . $valeurs['password']);
    if($valeurs['email'] != null && $valeurs['password'] != null){
        if($utilisateurDAO->existe( $valeurs['email'])){

            if($utilisateurDAO->MdpJuste($valeurs['email'],$valeurs['password'])){
                session_start();
                
                $_SESSION['email'] = $valeurs['email'];
                header("location: pageUtilisateur.php");
                exit();
            }
            else{
                $message = "Le mot de passe est incorrect";
            }
    
        }
        else{
            $message = "L'utilisateur n'existe pas";
        }
    }

    
    

    require_once("../public/login.view.php");
?>
