<?php
     class ProbeDimension{
          private $db;
          public function __construct() {
               $this->db = new Database;
          }


          public function insert($data) {
               $this->db->query('INSERT INTO probedimensions (probeDimension, fk_idUltraSound)
                                   VALUES(:probeDimension, :fk_idUltraSound )');
          
               $this->db->bind(':probeDimension', $data["probeDimension"]); 
               $this->db->bind(':fk_idUltraSound', $data["idUltraSound"]); 
          
               if ($this->db->execute()) {
                    return $this->db->lastinsertid();
               } else {
                    return false;
               }
          }
           
          public function getProbeDimensionByIdUltrasound($id){
               $this->db->query("SELECT * FROM probedimensions
                                   WHERE fk_idUltrasound=:id");

                                   
               $this->db->bind(':id', $id); 

               $result = $this->db->resultSet();

               return $result;
          }

          public function getProbeDimensionsByIdInspection($id){
               $this->db->query("SELECT * FROM probedimensions
                                   INNER JOIN ultrasoundinspection ON idUltrasoundInspection = probedimensions.fk_idUltraSound
                                   WHERE fk_idInspection=:id");

                                   
               $this->db->bind(':id', $id); 

               $result = $this->db->resultSet();  

               return $result;
          }
          
          public function getIdProbeDimensionById($id){
               $this->db->query("SELECT * FROM probedimensions
                                   WHERE idProbeDimension =:id");

               $this->db->bind(':id', $id); 

               $result = (object)$this->db->single();

               return $result;
          }
 
          public function deleteProbeDimensionById($id){
               $this->db->query("DELETE FROM probedimensions WHERE idProbeDimension = :id");
               $this->db->bind(':id', $id); 
          
               if ($this->db->execute()) {
                    return true;
               } else {
                    return false;
               }
          }

          public function deleteProbeDimensionByIdUltrasound($id){
               $this->db->query("DELETE FROM probedimensions WHERE fk_idUltraSound = :id");
               $this->db->bind(':id', $id); 
          
               if ($this->db->execute()) {
                    return true;
               } else {
                    return false;
               }
          }
         
     }
?>