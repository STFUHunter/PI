<?php
    
    namespace App\Core;
    use PDO;
    
    abstract class BaseModel {
        protected PDO $db;

        //constructeur pour initilaser la connexion
        public function __construct(){
            $this->db = DataBase::getConnection();
        }

        protected function query(string $sql, array $params = []){
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        }

        protected function fetchOne(string $sql, array $params = []){
            $stmt = $this->query($sql, $params);
            return $stmt->fetch();
        }

        protected function fetchAll(string $sql, array $params = []){
            $stmt = $this->query($sql, $params);
            return $stmt->fetchAll();
        }

        protected function execute(string $sql, array $params = []){
            $stmt = $this->query($sql, $params);
            return $stmt->rowCount();
        }

        //methode hydrate : automatisation de remplissage des donnees de l'utilisateur
        protected function hydrate(array $data) : void {
            foreach($data as $cle => $valeur){
                if(property_exists($this, $cle)){
                    $this->$cle = $valeur;
                }
            }
        }
    }