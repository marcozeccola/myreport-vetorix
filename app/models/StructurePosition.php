<?php
     class StructurePosition{
          private $db;
          public function __construct() {
               $this->db = new Database;
          }


          public function insert($data) {
               $this->db->query('INSERT INTO structurepositions (structurePosition, fk_idInspection)
                                   VALUES(:structurePosition, :fk_idInspection )');
          
               $this->db->bind(':structurePosition', $data["position"]); 
               $this->db->bind(':fk_idInspection', $data["idInspection"]); 
          
               if ($this->db->execute()) {
                    return $this->db->lastinsertid();
               } else {
                    return false;
               }
          }
           
          
          public function getStructurePositionById($id){
               $this->db->query("SELECT * FROM structurepositions
                                   WHERE idStructurePosition=:id");

                                   
               $this->db->bind(':id', $id); 

               $result = (object)$this->db->single();

               return $result;
          }

          
          public function getStructurePositionByIdInspection($id){
               $this->db->query("SELECT * FROM structurepositions
                                   WHERE fk_idInspection=:id");

                                   
               $this->db->bind(':id', $id); 

               $result = $this->db->resultSet();

               return $result;
          }
  
          
          public function deleteStructurePositionById($id){
               $this->db->query("DELETE FROM structurepositions WHERE idStructurePosition = :id");
               $this->db->bind(':id', $id); 
          
               if ($this->db->execute()) {
                    return true;
               } else {
                    return false;
               }
          }

          
          public function deleteStructurePositionByIdInspection($id){
               $this->db->query("DELETE FROM structurepositions WHERE fk_idInspection = :id");
               $this->db->bind(':id', $id); 
          
               if ($this->db->execute()) {
                    return true;
               } else {
                    return false;
               }
          }

         
     }
?>