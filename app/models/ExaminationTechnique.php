<?php
     class ExaminationTechnique{
          private $db;
          public function __construct() {
               $this->db = new Database;
          }


          public function insert($data) {
               $this->db->query('INSERT INTO examinationtechniques (examinationtechnique, fk_idInspection)
                                   VALUES(:examinationtechnique, :fk_idInspection )');
          
               $this->db->bind(':examinationtechnique', $data["examinationtechnique"]); 
               $this->db->bind(':fk_idInspection', $data["idInspection"]); 
          
               if ($this->db->execute()) {
                    return $this->db->lastinsertid();
               } else {
                    return false;
               }
          }
          
          
          
          public function getExaminationTechniquesByIdInspection($id){
               $this->db->query("SELECT * FROM examinationtechniques
                                   WHERE fk_idInspection=:id");

                                   
               $this->db->bind(':id', $id); 

               $result = $this->db->resultSet();

               return $result;
          }
  
          
          public function getExaminationTechniqueById($id){
               $this->db->query("SELECT * FROM examinationtechniques
                                   WHERE idExaminationTechnique = :id");

                                   
               $this->db->bind(':id', $id); 

               $result = (object)$this->db->single();

               return $result;
          }

          
          public function deleteExaminationTechniqueById($id){
               $this->db->query("DELETE FROM examinationtechniques WHERE idExaminationTechnique = :id");
               $this->db->bind(':id', $id); 
          
               if ($this->db->execute()) {
                    return true;
               } else {
                    return false;
               }
          }

          public function deleteExaminationTechniqueByIdInspection($id){
               $this->db->query("DELETE FROM examinationtechniques WHERE fk_idInspection = :id");
               $this->db->bind(':id', $id); 
          
               if ($this->db->execute()) {
                    return true;
               } else {
                    return false;
               }
          }
         
     }
?>