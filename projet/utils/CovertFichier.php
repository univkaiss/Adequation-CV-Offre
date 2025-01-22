<?php
class FileConverter {
    private $pythonScript = 'convertisseur.py';
    private $pythonPath = 'python'; // ou 'python3' selon votre système

    /**
     * Constructeur avec vérification de Python
     */
    public function __construct() {
        // Vérifie si Python est installé
        exec("{$this->pythonPath} --version 2>&1", $output, $returnCode);
        if ($returnCode !== 0) {
            throw new Exception("Python n'est pas installé ou n'est pas accessible.");
        }
    }

    /**
     * Convertit un fichier en utilisant le script Python
     */
    public function convertirFichier($cheminFichier) {
        // Vérifie si le fichier Python existe
        if (!file_exists($this->pythonScript)) {
            throw new Exception("Le script Python n'existe pas dans le répertoire courant.");
        }

        // Échapper les arguments pour la sécurité
        $cheminFichier = escapeshellarg($cheminFichier);
        
        // Exécuter le script Python
        $command = "{$this->pythonPath} {$this->pythonScript} {$cheminFichier} 2>&1";
        exec($command, $output, $returnCode);

        // Vérifier si l'exécution a réussi
        if ($returnCode !== 0) {
            throw new Exception("Erreur lors de l'exécution du script Python: " . implode("\n", $output));
        }

        return implode("\n", $output);
    }

    /**
     * Méthode alternative utilisant proc_open pour plus de contrôle
     */
    public function convertirFichierProc($cheminFichier) {
        $descriptorspec = array(
            0 => array("pipe", "r"),  // stdin
            1 => array("pipe", "w"),  // stdout
            2 => array("pipe", "w")   // stderr
        );

        $process = proc_open(
            "{$this->pythonPath} {$this->pythonScript} " . escapeshellarg($cheminFichier),
            $descriptorspec,
            $pipes,
            dirname(__FILE__)
        );

        if (is_resource($process)) {
            // Lire la sortie
            $output = stream_get_contents($pipes[1]);
            $errors = stream_get_contents($pipes[2]);

            // Fermer les pipes
            fclose($pipes[0]);
            fclose($pipes[1]);
            fclose($pipes[2]);

            // Fermer le processus
            $returnValue = proc_close($process);

            if ($returnValue !== 0) {
                throw new Exception("Erreur Python: " . $errors);
            }

            return trim($output);
        }

        throw new Exception("Impossible de lancer le processus Python");
    }
}

// Exemple d'utilisation
try {
    $converter = new FileConverter();

    // Méthode 1: Utilisation de exec
    $resultat = $converter->convertirFichier('document.pdf');
    echo $resultat . "\n";

    // Méthode 2: Utilisation de proc_open
    $resultat2 = $converter->convertirFichierProc('document.docx');
    echo $resultat2 . "\n";

} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage() . "\n";
}

// Fonction utilitaire pour vérifier l'installation des dépendances Python
function verifierDependancesPython() {
    $dependances = ['PyPDF2', 'python-docx'];
    $manquantes = [];

    foreach ($dependances as $dep) {
        $command = "python -c \"import {$dep}\" 2>/dev/null";
        exec($command, $output, $returnCode);
        
        if ($returnCode !== 0) {
            $manquantes[] = $dep;
        }
    }

    if (!empty($manquantes)) {
        echo "Dépendances Python manquantes : " . implode(', ', $manquantes) . "\n";
        echo "Installez-les avec : pip install " . implode(' ', $manquantes) . "\n";
        return false;
    }

    return true;
}
?>