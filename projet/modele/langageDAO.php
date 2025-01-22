<?php
require_once('language.class.php');
require_once('connexion.php');

class LanguageDAO{
    private $bd;
    private $select;
    public function __construct(){
        $this->bd = new Connexion();
        $this->select = 'SELECT * FROM Langages';
    }

    public function insert(Language $language){
        $this->bd->execSQL("INSERT INTO Languages (id_language, id_utilisateur, langue) 
        VALUES (:id_language, :id_utilisateur, :langue",["id_language"=>$language->getIdLanguage(),"id_utilisateur"=>$language->getIdUtilisateur(),"langue"=>$language->getLangue()]);
    }
    public function update(Language $language){
        $this->bd->execSQL("UPDATE Langages SET id_utilisateur = :id_utilisateur , langue = :langue WHERE id_language = :id_language",["id_utilisateur"=>$language->getIdUtilisateur(),"langue"=>$language->getLangue(),"id_language"=>$language->getIdLanguage()]);
    }
    public function delete(string $idLanguage){
        $this->bd->execSQL("DELETE FROM Langages WHERE id_language = :id_language",["id_language"=>$idLanguage]);
    }
    public function loadQuery(array $result): array{
        $language = [];
        foreach($result as $row){
            $language = new Language();
            $language->setIdLanguage($row['id_language']);
            $language->setIdUtilisateur($row['id_utilisateur']);
            $language->setLangue($row['langue']);
            $language[] = $language;
        }
        return $language;
    }
    public function getAll(): array{
        return ($this->loadQuery($this->bd->execSQL($this->select)));
    }
    public function getById(string $id): Language | null{
        $unLanguage = new Language();
        $lesLanguages = $this->loadQuery($this->bd->execSQL($this->select." WHERE id_language=:id_language", [':id_language'=>$id]));
        if(count($lesLanguages)>0){
            $unLanguage = $lesLanguages[0];
        }
        return $unLanguage;
    }
    public function existe(string $id): bool{
        $req = "SELECT * FROM Langages WHERE id_language = :id";
        $res = ($this->loadQuery($this->bd->execSQL($req,[':id'=>$id])));
        return ($res != []);
    }
    public function getAllByUserId(string $idLanguage, string $idUtilisateur): array{
        $sql = "SELECT * FROM Langages WHERE id_language = :id_language AND id_utilisateur = :id_utilisateur";
        return ($this->loadQuery($this->bd->execSQL($sql, [':idLanguage'=>$idLanguage, ':idUtilisateur'=>$idUtilisateur])));
    }
}
?>