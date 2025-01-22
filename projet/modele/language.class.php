<?php
class Language {
    private $id_language;
    private $id_utilisateur;
    private $langue;

    public function __construct($id_language = null, $id_utilisateur = ' ', $langue = ' '){
        $this->id_language = $id_language;
        $this->id_utilisateur = $id_utilisateur;
        $this->langue = $langue;
    }

    public function getIdLanguage(){
        return $this->id_language;
    }

    public function setIdLanguage($id_language){
        $this->id_language = $id_language;
    }

    public function getIdUtilisateur(){
        return $this->id_utilisateur;
    }

    public function setIdUtilisateur($id_utilisateur){
        $this->id_utilisateur = $id_utilisateur;
    }

    public function getLangue(){
        return $this->langue;
    }

    public function setLangue($langue){
        $this->langue = $langue;
    }

    public function __toString(){
        return "Language [id_language = ".$this->id_language.", id_utilisateur = ".$this->id_utilisateur.", langue = ".$this->langue."]";
    }
    
}

?> 