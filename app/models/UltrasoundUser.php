<?php
     class UltrasoundUser{
          private $db;
          public function __construct() {
               $this->db = new Database;
          }


          public function insert($data) {
               $this->db->query('INSERT INTO ultrasoundusers (ultrasound, 
                                                                      sn,
                                                                      expiration,
                                                                      probe,
                                                                      fk_idUser,
                                                                      isUsed)
                                   VALUES(:ultrasound,
                                             :sn,
                                             :expiration,
                                             :probe,
                                             :fk_idUser,
                                             :isUsed )');
          
               $this->db->bind(':ultrasound', $data["ultrasound"]); 
               $this->db->bind(':sn', $data["sn"]); 
               $this->db->bind(':expiration', $data["expiration"]); 
               $this->db->bind(':probe', $data["probe"]); 
               $this->db->bind(':fk_idUser', $data["idUser"]); 
               $this->db->bind(':isUsed', true); 
          
               if ($this->db->execute()) {
                    return $this->db->lastinsertid();
               } else {
                    return false;
               }
          }
           
          
          public function getUltrasoundUserById($id){
               $this->db->query("SELECT * FROM ultrasoundusers
                                   WHERE idUltrasoundUser=:id");

                                   
               $this->db->bind(':id', $id); 

               $result = (object)$this->db->single();

               return $result;
          }

          public function unUseUltrasoundUser($id){
                $this->db->query("UPDATE ultrasoundusers 
                        SET isUsed = :isUsed 
                        WHERE idUltrasoundUser = :id;");

               $this->db->bind(":isUsed", 0); 
               $this->db->bind(":id", $id); 

               if ($this->db->execute()) {
                    return true;
               } else {
                    return false;
               }
          }

          public function getUltrasoundUserByIdUser($id){
               $this->db->query("SELECT * FROM ultrasoundusers
                                   WHERE fk_idUser=:id  AND isUsed = :used");

                                   
               $this->db->bind(':id', $id); 
               $this->db->bind(':used', true); 

               $result = $this->db->single();

               return $result;
          }
          public function getUsedUltrasoundUserById($id){
               $this->db->query("SELECT * FROM ultrasoundusers
                                   WHERE fk_idUser=:id AND isUsed = :used");

                                   
               $this->db->bind(':id', $id); 
               $this->db->bind(':used', true); 

               $result = $this->db->single();

               return $result;
          }
  
          public function unUseAllUltrasoundByUserId($id){
                $this->db->query("UPDATE ultrasoundusers 
                        SET isUsed = :isUsed 
                        WHERE fk_idUser = :id;");

               $this->db->bind(":isUsed", 0); 
               $this->db->bind(":id", $id); 

               if ($this->db->execute()) {
                    return true;
               } else {
                    return false;
               }
          }

          
          public function deleteUltrasoundUserById($id){
               $this->db->query("DELETE FROM ultrasoundusers WHERE idUltrasoundUser = :id");
               $this->db->bind(':id', $id); 
          
               if ($this->db->execute()) {
                    return true;
               } else {
                    return false;
               }
          }

         
     }
?>