<?php
     class Uninspectible{
          private $db;
          public function __construct() {
               $this->db = new Database;
          }


          public function insert($data) {
               $this->db->query('INSERT INTO uninspectibles (imageName, width, height, x, y, fk_idComponentIstance) 
                              VALUES (:imageName, :width,:height, :x, :y, :fk_idComponentIstance)');
          
               $this->db->bind(':imageName', $data["imageName"]); 
               $this->db->bind(':width', $data["width"]); 
               $this->db->bind(':height', $data["height"]); 
               $this->db->bind(':x', $data["x"]); 
               $this->db->bind(':y', $data["y"]); 
               $this->db->bind(':fk_idComponentIstance', $data["idComponentIstance"]); 
          
               if ($this->db->execute()) {
                    return $this->db->lastinsertid();
               } else {
                    return false;
               }
          }  
           
          
          public function getUninspectibleByIdComponent($id){
               $this->db->query("SELECT * FROM uninspectibles 
                         WHERE   fk_idComponentIstance = :id");
                
               $this->db->bind(':id', $id); 

               $result = $this->db->resultSet();

               return $result;
          }
          
          public function getUninspectibleByImageNameAndIdComponent($data){
               $this->db->query("SELECT * FROM uninspectibles 
                         WHERE imageName = :imageName 
                         AND fk_idComponentIstance = :idComponentIstance");
               
               $this->db->bind(':imageName', $data["imageName"]); 
               $this->db->bind(':idComponentIstance', $data["idComponentIstance"]); 

               $result = $this->db->resultSet();

               return $result;
          }  

          public function delete($id){
               $this->db->query("DELETE FROM uninspectibles WHERE idUninspectible = :id");

               $this->db->bind(':id', $id); 
          
               if ($this->db->execute()) {
                    return true;
               } else {
                    return false;
               }
          }

         
     }
?>