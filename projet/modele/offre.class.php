<?php
class Offre {
    private $id_offre;
 private $lien_offre;
 private $date_ajout;

 private $id_utilisateur;
 private $id_anonyme;

    public function __construct($id_offre = null, $lien_offre = ' ', $date_ajout = ' ', $id_utilisateur = null, $id_anonyme = null){
        $this->id_offre = $id_offre;
        $this->lien_offre = $lien_offre;
        $this->date_ajout = $date_ajout;
        $this->id_utilisateur = $id_utilisateur;
        $this->id_anonyme = $id_anonyme;
    }

    public function getIdOffre(){
        return $this->id_offre;
    }

    public function setIdOffre($id_offre){
        $this->id_offre = $id_offre;
    }

    public function getLienOffre(){
        return $this->lien_offre;
    }

    public function setLienOffre($lien_offre){
        $this->lien_offre = $lien_offre;
    }

    public function getDateAjout(){
        return $this->date_ajout;
    }

    public function setDateAjout($date_ajout){
        $this->date_ajout = $date_ajout;
    }

    public function getIdUtilisateur(){
        return $this->id_utilisateur;
    }

    public function setIdUtilisateur($id_utilisateur){
        $this->id_utilisateur = $id_utilisateur;
    }

    public function getIdAnonyme(){
        return $this->id_anonyme;
    }

    public function setIdAnonyme($id_anonyme){
        $this->id_anonyme = $id_anonyme;
    }
    
    public function __toString(){
        return "Offre [id_offre = ".$this->id_offre.", lien_offre = ".$this->lien_offre.", date_ajout = ".$this->date_ajout."]";
    }

}
?>