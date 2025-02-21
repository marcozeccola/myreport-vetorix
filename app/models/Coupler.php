<?php
     class Coupler{
          private $db;
          public function __construct() {
               $this->db = new Database;
          }


          public function insert($data) {
               $this->db->query('INSERT INTO couplers (coupler, fk_idUltraSound)
                                   VALUES(:coupler, :fk_idUltraSound )');
          
               $this->db->bind(':coupler', $data["coupler"]); 
               $this->db->bind(':fk_idUltraSound', $data["idUltraSound"]); 
          
               if ($this->db->execute()) {
                    return $this->db->lastinsertid();
               } else {
                    return false;
               }
          }
           
          public function getCouplerByIdUltrasound($id){
               $this->db->query("SELECT * FROM couplers
                                   WHERE fk_idUltrasound=:id");

                                   
               $this->db->bind(':id', $id); 

               $result = $this->db->resultSet();

               return $result;
          }

           
          public function getCouplersByIdInspection($id){
               $this->db->query("SELECT * FROM couplers
                                   INNER JOIN ultrasoundinspection ON idUltrasoundInspection = couplers.fk_idUltraSound
                                   WHERE fk_idInspection=:id");

                                   
               $this->db->bind(':id', $id); 

               $result = $this->db->resultSet();

               return $result;
          }
          
          
          public function getCouplerById($id){
               $this->db->query("SELECT * FROM couplers
                                   WHERE idCoupler=:id");

                                   
               $this->db->bind(':id', $id); 

               $result = (object)$this->db->single();

               return $result;
          }

          
          
          public function deleteCouplerById($id){
               $this->db->query("DELETE FROM couplers WHERE idCoupler = :id");
               $this->db->bind(':id', $id); 
          
               if ($this->db->execute()) {
                    return true;
               } else {
                    return false;
               }
          }

          
          public function deleteCouplerByIdUltrasound($id){
               $this->db->query("DELETE FROM couplers WHERE fk_idUltraSound = :id");
               $this->db->bind(':id', $id); 
          
               if ($this->db->execute()) {
                    return true;
               } else {
                    return false;
               }
          }
         
     }
?>