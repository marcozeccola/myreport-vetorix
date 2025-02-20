<?php
     class SurfaceCondition{
          private $db;
          public function __construct() {
               $this->db = new Database;
          }


          public function insert($data) {
               $this->db->query('INSERT INTO surfaceconditions (surfaceCondition, fk_idInspection)
                                   VALUES(:surfaceCondition, :fk_idInspection )');
          
               $this->db->bind(':surfaceCondition', $data["condition"]); 
               $this->db->bind(':fk_idInspection', $data["idInspection"]); 
          
               if ($this->db->execute()) {
                    return $this->db->lastinsertid();
               } else {
                    return false;
               }
          }
           
          
          public function getSurfaceConditionById($id){
               $this->db->query("SELECT * FROM surfaceconditions
                                   WHERE idSurfaceCondition=:id");

                                   
               $this->db->bind(':id', $id); 

               $result = (object)$this->db->single();

               return $result;
          }

          
          public function getSurfaceConditionByIdInspection($id){
               $this->db->query("SELECT * FROM surfaceconditions
                                   WHERE fk_idInspection=:id");

                                   
               $this->db->bind(':id', $id); 

               $result = $this->db->resultSet();

               return $result;
          }
  
          
          public function deleteSurfaceConditionById($id){
               $this->db->query("DELETE FROM surfaceconditions WHERE idSurfaceCondition = :id");
               $this->db->bind(':id', $id); 
          
               if ($this->db->execute()) {
                    return true;
               } else {
                    return false;
               }
          }

          
          
          public function deleteSurfaceConditionByIdInspection($id){
               $this->db->query("DELETE FROM surfaceconditions WHERE fk_idInspection = :id");
               $this->db->bind(':id', $id); 
          
               if ($this->db->execute()) {
                    return true;
               } else {
                    return false;
               }
          }

         
     }
?>