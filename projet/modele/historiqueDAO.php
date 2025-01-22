<?php
require_once 'historique.class.php';
require_once 'connexion.php';

class HistoriqueDAO{
    private $bd;
    private $select;
    public function __construct(){
        $this->bd = new Connexion();
        $this->select = 'SELECT * FROM Historique';
    }
    public function insert(Historique $historique){
        $this->bd->execSQL("INSERT INTO Historique (id_cv, iteration, statistiques, date_iteration) 
        VALUES (:id_cv, :iteration, :statistique, NOW())",["id_cv"=>$historique->getIdCv(),"iteration"=>$historique->getIteration(),"statistique"=>$historique->getStatistique()]);
    }
    public function update(Historique $historique){
        $this->bd->execSQL("UPDATE Historique SET id_cv = :id_cv , iteration = :iteration, statistique = :statistique, date_iteration = :date_iteration WHERE id_historique = :id_historique",["id_cv"=>$historique->getIdCv(),"iteration"=>$historique->getIteration(),"statistique"=>$historique->getStatistique(),"date_iteration"=>$historique->getDateIteration(),"id_historique"=>$historique->getIdHistorique()]);
    }
    public function delete(string $idHistorique){
        $this->bd->execSQL("DELETE FROM Historique WHERE id_historique = :id_historique",["id_historique"=>$idHistorique]);
    }

    public function deleteByIdCV(string $idCV){
        $this->bd->execSQL("DELETE FROM Historique WHERE id_cv = :idCV",["idCV"=>$idCV]);
    }

    public function loadQuery(array $result): array{
        $historique = [];
        foreach($result as $row){
            $historique = new Historique();
            $historique->setIdHistorique($row['id_historique']);
            $historique->setIdCv($row['id_cv']);
            $historique->setIteration($row['iteration']);
            $historique->setStatistique($row['statistique']);
            $historique->setDateIteration($row['date_iteration']);
            $historique[] = $historique;
        }
        return $historique;
    }
    public function getAll(): array{
        return ($this->loadQuery($this->bd->execSQL($this->select)));
    }
    public function getById(string $id): Historique | null{
        $unHistorique = new Historique();
        $lesHistoriques = $this->loadQuery($this->bd->execSQL($this->select." WHERE id_historique=:id_historique", [':id_historique'=>$id]));
        if(count($lesHistoriques)>0){
            $unHistorique = $lesHistoriques[0];
        }
        return $unHistorique;
    }
    public function existe(string $id): bool{
        $req = "SELECT * FROM Historique WHERE id_historique = :id";
        $res = ($this->loadQuery($this->bd->execSQL($req,[':id'=>$id])));
        return ($res != []);
    }
    public function getAllByUserId(string $idHistorique, string $idUtilisateur): array{
        $sql = "SELECT * FROM Historique WHERE id_historique = :idHistorique AND id_utilisateur = :idUtilisateur";
        return ($this->loadQuery($this->bd->execSQL($sql, [':idHistorique'=>$idHistorique, ':idUtilisateur'=>$idUtilisateur])));
    }
    public function countByCvId(string $idCv): int {
        $sql = "SELECT COUNT(*) FROM Historique WHERE id_cv = :idCv";
        $result = $this->bd->execSQL($sql, [':idCv' => $idCv]);
        return $result[0]['COUNT(*)'];
    }
    public function getLatestStatisticsByCvId(string $idCv): ?Historique {
        $sql = "SELECT * FROM Historique WHERE id_cv = :idCv ORDER BY date_iteration DESC LIMIT 1";
        $result = $this->bd->execSQL($sql, [':idCv' => $idCv]);
        if (!empty($result)) {
            $historique = new Historique();
            $historique->setIdHistorique($result[0]['id_historique']);
            $historique->setIdCv($result[0]['id_cv']);
            $historique->setIteration($result[0]['iteration']);
            $historique->setStatistique($result[0]['statistiques']);
            $historique->setDateIteration($result[0]['date_iteration']);
            return $historique;
        }
        return null;
    }
}
?>