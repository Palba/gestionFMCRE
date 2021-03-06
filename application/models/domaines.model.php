<?php
    defined('__COUPDEPOUCE__') or die('Acces interdit');

    class DomainesModel extends Model {
        
        public function sauver($libelle) {
            $sql = "INSERT INTO domaines SET libelle = :libelle, annee = :annee";
            $req = $this->db->prepare($sql);
            
            $req->bindValue(':libelle', $libelle);
            $req->bindValue(':annee', Application::getConfig()->annee_courante);
            
            try {
                $req->execute();
            } catch (PDOException $ex) {
                throw new Erreur('Erreur SQL : '.$ex->getMessage());
            }
        }
        
        public function lister() {
            
            $sql = "SELECT domaines.id, libelle, message, dateFinMessage FROM domaines WHERE annee = :annee";        
            $req = $this->db->prepare($sql);              
            $req->bindValue(':annee', Application::getConfig()->annee_courante);
            
            try {
                $req->execute();
            } catch (PDOException $ex) {
                throw new Erreur("Erreur SQL ".$ex->getMessage());
            }
            return $req->fetchAll(PDO::FETCH_ASSOC);
        }  
        
        public function supprimer($id){
            $sql = "DELETE FROM domaines WHERE id = :id";
            $req = $this->db->prepare($sql);
            
            $req->bindValue(':id', $id);
            
            try {
                $req->execute();
            } catch (PDOException $ex) {
                throw new Erreur("Erreur SQL ".$ex->getMessage());
            }
        }
    }
    
    

