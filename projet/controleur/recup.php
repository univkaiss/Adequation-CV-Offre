<?php
$outputFolder = '/var/www/html/uploads';
$pythonScript = '/var/www/html/projetCV/projet/utils/retrieve_pdf.py'; // Chemin vers le script Python

// Appeler le script Python pour récupérer la lettre de motivation
$command = escapeshellcmd("python3 $pythonScript $idCv $idOffre $idTache $outputFolder");
$output = shell_exec($command);

$response = json_decode($output, true);

if (isset($response['error'])) {
    error_log("Erreur lors de l'exécution du script Python : " . $response['error']);
    $cheminFichier = null;
} elseif (isset($response['path'])) {
    $cheminFichier = $response['path']; // Chemin du fichier PDF récupéré

    // Vérifier si le fichier existe avant de l'utiliser
    if (!file_exists($cheminFichier)) {
        error_log("Erreur : Le fichier récupéré n'existe pas : $cheminFichier");
        $cheminFichier = null;
    }
} else {
    error_log("Erreur inattendue lors de la récupération du fichier PDF.");
    $cheminFichier = null;
}
?>
