<?php
     class UltrasoundInspection{
          private $db;
          public function __construct() {
               $this->db = new Database;
          }


          public function insert($data) {
               $this->db->query('INSERT INTO ultrasoundinspection (ultrasound, 
                                                                      sn,
                                                                      expiration,
                                                                      probe,
                                                                      fk_idInspection)
                                   VALUES(:ultrasound,
                                             :sn,
                                             :expiration,
                                             :probe,
                                             :fk_idInspection )');
          
               $this->db->bind(':ultrasound', $data["ultrasound"]); 
               $this->db->bind(':sn', $data["sn"]); 
               $this->db->bind(':expiration', $data["expiration"]); 
               $this->db->bind(':probe', $data["probe"]); 
               $this->db->bind(':fk_idInspection', $data["idInspection"]); 
          
               if ($this->db->execute()) {
                    return $this->db->lastinsertid();
               } else {
                    return false;
               }
          }
           
          
          public function getUltrasoundInspectionById($id){
               $this->db->query("SELECT * FROM ultrasoundinspection
                                   WHERE idUltrasoundInspection=:id");

                                   
               $this->db->bind(':id', $id); 

               $result = (object)$this->db->single();

               return $result;
          }

          
          public function getUltrasoundInspectionByIdInspection($id){
               $this->db->query("SELECT * FROM ultrasoundinspection
                                   WHERE fk_idInspection=:id");

                                   
               $this->db->bind(':id', $id); 

               $result = $this->db->resultSet();

               return $result;
          }
  
          
          public function deleteUltrasoundInspectionById($id){
               $this->db->query("DELETE FROM ultrasoundinspection WHERE idUltrasoundInspection = :id");
               $this->db->bind(':id', $id); 
          
               if ($this->db->execute()) {
                    return true;
               } else {
                    return false;
               }
          }
          
          public function update($data){
               $this->db->query("UPDATE ultrasoundinspection
                                   SET ultrasound = :ultrasound,
                                       sn = :sn,
                                       expiration = :expiration,
                                       probe = :probe
                                   WHERE idUltrasoundInspection = :id");

                                   
               $this->db->bind(':ultrasound', $data["ultrasound"]); 
               $this->db->bind(':sn', $data["sn"]); 
               $this->db->bind(':expiration', $data["expiration"]); 
               $this->db->bind(':probe', $data["probe"]); 
               $this->db->bind(':id', $data["id"]); 
          
               if ($this->db->execute()) {
                    return true;
               } else {
                    return false;
               }
          }

         
     }
?>