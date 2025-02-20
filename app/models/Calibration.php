<?php
     class Calibration{
          private $db;
          public function __construct() {
               $this->db = new Database;
          }


          public function insert($data) {
               $this->db->query('INSERT INTO calibrations (calibration, fk_idInspection)
                                   VALUES(:calibration, :fk_idInspection )');
          
               $this->db->bind(':calibration', $data["calibration"]); 
               $this->db->bind(':fk_idInspection', $data["idInspection"]); 
          
               if ($this->db->execute()) {
                    return $this->db->lastinsertid();
               } else {
                    return false;
               }
          }
           
          
          public function getCalibrationById($id){
               $this->db->query("SELECT * FROM calibrations
                                   WHERE idCalibration=:id");

                                   
               $this->db->bind(':id', $id); 

               $result = (object)$this->db->single();

               return $result;
          }

          
          public function getCalibrationsByIdInspection($id){
               $this->db->query("SELECT * FROM calibrations
                                   WHERE fk_idInspection=:id");

                                   
               $this->db->bind(':id', $id); 

               $result = $this->db->resultSet();

               return $result;
          }
  
          
          public function deleteCalibrationById($id){
               $this->db->query("DELETE FROM calibrations WHERE idCalibration = :id");
               $this->db->bind(':id', $id); 
          
               if ($this->db->execute()) {
                    return true;
               } else {
                    return false;
               }
          }
          
          public function deleteCalibrationByIdInspection($id){
               $this->db->query("DELETE FROM calibrations WHERE fk_idInspection = :id");
               $this->db->bind(':id', $id); 
          
               if ($this->db->execute()) {
                    return true;
               } else {
                    return false;
               }
          }

         
     }
?>