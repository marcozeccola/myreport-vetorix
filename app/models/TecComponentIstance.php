<?php
     class TecComponentIstance{
          private $db;
          public function __construct() {
               $this->db = new Database;
          }


          public function insert($data) {
               $this->db->query('INSERT INTO teccomponentistance (technique, fk_idComponentIstance)
                                   VALUES(:technique, :fk_idComponentIstance )');
          
               $this->db->bind(':technique', $data["technique"]); 
               $this->db->bind(':fk_idComponentIstance', $data["idComponentIstance"]); 
          
               if ($this->db->execute()) {
                    return $this->db->lastinsertid();
               } else {
                    return false;
               }
          }
           
          
          public function getTecCompById($id){
               $this->db->query("SELECT * FROM teccomponentistance
                                   WHERE idTecComponentIstance=:id");

                                   
               $this->db->bind(':id', $id); 

               $result = (object)$this->db->single();

               return $result;
          }

          
          public function getTecCompByIdComponentIstance($id){
               $this->db->query("SELECT * FROM teccomponentistance
                                   WHERE fk_idComponentIstance=:id");

                                   
               $this->db->bind(':id', $id); 

               $result = $this->db->resultSet();

               return $result;
          }

          public function getBuildingTecByIdInspection($id){
               $this->db->query("SELECT * FROM teccomponentistance
                                   INNER JOIN componentistances ON componentistances.idComponentIstance = teccomponentistance.fk_idComponentIstance
                                   INNER JOIN inspections ON inspections.fk_idModelIstance = componentistances.fk_idModelIstance
                                   WHERE idInspection=:id");

                                   
               $this->db->bind(':id', $id); 

               $result = $this->db->resultSet();

               return $result;
          }
  
          
          public function deleteTecCompById($id){
               $this->db->query("DELETE FROM teccomponentistance WHERE idTecComponentIstance = :id");
               $this->db->bind(':id', $id); 
          
               if ($this->db->execute()) {
                    return true;
               } else {
                    return false;
               }
          }

          
          
          public function deleteTecByIdComponentIstance($id){
               $this->db->query("DELETE FROM teccomponentistance WHERE fk_idComponentIstance = :id");
               $this->db->bind(':id', $id); 
          
               if ($this->db->execute()) {
                    return true;
               } else {
                    return false;
               }
          }

         
     }
?>