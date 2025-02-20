<?php
     class Model{
          private $db;
          public function __construct() {
               $this->db = new Database;
          }


          public function insert($data) {
               $this->db->query('INSERT INTO models (model, fk_idFolder)
                                   VALUES(:model, :idFolder )');
          
               $this->db->bind(':model', $data["model"]); 
               $this->db->bind(':idFolder', $data["idFolder"]); 
          
               if ($this->db->execute()) {
                    return $this->db->lastinsertid();
               } else {
                    return false;
               }
          }
          
          public function getAllModels(){
               $this->db->query("SELECT * FROM models
                              ORDER BY model ASC");
               $result = $this->db->resultSet();

               return $result;
          }
          
          public function getModelById($id){
               $this->db->query("SELECT * FROM models
                                   WHERE idModel=:id");

                                   
               $this->db->bind(':id', $id); 

               $result = (object)$this->db->single();

               return $result;
          }

          
          public function getModelsByIdFolder($id){
               $this->db->query("SELECT * FROM models
                                   WHERE fk_idFolder=:id");

                                   
               $this->db->bind(':id', $id); 

               $result = $this->db->resultSet();

               return $result;
          }
 
 
  
          

          public function editModel($data){
               $this->db->query("UPDATE models 
                        SET model = :model
                        WHERE idModel = :id;");

               $this->db->bind(":model", $data["model"]);
               $this->db->bind(":id", $data["id"]); 

               if ($this->db->execute()) {
                    return true;
               } else {
                    return false;
               }
          }
          
          public function deleteModelById($id){
               $this->db->query("DELETE FROM models WHERE idModel = :id");
               $this->db->bind(':id', $id); 
          
               if ($this->db->execute()) {
                    return true;
               } else {
                    return false;
               }
          }

         
     }
?>