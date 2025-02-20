<?php
     class ProbeDetail{
          private $db;
          public function __construct() {
               $this->db = new Database;
          }


          public function insert($data) {
               $this->db->query('INSERT INTO probedetails (probeDetail, fk_idUltraSound)
                                   VALUES(:probeDetail, :fk_idUltraSound )');
          
               $this->db->bind(':probeDetail', $data["probeDetail"]); 
               $this->db->bind(':fk_idUltraSound', $data["idUltraSound"]); 
          
               if ($this->db->execute()) {
                    return $this->db->lastinsertid();
               } else {
                    return false;
               }
          }
           
          public function getProbeDetailByIdUltrasound($id){
               $this->db->query("SELECT * FROM probedetails
                                   WHERE fk_idUltrasound=:id");

                                   
               $this->db->bind(':id', $id); 

               $result = $this->db->resultSet();

               return $result;
          }
          
          public function getIdProbeDetailById($id){
               $this->db->query("SELECT * FROM probedetails
                                   WHERE idProbeDetail =:id");

               $this->db->bind(':id', $id); 

               $result = (object)$this->db->single();

               return $result;
          }
 
          public function deleteProbeDetailById($id){
               $this->db->query("DELETE FROM probedetails WHERE idProbeDetail = :id");
               $this->db->bind(':id', $id); 
          
               if ($this->db->execute()) {
                    return true;
               } else {
                    return false;
               }
          }

          public function deleteDetailByIdUltrasound($id){
               $this->db->query("DELETE FROM probedetails WHERE fk_idUltraSound = :id");
               $this->db->bind(':id', $id); 
          
               if ($this->db->execute()) {
                    return true;
               } else {
                    return false;
               }
          }

         
     }
?>