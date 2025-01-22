<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = '../uploads/';
        $uploadFile = $uploadDir . basename($_FILES['file']['name']);
        
        if (!is_dir($uploadDir)) {
            if (!mkdir($uploadDir, 0777, true)) {
                die("Erreur lors de la création du dossier de téléchargement. Vérifiez les permissions du dossier parent.");
            }
        }
        
        if (!is_writable($uploadDir)) {
            die("Le dossier de destination n'est pas accessible en écriture.");
        }
        
        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
            $_SESSION['file'] = basename($uploadFile);
            header("Location:../controleur/verifierLien.php");
            exit();
        } else {
            echo "Erreur lors du déplacement du fichier téléchargé.";
            error_log("Erreur lors du déplacement du fichier téléchargé de " . $_FILES['file']['tmp_name'] . " vers " . $uploadFile);
        }
    } else {
        echo "Aucun fichier téléchargé ou une erreur est survenue.";
        switch ($_FILES['file']['error']) {
            case UPLOAD_ERR_INI_SIZE:
                echo "Le fichier téléchargé dépasse la directive upload_max_filesize dans php.ini.";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                echo "Le fichier téléchargé dépasse la directive MAX_FILE_SIZE spécifiée dans le formulaire HTML.";
                break;
            case UPLOAD_ERR_PARTIAL:
                echo "Le fichier n'a été que partiellement téléchargé.";
                break;
            case UPLOAD_ERR_NO_FILE:
                echo "Aucun fichier n'a été téléchargé.";
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                echo "Un dossier temporaire est manquant.";
                break;
            case UPLOAD_ERR_CANT_WRITE:
                echo "Échec de l'écriture du fichier sur le disque.";
                break;
            case UPLOAD_ERR_EXTENSION:
                echo "Une extension PHP a arrêté le téléchargement du fichier.";
                break;
            default:
                echo "Erreur inconnue.";
                break;
        }
    }
} else {
    echo "";
}
include "../public/importationCV.view.php";
?>