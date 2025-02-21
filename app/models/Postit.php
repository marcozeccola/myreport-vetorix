<?php
     class Postit{
          private $db;
          public function __construct() {
               $this->db = new Database;
          }


          public function insert($data) {
               $this->db->query('INSERT INTO postits (imageName, note, x, y, fk_idComponentIstance) 
                              VALUES (:imageName, :note, :x, :y, :fk_idComponentIstance)');
          
               $this->db->bind(':imageName', $data["imageName"]); 
               $this->db->bind(':note', $data["note"]); 
               $this->db->bind(':x', $data["x"]); 
               $this->db->bind(':y', $data["y"]); 
               $this->db->bind(':fk_idComponentIstance', $data["idComponentIstance"]); 
          
               if ($this->db->execute()) {
                    return $this->db->lastinsertid();
               } else {
                    return false;
               }
          }  
          
          public function getPositsByIdComponent($id){
               $this->db->query("SELECT * FROM postits 
                         WHERE   fk_idComponentIstance = :id");
                
               $this->db->bind(':id', $id); 

               $result = $this->db->resultSet();

               return $result;
          }
          
          public function getPostitsByImageNameAndIdComponent($data){
               $this->db->query("SELECT * FROM postits 
                         WHERE imageName = :imageName 
                         AND fk_idComponentIstance = :idComponentIstance");
               
               $this->db->bind(':imageName', $data["imageName"]); 
               $this->db->bind(':idComponentIstance', $data["idComponentIstance"]); 

               $result = $this->db->resultSet();

               return $result;
          }

          public function delete($id){
               $this->db->query("DELETE FROM postits WHERE idPostit = :id");
               $this->db->bind(':id', $id); 
          
               if ($this->db->execute()) {
                    return true;
               } else {
                    return false;
               }
          }

         
     }
?>