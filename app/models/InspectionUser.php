<?php
     class InspectionUser{
          private $db;
          public function __construct() {
               $this->db = new Database;
          }


          public function insert($data) {
               $this->db->query('INSERT INTO inspectionusers (fk_idUser, fk_idInspection)
                                   VALUES(:fk_idUser, :fk_idInspection )');
          
               $this->db->bind(':fk_idUser', $data["idUser"]); 
               $this->db->bind(':fk_idInspection', $data["idInspection"]); 
          
               if ($this->db->execute()) {
                    return $this->db->lastinsertid();
               } else {
                    return false;
               }
          }
           
          
          public function getInspectionUsersByIdInspection($id){
               $this->db->query("SELECT * FROM inspectionusers
                                   INNER JOIN users ON users.idUser = inspectionusers.fk_idUser
                                   WHERE fk_idInspection = :id");

                                   
               $this->db->bind(':id', $id); 

               $result = $this->db->resultSet();

               return $result;
          }
 

          public function getInspectionUsersByIdUser($id){
               $this->db->query("SELECT * FROM inspectionusers
                                   WHERE fk_idUser=:id");
                                   
               $this->db->bind(':id', $id); 

               $result = $this->db->resultSet();

               return $result;
          }
   
          public function getInspectionUserById($id){
               $this->db->query("SELECT * FROM inspectionusers
                                   WHERE idInspectionUser = :id");

                                   
               $this->db->bind(':id', $id); 

               $result = (object)$this->db->single();

               return $result;
          }

          
          public function deleteInspectionUserById($id){
               $this->db->query("DELETE FROM inspectionusers WHERE idInspectionUser = :id");
               $this->db->bind(':id', $id); 
          
               if ($this->db->execute()) {
                    return true;
               } else {
                    return false;
               }
          }

         
     }
?>