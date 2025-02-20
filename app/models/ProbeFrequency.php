<?php
     class ProbeFrequency{
          private $db;
          public function __construct() {
               $this->db = new Database;
          }


          public function insert($data) {
               $this->db->query('INSERT INTO probefrequency (probeFrequency, fk_idUltraSound)
                                   VALUES(:probefrequency, :fk_idUltraSound )');
          
               $this->db->bind(':probefrequency', $data["probefrequency"]); 
               $this->db->bind(':fk_idUltraSound', $data["idUltraSound"]); 
          
               if ($this->db->execute()) {
                    return $this->db->lastinsertid();
               } else {
                    return false;
               }
          }
           
          public function getProbeFrequencyByIdUltrasound($id){
               $this->db->query("SELECT * FROM probefrequency
                                   WHERE fk_idUltrasound=:id");

                                   
               $this->db->bind(':id', $id); 

               $result = $this->db->resultSet();

               return $result;
          }
          
          public function getIdProbeFrequencyById($id){
               $this->db->query("SELECT * FROM probefrequency
                                   WHERE idProbeFrequency =:id");

               $this->db->bind(':id', $id); 

               $result = (object)$this->db->single();

               return $result;
          }
 
          public function deleteProbeDimentionById($id){
               $this->db->query("DELETE FROM probefrequency WHERE idProbeFrequency = :id");
               $this->db->bind(':id', $id); 
          
               if ($this->db->execute()) {
                    return true;
               } else {
                    return false;
               }
          }

          public function deleteFrequencyByIdUltrasound($id){
               $this->db->query("DELETE FROM probefrequency WHERE fk_idUltraSound = :id");
               $this->db->bind(':id', $id); 
          
               if ($this->db->execute()) {
                    return true;
               } else {
                    return false;
               }
          }

         
     }
?>