<?php
    class Connexion {
        private $db;
        public function __construct(){
            $db_config['SGBD'] = 'mysql';
            $db_config['HOST'] = 'localhost';
            $db_config['DB_NAME'] = 'projetK';
            $db_config['USER'] = 'projet';
            $db_config['PASSWORD'] = 'projetKiener';

            try{
                $this->db = new PDO( $db_config['SGBD'].':host='.$db_config['HOST'].';dbname='.$db_config['DB_NAME'],
                    $db_config['USER'], $db_config['PASSWORD'],
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
                    // permet d’afficher les caractères utf8 si la BdD est définie en utf8 (accents…)
                    unset($db_config);
            }
            catch( Exception $exception ) {
                die($exception->getMessage());
            }
        }

        public function execSQL(string $req, array $valeurs=[]): array{

            try{

            $res = $this->db->prepare($req);
            error_log("Executing SQL: $req with values: " . json_encode($valeurs));
            $res->execute($valeurs);
            return $res->fetchAll(PDO::FETCH_ASSOC);

            }catch(PDOException $exception ) {
                die("Erreur SQL".$exception->getMessage());
            }
        }
    }
?>