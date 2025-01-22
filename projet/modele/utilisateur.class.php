<?php
class Utilisateur{
 private $id_utilisateur;   
 private $nom;
 private $prenom;
 private $email;
 private $mot_de_passe;
    private $date_inscription;

    public function __construct($id_utilisateur = null, $nom = ' ', $prenom = ' ', $email = ' ', $mot_de_passe = ' ', $date_inscription = ' '){
        $this->id_utilisateur = $id_utilisateur;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->mot_de_passe = $mot_de_passe;
        $this->date_inscription = $date_inscription;
    }

    public function getIdUtilisateur(){
        return $this->id_utilisateur;
    }

    public function setIdUtilisateur($id_utilisateur){
        $this->id_utilisateur = $id_utilisateur;
    }

    public function getNom(){
        return $this->nom;
    }

    public function setNom($nom){
        $this->nom = $nom;
    }

    public function getPrenom(){
        return $this->prenom;
    }

    public function setPrenom($prenom){
        $this->prenom = $prenom;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getMotDePasse(){
        return $this->mot_de_passe;
    }

    public function setMotDePasse($mot_de_passe){
        $this->mot_de_passe = $mot_de_passe;
    }

    public function getDateInscription(){
        return $this->date_inscription;
    }

    public function setDateInscription($date_inscription){
        $this->date_inscription = $date_inscription;
    }

    public function __toString(){
        return "Utilisateur [id_utilisateur = ".$this->id_utilisateur.", nom = ".$this->nom.", prenom = ".$this->prenom.", email = ".$this->email.", mot_de_passe = ".$this->mot_de_passe.", date_inscription = ".$this->date_inscription."]";

}
}
?>