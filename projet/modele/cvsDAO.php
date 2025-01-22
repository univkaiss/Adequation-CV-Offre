<?php
require_once 'cvs.class.php';
require_once 'connexion.php';

class CVsDAO{
    private $bd;
    private $select;
    public function __construct(){
        $this->bd = new Connexion();
        $this->select = 'SELECT * FROM CVs';
    }

    public function insert(CVs $cvs){
        $this->bd->execSQL("INSERT INTO CVs (id_utilisateur, id_anonyme,nom_fichier, type_fichier, donnees_fichier, date_telechargement) 
        VALUES (:id_utilisateur, :id_anonyme, :nom_fichier, :type_fichier, :donnees_fichier, NOW())",["id_utilisateur"=>$cvs->getIdUtilisateur(),"id_anonyme"=>$cvs->getIdAnonyme(),"nom_fichier"=>$cvs->getNomFichier(),"type_fichier"=>$cvs->getTypeFichier(),"donnees_fichier"=>$cvs->getDonneesFichier()]);
    }
    public function update(CVs $cvs){
        $this->bd->execSQL("UPDATE CVs SET id_utilisateur = :id_utilisateur , id_anonyme = :id_anonyme, nom_fichier = :nom_fichier, type_fichier = :type_fichier, donnees_fichier = :donnees_fichier, date_telechargement = :date_telechargement WHERE id_cv = :id_cv",["id_utilisateur"=>$cvs->getIdUtilisateur(),"id_anonyme"=>$cvs->getIdAnonyme(),"nom_fichier"=>$cvs->getNomFichier(),"type_fichier"=>$cvs->getTypeFichier(),"donnees_fichier"=>$cvs->getDonneesFichier(),"date_telechargement"=>$cvs->getDateTelechargement(),"id_cv"=>$cvs->getIdCv()]);
    }
    public function delete(string $idCv){
        $this->bd->execSQL("DELETE FROM CVs WHERE id_cv = :id_cv",["id_cv"=>$idCv]);
    }
    public function loadQuery(array $result): array{
        $cvs = [];
        foreach($result as $row){
            $cv = new CVs();
            $cv->setIdCv($row['id_cv']);
            $cv->setIdUtilisateur($row['id_utilisateur']);
            $cv->setIdAnonyme($row['id_anonyme']);
            $cv->setNomFichier($row['nom_fichier']);
            $cv->setTypeFichier($row['type_fichier']);
            $cv->setDonneesFichier($row['donnees_fichier']);
            $cv->setDateTelechargement($row['date_telechargement']);
            $cvs[] = $cv;
        }
        return $cvs;
    }
    public function getAll(): array{
        return ($this->loadQuery($this->bd->execSQL($this->select)));
    }
    public function getById(string $id): CVs | null{
        $unCvs = new CVs();
        $lesCvs = $this->loadQuery($this->bd->execSQL($this->select." WHERE id_cv=:id_cv", [':id_cv'=>$id]));
        if(count($lesCvs)>0){
            $unCvs = $lesCvs[0];
        }
        return $unCvs;
    }
    public function existe(string $id): bool{
        $req = "SELECT * FROM CVs WHERE id_cv = :id";
        $res = ($this->loadQuery($this->bd->execSQL($req,[':id'=>$id])));
        return ($res != []);
    }
    public function getAllByUserId(string $idCv, string $idUtilisateur): array{
        $sql = "SELECT * FROM CVs WHERE id_cv = :id_cv AND id_utilisateur = :id_utilisateur";
        return ($this->loadQuery($this->bd->execSQL($sql, [':idCv'=>$idCv, ':idUtilisateur'=>$idUtilisateur])));
    }

    public function getAllByUserId2(string $idUtilisateur): array{
        $sql = "SELECT * FROM CVs WHERE id_utilisateur = :id_utilisateur";
        return ($this->loadQuery($this->bd->execSQL($sql, [':id_utilisateur'=>$idUtilisateur])));
    }

    public function getIdCvByAnonymeId(string $idAnonyme): string | null {
        $sql = "SELECT id_cv FROM CVs WHERE id_anonyme = :id_anonyme";
        $result = $this->bd->execSQL($sql, [':id_anonyme' => $idAnonyme]);
        if (!empty($result)) {
            return $result[0]['id_cv'];
        }
        return null;
    }

    public function getLastIdCvByUserId(string $idUtilisateur): string | null {
        $sql = "SELECT id_cv FROM CVs WHERE id_utilisateur = :id_utilisateur ORDER BY id_cv DESC LIMIT 1";
        $result = $this->bd->execSQL($sql, [':id_utilisateur' => $idUtilisateur]);
        if (!empty($result)) {
            return $result[0]['id_cv'];
        }
        return null;
    }

    public function getNomFicByIdU(string $idUtilisateur): string {
        $req = "SELECT nom_fichier FROM CVs WHERE idUtilisateur = :idUtilisateur";
        $res = $this->bd->execSQL($req, [':idUtilisateur' => $idUtilisateur]);
        if (!empty($res)) {
            return $res[0]['nom_fichier'];
        }
        return ''; 
    }
}
?>