<?php
require_once 'connexion.php';
require_once 'analyse.class.php';

class AnalyseDAO{
    private $bd;
    private $select;
    public function __construct(){
        $this->bd = new Connexion();
        $this->select = 'SELECT * FROM Analyses';
    }

        public function insert(Analyse $analyse){
            $this->bd->execSQL("INSERT INTO Analyses (id_analyse, id_cv, id_offre, suggestions, statistiques, date_analyse, lettre_de_motivation, nom_fichier) 
            VALUES (:id_analyse, :id_cv, :id_offre, :suggestions, :statistiques, :date_analyse, :lettre_de_motivation,:nomFichier)",["id_analyse"=>$analyse->getIdAnalyse(),"id_cv"=>$analyse->getIdCv(),"id_offre"=>$analyse->getIdOffre(),"suggession"=>$analyse->getSuggession(),"statistique"=>$analyse->getStatistique(),"date_analyse"=>$analyse->getDateAnalyse(),"lettre_de_motivation"=>$analyse->getLettreDeMotivation(),"nomFichier"=>$analyse->getNomFichier()]);
        }

        public function update(Analyse $analyse){
            $this->bd->execSQL("UPDATE Analyses SET id_cv = :id_cv , id_offre = :id_offre, suggession = :suggession, statistique = :statistique, date_analyse = :date_analyse, lettre_de_motivation = :lettre_de_motivation, nom_fichier = :nomfichier WHERE id_analyse = :id_analyse",["id_cv"=>$analyse->getIdCv(),"id_offre"=>$analyse->getIdOffre(),"suggession"=>$analyse->getSuggession(),"statistique"=>$analyse->getStatistique(),"date_analyse"=>$analyse->getDateAnalyse(),"lettre_de_motivation"=>$analyse->getLettreDeMotivation(),"nomfichier"=>$analyse->getNomFichier(),"id_analyse"=>$analyse->getIdAnalyse()]);
        }

        public function delete(string $idAnalyse){
            $this->bd->execSQL("DELETE FROM Analyses WHERE id_analyse = :id_analyse",["id_analyse"=>$idAnalyse]);
        }


        public function deleteByIdCV(string $idCV){
            $this->bd->execSQL("DELETE FROM Analyses WHERE id_cv = :idCV",["idCV"=>$idCV]);
        }


        public function loadQuery(array $result): array{
            $analyses = [];
            foreach($result as $row){
                $analyse = new Analyse();
                $analyse->setIdAnalyse($row['id_analyse']);
                $analyse->setIdCv($row['id_cv']);
                $analyse->setIdOffre($row['id_offre']);
                $analyse->setSuggession($row['suggestions']);
                $analyse->setStatistique($row['statistiques']);
                $analyse->setDateAnalyse($row['date_analyse']);
                $analyse->setLettreDeMotivation($row['lettre_de_motivation']);
                $analyse->setNomFichier($row['nom_fichier']);
                $analyses[] = $analyse;
            }
            return $analyses;
        }
        public function getAll(): array{
            return ($this->loadQuery($this->bd->execSQL($this->select)));
        }
        public function getById(string $id): Analyse | null{
            $uneAnalyse = new Analyse();
            $lesAnalyses = $this->loadQuery($this->bd->execSQL($this->select." WHERE id_analyse=:id_analyse", [':id_analyse'=>$id]));
            if(count($lesAnalyses)>0){
                $uneAnalyse = $lesAnalyses[0];
            }
            return $uneAnalyse;
        }
        public function existe(string $id): bool{
            $req = "SELECT * FROM Analyses WHERE id_analyse = :id";
            $res = ($this->loadQuery($this->bd->execSQL($req,[':id'=>$id])));
            return ($res != []);
        }
        public function getAllByUserId(string $idAnalyse, string $idUtilisateur): array{
            $sql = "SELECT * FROM Analyses WHERE id_analyse = :idAnalyse AND id_utilisateur = :idUtilisateur";
            return ($this->loadQuery($this->bd->execSQL($sql, [':idAnalyse'=>$idAnalyse, ':idUtilisateur'=>$idUtilisateur])));
        }

        public function getAnalysisByIdCvAndIdOffre(string $idCv, string $idOffre): Analyse | null {
            $sql = "SELECT * FROM Analyses WHERE id_cv = :idCv AND id_offre = :idOffre";
            $analyses = $this->loadQuery($this->bd->execSQL($sql, [':idCv' => $idCv, ':idOffre' => $idOffre]));
            if (count($analyses) > 0) {
                return $analyses[0];
            }
            return null;
        }
        public function saveLettreDeMotivationToFolder(string $idAnalyse, string $baseFolder): string {
            // Vérification si l'analyse existe
            $analyse = $this->getById($idAnalyse);
            if ($analyse === null) {
                throw new Exception("Analyse introuvable pour l'ID : $idAnalyse");
            }
    
            // Vérification de la lettre de motivation
            $lettreDeMotivation = $analyse->getLettreDeMotivation();
            if (empty($lettreDeMotivation)) {
                throw new Exception("Aucune lettre de motivation trouvée pour l'analyse ID : $idAnalyse");
            }
    
            // Vérification du nom de fichier
            $nomFichier = $analyse->getNomFichier();
            if (empty($nomFichier)) {
                throw new Exception("Nom de fichier invalide pour l'analyse ID : $idAnalyse");
            }
    
            // Création du dossier si nécessaire
            $folderPath = rtrim($baseFolder, '/') . "/$idAnalyse";
            if (!is_dir($folderPath)) {
                if (!mkdir($folderPath, 0777, true)) {
                    throw new Exception("Impossible de créer le dossier : $folderPath");
                }
            }
            // Chemin complet du fichier
            $filePath = $folderPath . "/" . basename($nomFichier);
    
            // Sauvegarde du fichier
            if (file_put_contents($filePath, $lettreDeMotivation) === false) {
                throw new Exception("Échec de l'écriture du fichier : $filePath");
            }
    
            // Vérification de l'intégrité du fichier PDF
            if (mime_content_type($filePath) !== 'application/pdf') {
                throw new Exception("Le fichier sauvegardé n'est pas un PDF valide : $filePath");
            }
    
            return $filePath;
        }
    }
?>