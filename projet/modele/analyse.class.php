<?php
class Analyse {
    private $id_analyse;
    private $id_cv;
    private $id_offre;
    private $suggestions;
    private $statistiques;
    private $date_analyse;
    private $lettre_de_motivation;
    private $nom_fichier;

    public function __construct($id_analyse = null, $id_cv = ' ', $id_offre = ' ', $suggession = ' ', $statistique = ' ', $date_analyse = ' ', $lettre_de_motivation = ' ', $nom_fichier = ' '){
        $this->id_analyse = $id_analyse;
        $this->id_cv = $id_cv;
        $this->id_offre = $id_offre;
        $this->suggestions = $suggession;
        $this->statistiques = $statistique;
        $this->date_analyse = $date_analyse;
        $this->lettre_de_motivation = $lettre_de_motivation;
        $this->nom_fichier = $nom_fichier;
    }

    public function getIdAnalyse(){
        return $this->id_analyse;
    }

    public function setIdAnalyse($id_analyse){
        $this->id_analyse = $id_analyse;
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

    public function getSuggession(){
        return $this->suggestions;
    }

    public function setSuggession($suggession){
        $this->suggestions = $suggession;
    }

    public function getStatistique(){
        return $this->statistiques;
    }

    public function setStatistique($statistique){
        $this->statistiques = $statistique;
    }

    public function getDateAnalyse(){
        return $this->date_analyse;
    }

    public function setDateAnalyse($date_analyse){
        $this->date_analyse = $date_analyse;
    }

    public function getLettreDeMotivation(){
        return $this->lettre_de_motivation;
    }

    public function setLettreDeMotivation($lettre_de_motivation){
        $this->lettre_de_motivation = $lettre_de_motivation;
    }

    public function getNomFichier(){
        return $this->nom_fichier;
    }

    public function setNomFichier($nom_fichier){
        $this->nom_fichier = $nom_fichier;
    }

    public function __toString(){
        return "Analyse [id_analyse = ".$this->id_analyse.", id_cv = ".$this->id_cv.", id_offre = ".$this->id_offre.", suggession = ".$this->suggestions.", statistique = ".$this->statistiques.", date_analyse = ".$this->date_analyse."]";
    }
}
?>