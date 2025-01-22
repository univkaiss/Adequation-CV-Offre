<?php
require_once 'offre.class.php';
require_once 'connexion.php';

class OffreDAO{
    private $bd;
    private $select;
    public function __construct(){
        $this->bd = new Connexion();
        $this->select = 'SELECT * FROM Offres';
    }

    public function insert(Offre $offre){
        $this->bd->execSQL("INSERT INTO Offres (lien_offre, date_ajout,id_utilisateur,id_anonyme) VALUES (:lien_offre, NOW(),:id_utilisateur,:id_anonyme)",["lien_offre"=>$offre->getLienOffre(),"id_utilisateur"=>$offre->getIdUtilisateur(),"id_anonyme"=>$offre->getIdAnonyme()]);
    }

    public function update(Offre $offre){
        $this->bd->execSQL("UPDATE Offres SET lien_offre = :lien_offre , date_ajout = :date_ajout WHERE id_offre = :id_offre",["lien_offre"=>$offre->getLienOffre(),"date_ajout"=>$offre->getDateAjout(),"id_offre"=>$offre->getIdOffre()]);
    }

    public function delete(string $idOffre){
        $this->bd->execSQL("DELETE FROM Offres WHERE id_offre = :id_offre",["id_offre"=>$idOffre]);
    }

    public function deleteByIdUtilisateur(string $idUser){
        $this->bd->execSQL("DELETE FROM Offres WHERE id_utilisateur = :id_utilisateur",["id_utilisateur"=>$idUser]);
    }

    public function loadQuery(array $result): array{
        $offres = [];
        foreach($result as $row){
            $offre = new Offre();
            $offre->setIdOffre($row['id_offre']);
            $offre->setLienOffre($row['lien_offre']);
            $offre->setDateAjout($row['date_ajout']);
            $offres[] = $offre;
        }
        return $offres;
    }
    public function getAll(): array{
        return ($this->loadQuery($this->bd->execSQL($this->select)));
    }
    public function getById(string $id): Offre | null{
        $uneOffre = new Offre();
        $lesOffres = $this->loadQuery($this->bd->execSQL($this->select." WHERE id_offre=:id_offre", [':id_offre'=>$id]));
        if(count($lesOffres)>0){
            $uneOffre = $lesOffres[0];
        }
        return $uneOffre;
    }
    public function existe(string $id): bool{
        $req = "SELECT * FROM Offres WHERE id_offre = :id";
        $res = ($this->loadQuery($this->bd->execSQL($req,[':id'=>$id])));
        return ($res != []);
    }
    public function getAllByUserId(string $idOffre, string $idUtilisateur): array{
        $sql = "SELECT * FROM Offres WHERE id_offre = :idOffre AND id_utilisateur = :idUtilisateur";
        return ($this->loadQuery($this->bd->execSQL($sql, [':idOffre'=>$idOffre, ':idUtilisateur'=>$idUtilisateur])));
    }
    public function getOffreByLien(string $lien): Offre | null{
        $uneOffre = new Offre();
        $lesOffres = $this->loadQuery($this->bd->execSQL($this->select." WHERE lien_offre=:lien_offre", [':lien_offre'=>$lien]));
        if(count($lesOffres)>0){
            $uneOffre = $lesOffres[0];
        }
        return $uneOffre;
    }

    public function getIdOffreByAnonymeId(string $anonymeId): string | null{
        $sql = "SELECT id_offre FROM Offres WHERE id_anonyme = :anonyme_id";
        $result = $this->bd->execSQL($sql, [':anonyme_id' => $anonymeId]);
        if (!empty($result)) {
            return $result[0]['id_offre'];
        }
        return null;
    }

    public function getLastIdOffreByUserId(string $idUtilisateur): string | null{
        $sql = "SELECT id_offre FROM Offres WHERE id_utilisateur = :idUtilisateur ORDER BY id_offre DESC LIMIT 1";
        $result = $this->bd->execSQL($sql, [':idUtilisateur' => $idUtilisateur]);
        if (!empty($result)) {
            return $result[0]['id_offre'];
        }
        return null;
    }
}
?>