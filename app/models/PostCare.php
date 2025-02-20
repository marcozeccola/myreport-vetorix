<?php
     class PostCare{
          private $db;
          public function __construct() {
               $this->db = new Database;
          }


          public function insert($data) {
               $this->db->query('INSERT INTO postcare (postcare, fk_idComponentIstance)
                                   VALUES(:postcare, :fk_idComponentIstance )');
          
               $this->db->bind(':postcare', $data["postcare"]); 
               $this->db->bind(':fk_idComponentIstance', $data["idComponentIstance"]); 
          
               if ($this->db->execute()) {
                    return $this->db->lastinsertid();
               } else {
                    return false;
               }
          }
           
          
          public function getPostCareById($id){
               $this->db->query("SELECT * FROM postcare
                                   WHERE idPostCare=:id");

                                   
               $this->db->bind(':id', $id); 

               $result = (object)$this->db->single();

               return $result;
          }

          
          public function getPostCareByIdComponentIstance($id){
               $this->db->query("SELECT * FROM postcare
                                   WHERE fk_idComponentIstance=:id");

                                   
               $this->db->bind(':id', $id); 

               $result = $this->db->resultSet();

               return $result;
          }

          public function getPostCareByIdInspection($id){
               $this->db->query("SELECT * FROM postcare
                                   INNER JOIN componentistances ON componentistances.idComponentIstance = postcare.fk_idComponentIstance
                                   INNER JOIN inspections ON inspections.fk_idModelIstance = componentistances.fk_idModelIstance
                                   WHERE idInspection=:id");

                                   
               $this->db->bind(':id', $id); 

               $result = $this->db->resultSet();

               return $result;
          }

          
          public function deletePostCareByIdComponentIstance($id){
               $this->db->query("DELETE FROM postcare WHERE fk_idComponentIstance = :id");
               $this->db->bind(':id', $id); 
          
               if ($this->db->execute()) {
                    return true;
               } else {
                    return false;
               }
          }

          
          public function deletePostCareById($id){
               $this->db->query("DELETE FROM postcare WHERE idPostCare = :id");
               $this->db->bind(':id', $id); 
          
               if ($this->db->execute()) {
                    return true;
               } else {
                    return false;
               }
          }

         
     }
?>