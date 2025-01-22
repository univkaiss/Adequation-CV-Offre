<?php
require_once 'taches.class.php';
require_once 'connexion.php';

class TachesDAO{
    private $bd;
    private $select;
    public function __construct(){
        $this->bd = new Connexion();
        $this->select = 'SELECT * FROM Taches';
    }

        public function insert(Taches $taches){
            $this->bd->execSQL("INSERT INTO Taches (id_cv, id_offre, etat, date_creation, date_debut, date_fin) 
            VALUES (:id_cv, :id_offre, :etat, NOW(), :date_debut, :date_fin)",["id_cv"=>$taches->getIdCv(),"id_offre"=>$taches->getIdOffre(),"etat"=>$taches->getEtat(),"date_debut"=>$taches->getDateDebut(),"date_fin"=>$taches->getDateFin()]);
        }

        public function update(Taches $taches){
            $this->bd->execSQL("UPDATE Taches SET id_cv = :id_cv , id_offre = :id_offre, etat = :etat, date_creation = :date_creation, date_debut = :date_debut, date_fin = :date_fin WHERE id_tache = :id_tache",["id_cv"=>$taches->getIdCv(),"id_offre"=>$taches->getIdOffre(),"etat"=>$taches->getEtat(),"date_creation"=>$taches->getDateCreation(),"date_debut"=>$taches->getDateDebut(),"date_fin"=>$taches->getDateFin(),"id_tache"=>$taches->getIdTache()]);
        }

        public function delete(string $idTache){
            $this->bd->execSQL("DELETE FROM Taches WHERE id_tache = :id_tache",["id_tache"=>$idTache]);
        }

        public function deleteByIdCV(string $idCV){
            $this->bd->execSQL("DELETE FROM Taches WHERE id_cv = :idCV",["idCV"=>$idCV]);
        }

        public function loadQuery(array $result): array{
            $taches = [];
            foreach($result as $row){
                $tache = new Taches();
                $tache->setIdTache($row['id_tache']);
                $tache->setIdCv($row['id_cv']);
                $tache->setIdOffre($row['id_offre']);
                $tache->setEtat($row['etat']);
                $tache->setDateCreation($row['date_creation']);
                $tache->setDateDebut($row['date_debut']);
                $tache->setDateFin($row['date_fin']);
                $taches[] = $tache;
            }
            return $taches;
        }
        public function getAll(): array{
            return ($this->loadQuery($this->bd->execSQL($this->select)));
        }
        public function getById(string $id): Taches | null{
            $uneTaches = new Taches();
            $lesTaches = $this->loadQuery($this->bd->execSQL($this->select." WHERE id_tache=:id_tache", [':id_tache'=>$id]));
            if(count($lesTaches)>0){
                $uneTaches = $lesTaches[0];
            }
            return $uneTaches;
        }
        public function existe(string $id): bool{
            $req = "SELECT * FROM Taches WHERE id_tache = :id";
            $res = ($this->loadQuery($this->bd->execSQL($req,[':id'=>$id])));
            return ($res != []);
        }
        public function getAllByUserId(string $idTache, string $idUtilisateur): array{
            $sql = "SELECT * FROM Taches WHERE id_tache = :idTache AND id_utilisateur = :idUtilisateur";
            return ($this->loadQuery($this->bd->execSQL($sql, [':idTache'=>$idTache, ':idUtilisateur'=>$idUtilisateur])));
        }
        public function getPendingById(string $id): Taches | null{
            $uneTaches = new Taches();
            $lesTaches = $this->loadQuery($this->bd->execSQL($this->select." WHERE id_tache=:id_tache AND etat='En attente'", [':id_tache'=>$id]));
            if(count($lesTaches)>0){
                $uneTaches = $lesTaches[0];
            }
            return $uneTaches;
        }
        public function getPendingIdByCvAndOffre(int $idCv, int $idOffre): string | null {
            $sql = "SELECT id_tache FROM Taches WHERE id_cv = :id_cv AND id_offre = :id_offre AND etat = 'En attente'";
            error_log("Executing SQL: $sql with id_cv = $idCv and id_offre = $idOffre");
            $result = $this->bd->execSQL($sql, [':id_cv' => $idCv, ':id_offre' => $idOffre]);
            error_log("SQL Result: " . json_encode($result));
            if (!empty($result)) {
                return $result[0]['id_tache'];
            }
            return null;
        }

        public function checkTaskStatus(string $idCv, string $idOffre, string $etat): bool {
            $sql = "SELECT COUNT(*) as count FROM Taches WHERE id_cv = :id_cv AND id_offre = :id_offre AND etat = :etat ORDER BY id_tache DESC LIMIT 1";
            $result = $this->bd->execSQL($sql, [':id_cv' => $idCv, ':id_offre' => $idOffre, ':etat' => $etat]);
            return ($result[0]['count'] > 0);
        }
    
        public function checkTaskStatusByIdAndStatus(string $idTache, string $etat): bool {
            $sql = "SELECT COUNT(*) as count FROM Taches WHERE id_tache = :id_tache AND etat = :etat ORDER BY id_tache DESC LIMIT 1";
            $result = $this->bd->execSQL($sql, [':id_tache' => $idTache, ':etat' => $etat]);
            return ($result[0]['count'] > 0);
        }
        public function updateTaskStatusByCvAndOffre(string $idCv, string $idOffre, string $status): void {
            $sql = "UPDATE Taches SET etat = :etat WHERE id_cv = :id_cv AND id_offre = :id_offre";
            $this->bd->execSQL($sql, [':etat' => $status, ':id_cv' => $idCv, ':id_offre' => $idOffre]);
        }
        public function updateStatus(string $idTache, string $newStatus): void {
            $sql = "UPDATE Taches SET etat = :newStatus WHERE id_tache = :idTache";
            $this->bd->execSQL($sql, [':newStatus' => $newStatus, ':idTache' => $idTache]);
        }
    }
?>