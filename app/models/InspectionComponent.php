<?php
     class InspectionComponent{
          private $db;
          public function __construct() {
               $this->db = new Database;
          }


          public function insert($data) {
               $this->db->query('INSERT INTO inspectioncomponents (interferences, fk_idInspection, fk_idComponentIstance)
                                   VALUES(:interferences, :fk_idInspection ,:fk_idComponentIstance )');
          
               $this->db->bind(':interferences', $data["interferences"]); 
               $this->db->bind(':fk_idInspection', $data["idInspection"]); 
               $this->db->bind(':fk_idComponentIstance', $data["idComponentIstance"]); 
          
               if ($this->db->execute()) {
                    return $this->db->lastinsertid();
               } else {
                    return false;
               }
          }

          public function getInspectionComponentByInspectionAndComponent($idInspection, $idComponent){
               $this->db->query("SELECT * FROM inspectioncomponents
                                   WHERE fk_idInspection = :fk_idInspection AND fk_idComponentIstance = :fk_idComponentIstance");

                                   
               $this->db->bind(':fk_idInspection', $idInspection); 
               $this->db->bind(':fk_idComponentIstance', $idComponent); 

               $result = $this->db->single();

               return $result;
          }

           
          public function getInspectionComponentById($id){
               $this->db->query("SELECT * FROM inspectioncomponents
                                   WHERE idInspectionComponent=:id");

                                   
               $this->db->bind(':id', $id); 

               $result = (object)$this->db->single();

               return $result;
          }

          
          public function getInspectionComponentsByIdInspection($id){
               $this->db->query("SELECT * FROM inspectioncomponents
                                   WHERE fk_idInspection=:id");

                                   
               $this->db->bind(':id', $id); 

               $result = $this->db->resultSet();

               return $result;
          }


          
          
          public function getComponentsByIdInspection($id){
               $this->db->query("SELECT * FROM inspectioncomponents
                                        INNER JOIN componentIstances 
                                        ON componentIstances.idComponentIstance = inspectioncomponents.fk_idComponentIstance 
                                   WHERE fk_idInspection=:id");

                                   
               $this->db->bind(':id', $id); 

               $result = $this->db->resultSet();

               return $result;
          }
          
  
          

          public function editInterferences($data){
               $this->db->query("UPDATE inspectioncomponents 
                        SET interferences = :interferences 
                        WHERE idInspectionComponent = :id;");

               $this->db->bind(":interferences", $data["interferences"]);  
               $this->db->bind(":id", $data["idInspectionComponent"]); 

               if ($this->db->execute()) {
                    return true;
               } else {
                    return false;
               }
          }

          
          public function editNotes($data){
               $this->db->query("UPDATE inspectioncomponents 
                        SET notes = :notes 
                        WHERE idInspectionComponent = :id;");

               $this->db->bind(":notes", $data["notes"]);  
               $this->db->bind(":id", $data["idInspectionComponent"]); 

               if ($this->db->execute()) {
                    return true;
               } else {
                    return false;
               }
          }

          
          public function deleteInspectionComponentById($id){
               $this->db->query("DELETE FROM inspectioncomponents WHERE idInspectionComponent = :id");
               $this->db->bind(':id', $id); 
          
               if ($this->db->execute()) {
                    return true;
               } else {
                    return false;
               }
          }
           

         
     }
?>