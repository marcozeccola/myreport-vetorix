<?php
     class Inspection{
          private $db;
          public function __construct() {
               $this->db = new Database;
          }
 

          public function insert($data) {
               $this->db->query('INSERT INTO inspections (date, 
                                                                 client, 
                                                                 projectId,
                                                                 builder,
                                                                 factory,
                                                                 year,
                                                                 location,
                                                                 goal,
                                                                 type,
                                                                 goalNotes,
                                                                 specificProcedure,
                                                                 accessibility,
                                                                 calibrationNotes,
                                                                 conclusions,
                                                                 fk_idModelIstance,
                                                                 fk_idReviewer)
                                                        VALUES(:date, 
                                                                 :client, 
                                                                 :projectId,
                                                                 :builder,
                                                                 :factory,
                                                                 :year,
                                                                 :location,
                                                                 :goal,
                                                                 :type,
                                                                 :goalNotes,
                                                                 :specificProcedure,
                                                                 :accessibility,
                                                                 :calibrationNotes,
                                                                 :conclusions,
                                                                 :fk_idModelIstance,
                                                                 :fk_idReviewer )');
          
               $this->db->bind(':client', $data["client"]); 
               $this->db->bind(':date', $data["date"]); 
               $this->db->bind(':projectId', $data["projectId"]); 
               $this->db->bind(':builder', $data["builder"]); 
               $this->db->bind(':factory', $data["factory"]); 
               $this->db->bind(':year', $data["year"]); 
               $this->db->bind(':location', $data["location"]); 
               $this->db->bind(':goal', $data["goal"]); 
               $this->db->bind(':type', $data["type"]); 
               $this->db->bind(':goalNotes', $data["goalNotes"]); 
               $this->db->bind(':specificProcedure', $data["specificProcedure"]); 
               $this->db->bind(':accessibility', $data["accessibility"]); 
               $this->db->bind(':calibrationNotes', $data["calibrationNotes"]); 
               $this->db->bind(':conclusions', $data["conclusions"]); 
               $this->db->bind(':fk_idModelIstance', $data["fk_idModelIstance"]); 
               $this->db->bind(':fk_idReviewer', $data["fk_idReviewer"]); 
          
               if ($this->db->execute()) {
                    return $this->db->lastinsertid();
               } else {
                    return false;
               }
          }
           
          
          public function getInspectionById($id){
               $this->db->query("SELECT * FROM inspections
                                   WHERE idInspection=:id");

                                   
               $this->db->bind(':id', $id); 

               $result = (object)$this->db->single();

               return $result;
          }

          
          public function getInspectionsByIdModelIstance($id){
               $this->db->query("SELECT * FROM inspections
                                   WHERE fk_idModelIstance=:id");

                                   
               $this->db->bind(':id', $id); 

               $result = $this->db->resultSet();

               return $result;
          }
 
  
          public function editInspection($data){
               $this->db->query("UPDATE inspections 
                        SET date = :date, 
                              client = :client, 
                              projectId = :projectId,
                              builder = :builder,
                              factory = :factory ,
                              year = :year,
                              location = :location,
                              goal = :goal,
                              type = :type,
                              goalNotes = :goalNotes,
                              specificProcedure = :specificProcedure,
                              accessibility = :accessibility,
                              calibrationNotes = :calibrationNotes,
                              conclusions = :conclusions, 
                              fk_idReviewer = :fk_idReviewer
                        WHERE idInspection = :id;");

               $this->db->bind(':client', $data["client"]); 
               $this->db->bind(':date', $data["date"]); 
               $this->db->bind(':projectId', $data["projectId"]); 
               $this->db->bind(':builder', $data["builder"]); 
               $this->db->bind(':factory', $data["factory"]); 
               $this->db->bind(':year', $data["year"]); 
               $this->db->bind(':location', $data["location"]); 
               $this->db->bind(':goal', $data["goal"]); 
               $this->db->bind(':type', $data["type"]); 
               $this->db->bind(':goalNotes', $data["goalNotes"]); 
               $this->db->bind(':specificProcedure', $data["specificProcedure"]); 
               $this->db->bind(':accessibility', $data["accessibility"]); 
               $this->db->bind(':calibrationNotes', $data["calibrationNotes"]); 
               $this->db->bind(':conclusions', $data["conclusions"]); 
               $this->db->bind(':id', $data["id"]); 
               $this->db->bind(':fk_idReviewer', $data["fk_idReviewer"]); 
          

               if ($this->db->execute()) {
                    return true;
               } else {
                    return false;
               }
          }
           
           public function editBasicInfo($data){
               $this->db->query("UPDATE inspections 
                        SET date = :date, 
                              client = :client, 
                              projectId = :projectId,
                              builder = :builder,
                              factory = :factory ,
                              year = :year,
                              location = :location,
                              goal = :goal,
                              type = :type,
                              goalNotes = :goalNotes 
                        WHERE idInspection = :id;");

               $this->db->bind(':client', $data["client"]); 
               $this->db->bind(':date', $data["date"]); 
               $this->db->bind(':projectId', $data["projectId"]); 
               $this->db->bind(':builder', $data["builder"]); 
               $this->db->bind(':factory', $data["factory"]); 
               $this->db->bind(':year', $data["year"]); 
               $this->db->bind(':location', $data["location"]); 
               $this->db->bind(':goal', $data["goal"]); 
               $this->db->bind(':type', $data["type"]); 
               $this->db->bind(':goalNotes', $data["goalNotes"]);  
               $this->db->bind(':id', $data["idInspection"]);  
          

               if ($this->db->execute()) {
                    return true;
               } else {
                    return false;
               }
          }

          public function editProcedures($data){
               $this->db->query("UPDATE inspections 
                        SET   specificProcedure = :specificProcedure,
                              accessibility = :accessibility
                               WHERE idInspection = :id;");
 
               $this->db->bind(':specificProcedure', $data["procedure"]); 
               $this->db->bind(':accessibility', $data["accessibility"]);  
               $this->db->bind(':id', $data["id"]);  
          

               if ($this->db->execute()) {
                    return true;
               } else {
                    return false;
               }
          }

          
          public function editCalibrationNotes($data){
               $this->db->query("UPDATE inspections 
                        SET   calibrationNotes = :calibrationNotes 
                               WHERE idInspection = :id;");
 
               $this->db->bind(':calibrationNotes', $data["calibrationNotes"]);  
               $this->db->bind(':id', $data["id"]);  
          

               if ($this->db->execute()) {
                    return true;
               } else {
                    return false;
               }
          }
          
          
          public function reviewInspection($id){
               $this->db->query("UPDATE inspections 
                        SET   isReviewed = :isReviewed 
                               WHERE idInspection = :id;");
 
               $this->db->bind(':isReviewed', true);  
               $this->db->bind(':id', $id);  
          

               if ($this->db->execute()) {
                    return true;
               } else {
                    return false;
               }
          }

          
          
          public function unreviewInspection($id){
               $this->db->query("UPDATE inspections 
                        SET   isReviewed = :isReviewed 
                               WHERE idInspection = :id;");
 
               $this->db->bind(':isReviewed', false);  
               $this->db->bind(':id', $id);  
          

               if ($this->db->execute()) {
                    return true;
               } else {
                    return false;
               }
          }
          

          
          public function editConclusions($data){
               $this->db->query("UPDATE inspections 
                        SET   conclusions = :conclusions 
                               WHERE idInspection = :id;");
 
               $this->db->bind(':conclusions', $data["conclusions"]);  
               $this->db->bind(':id', $data["id"]);  
          

               if ($this->db->execute()) {
                    return true;
               } else {
                    return false;
               }
          }

          
          public function editReviewer($data){
               $this->db->query("UPDATE inspections 
                        SET   fk_idReviewer = :idReviewer 
                               WHERE idInspection = :id;");
 
               $this->db->bind(':idReviewer', $data["idReviewer"]);  
               $this->db->bind(':id', $data["id"]);  
          

               if ($this->db->execute()) {
                    return true;
               } else {
                    return false;
               }
          }



         
     }
?>