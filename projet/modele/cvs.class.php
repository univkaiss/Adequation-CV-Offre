<?php
class CVs{
    private $id_cv;
    private $id_utilisateur;
    private $id_anonyme;
    private $nom_fichier;
    private $type_fichier;
    private $donnees_fichier;
    private $date_telechargement;

    public function __construct($id_cv = null , $id_utilisateur = ' ', $id_anonyme = ' ', $nom_fichier = ' ', $type_fichier = ' ', $donnees_fichier = ' ', $date_telechargement = ' '){
        $this->id_cv = $id_cv;
        $this->id_utilisateur = $id_utilisateur;
        $this->id_anonyme = $id_anonyme;
        $this->nom_fichier = $nom_fichier;
        $this->type_fichier = $type_fichier;
        $this->donnees_fichier = $donnees_fichier;
        $this->date_telechargement = $date_telechargement;
    }

    public function getIdCv(){
        return $this->id_cv;
    }

    public function setIdCv($id_cv){
        $this->id_cv = $id_cv;
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

    public function getNomFichier(){
        return $this->nom_fichier;
    }

    public function setNomFichier($nom_fichier){
        $this->nom_fichier = $nom_fichier;
    }

    public function getTypeFichier(){
        return $this->type_fichier;
    }

    public function setTypeFichier($type_fichier){
        $this->type_fichier = $type_fichier;
    }

    public function getDonneesFichier(){
        return $this->donnees_fichier;
    }

    public function setDonneesFichier($donnees_fichier){
        $this->donnees_fichier = $donnees_fichier;
    }

    public function getDateTelechargement(){
        return $this->date_telechargement;
    }

    public function setDateTelechargement($date_telechargement){
        $this->date_telechargement = $date_telechargement;
    }



}
?>