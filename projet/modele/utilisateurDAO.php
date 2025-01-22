<?php
require_once('utilisateur.class.php');
require_once('connexion.php');

class UtilisateurDAO{
    private $bd;
    private $select;
    public function __construct(){
        $this->bd = new Connexion();
        $this->select = 'SELECT * FROM Utilisateurs';
    }

    public function insert(Utilisateur $utilisateur){
        $this->bd->execSQL("INSERT INTO Utilisateurs ( nom, prenom, email, mot_de_passe) 
        VALUES (:nom, :prenom, :email, :mot_de_passe)",["nom"=>$utilisateur->getNom(),"prenom"=>$utilisateur->getPrenom(),"email"=>$utilisateur->getEmail(),"mot_de_passe"=>$utilisateur->getMotDePasse()]);
    }

    public function update(Utilisateur $utilisateur){
        $this->bd->execSQL("UPDATE Utilisateurs SET nom = :nom , prenom = :prenom, email = :email, mot_de_passe = :mot_de_passe, date_inscription = :date_inscription WHERE id_utilisateur = :id_utilisateur",["nom"=>$utilisateur->getNom(),"prenom"=>$utilisateur->getPrenom(),"email"=>$utilisateur->getEmail(),"mot_de_passe"=>$utilisateur->getMotDePasse(),"date_inscription"=>$utilisateur->getDateInscription(),"id_utilisateur"=>$utilisateur->getIdUtilisateur()]);
    }

    public function delete(string $idUtilisateur){
        $this->bd->execSQL("DELETE FROM Utilisateurs WHERE id_utilisateur = :id_utilisateur",["id_utilisateur"=>$idUtilisateur]);
    }


    public function loadQuery(array $result): array{
        $utilisateurs = [];
        foreach($result as $row){
            $utilisateur = new Utilisateur();
            $utilisateur->setIdUtilisateur($row['id_utilisateur']);
            $utilisateur->setNom($row['nom']);
            $utilisateur->setPrenom($row['prenom']);
            $utilisateur->setEmail($row['email']);
            $utilisateur->setMotDePasse($row['mot_de_passe']);
            $utilisateur->setDateInscription($row['date_inscription']);
            $utilisateurs[] = $utilisateur;
        }
        return $utilisateurs;
    }

    public function getAll(): array{
        return ($this->loadQuery($this->bd->execSQL($this->select)));
    }

    public function getById(string $id): Utilisateur | null{
        $unUtilisateur = new Utilisateur();
        $lesUtilisateurs = $this->loadQuery($this->bd->execSQL($this->select." WHERE id_utilisateur=:id_utilisateur", [':id_utilisateur'=>$id]));
        if(count($lesUtilisateurs)>0){
            $unUtilisateur = $lesUtilisateurs[0];
        }
        return $unUtilisateur;
    }

    public function getByEmail(string $email): Utilisateur | null{
        $unUtilisateur = new Utilisateur();
        $lesUtilisateurs = $this->loadQuery($this->bd->execSQL($this->select." WHERE email=:email", [':email'=>$email]));
        if(count($lesUtilisateurs)>0){
            $unUtilisateur = $lesUtilisateurs[0];
        }
        return $unUtilisateur;
    }

    public function existe(string $email): bool{
        $req = "SELECT * FROM Utilisateurs WHERE email = :email";
        $res = ($this->loadQuery($this->bd->execSQL($req,[':email'=>$email])));
        return ($res != []);
    }

    // Permet de savoir si le mot de passe correspond à celui du client donné
    function MdpJuste(string $mel_cli, string $mdp_cli) {
        $verifMdp = $this->bd->execSQL("SELECT mot_de_passe 
            FROM Utilisateurs
            WHERE email = :mel_cli",[':mel_cli'=>$mel_cli])[0]['mot_de_passe'];

        return password_verify($mdp_cli, $verifMdp);
    }

    public function sauvegarderToken($email, $token, $expiration) {
        $this->bd->execSQL("INSERT INTO TokenMdpOublie (email, token, expiration) 
        VALUES (:email, :token, :expiration)",["email"=>$email,"token"=>$token,"expiration"=>$expiration]);
    }



    public function getNomByEmail(string $email): string {
        $req = "SELECT nom FROM Utilisateurs WHERE email = :email";
        $res = $this->bd->execSQL($req, [':email' => $email]);
        if (!empty($res)) {
            return $res[0]['nom'];
        }
        return ''; 
    }

   
    

    



}
?>