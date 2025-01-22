<?php
class Taches {
    private $id_tache;
    private $id_cv;
    private $id_offre;
    private $etat;
    private $date_creation;
    private $date_debut;
    private $date_fin;

    public function __construct($id_tache = null, $id_cv = ' ', $id_offre = ' ', $etat = ' ', $date_creation = ' ', $date_debut = ' ', $date_fin = ' '){
        $this->id_tache = $id_tache;
        $this->id_cv = $id_cv;
        $this->id_offre = $id_offre;
        $this->etat = $etat;
        $this->date_creation = $date_creation;
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
    }

    public function getIdTache(){
        return $this->id_tache;
    }

    public function setIdTache($id_tache){
        $this->id_tache = $id_tache;
    }

    public function getIdCv(){
        return $this->id_cv;
    }

    public function setIdCv($id_cv){
        $this->id_cv = $id_cv;
    }

    public function getIdOffre(){
        return $this->id_offre;
    }

    public function setIdOffre($id_offre){
        $this->id_offre = $id_offre;
    }

    public function getEtat(){
        return $this->etat;
    }

    public function setEtat($etat){
        $this->etat = $etat;
    }

    public function getDateCreation(){
        return $this->date_creation;
    }

    public function setDateCreation($date_creation){
        $this->date_creation = $date_creation;
    }

    public function getDateDebut(){
        return $this->date_debut;
    }

    public function setDateDebut($date_debut){
        $this->date_debut = $date_debut;
    }

    public function getDateFin(){
        return $this->date_fin;
    }

    public function setDateFin($date_fin){
        $this->date_fin = $date_fin;
    }

    public function __toString(){
        return "Taches [id_tache = ".$this->id_tache.", id_cv = ".$this->id_cv.", id_offre = ".$this->id_offre.", etat = ".$this->etat.", date_creation = ".$this->date_creation.", date_debut = ".$this->date_debut.", date_fin = ".$this->date_fin."]";
    }
}
?>