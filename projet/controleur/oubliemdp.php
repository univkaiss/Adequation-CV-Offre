<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);


    require_once '../lib/phpmailer/src/PHPMailer.php';
    require_once '../lib/phpmailer/src/SMTP.php';
    require_once '../lib/phpmailer/src/Exception.php';
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;


    require_once("../modele/utilisateurDAO.php");

    $utilisateurDAO = new UtilisateurDAO();

    $valeurs['email'] = (isset($_POST['email']) ? trim($_POST['email']) : null);

    if($valeurs['email'] != null){
        if($utilisateurDAO->existe( $valeurs['email'])){
            $token = bin2hex(random_bytes(32));
            $expiration = date("Y-m-d H:i:s", strtotime("+1 hour"));


            $utilisateurDAO->sauvegarderToken($valeurs['email'], $token, $expiration);

            $mail = new PHPMailer(true);

            $resetLink = "test";

            $mail->SMTPDebug = 2;
            $mail->Debugoutput = 'html'; 

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Utilisez le serveur SMTP de votre fournisseur
            $mail->SMTPAuth = true;
            $mail->Username = 'aomime22@gmail.com'; // Votre email
            $mail->Password = 'szzv evyk neaa jwgp'; // Votre mot de passe ou mot de passe d'application
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587; // Port SMTP
        
            // Destinataires
            $mail->setFrom('aomime22@gmail.com', 'Votre Nom'); // Expéditeur
            $mail->addAddress($valeurs['email']); // Destinataire
        
            // Contenu de l'e-mail
            $mail->isHTML(true); // Permet d'envoyer un e-mail en HTML
            $mail->Subject = 'Réinitialisation de mot de passe';
            $mail->Body    = "Cliquez sur ce lien pour réinitialiser votre mot de passe : <a href='$resetLink'>Réinitialiser</a>";
            $mail->AltBody = 'Cliquez sur ce lien pour réinitialiser votre mot de passe : ' . $resetLink;

            $message = "un lien vous a ete envoye par mail";

        }
        else{
            $message = "l user n existe pas";
        }
    }

    
    

    require_once("../public/oubliemdp.view.php");
?>
